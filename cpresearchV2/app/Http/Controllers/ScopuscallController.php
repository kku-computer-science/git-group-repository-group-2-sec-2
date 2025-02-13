<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paper;
use App\Models\Source_data;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScopuscallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try{
        //$data = User::all();
        //$data = User::find(46);
        //return $id;
        $id = Crypt::decrypt($id);
        $data = User::find($id);
        //$data = User::role('teacher')->get();
        //return $data;
        //foreach ($data as $name) {

        $fname = substr($data['fname_en'], 0, 1);
        $lname = $data['lname_en'];
        $id    = $data['id'];

        $keyapi = '941c606e597bb9c2631b1da47e05e71e';

        $url = Http::get('https://api.elsevier.com/content/search/scopus?', [
            'query' => "AUTHOR-NAME(" . "$lname" . "," . "$fname" . ")",
            'apikey' => $keyapi,
        ])->json();
 

        if (isset($url['error']) || empty($url)) {
            throw new \Exception('Scopus API ไม่สามารถใช้งานได้');
        }

        $content = $url['search-results']['entry'];

        // dd($url['search-results']['entry']);


        // ตรวจสอบว่าข้อมูลมีปัญหาหรือไม่
        if (empty($content)) {
            throw new \Exception('ไม่พบข้อมูลจาก Scopus API');
        }

        // อัปเดตสถานะ API ว่าใช้งานได้
        $this->updateApiStatus('Scopus API', 'active');

        

        $links = $url["search-results"]["link"];
        //print_r($links);
        do {
            $ref = 'prev';
            foreach ($links as $link) {
                if ($link['@ref'] == 'next') {
                    $link2 = $link['@href'];
                    $link2 = Http::get("$link2")->json();
                    $links = $link2["search-results"]["link"];
                    $nextcontent = $link2["search-results"]["entry"];
                    foreach ($nextcontent as $item) {
                        array_push($content, $item);
                    }
                }
            }
        } while ($ref != 'prev');

        foreach ($content as $item) {
            if (array_key_exists('error', $item)) {
                continue;
            } else {
                if (Paper::where('paper_name', '=', $item['dc:title'])->first() == null) { //เช็คว่ามี paper นี้ในฐานข้อมูลหรือยัง ถ้ามี
                    $scoid = $item['dc:identifier'];
                    $scoid = explode(":", $scoid);
                    $scoid = $scoid[1];

                    $all = Http::get("https://api.elsevier.com/content/abstract/scopus_id/" . $scoid . "?filed=authors&apiKey=". $keyapi ."&httpAccept=application%2Fjson");
                    //$all = Http::get("https://api.crossref.org/works/"."");
                    //$all = Http::get("https://api.crossref.org/works?query.title=" . $item['dc:title'] . "&rows=2");
                    $paper = new Paper;
                    $paper->paper_name = $item['dc:title'];
                    $paper->paper_type = $item['prism:aggregationType'];
                    $paper->paper_subtype = $item['subtypeDescription'];
                    $paper->paper_sourcetitle = $item['prism:publicationName'];

                    //$date = Carbon::createFromFormat('m/d/Y', $item['prism:issueIdentifier'])->format('Y');
                    //$paper->paper_issue=$date;
                    //$paper->paper_issue=$item['prism:issueIdentifier'];
                    $paper->paper_url = $item['link'][2]['@href'];
                    //$paper->paper_yearpub = $item['prism:coverDate'];

                    $date = Carbon::parse($item['prism:coverDate'])->format('Y');
                    //return $date;
                    //$date = $item['prism:coverDate']->format('Y');
                    $paper->paper_yearpub = $date;
                    if (array_key_exists('prism:volume', $item)) {
                        $paper->paper_volume = $item['prism:volume'];
                    } else {
                        $paper->paper_volume = null;
                    }
                    if (array_key_exists('prism:issueIdentifier', $item)) {
                        $paper->paper_issue = $item['prism:issueIdentifier'];
                    } else {
                        $paper->paper_issue = null;
                    }
                    $paper->paper_citation = $item['citedby-count'];
                    $paper->paper_page = $item['prism:pageRange'];

                    if (array_key_exists('prism:doi', $item)) {
                        $paper->paper_doi = $item['prism:doi'];
                    } else {
                        $paper->paper_doi = null;
                    }
                    //return $all['abstracts-retrieval-response']['item']['xocs:meta']['xocs:funding-list'];
                    if (array_key_exists('item', $all['abstracts-retrieval-response'])) {
                        if (array_key_exists('xocs:meta', $all['abstracts-retrieval-response']['item'])) {
                            if (array_key_exists('xocs:funding-text', $all['abstracts-retrieval-response']['item']['xocs:meta']['xocs:funding-list'])) {
                                $funder = $all['abstracts-retrieval-response']['item']['xocs:meta']['xocs:funding-list']['xocs:funding-text'];
                                $paper->paper_funder = json_encode($funder);
                            }else{
                                $paper->paper_funder = null;
                            }
                        }else{
                            $paper->paper_funder = null;
                        }
                        
                        //$paper->paper_funder = $all['abstracts-retrieval-response']['item']['xocs:meta']['xocs:funding-list']['xocs:funding-text'];
                        $paper->abstract = $all['abstracts-retrieval-response']['item']['bibrecord']['head']['abstracts'];
                        //$key = $all['abstracts-retrieval-response']['item']['bibrecord']['head']['citation-info']['author-keywords']['author-keyword'];
                        
                        if (array_key_exists('author-keywords', $all['abstracts-retrieval-response']['item']['bibrecord']['head']['citation-info'])) {
                            $key = $all['abstracts-retrieval-response']['item']['bibrecord']['head']['citation-info']['author-keywords']['author-keyword'];
                            $paper->keyword = json_encode($key);
                            
                        }else{
                            $paper->keyword = null;
                        }
                        
                    } else {
                        $paper->paper_funder = null;
                        $paper->abstract = null;
                        $paper->keyword = null;
                    }


                    $paper->save();

                    $source = Source_data::findOrFail(1);
                    $paper->source()->sync($source);

                    if (!isset($all['abstracts-retrieval-response']['authors']['author'])) {
                        Log::error("No authors found in response for paper: " . $item['dc:title']);
                        continue; // Skip this paper if authors are missing
                    }

                    $all_au = $all['abstracts-retrieval-response']['authors']['author'];
                    $x = 1;
                    $length = count($all_au);
                    foreach ($all_au as $i) {
                            if (array_key_exists('ce:given-name', $i)) {
                                $i['ce:given-name'] = $i['ce:given-name'];
                            }else{
                                $i['ce:given-name'] = $i['preferred-name']['ce:given-name'];
                            }
                            
                        if (User::where([['fname_en', '=', $i['ce:given-name']], ['lname_en', '=', $i['ce:surname']]])->orWhere([[DB::raw("concat(left(fname_en,1),'.')"), '=', $i['ce:given-name']], ['lname_en', '=', $i['ce:surname']]])->first() == null) {  //เช็คว่าคนนี้อยู่ใน user ไหม ถ้าไม่มี 

                            if (Author::where([['author_fname', '=', $i['ce:given-name']], ['author_lname', '=', $i['ce:surname']]])->first() == null) { //เช็คว่ามีชื่อผู้แต่งคนนี้มีหรือยังในฐานข้อมูล ถ้ายังให้
                                //$comp = User::select(DB::raw("concat(left(fname_en,1),'.') as name"))->get();
                                //return $comp;
                                $author = new Author;
                                $author->author_fname = $i['ce:given-name'];
                                $author->author_lname = $i['ce:surname'];
                                $author->save();
                                if ($x === 1) {
                                    $paper->author()->attach($author, ['author_type' => 1]);
                                } else if ($x === $length) {
                                    $paper->author()->attach($author, ['author_type' => 3]);
                                } else {
                                    $paper->author()->attach($author, ['author_type' => 2]);
                                }
                            } else { //ถ้ามีแล้ว
                                $author = Author::where([['author_fname', '=', $i['ce:given-name']], ['author_lname', '=', $i['ce:surname']]])->first();
                                $authorid = $author->id;
                                if ($x === 1) {
                                    $paper->author()->attach($authorid, ['author_type' => 1]);
                                } else if ($x === $length) {
                                    $paper->author()->attach($authorid, ['author_type' => 3]);
                                } else {
                                    $paper->author()->attach($authorid, ['author_type' => 2]);
                                }
                            }
                        } else {
                            $us = User::where([['fname_en', '=', $i['ce:given-name']], ['lname_en', '=', $i['ce:surname']]])->orWhere([[DB::raw("concat(left(fname_en,1),'.')"), '=', $i['ce:given-name']], ['lname_en', '=', $i['ce:surname']]])->first();
                            //return $us->id;
                            //$usid = $us->id;
                            //return 
                            if ($x === 1) {
                                $paper->teacher()->attach($us, ['author_type' => 1]);
                            } else if ($x === $length) {
                                $paper->teacher()->attach($us, ['author_type' => 3]);
                            } else {
                                $paper->teacher()->attach($us, ['author_type' => 2]);
                            }
                        }
                        $x++;
                    }
                
                } else { //ถ้ามี ให้ทำต่อไปนี้
                    $paper = Paper::where('paper_name', '=', $item['dc:title'])->first();
                    $paperid = $paper->id;
                    $user = User::find($id);

                    $hasTask = $user->paper()->where('paper_id', $paperid)->exists(); //เช็คว่า  user คนนี้มี paper นี้หรือยัง ถ้ายังให้
                    if ($hasTask != $paperid) { //ถ้าไม่เท่าให้
                        /*$user = new User;
                            $paper = Paper::find($paperid);
                            $$user->paper()->sync($paper);*/
                        $paper = Paper::find($paperid);
                        $useaut=Author::where([['author_fname', '=', $user->fname_en], ['author_lname', '=', $user->lname_en]])->first();
                        if ($useaut != null) {  
                            $paper->author()->detach($useaut); 
                            $paper->teacher()->attach($id);
                        }else {
                            $paper->teacher()->attach($id);
                        }
                        
                       
                    } else {
                        continue;
                    }
                }
            }
        }
        //}
        return redirect()->back();
        }catch(\Exception $e){
            Log::error("เกิดข้อผิดพลาด: " . $e->getMessage());

            // อัปเดตสถานะ API ว่าไม่สามารถใช้งานได้
            $this->updateApiStatus('Scopus API', 'inactive', $e->getMessage());

            return redirect()->back()->with('error', 'API มีปัญหา: ' . $e->getMessage());
        }
        
    }
    private function updateApiStatus($apiName, $status, $message = null)
{
    $requestData = [
        'api_name' => $apiName,
        'status' => $status,
        'last_checked' => now()->toDateTimeString(),
        'message' => $message,
    ];

    // Log the data for debugging
    Log::info('Updating API status with data:', $requestData);

    // Create an instance of the controller
    $controller = new APIstatusController();

    // Call the updateOrCreate method on the controller instance
    return $controller->updateOrCreate(new \Illuminate\Http\Request($requestData));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $year = range(Carbon::now()->year - 5, Carbon::now()->year);
        $paper = [];
        foreach ($year as $key => $value) {
            $paper[] = Paper::where(DB::raw('(paper_yearpub)'), $value)->count();
        }
        //return $paper;
        return view('test')->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('paper', json_encode($paper, JSON_NUMERIC_CHECK));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
