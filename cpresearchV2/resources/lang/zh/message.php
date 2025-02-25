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
    /*P'France ทำการลบ comment ออกเพื่อเอามาใช้*/
    'report_total_articles'     => '报告文章总数（5年：累计）',
    'number'                    => '编号',
    /*P'France เพิ่มเพื่อเอามาใช้ในกราฟหน้า Homepage ส่วนตาราง--ยังไม่มี*/
    'SUMMARY'                      => '摘要',

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

'No.' => '编号',
'Year' => '年份',
'Paper Name' => '论文名称',
'Name' => '名称',
'Authors' => '作者们',
'Author' => '作者',
'Document Type' => '文档类型',
'Page' => '页数',
'Journal' => '期刊',
'Journals/Transactions' => '期刊/交易',
'Citations' => '引用次数',
'Doi' => 'DOI',
'Source' => '来源',
'Summary' => '摘要',
'Book' => '书籍',
'Others' => '其他',
'BookName' => '书名',
'Publication Place' => '出版地点',
'Registration Number' => '注册号',
'Registration Date' => '注册日期',
'First Page' => '第一页',
'Previous Page' => '上一页',
'Next Page' => '下一页',
'Search' => '搜索',
'Showing' => '显示',
'to' => '到',
'of' => '的',
'entries' => '条目',
'No data available in table' => '表中无可用数据',
'filtered from' => '筛选自',
'Processing...' => '处理中...',
'Export to Excel' => '导出到 Excel',


// http://127.0.0.1:8000/permissions/create
'Create Permission' => '创建权限',
'Permission Name' => '权限名称',
'Permission' => '权限',
'Submit' => '提交',

// http://127.0.0.1:8000/users/create
'Create User' => '创建用户',
'Fill in the form below to create a new user' => '请填写以下表格以创建新用户',
'First Name (Thai)' => '名字 (泰文)',
'Last Name (Thai)' => '姓氏 (泰文)',
'First Name (English)' => '名字 (英文)',
'Last Name (English)' => '姓氏 (英文)',
'Email' => '电子邮件',
'Password' => '密码',
'Confirm Password' => '确认密码',
'Role' => '角色',
'Department' => '部门',
'Program' => '项目',
'Optional' => '可选',
'Select' => '选择',
'Enter' => '输入',
'Cancel' => '取消',
'Oops' => '哎呀',
'Something went wrong, please check below errors' => '发生错误，请检查以下错误',

// http://127.0.0.1:8000/importfiles
'Import Excel, CSV File' => '导入 Excel, CSV 文件',
'Choose File' => '选择文件',
'No file chosen' => '未选择文件',

// http://127.0.0.1:8000/roles/create
'Create Role' => '创建角色',
'Role Name' => '角色名称',
'Roles' => '角色',
'Role' => '角色',
'Permission' => '权限',

// http://127.0.0.1:8000/funds/create
'Fund Name' => '基金名称',
'Whoops!' => '哎呀!',
'There were some problems with your input.' => '您的输入存在一些问题。',
'Add Research Fund' => '添加研究基金',
'Fill in the form below to add a new research fund' => '请填写以下表格以添加新的研究基金',
'Research Fund Type' => '研究基金类型',
'Please specify the type of fund' => '请指定基金类型',
'Internal Fund' => '内部基金',
'External Fund' => '外部基金',
'Research Fund Level' => '研究基金级别',
'Please specify the level of fund' => '请指定基金级别',
'Funding Level' => '资助级别',
'Not Specified' => '未指定',
'High' => '高',
'Medium' => '中',
'Low' => '低',
'Supporting Agency / Research Project' => '资助机构 / 研究项目',
'Support Resource' => '支持资源',

