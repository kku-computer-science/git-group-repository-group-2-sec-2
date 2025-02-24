<?php
return [
    // cpresearchV2\resources\views\layouts\layout.blade.php
    'Home'                         => '首页',
    'Researchers'                  => '研究人员',
    'ResearchProj'                 => '研究项目',
    'ResearchGroup'                => '研究组',
    'Report'                       => '报告',
    'expertise'                    => '专长',
    'education'                    => '教育',
    'publications2'                => '出版物',
    'login'                        => '登录',

    // cpresearchV2\resources\views\home.blade.php
    'publications'                 => '近 5 年出版物',
    'reference'                    => '参考',
    'before'                       => '之前',
    // 'report_total_articles'     => '报告文章总数（5年：累计）',
    // 'number'                    => '编号',

    // cpresearchV2\resources\views\research_proj.blade.php
    'project_service_or_research'  => '学术服务/研究项目',
    'order'                        => '序号',
    'year'                         => '年',
    'project_name'                 => '项目名称',
    'details'                      => '详细信息',
    'project_leader'               => '项目负责人',
    'status'                       => '状态',
    'research_fund_type'           => '研究资助类型',
    'funding_agency'               => '资助机构',
    'responsible_department'       => '责任单位',
    'allocated_budget'             => '分配预算',
    'project_duration'             => '项目时长',
    'to'                           => '至',
    'closed'                       => '已关闭',
    'currency'                     => '泰铢',

    // cpresearchV2\resources\views\welcome.blade.php
    'welcome_message' => '欢迎来到计算机科学系的研究数据管理系统',

    //cpresearchV2/resources/views/funds/index.blade.php
    'fund' => '基金',
    'no_dot' => '不.',
    'fund_name' => '基金名稱',
    'fund_type' => '基金類型',
    'fund_level' => '基金層面',
    'action' => '行動',
    'search' => '搜尋',
    'show' => '展示',
    'entries' => '條目',
    'add' => '添加',
    'showing' => '顯示',
    'to' => '到',
    'of' => '的',
    'previous' => '以前的',
    'next' => '下一個',

    //cpresearchV2/app/Http/Controllers/FundController.php
    'fund_created' => '基金创建成功。',
    'fund_updated' => '基金更新成功。',
    'fund_deleted' => '基金删除成功。',

    //cpresearchV2/resources/views/research_projects/index.blade.php
    'research_project' => '研究項目',
    'research_project_name' => '項目名稱',
    'research_project_year' => '年',
    'research_project_head' => '頭',
    'research_project_member' => '成員',

    //cpresearchV2/app/Http/Controllers/ResearchProjectController.php
    'research_project_created' => '研究项目创建成功。',
    'research_project_updated' => '研究项目更新成功。',
    'research_project_deleted' => '研究项目删除成功。',

    //cpresearchV2/resources/views/research_groups/index.blade.php
    'research_group' => '研究小組',
    'research_group_name' => '組名',
    'research_group_head' => '頭',
    'research_group_member' => '成員',

    //cpresearchV2/app/Http/Controllers/ResearchGroupController.php
    'research_group_created' => '研究小组创建成功!',
    'research_group_updated' => '研究小组更新成功!',
    'research_group_deleted' => '研究小组删除成功!',

    //cpresearchV2/resources/views/papers/index.blade.php
    'published_research' => '已發表的研究',
    'published_research_name' => '論文名稱',
    'published_research_type' => '紙張類型',
    'published_research_year' => '出版年份',
    'published_research_call_paper' => '徵求意見稿',

    //cpresearchV2/app/Http/Controllers/PaperController.php
    'paper_created' => '研究论文创建成功。',
    'paper_updated' => '研究论文更新成功。',

    //cpresearchV2/resources/views/books/index.blade.php
    'book' => '書',
    'book_name' => '書名',
    'book_year' => '年',
    'book_source' => '來源',
    'book_page' => '頁',

    //cpresearchV2/app/Http/Controllers/BookController.php
    'book_created' => '书籍创建成功。',
    'book_updated' => '书籍更新成功。',
    'book_deleted' => '书籍删除成功。',

    //cpresearchV2/resources/views/patents/index.blade.php
    'patent' => '其他學術著作',
    'patent_name' => '姓名',
    'patent_type' => '類型',
    'patent_date' => '註冊日期',
    'patent_number' => '註冊號碼',
    'patent_author' => '作者',

    //cpresearchV2/app/Http/Controllers/PatentController.php
    'patent_created' => '专利创建成功。',
    'patent_updated' => '专利更新成功。',
    'patent_deleted' => '专利删除成功。',

    //cpresearchV2/resources/views/users/index.blade.php
    'users' => '使用者',
    'user_name' => '姓名',
    'user_email' => '電子郵件',
    'user_role' => '角色',
    'user_department' => '部門',
    'user_new_user' => '新用戶',
    'user_import_new_user' => '導入新用戶',

    //cpresearchV2/app/Http/Controllers/UserController.php
    'user_created_successfully' => '用户创建成功。',
    'user_updated_successfully' => '用户更新成功。',
    'user_deleted_successfully' => '用户删除成功。',

    //cpresearchV2/resources/views/roles/index.blade.php
    'roles' => '角色',
    'role_name' => '姓名',

    //cpresearchV2/app/Http/Controllers/RoleController.php
    'role_created' => '角色创建成功。',
    'role_updated' => '角色更新成功。',
    'role_deleted' => '角色删除成功。',


    //cpresearchV2/app/Http/Controllers/RoleController.php
    'permissions' => '權限',
    'permission_name' => '姓名',
    'permission_new' => '新權限',

    //cpresearchV2/app/Http/Controllers/PermissionController.php
    'permission_created' => '权限创建成功。',
    'permission_updated' => '权限更新成功。',
    'permission_deleted' => '权限删除成功。',

    //cpresearchV2/resources/views/departments/index.blade.php
    'departments' => '部門',
    'department_name' => '姓名',
    'department_new' => '新部門',

    //cpresearchV2/app/Http/Controllers/DepartmentController.php
    'department_created' => '部门创建成功。',
    'department_updated' => '部门更新成功。',
    'department_deleted' => '部门删除成功。',

    //cpresearchV2/resources/views/programs/index.blade.php
    'programs' => '程式',
    'program_name' => '姓名',
    'program_degree' => '程度',

    //cpresearchV2/app/Http/Controllers/ProgramController.php
    'program_created' => '课程创建成功。',
    'program_updated' => '课程数据已成功更新。',
    'program_deleted' => '课程已成功删除。',

    //cpresearchV2/resources/views/expertise/index.blade.php
    'expertise' => '專業知識',
    'expertise_name' => '姓名',
    'expertise_teacher_name' => '老師姓名',

    //cpresearchV2/app/Http/Controllers/ExpertiseController.php
    'expertise_created' => '成功创建专长条目。',
    'expertise_updated' => '专长数据更新成功。',
    'expertise_deleted' => '专长已成功删除。',

        //cpresearchV2/resources/views/researchers.blade.php
        'researchers' => '研究人员',
        'researcher_role_teacher' => '教师',
        'researcher_role_undergrad_student' => '本科生',
        'researcher_role_master_student' => '硕士生',
        'researcher_role_doctoral_student' => '博士生',
        'placeholder_research' => '研究兴趣',


        //=========================Mean==============================



    // cpresearchV2/resources/views/research_g.blade.php
    'Research_Group' => '研究小组',
    'Laboratory_Supervisor' => '实验室主管',
    // 'Expertise' => '专业领域',
    'Add_Expertise' => '添加专业领域',
    // 'Course' => '课程',
    'Research_Information_Management_System' => '研究信息管理系统',
    // 'Add_Course' => '添加课程',
    'Research_Group' => '研究小组',
    'Laboratory_Supervisor' => '实验室主管',
    'details' => '详细信息',

    // 研究小组描述
    'group_desc_agt' => '本实验室致力于研究高性能计算的智能技术，该技术模仿自然启发的行为。',
    'group_desc_asc' => '本研究实验室汇集了多个跨学科研究领域，如数据科学与数据分析、数据挖掘、文本挖掘、观点挖掘、商业智能、ERP 系统、IT 管理、语义网、情感分析、图像处理、泛在学习、混合学习以及生物信息学。',

    // cpresearchV2/resources/views/programs/index.blade.php
    'Add_New_Program' => '添加新课程',
    'Education_Level' => '教育水平',
    'Academic_Program' => '学术课程',
    'Name_TH' => '名称 (泰文)',
    'Name_EN' => '名称 (英文)',
    'Submit' => '提交',
    'Cancle' => '取消',

    // cpresearchV2/resources/views/dashboards/users/profile.blade.php
    'Name' => '姓名',
    'Expert_Name' => '专家姓名',

    // cpresearchV2/resources/views/departments/create.blade.php
    'Department_Name_TH' => '系名称 (泰文)',
    'Department_Name_EN' => '系名称 (英文)',
    'Create_Department' => '创建系',
    'Departments' => '系',

    // cpresearchV2/resources/views/books/create.blade.php
    'Add_Book' => '添加书籍',
    'Book_Name' => '书名',
    'Enter_Book_Details' => '输入书籍详细信息',
    'Place_Of_Publication' => '出版地点',
    'Year_(A.D.)' => '出版年份 (公元)',
    'Number_Of_Pages' => '页数',

    // cpresearchV2/resources/views/research_groups/create.blade.php
    'Create_Research_Group' => '创建研究小组',
    'Edit_Research_Group_Details' => '编辑研究小组详情',
    'Research_Group_Name_TH' => '研究小组名称 (泰文)',
    'Research_Group_Name_EN' => '研究小组名称 (英文)',
    'Research_Group_Description_TH' => '研究小组描述 (泰文)',
    'Research_Group_Description_EN' => '研究小组描述 (英文)',
    'Image' => '图片',
    'Research_Group_Leader' => '研究小组负责人',
    'Research_Group_Members' => '研究小组成员',
    'Back' => '返回',

    // cpresearchV2/resources/views/users/create.blade.php
    'Add_User' => '添加用户',
    'Add_User_Details' => '编辑用户详情',
    'First_Name_TH' => '名字 (泰文)',
    'Last_Name_TH' => '姓氏 (泰文)',
    'First_Name_EN' => '名字 (英文)',
    'Last_Name_EN' => '姓氏 (英文)',
    'Email' => '电子邮件',
    'Password' => '密码',
    'Confirm_Password' => '确认密码',
    'Role' => '角色',
    'Department' => '系',
    'Program' => '课程',
    'Select_Subcategory' => '选择子类别',
    'Scholar_ID_(Optional)' => '学者编号 (可选)',

    // cpresearchV2/resources/views/users/import.blade.php
    'Import' => '导入 Excel, CSV 文件',
    'Choose_File' => '选择文件',





//=========================Mean==============================

];





