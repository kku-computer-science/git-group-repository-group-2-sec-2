<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class FundController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $id = auth()->id(); // ดึง ID ของ User ที่ล็อกอิน

        if (auth()->user()->hasRole('admin')) {
            // Admin เห็นทุกงาน
            $funds = Fund::with('user')->get();
        } else {
            // ผู้ใช้ทั่วไปเห็นแค่ของตัวเอง
            $funds = Fund::where('user_id', $id)->get();
        }

        return view('funds.index', compact('funds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fund_name' => 'required',
            'fund_type' => 'required',
            'support_resource' => 'required',
        ], [
            'fund_name.required' => __('validation.fund_name_required'),
            'fund_type.required' => __('validation.fund_type_required'),
            'support_resource.required' => __('validation.support_resource_required'),
        ]);
    //return $request->all();
        //Fund::create($request->all());
        $user = User::find(Auth::user()->id);
        //return $request->all();
        // if($request->has('pos')){
        //     $fund_type = $request->fund_type_etc ;

        // }else{
        //     $fund_type = $request->fund_type;

        // }

        //$fund = $request->all();
        //$fund['fund_type'] = $fund_type;
        //return $fund ;
        $input=$request->all();
        if($request->fund_type == 'ทุนภายนอก'){
            $input['fund_level']=null;
        }
        $user->fund()->Create($input);
        return redirect()->route('funds.index')->with('success', trans('message.fund_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        return view('funds.show',compact('fund'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return $id;
        $fu_id = Crypt::decrypt($id);
        $fund=Fund::find($fu_id);
        $this->authorize('update', $fund);
        return view('funds.edit',compact('fund'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        // ]);
    //return $request->all();
        $input=$request->all();
        if($request->fund_type == 'ทุนภายนอก'){
            $input['fund_level']=null;
        }
        $fund->update($input);
        return redirect()->route('funds.index')->with('success', trans('message.fund_updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        $fund->delete();

        return redirect()->route('funds.index')->with('success', trans('message.fund_deleted'));

    }
}
