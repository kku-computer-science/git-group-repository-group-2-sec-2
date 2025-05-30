<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ResearchProject;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Log;
use App\Models\Fund;
use App\Models\Outsider;

class ResearchProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') || $user->hasRole('staff')) {
            // Admin และ Staff เห็นทุกโครงการ
            $researchProjects = ResearchProject::with('user')->get();
        } elseif ($user->hasRole('headproject')) {
            // Headproject เห็นทั้งโครงการที่เป็นหัวหน้า และโครงการที่มีส่วนร่วม
            $researchProjects = ResearchProject::whereIn('id', function ($query) use ($user) {
                $query->select('research_project_id')
                      ->from('work_of_research_projects')
                      ->where('user_id', $user->id);
            })->get();
        } else {
            // ผู้ใช้ทั่วไป เห็นเฉพาะโครงการที่ตนมีส่วนร่วม
            $researchProjects = ResearchProject::whereIn('id', function ($query) use ($user) {
                $query->select('research_project_id')
                      ->from('work_of_research_projects')
                      ->where('user_id', $user->id);
            })->get();
        }

        return view('research_projects.index', compact('researchProjects'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::role(['teacher', 'student'])->get();
        $funds = Fund::get();
        $deps = Department::get();
        return view('research_projects.create', compact('users', 'funds', 'deps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'project_name' => 'required',
                'budget' => 'required|numeric',
                'project_year' => 'required',
                'fund' => 'required',
                'head' => 'required'
            ],
            [
                'required' => __('validation.required', ['attribute' => ':attribute']),
            ]
        );
        //return $request->fund;
        $fund = Fund::find($request->fund);
        $req = $request->all();
        //return $req;
        //$req['project_year'] = $req['project_year'] - 543;

        $researchProject = $fund->researchProject()->Create($req);
        //$researchProject = $fund->researchProject()->save($fund);
        //$fund = $request->fund;
        //$researchProject = ResearchProject::create($request->all());

        //$researchProject->fund()->create($fund);

        $head = $request->head;
        $researchProject->user()->attach($head, ['role' => 1]);
        //$user=auth()->user();
        //$user=User::find($head);
        //$user->givePermissionTo('editResearchProject','deleteResearchProject');


        if (isset($request->moreFields)) {
            foreach ($request->moreFields as $key => $value) {
                //dd($value);
                if ($value['userid'] != null) {
                    $researchProject->user()->attach($value, ['role' => 2]);
                }
                //$user->givePermissionTo('readResearchProject');
            }
        }
        $input = $request->except(['_token']);
        //$x = 1;
        //return isset($input['fname']);
        //$length = count($request->input('fname'));
        if (isset($input['fname'][0]) and (!empty($input['fname'][0]))){
            foreach ($request->input('fname') as $key => $value) {
                $data['fname'] = $input['fname'][$key];
                $data['lname'] = $input['lname'][$key];
                $data['title_name'] = $input['title_name'][$key];

                if (Outsider::where('fname', '=', $data['fname'])->orWhere('lname', '=', $data['lname'])->first() == null) {
                    $author = new Outsider;
                    $author->fname = $data['fname'];
                    $author->lname = $data['lname'];
                    $author->title_name = $data['title_name'];
                    $author->save();
                    $researchProject->outsider()->attach($author, ['role' => 2]);
                } else {
                    $author = Outsider::where('fname', '=', $data['fname'])->orWhere('lname', '=', $data['lname'])->first();
                    $authorid = $author->id;
                    $researchProject->outsider()->attach($authorid, ['role' => 2]);
                }
                //$x++;
            }
        }


        //$user = User::find(auth()->user()->id);
        //$user->researchProject()->attach(2);

        return redirect()->route('researchProjects.index')->with('success', trans('message.research_project_created'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResearchProject  $researchProject
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchProject $researchProject)
    {
        return view('research_projects.show', compact('researchProject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResearchProject  $researchProject
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchProject $researchProject)
    {

        $researchProject = ResearchProject::find($researchProject->id);
        $this->authorize('update', $researchProject);
        $researchProject = ResearchProject::with(['user'])->where('id', $researchProject->id)->first();


        $users = User::role(['teacher', 'student'])->get();
        $funds = Fund::get();
        $deps = Department::get();
        return view('research_projects.edit', compact('researchProject', 'users', 'funds', 'deps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResearchProject  $researchProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchProject $researchProject)
    {

        $request->validate(
            [
                //'project_name' => 'required|max:200',
                'project_name' => 'required',
                'budget' => 'required|numeric',
                'project_year' => 'required',
                'fund' => 'required',
                //'note' => 'required',
                'head' => 'required'
            ],
            [
                'project_name.required' => 'ต้องใส่ข้อมูล ชื่อโครงการวิจัย',
                'budget.required' => 'ต้องใส่ข้อมูล งบประมาณ',
                'project_year.required' => 'ต้องใส่ข้อมูล ปีที่ปีที่ยื่นขอ',
                'fund.required' => 'ต้องใส่ข้อมูล ทุนวิจัย',
                'head.required' => 'ต้องใส่ข้อมูล ผู้รับผิดชอบโครงการ',

            ]
        );
        $researchProject = ResearchProject::find($researchProject->id);
        $this->authorize('update', $researchProject);
        $req = $request->all();
        //$req['project_year'] = $req['project_year'] - 543;
        $researchProject->update($req);
        $head = $request->head;
        //$researchProject->user()->detach($head);
        //dd($researchProject->user()->get());
        $researchProject->user()->detach();
        $researchProject->user()->attach(array(
            $head => array('role' => 1),
        ));
        //$researchProject->user()->attach($head,['role' => 1]);

        //$researchProject->update($this->validatePost());
        if (isset($request->moreFields)) {
            foreach ($request->moreFields as $key => $value) {
                //dd($value);
                if ($value['userid'] != null) {
                    $researchProject->user()->attach($value, ['role' => 2]);
                }
                //$user->givePermissionTo('readResearchProject');
            }
        }
        $input = $request->except(['_token']);
        //$x = 1;
        //$length = count($request->input('fname'));
        $researchProject->outsider()->detach();
        if (isset($input['fname'][0]) and (!empty($input['fname'][0]))){
            foreach ($request->input('fname') as $key => $value) {
                $data['fname'] = $input['fname'][$key];
                $data['lname'] = $input['lname'][$key];
                $data['title_name'] = $input['title_name'][$key];

                if (Outsider::where([['fname', '=', $data['fname']],['lname', '=', $data['lname']]])->first() == null) {
                    $author = new Outsider;
                    $author->fname = $data['fname'];
                    $author->lname = $data['lname'];
                    $author->title_name = $data['title_name'];
                    $author->save();
                    $researchProject->outsider()->attach($author, ['role' => 2]);
                } else {
                    $author = Outsider::where([['fname', '=', $data['fname']],['lname', '=', $data['lname']]])->first();
                    $authorid = $author->id;
                    $researchProject->outsider()->attach($authorid, ['role' => 2]);
                }
                //$x++;
            }
        }
        return redirect()->route('researchProjects.index')->with('success', trans('message.research_project_updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResearchProject  $researchProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchProject $researchProject)
    {

        $this->authorize('delete', $researchProject);
        $researchProject->delete();
        return redirect()->route('researchProjects.index')->with('success', trans('message.research_project_deleted'));

    }
}