// http://127.0.0.1:8000/patents/create
'Add Academic Work' => '添加学术作品',
'Fill in the form below to add a new academic work' => '请填写以下表单以添加新的学术作品',
'Academic Work Name' => '学术作品名称',
'Name' => '名称',
'Type' => '类型',
'Please specify the type' => '请指定类型',
'Patent' => '专利',
'Patent (Invention)' => '专利（发明）',
'Patent (Design)' => '专利（设计）',
'Petty Patent' => '小专利',
'Copyright' => '版权',
'Copyright (Literature)' => '版权（文学）',
'Copyright (Music)' => '版权（音乐）',
'Copyright (Film)' => '版权（电影）',
'Copyright (Art)' => '版权（艺术）',
'Copyright (Broadcast)' => '版权（广播）',
'Copyright (Audiovisual)' => '版权（视听）',
'Copyright (Other)' => '版权（其他）',
'Copyright (Sound Recording)' => '版权（录音）',
'Other' => '其他',
'Trade Secret' => '商业秘密',
'Trademark' => '商标',
'Copyright Date' => '版权日期',
'Registration Number' => '注册号',
'Internal Authors' => '内部作者',
'External Authors' => '外部作者',
'First Name' => '名字',
'Last Name' => '姓氏',
'Add More Person' => '添加更多人员',
'Sorry! Can\'t remove first row!' => '对不起！无法删除第一行！',
'Enter your Name' => '输入您的姓名',
'Select User' => '选择用户',
'Submit' => '提交',
'Cancel' => '取消',
'Whoops' => '哎呀',
'There were some problems with your input' => '您的输入有一些问题',

// http://127.0.0.1:8000/papers/create
'Please specify the source' => '请指定来源',
'Add Paper' => '添加论文',
'Fill in the form below to add a new paper' => '请填写以下表单以添加新的论文',
'Keyword' => '关键词',
'Keyword Instruction' => '请用逗号分隔输入关键词。',
'Paper Type' => '论文类型',
'Please specify the type' => '请指定类型',
'Journal' => '期刊',
'Abstract' => '摘要',
'Conference Proceeding' => '会议论文',
'Book Series' => '丛书',
'Book' => '书籍',
'Paper Subtype' => '论文子类型',
'Please specify the subtype' => '请指定子类型',
'Article' => '文章',
'Conference Paper' => '会议论文',
'Editorial' => '社论',
'Book Chapter' => '书籍章节',
'Erratum' => '勘误',
'Review' => '评论',
'Publication' => '出版物',
'Please specify the publication' => '请指定出版物',
'International Journal' => '国际期刊',
'International Book' => '国际书籍',
'International Conference' => '国际会议',
'National Conference' => '国内会议',
'National Journal' => '国内期刊',
'National Book' => '国内书籍',
'National Magazine' => '国内杂志',
'Source Title' => '来源标题',
'Year Published' => '出版年份',
'Funder' => '资助方',
'URL' => '网址',
'First Author' => '第一作者',
'Co-Author' => '合著者',
'Corresponding Author' => '通讯作者',
'Issue Number' => '期号',
'Citation' => '引用',
'Volume' => '卷',
'Submit' => '提交',
'Cancel' => '取消',

