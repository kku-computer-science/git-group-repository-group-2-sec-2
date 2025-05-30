<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ResearcherController extends Controller
{
    public function index()
    {
        //$reshr = User::role('teacher')->orderBy('department_id')->with('Expertise')->get();
        //$reshr = Department::with(['users' => fn($query) => $query->where('fname', 'like', 'wat%')])->get();
        $reshr = Program::with(['users' => fn($query) => $query->role('teacher')->with('expertise')])->where('degree_id', '=', 1)->get();
        //$reshr = Department::with('users')->join('expertises', 'id', '=', 'expertises.user_id')->get();


        //return view('researchers',compact('reshr'));
    }
    public function request($id)
    {
        //$res=User::where('id',$id)->with('paper')->get();
        //User::with(['paper'])->where('id',$id)->get();
        //$paper = User::with(['paper','author'])->where('id',$id)->get();
        $user1 = User::role('teacher')->where('position_th', 'ศ.ดร.')->with('program')->whereHas('program', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user2 = User::role('teacher')->where('position_th', 'รศ.ดร.')->with('program')->whereHas('program', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user3 = User::role('teacher')->where('position_th', 'ผศ.ดร.')->with('program')->whereHas('program', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user4 = User::role('teacher')->where('position_th', 'ศ.')->with('program')->whereHas('program', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user5 = User::role('teacher')->where('position_th', 'รศ.')->with('program')->whereHas('program', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user6 = User::role('teacher')->where('position_th', 'ผศ.')->with('program')->whereHas('program', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user7 = User::role('teacher')->where('position_th', 'อ.ดร.')->with('program')->whereHas('program', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user8 = User::role('teacher')->where('position_th', 'อ.')->with('program')->whereHas('program', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();

        $users = collect([...$user1, ...$user4, ...$user2, ...$user5, ...$user3, ...$user6, ...$user7, ...$user8]);
        //return $users;
        // $request = Program::with(['users' => fn($query) =>
        // //$query->role('teacher')->orderByRaw("FIELD(position_en , 'Prof. Dr.' as 1, 'Assoc. Prof. Dr.' as 2, 'Asst. Prof. Dr.' as 3,'Assoc. Prof.' as 4, 'Asst. Prof.' as 5, 'Dr.' as 6,'Lecturer' as 7) ASC")
        // $query->role('teacher')->orderByRaw("FIELD(position_en , 'Prof. Dr.' , 'Assoc. Prof. Dr.' , 'Asst. Prof. Dr.' ,'Assoc. Prof.' , 'Asst. Prof.' , 'Dr.' ,'Lecturer' )")
        // ->with('expertise')])
        // ->where('degree_id', '=', 1, 'and')->where('id','=',$id)->get();
        $request = Program::where('id', '=', $id)->get();
        // $request = Program::with('users')->whereHas('users', function (Builder $query) {
        //     $query->role('teacher')->where('position_en', '==', 'Prof. Dr.');
        //     });
        //return $request;
        //$user = User::orderByRaw("FIELD(position_en , '	Prof. Dr.', 'Assoc. Prof. Dr.', 'Asst. Prof. Dr.','Assoc. Prof.', 'Asst. Prof.', 'Dr.','Lecturer') ASC");
        //return $request;
        return view('researchers', compact('request', 'users'));
    }
    public function searchs($id, $text)
    {
        // ดึงค่าภาษาในระบบ
        $locale = app()->getLocale();

        // ดึงรายการคำแปล
        $expertise_translations = trans('message.expertise_translation');
        $matching_expertises = [];
        $matching_thai_expertises = [];

        // ค้นหาข้อความในภาษาไทยและภาษาจีน
        foreach ($expertise_translations as $eng => $translation) {
            if (strpos($translation, $text) !== false) {
                $matching_expertises[] = $eng;
            }
            if ($locale == 'th' && strpos($eng, $text) !== false) {
                $matching_thai_expertises[] = $eng;
            }
        }

        // รวมรายการที่พบในภาษาไทยและภาษาจีน
        $matching_expertises = array_unique(array_merge($matching_expertises, $matching_thai_expertises));

        // กำหนดค่าการแปลงชื่อจีนเป็นภาษาอังกฤษ
        $chinese_name_mapping = [
            '范冰冰' => ['Fan Bingbing'],
        ];

        // ตรวจสอบว่าคำค้นหาเป็นภาษาจีนและมีการแมปไปยังชื่ออังกฤษหรือไม่
        $english_names = $chinese_name_mapping[$text] ?? [$text];

        $users = User::whereHas('roles', function ($q) use ($id) {
            $q->where('roles.id', $id);
        })
            ->with('expertise')
            ->where(function ($q) use ($text, $matching_expertises, $locale) {
                if (!empty($matching_expertises)) {
                    $q->whereHas('expertise', function ($q) use ($matching_expertises) {
                        $q->whereIn('expert_name', $matching_expertises);
                    });
                } else {
                    $q->whereHas('expertise', function ($q) use ($text) {
                        $q->where('expert_name', 'LIKE', "%{$text}%");
                    });
                }

                $q->orWhere('fname_th', 'LIKE', "%{$text}%")
                    ->orWhere('lname_th', 'LIKE', "%{$text}%")
                    ->orWhere('fname_en', 'LIKE', "%{$text}%")
                    ->orWhere('lname_en', 'LIKE', "%{$text}%");

                // เงื่อนไขพิเศษสำหรับชื่อ Fan Bingbing เมื่อค้นหาด้วย 范冰冰
                if (preg_match('/[\x{4E00}-\x{9FFF}]/u', $text)) { // ตรวจสอบว่ามีตัวอักษรจีนหรือไม่
                    if (strpos($text, '范冰冰') !== false) {
                        $q->orWhere(function ($subQuery) {
                            $subQuery->where('fname_en', 'Fan')->where('lname_en', 'Bingbing');
                        });
                    }
                }
            })
            ->orderBy('fname_en')
            ->get();

        $request = Role::where('id', $id)->get();
        return view('researchers', compact('request', 'users'));
    }



    public function search($id, Request $request)
    {
        $request = $request->textsearch;
        $a = $this->searchs($id, $request);
        return $a;
    }
    public function requestByRole($id)
    {
        if ($id != 2 && $id != 6 && $id != 7 && $id != 8) {
            $newid = 2;
        } else {
            $newid = $id;
        }

        // Query users with the specified role
        $users = User::whereHas('roles', function ($query) use ($newid) {
            $query->where('roles.id', $newid);
        })->get();

        //$request = Program::where('id','=',$id)->get();
        $request = Role::where('id', $newid)->get();
        // Return the users or pass them to a view
        return view('researchers', compact('request', 'users'));
    }
}
