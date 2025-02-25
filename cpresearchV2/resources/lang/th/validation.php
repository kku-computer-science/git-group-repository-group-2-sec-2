<?php

return [
    'required' => 'The :attribute field is required.',
    'custom' => [
        'department_name_th' => [
            'required' => 'กรุณากรอกชื่อหน่วยงาน (ภาษาไทย)',
        ],
        'department_name_en' => [
            'required' => 'กรุณากรอกชื่อหน่วยงาน (ภาษาอังกฤษ)',
        ],
        'ac_name' => [
            'required' => 'กรุณากรอกชื่อหนังสือ',
        ],
        'ac_year' => [
            'required' => 'กรุณากรอกปีที่พิมพ์ของหนังสือ',
        ],
        'group_name_th' => [
            'required' => 'กรุณากรอกชื่อกลุ่มวิจัย (ภาษาไทย)',
        ],
        'group_name_en' => [
            'required' => 'กรุณากรอกชื่อกลุ่มวิจัย (ภาษาอังกฤษ)',
        ],
        'head' => [
            'required' => 'กรุณาเลือกหัวหน้ากลุ่มวิจัย',
        ],

        //cpresearchV2/resources/views/users/create.blade.php

        'fname_en' => [
            'required' => 'ต้องระบุชื่อจริง (ภาษาอังกฤษ)',
        ],
        'lname_en' => [
            'required' => 'ต้องระบุนามสกุล (ภาษาอังกฤษ)',
        ],
        'fname_th' => [
            'required' => 'ต้องระบุชื่อจริง (ภาษาไทย)',
        ],
        'lname_th' => [
            'required' => 'ต้องระบุนามสกุล (ภาษาไทย)',
        ],
        'email' => [
            'required' => 'ต้องระบุอีเมล',
            'unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
        ],
        'password' => [
            'required' => 'ต้องระบุรหัสผ่าน',
        ],
        'roles' => [
            'required' => 'ต้องเลือกระดับผู้ใช้',
        ],
        'field' => [
            'required' => 'ต้องระบุข้อมูลในช่อง :attribute',
        ],
        //cpresearchV2/app/Http/Controllers/ResearchGroupController.php
        'group_name_th' => ['required' => 'กรุณากรอกชื่อกลุ่มวิจัย (ภาษาไทย)'],
        'group_name_en' => ['required' => 'กรุณากรอกชื่อกลุ่มวิจัย (ภาษาอังกฤษ)'],
        'group_desc_th' => ['required' => 'กรุณากรอกรายละเอียดกลุ่มวิจัย (ภาษาไทย)'],
        'group_desc_en' => ['required' => 'กรุณากรอกรายละเอียดกลุ่มวิจัย (ภาษาอังกฤษ)'],
        'group_detail_th' => ['required' => 'กรุณากรอกรายละเอียดเพิ่มเติมของกลุ่มวิจัย (ภาษาไทย)'],
        'group_detail_en' => ['required' => 'กรุณากรอกรายละเอียดเพิ่มเติมของกลุ่มวิจัย (ภาษาอังกฤษ)'],
        'head' => ['required' => 'กรุณาเลือกหัวหน้ากลุ่มวิจัย'],
        'group_image' => [
            'mimes' => 'รูปภาพต้องเป็นไฟล์ประเภท: png, jpg, jpeg.',
            'max' => 'ขนาดของรูปภาพต้องไม่เกิน 2MB.',
        ],
        
    ],
    'email' => [
        'required' => 'ต้องระบุอีเมล',
        'unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
    ],

    
];