// http://127.0.0.1:8000/researchProjects/create
'Whoops' => '哎呀',
'There were some problems with your input' => '您的输入有一些问题',
'Add Research Project' => '添加研究项目',
'Fill in the form below to add a new research project' => '请填写以下表单以添加新的研究项目',
'Project Name' => '项目名称',
'Start Date' => '开始日期',
'End Date' => '结束日期',
'Select Fund' => '选择基金',
'Project Year' => '项目年度',
'Budget' => '预算',
'Responsible Department' => '负责部门',
'Select Department' => '选择部门',
'Project Details' => '项目详情',
'Note' => '备注',
'Status' => '状态',
'Select Status' => '选择状态',
'Submitted' => '已提交',
'In Progress' => '进行中',
'Closed' => '已关闭',
'Project Leader' => '项目负责人',
'Select User' => '选择用户',
'Internal Co-Leader' => '内部联合负责人',
'External Co-Leader' => '外部联合负责人',
'Title' => '标题',
'First Name' => '名字',
'Last Name' => '姓氏',
'Add More Person' => '添加更多人员',
'Record Inserted Successfully' => '记录插入成功',
'Sorry! Cannot remove first row!' => '对不起！无法删除第一行！',
'Invalid Date Range' => '无效的日期范围',

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
    'empty_table' => '表中没有可用数据',
    'zero_record' => '未找到匹配的记录',
    'from' => '從',
    'filtered' => '已過濾',
    'total' => '總',


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
    'Edit_Program' => '編輯程式',

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







    // cpresearchV2\resources\views\users\show.blade.php
    'user_info'      => '用户信息',
    'user_details'   => '用户详细信息',
    'name_th'        => '姓名 (泰语)',
    'name_en'        => '姓名 (英语)',
    'email'          => '電子郵件',
    'role'           => '角色',
    'password'       => '密码',
    'back'           => '返回',
    'academic_ranks'   => '学术职称',
    'department'       => '系',
    'program'          => '专业',
    'education_history' => '教育背景',

    // cpresearchV2\resources\views\roles\show.blade.php
    'roles'         => '角色',
    'details_info'  => '详细信息',
    'name'          => '名称',
    'permissions'   => '权限',
    'back'          => '返回',

    // cpresearchV2\resources\views\books\show.blade.php
    'book_detail'         => '图书详情',
    'book_detail_info'    => '图书详细信息',
    'book_name'           => '书名',
    'book_year'           => '年份',
    'book_publisher'      => '出版社',
    'book_page'           => '页',
    'back'                => '返回',

    // cpresearchV2\resources\views\funds\show.blade.php
    'fund_detail'         => '基金详情',
    'fund_detail_info'    => '基金详情信息',
    'fund_name'           => '基金名称',
    'year'                => '年份',
    'fund_description'    => '基金描述',
    'fund_type'           => '基金类型',
    'fund_level'          => '基金级别',
    'agency'              => '机构',
    'added_by'            => '添加者',

    // cpresearchV2\resources\views\papers\show.blade.php
    'journal_detail'         => '期刊详情',
    'journal_detail_info'    => '期刊详细信息',
    'title'                  => '标题',
    'abstract'               => '摘要',
    'keyword'                => '关键词',
    'journal_type'           => '期刊类型',
    'document_type'          => '文档类型',
    'publication'            => '出版物',
    'author'                 => '作者',
    'first_author'           => '第一作者',
    'co_author'              => '共同作者',
    'corresponding_author'   => '通讯作者',
    'source_title'           => '期刊名称',
    'publication_year'       => '出版年份',
    'volume'                 => '卷',
    'issue'                  => '期',
    'page_number'            => '页码',
    'doi'                    => 'DOI',
    // 'url'                    => '网址',

    // cpresearchV2\resources\views\patents\show.blade.php
    'other_academic_works'      => '其他学术成果（专利、专利申请、版权）',
    'other_academic_works_info' => '其他学术成果详细信息（专利、专利申请、版权）',
    'name'                      => '名称',
    'type'                      => '类型',
    'registration_date'         => '注册日期',
    'registration_number'       => '注册号码',
    'prepared_by'               => '编制者',
    'prepared_by_co'            => '共同编制',
    'number'                    => '编号',

    // cpresearchV2\resources\views\research_projects\show.blade.php
    'research_projects_detail'       => '研究项目详情',
    'research_projects_detail_info'  => '研究项目详细信息',
    'project_name'                   => '项目名称',
    'project_start_date'             => '项目开始日期',
    'project_end_date'               => '项目结束日期',
    'research_funding_source'        => '研究资金来源',
    'amount'                         => '金额',
    'project_details'                => '项目详情',
    'project_status'                 => '项目状态',
    'project_leader'                 => '项目负责人',
    'project_members'                => '项目成员',
    'requested'                      => '申请中',
    'in_progress'                    => '进行中',
    'closed'                         => '已关闭',

    // cpresearchV2\resources\views\research_groups\show.blade.php
    'research_group_detail'            => '研究小组详情',
    'research_group_detail_info'       => '研究小组详细信息',
    'research_group_name_th'           => '研究小组名称 (泰语)',
    'research_group_name_en'           => '研究小组名称 (英语)',
    'research_group_description_th'    => '研究小组描述 (泰语)',
    'research_group_description_en'    => '研究小组描述 (英语)',
    'research_group_details_th'        => '研究小组详情 (泰语)',
    'research_group_details_en'        => '研究小组详情 (英语)',
    'research_group_leader'            => '研究小组负责人',
    'research_group_members'           => '研究小组成员',

    // cpresearchV2\resources\views\departments\show.blade.php
    'department'          => '系',
    'department_name_th'  => '系名称 (泰语)',
    'department_name_en'  => '系名称 (英语)',

    // cpresearchV2\resources\views\permissions\show.blade.php
    'permission'                    => '权限',
    'name'                          => '名称',

    //cpresearchV2\resources\views\researchgroupdetail.blade.php
    'laboratory_supervisor' => '实验室主管',
    'student'               => '学生',
    // cpresearchV2\resources\views\dashboards\users\layouts\user-dash-layout.blade.php
    'search' => '搜索',
    'logout' => '登出',
    'header' => '研究信息管理系统',
    'dashboard' => '仪表板',
    'profile' => '用户资料',
    'option' => '选项',
    'manage_fund' => '管理研究经费',
    'project' => '管理研究项目',
    'group' => '管理研究组',
    'manage_publication' => '管理出版物',
    'research' => '已发表研究',
    'book' => '书籍',
    'patent' => '其他学术作品',
    'admin' => '管理员',
    'user' => '用户',
    'role' => '角色',
    'permission' => '权限',
    'department' => '部门',
    'manage_program' => '管理项目',
    'expertise_menu' => '管理专长',
    'api'  => '研究 API',

    //cpresearchV2\resources\views\auth\login.blade.php
    'login_failed' => '登录失败！请检查您的用户名和密码。',
    'account_login' => '账户登录',
    'username'      => '用户名',
    'password'      => '密码',
    'remember_me'   => '记住我',
    'login'         => '登录',
    'forgot_password' => '如果您忘记了密码，请
    联系管理员。',
    'username_login' => '对于用户名，请使用 KKU-Mail 登录。',
    'username_student' => '首次登录的学生，请使用学号登录。',
    // cpresearchV2\resources\views\report.blade.php
    'stat_5years' => '过去 5 年文章总数统计',
    'stat_citation' => '引用文章统计',

    // cpresearchV2\resources\views\dashboards\users\index.blade.php
    'greeting' => '你好,:position :fname :lname!',

    // cpresearchV2\resources\views\dashboards\users\profile.blade.php
    'change_pic' => '更改图片',
    'account' => '账户',
    'password' => '密码',
    'expertise' => '专长',
    'education' => '教育',
    'profile_setting' => '个人资料设置',
    'academic_rank' => '学术职称',
    'professor' => '教授',
    'associate_professor' => '副教授',
    'assistant_professor' => '助理教授',
    'lecturer' => '讲师',
    'name_title' => '姓名标题',
    'mr' => 'Mr.',
    'mrs' => 'Mrs.',
    'miss' => 'Miss',
    'fname_en' => '名字（英语）',
    'lname_en' => '姓氏（英语）',
    'fname_th' => '名字（泰语）',
    'lname_th' => '姓氏（泰语）',
    'email' => '电子邮件',
    'addition_profile' => '对于没有博士学位的讲师，请指定。',
    'update_picture' => '更新图片',
    'update_picutre_success' => '图片更新成功！',
    'update' => '更新',
    'password_setting' => '密码设置',
    'old_password' => '旧密码',
    'enter_current_password' => '输入您的当前密码',
    'enter_new_password' => '输入您的新密码',
    'enter_confirm_password' => '输入您的确认密码',
    'update_password' => '更新密码',
    'update_password_success' => '密码更新成功！',
    'new_password' => '新密码',
    'renew_password' => '重新输入新密码',
    'confirm_password' => '确认新密码',
    'add_expertise' => '添加专长',
    'edit_expertise' => '编辑专长',
    'name_expertise' => '专长名称',
    'expertise_holder' => '输入您的专长',
    'submit_button' => '提交',
    'cancel_button' => '取消',
    'update_info'   => '更新信息',
    'update_success' => '成功！',
    'update_error' => '哎呀！',
    'update_error_text' => '您的输入有一些问题。',
    'delete_title' => '你确定吗？',
    'delete_text' => '您将无法恢复此数据！',
    'delete_error' => '哎呀！',
    'try_again' => '您的输入有一些问题。',
    'delete_success' => '成功！',
    'education_background' => '教育背景',
    'bachelor_degree' => '学士学位',
    'master_degree' => '硕士学位',
    'doctoral_degree' => '博士学位',
    'university_name' => '大学名称',
    'academic_degree' => '学位',
    'year_of_graduation' => '毕业年份',

    // cpresearchv2\resources\views\departments\edit.blade.php
    'edit_department' => '编辑系',
    'department_name_th' => '系名称 (泰文)',
    'department_name_en' => '系名称 (英文)',
    'department_name_th_holder' => '输入系名称 (泰文)',
    'department_name_en_holder' => '输入系名称 (英文)',

    // cpresearchv2\resources\views\users\edit.blade.php
    'edit_user' => '编辑用户',
    'edit_user_details' => '编辑详细信息',
    'edit_user_status' => '编辑状态',
    'edit_user_studying' => '正在学习',
    'edit_user_graduated' => '毕业',
    'edit_user_schorlarID_holder' => '输入 Scholar ID',

    // cpresearchv2\resources\views\funds\edit.blade.php
    'edit_fund' => '编辑基金',
    'edit_fund_details' => '编辑基金详细信息',
    'Research Fund Type' => '研究资助类型',
    'Internal Fund' => '内部基金',
    'External Fund' => '外部基金',
    'Not Specified' => '未指定',
    'High' => '高',
    'Medium' => '中',
    'Low' => '低',
    'Funding Level' => '资助级别',
    'Fund Name' => '基金名称',
    'Supporting Agency / Research Project' => '支持机构/研究项目',

    // cpresearchv2\resources\views\research_groups\edit.blade.php
    'edit_research_group' => '编辑研究小组',
    'edit_research_group_details' => '编辑研究小组详细信息',
    'research_group_description_th' => '研究小组描述 (泰文)',
    'research_group_description_en' => '研究小组描述 (英文)',
    'research_group_detail_th' => '研究小组详细信息 (泰文)',
    'research_group_detail_en' => '研究小组详细信息 (英文)',
    'Whoops' => '哎呀！',
    'There were some problems with your input' => '您的输入有一些问题。',
    'research_group_leader' => '编辑研究小组负责人',

    // cpresearchV2\resources\views\books\edit.blade.php
    "edit_book_details" => "编辑书籍详情",
    "enter_book_details" => "输入书籍详细信息",
    "book_title" => "书名",
    "book_publisher" => "出版社",
    "publication_year" => "出版年份（佛历）",
    "number_of_pages" => "页数",
    "submit" => "提交",
    "cancel" => "取消",

    // cpresearchV2\resources\views\patents\edit.blade.php
    "patents_edit_details" => "编辑详情",
    "patents_enter_details" => "输入版权详细信息",
    "patents_name" => "名称",
    "patents_type" => "类型",
    "date_of_rights" => "获得权利的日期",
    "registration_number" => "注册号",
    "internal_professors" => "内部教授",
    "add_professor" => "添加教授",
    "select_user" => "选择用户",
    "external_persons" => "外部人员",
    "add_person" => "添加人员",
    "first_name" => "名字",
    "last_name" => "姓氏",
    "enter_name" => "输入您的名字",
    "remove" => "移除",
    "submit" => "提交",
    "cancel" => "取消",

    //  cpresearchV2\resources\views\roles\edit.blade.php
    'edit_role' => "编辑角色",
    'role_name' => "角色名称",
    'permission' => "允许",
    'back' => "后退",

    // cpresearchV2\resources\views\permissions\edit.blade.php
    'edit_permission' => "编辑权限",
    'permission_name' => "权限名称",

    // cpresearchV2\resources\views\users\edit.blade.php
    'edit_user_data' => "编辑用户数据",
    'edit_user_details' => "填写编辑用户详细信息",
    'first_name_th' => "名字 (泰语)",
    'last_name_th' => "姓氏 (泰语)",
    'first_name_en' => "名字 (英语)",
    'last_name_en' => "姓氏 (英语)",
    'email' => "电子邮件",
    'password' => "密码",
    'confirm_password' => "确认密码",
    'role' => "角色",
    'status' => "状态",
    'department' => "部门",
    'program' => "课程",

    // API Status Page
    'api_status' => 'API 状态',
    'api_name' => 'API 名称',
    'status' => '状态',
    'last_checked' => '最后检查',
    'message' => '消息',
    'active' => '活跃',
    'inactive' => '未激活',

    // Highlight Page
    'highlight' => '亮点',
    'welcome_higlight' => '欢迎来到亮点页面。请创建您引以为豪的亮点。',

    // Assistant Researcher Page
    'assistant_researcher' => '研究助理',
    'assistant_wanted' => '招聘研究助理',
    'assistant_welcome' => '欢迎来到研究助理招聘页面。本页面专门用于帮助项目负责人寻找研究相关任务的助手。',

    //Certificate Form Page
    'certificate_form' => '证书表单',
    'welcome_certificate' => '欢迎来到证书表单页面。请继续提交您的信息。',

    // Navbar
    'for_student' => '适用于学生',
    'for_head' => '适用于项目负责人',
    'for_staff' => '适用于工作人员',
    'research_API' => '研究 API',

    // cpresearchV2\resources\views\research_proj.blade.php
    'research_proj_head' => '学术服务项目/ 研究项目',
    'proj_name' => '项目名称',
    'desc' => '描述',
    'proj_lead' => '项目负责人',
    'proj_duration' => '项目周期',
    'proj_type' => '项目类型',
    'fund_agency' => '资助机构',
    'res_agency' => '负责机构',
    'alloc_budget' => '分配预算',
    'proj_closed' => '已结项目',
    'proj_req' => '请求',
    'proj_op' => '运行中',
];
