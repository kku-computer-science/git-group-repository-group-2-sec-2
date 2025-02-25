<?php
return [
    'required' => 'The :attribute field is required.',
    'custom' => [
        'department_name_th' => [
            'required' => '请输入部门名称',
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
        ],
        'password' => [
            'required' => '必须填写密码。',
        ],
        'roles' => [
            'required' => '必须选择用户角色。',
        ],
    ],
];