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
];
