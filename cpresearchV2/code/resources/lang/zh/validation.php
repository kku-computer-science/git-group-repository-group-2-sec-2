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


    'required_field' => '此字段是必填的',
    'attributes' => [],

    // create funds
    'required' => ':attribute 字段是必填的。',
    'attributes' => [
        'fund_name' => '基金名称',
        'support_resource' => '支持资源',
    ],

    'required' => '必须填写 :attribute。',
    'fund_name_required' => '请填写基金名称。',
    'fund_type_required' => '请填写基金类型。',
    'support_resource_required' => '请填写支持资源。',

    // create research project
    'required' => '必须填写 :attribute。',
    'attributes' => [
        'project_name' => '研究项目名称',
        'budget' => '预算',
        'project_year' => '申请年份',
        'fund' => '研究基金',
        'head' => '项目负责人',
    ],

    // create roles
    'required' => ':attribute 是必填字段。',

    'attributes' => [
        'name' => '名称',
        'permission' => '权限',
    ],

    //create permissions
    'required' => '请输入:attribute。',

    'attributes' => [
        'name' => '名称',
        'permission' => '权限',
    ],

    'required' => 'The :attribute field is required.',

    'custom' => [
        'fund_name' => [
            'required' => [
                'en' => 'The fund name field is required.',
                'th' => 'กรุณากรอกชื่อกองทุนวิจัย',
                'zh' => '请填写基金名称。',
            ],
        ],
        'support_resource' => [
            'required' => [
                'en' => 'The support resource field is required.',
                'th' => 'กรุณากรอกแหล่งสนับสนุน',
                'zh' => '请填写支持资源。',
            ],
        ],
    ],
];
