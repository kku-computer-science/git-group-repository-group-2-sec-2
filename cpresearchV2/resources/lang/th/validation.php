<?php

return [
    'accepted' => 'ต้องยอมรับ :attribute',
    'active_url' => ':attribute ไม่ใช่ URL ที่ถูกต้อง',
    'after' => ':attribute ต้องเป็นวันที่หลังจาก :date',
    'after_or_equal' => ':attribute ต้องเป็นวันที่หลังหรือเท่ากับ :date',
    'alpha' => ':attribute ต้องมีแค่ตัวอักษรเท่านั้น',
    'alpha_dash' => ':attribute ต้องมีแค่ตัวอักษร, ตัวเลข, ขีดกลาง และขีดล่าง',
    'alpha_num' => ':attribute ต้องมีแค่ตัวอักษรและตัวเลข',
    'array' => ':attribute ต้องเป็นอาร์เรย์',
    'before' => ':attribute ต้องเป็นวันที่ก่อน :date',
    'before_or_equal' => ':attribute ต้องเป็นวันที่ก่อนหรือเท่ากับ :date',
    'between' => [
        'numeric' => ':attribute ต้องอยู่ระหว่าง :min และ :max',
        'file' => ':attribute ต้องมีขนาดระหว่าง :min และ :max กิโลไบต์',
        'string' => ':attribute ต้องมีความยาวระหว่าง :min และ :max ตัวอักษร',
        'array' => ':attribute ต้องมีจำนวนรายการระหว่าง :min และ :max',
    ],
    'boolean' => 'ช่อง :attribute ต้องเป็นค่า true หรือ false',
    'confirmed' => ':attribute ไม่ตรงกัน',
    'date' => ':attribute ไม่ใช่วันที่ที่ถูกต้อง',
    'date_equals' => ':attribute ต้องเป็นวันที่เท่ากับ :date',
    'email' => ':attribute ต้องเป็นอีเมลที่ถูกต้อง',
    'exists' => ':attribute ที่เลือกไม่ถูกต้อง',
    'integer' => ':attribute ต้องเป็นจำนวนเต็ม',
    'max' => [
        'numeric' => ':attribute ต้องไม่มากกว่า :max',
        'file' => ':attribute ต้องไม่เกิน :max กิโลไบต์',
        'string' => ':attribute ต้องไม่เกิน :max ตัวอักษร',
        'array' => ':attribute ต้องมีไม่เกิน :max รายการ',
    ],
    'min' => [
        'numeric' => ':attribute ต้องมีค่าอย่างน้อย :min',
        'file' => ':attribute ต้องมีขนาดอย่างน้อย :min กิโลไบต์',
        'string' => ':attribute ต้องมีความยาวอย่างน้อย :min ตัวอักษร',
        'array' => ':attribute ต้องมีอย่างน้อย :min รายการ',
    ],
    'required' => ':attribute จำเป็นต้องกรอก',
    'unique' => ':attribute ถูกใช้ไปแล้ว',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'ข้อความที่กำหนดเอง',
        ],
    ],

    'password' => [
        'old_password_incorrect' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง',
        'enter_current_password' => 'กรุณาใส่รหัสผ่านปัจจุบันของคุณ',
        'enter_new_password' => 'กรุณาใส่รหัสผ่านใหม่ของคุณ',
        'reEnter_password' => 'กรุณาใส่รหัสผ่านใหม่ของคุณอีกครั้ง',
        'oldpass_min' => 'รหัสผ่านปัจจุบันต้องมีอย่างน้อย 8 ตัวอักษร',
        'oldpass_max' => 'รหัสผ่านปัจจุบันต้องไม่เกิน 30 ตัวอักษร',
        'newpass_min' => 'รหัสผ่านใหม่ต้องมีอย่างน้อย 8 ตัวอักษร',
        'newpass_max' => 'รหัสผ่านใหม่ต้องไม่เกิน 30 ตัวอักษร',
        'cnewpass_required' => 'กรุณายืนยันรหัสผ่านใหม่ของคุณ',
        'newpass_same' => 'รหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ต้องตรงกัน',
    ],

    'attributes' => [],

    // create funds
    'required' => 'ต้องระบุช่อง :attribute',
    'attributes' => [
        'fund_name' => 'ชื่อกองทุน',
        'support_resource' => 'แหล่งสนับสนุน',
    ],
    
    // create research project
    'required' => 'ต้องใส่ข้อมูล :attribute',
    'attributes' => [
        'project_name' => 'ชื่อโครงการวิจัย',
        'budget' => 'งบประมาณ',
        'project_year' => 'ปีที่ยื่นขอ',
        'fund' => 'ทุนวิจัย',
        'head' => 'ผู้รับผิดชอบโครงการ',
    ],

    // create roles
    'required' => 'ต้องใส่ข้อมูล :attribute',

    'attributes' => [
        'name' => 'ชื่อ',
        'permission' => 'สิทธิ์การใช้งาน',
    ],
    
    // create permissions
    'required' => 'กรุณากรอก :attribute.',

    'attributes' => [
        'name' => 'ชื่อ',
        'permission' => 'สิทธิ์การใช้งาน',
    ],
];
