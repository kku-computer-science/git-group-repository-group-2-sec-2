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

    'attributes' => [],
];
