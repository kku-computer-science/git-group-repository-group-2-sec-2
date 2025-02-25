<?php
return [
    'required' => 'The :attribute field is required.',
    'custom' => [
        'department_name_th' => [
            'required' => '请输入部门名称（泰语）。',
        ],
        'department_name_en' => [
            'required' => '请输入部门名称（英语）。',
        ],
        'ac_name' => [
            'required' => '请输入书名。',
        ],
        'ac_year' => [
            'required' => '请输入书籍出版年份。',
        ],
        'group_name_th' => [
            'required' => '请填写研究小组名称 (泰文)',
        ],
        'group_name_en' => [
            'required' => '请填写研究小组名称 (英文)',
        ],
        'head' => [
            'required' => '请选择研究小组负责人',
        ],

        //cpresearchV2/resources/views/users/create.blade.php

        'fname_en' => [
            'required' => '必须填写名字 (英文)',
        ],
        'lname_en' => [
            'required' => '必须填写姓氏 (英文)',
        ],
        'fname_th' => [
            'required' => '必须填写名字 (泰文)',
        ],
        'lname_th' => [
            'required' => '必须填写姓氏 (泰文)',
        ],
        'email' => [
            'required' => '必须填写电子邮件地址。',
            'unique' => '此电子邮件已被使用。',
        ],
        'password' => [
            'required' => '必须填写密码。',
        ],
        'roles' => [
            'required' => '必须选择用户角色。',
        ],
        'field' => [
            'required' => ':attribute 字段是必填的。',
        ],
        //cpresearchV2/app/Http/Controllers/ResearchGroupController.php
        'group_name_th' => ['required' => '请输入研究小组名称（泰语）。'],
        'group_name_en' => ['required' => '请输入研究小组名称（英语）。'],
        'group_desc_th' => ['required' => '请输入研究小组描述（泰语）。'],
        'group_desc_en' => ['required' => '请输入研究小组描述（英语）。'],
        'group_detail_th' => ['required' => '请输入研究小组详细信息（泰语）。'],
        'group_detail_en' => ['required' => '请输入研究小组详细信息（英语）。'],
        'head' => ['required' => '请选择研究小组负责人。'],
        'group_image' => [
            'mimes' => '图片必须是以下格式: png, jpg, jpeg。',
            'max' => '图片大小不得超过 2MB。',
        ],
    ],
    'email' => [
        'required' => '必须填写电子邮件地址。',
        'unique' => '此电子邮件已被使用。',
    ],
    
];
