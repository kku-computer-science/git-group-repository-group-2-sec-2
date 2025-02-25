<?php

return [
    'required' => 'The :attribute field is required.',
    'custom' => [
        'department_name_th' => [
            'required' => 'กรุณากรอกชื่อหน่วยงาน (ภาษาไทย)',
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
        ],
        'password' => [
            'required' => 'ต้องระบุรหัสผ่าน',
        ],
        'roles' => [
            'required' => 'ต้องเลือกระดับผู้ใช้',
        ],
    ],
];
