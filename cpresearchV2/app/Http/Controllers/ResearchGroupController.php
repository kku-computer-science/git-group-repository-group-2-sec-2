<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ResearchGroup;
use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // เพิ่มเข้ามา


class ResearchGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:groups-list|groups-create|groups-edit|groups-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:groups-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:groups-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:groups-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user(); // ดึงข้อมูล User ที่ล็อกอินอยู่

        // ดึงเฉพาะกลุ่มวิจัยที่ผู้ใช้เป็นสมาชิก
        $researchGroups = ResearchGroup::whereHas('user', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->with('User')->get();

        return view('research_groups.index', compact('researchGroups'));
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
        return view('research_groups.create', compact('users', 'funds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 🔹 Validate ข้อมูล พร้อมรองรับการแสดงผลหลายภาษา
        $request->validate([
            'group_name_th' => 'required',
            'group_name_en' => 'required',
            'group_desc_th' => 'required',
            'group_desc_en' => 'required',
            'group_detail_th' => 'required',
            'group_detail_en' => 'required',
            'head' => 'required',
            'group_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ], [
            'group_name_th.required' => trans('validation.custom.group_name_th.required'),
            'group_name_en.required' => trans('validation.custom.group_name_en.required'),
            'group_desc_th.required' => trans('validation.custom.group_desc_th.required'),
            'group_desc_en.required' => trans('validation.custom.group_desc_en.required'),
            'group_detail_th.required' => trans('validation.custom.group_detail_th.required'),
            'group_detail_en.required' => trans('validation.custom.group_detail_en.required'),
            'head.required' => trans('validation.custom.head.required'),
            'group_image.mimes' => trans('validation.custom.group_image.mimes'),
            'group_image.max' => trans('validation.custom.group_image.max'),
        ]);

        // 🔹 รับค่าข้อมูลทั้งหมด
        $input = $request->all();

        // 🔹 จัดการไฟล์รูปภาพ
        if ($request->hasFile('group_image')) {
            $input['group_image'] = time() . '.' . $request->group_image->extension();
            $request->group_image->move(public_path('img'), $input['group_image']);
        }

        // 🔹 บันทึกข้อมูลลงฐานข้อมูล
        $researchGroup = ResearchGroup::create($input);

        // 🔹 กำหนดหัวหน้ากลุ่มวิจัย (Role = 1)
        $head = $request->head;
        $researchGroup->user()->attach($head, ['role' => 1]);

        // 🔹 เพิ่มสมาชิกเพิ่มเติม (Role = 2)
        if ($request->moreFields) {
            foreach ($request->moreFields as $key => $value) {
                if (!empty($value['userid'])) {
                    $researchGroup->user()->attach($value['userid'], ['role' => 2]);
                }
            }
        }

        // 🔹 ส่งกลับไปยังหน้าแสดงรายการ พร้อมข้อความสำเร็จ
        return redirect()->route('researchGroups.index')
            ->with('success', trans('message.research_group_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fund  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchGroup $researchGroup)
    {
        #$researchGroup=ResearchGroup::find($researchGroup->id);
        //dd($researchGroup->id);
        //$data=ResearchGroup::find($researchGroup->id)->get(); 

        //return $data;
        return view('research_groups.show', compact('researchGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fund  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchGroup $researchGroup)
    {
        $researchGroup = ResearchGroup::find($researchGroup->id);
        $this->authorize('update', $researchGroup);
        $researchGroup = ResearchGroup::with(['user'])->where('id', $researchGroup->id)->first();
        $users = User::get();
        //return $users;
        return view('research_groups.edit', compact('researchGroup', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchGroup  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchGroup $researchGroup)
    {
        $request->validate([
            'group_name_th' => 'required',
            'group_name_en' => 'required',

        ]);
        $input = $request->all();
        if ($request->group_image) {
            //dd($request->file('group_image'));
            $input['group_image'] = time() . '.' . $request->group_image->extension();
            //$file = $request->file('image');

            //$url = Storage::putFileAs('images', $file, $name . '.' . $file->extension());
            //dd($input['group_image']);
            $request->group_image->move(public_path('img'), $input['group_image']);
        }
        $researchGroup->update($input);
        $head = $request->head;
        $researchGroup->user()->detach();
        $researchGroup->user()->attach(array(
            $head => array('role' => 1),
        ));

        if ($request->moreFields) {
            foreach ($request->moreFields as $key => $value) {

                if ($value['userid'] != null) {
                    $researchGroup->user()->attach($value, ['role' => 2]);
                }
            }
        }
        return redirect()->route('researchGroups.index')
            ->with('success', 'researchGroups updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fund  $researchGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchGroup $researchGroup)
    {
        $this->authorize('delete', $researchGroup);
        $researchGroup->delete();
        return redirect()->route('researchGroups.index')
            ->with('success', 'researchGroups deleted successfully');
    }
}
