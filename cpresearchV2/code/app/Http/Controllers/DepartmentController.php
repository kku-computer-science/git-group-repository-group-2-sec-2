<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:departments-list|departments-create|departments-edit|departments-delete', ['only' => ['index','store']]);
         $this->middleware('permission:departments-create', ['only' => ['create','store']]);
         $this->middleware('permission:departments-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:departments-delete', ['only' => ['destroy']]);
         //Redirect::to('dashboard')->send();
    }

    public function index(Request $request)
    {
        $data = Department::latest()->paginate(5);

        return view('departments.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลด้วย Laravel Validation
        $request->validate([
            'department_name_th' => 'required',
            'department_name_en' => 'required',
            'department_name_zh' => 'nullable',
        ], [
            'department_name_th.required' => trans('validation.custom.department_name_th.required'),
            'department_name_en.required' => trans('validation.custom.department_name_en.required'),
        ]);

        // ดึงข้อมูลจาก request ยกเว้น _token
        $input = $request->except(['_token']);

        // บันทึกข้อมูลลงในฐานข้อมูล
        Department::create($input);

        // ส่งกลับไปยังหน้า departments.index พร้อมข้อความสำเร็จที่รองรับหลายภาษา
        return redirect()->route('departments.index')
            ->with('success', trans('message.department_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('departments.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $department=Department::find($department->id);

        return view('departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        return redirect()->route('departments.index')
                        ->with('success',trans('message.department_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')
                        ->with('success',trans('message.department_deleted'));
    }
}
