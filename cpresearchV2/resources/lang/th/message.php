<?php
return [
    // cpresearchV2\resources\views\layouts\layout.blade.php
    'Home'                          => 'หน้าแรก',
    'Researchers'                   => 'ผู้วิจัย',
    'ResearchProj'                  => 'โครงการวิจัย',
    'ResearchGroup'                 => 'กลุ่มวิจัย',
    'Report'                        => 'รายงาน',
    'expertise'                     => 'ความเชี่ยวชาญ',
    'education'                     => 'การศึกษา',
    'publications2'                 => 'ผลงานตีพิมพ์',
    'login'                         => 'เข้าสู่ระบบ',

    // cpresearchV2\resources\views\home.blade.php
    'publications'                  => 'ผลงานตีพิมพ์ (5 ปี ย้อนหลัง)',
    'reference'                     => 'อ้างอิง',
    'before'                        => 'ก่อนหน้า',
    // 'report_total_articles'      => 'รายงานจำนวนบทความทั้งหมด (ย้อนหลัง 5 ปี: รวม)',
    // 'number'                     => 'หมายเลข',

    // cpresearchV2\resources\views\research_proj.blade.php
    'project_service_or_research' => 'โครงการบริการวิชาการ/ โครงการวิจัย',
    'order'                       => 'ลำดับ',
    'year'                        => 'ปี',
    'project_name'                => 'ชื่อโครงการ',
    'details'                     => 'รายละเอียดเพิ่มเติม',
    'project_leader'              => 'ผู้รับผิดชอบโครงการ',
    'status'                      => 'สถานะ',
    'research_fund_type'          => 'ประเภททุนวิจัย',
    'funding_agency'              => 'หน่วยงานที่สนันสนุนทุน',
    'responsible_department'      => 'หน่วยงานที่รับผิดชอบ',
    'allocated_budget'            => 'งบประมาณที่ได้รับจัดสรร',
    'project_duration'            => 'ระยะเวลาโครงการ',
    'to'                          => 'ถึง',
    'closed'                      => 'ปิดโครงการ',
    'currency'                    => 'บาท',

    // cpresearchV2\resources\views\welcome.blade.php
    'welcome_message' => 'ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลวิจัยของสาขาวิชาวิทยาการคอมพิวเตอร์',


    //cpresearchV2/resources/views/funds/index.blade.php
    'fund' => 'ทุนวิจัย',
    'no_dot' => 'ลำดับ',
    'fund_name' => 'ชื่อทุน',
    'fund_type' => 'ประเภททุน',
    'fund_level' => 'ระดับทุน',
    'action' => 'การดำเนินการ',
    'search' => 'ค้นหา',
    'show' => 'แสดง',
    'entries' => 'รายการ',
    'add' => 'เพิ่ม',
    'showing' => 'แสดง',
    'to' => 'ถึง',
    'of' => 'จาก',
    'previous' => 'ก่อนหน้า',
    'next' => 'ถัดไป',

    //cpresearchV2/app/Http/Controllers/FundController.php
    'fund_created' => 'สร้างทุนวิจัยสำเร็จ',
    'fund_updated' => 'อัปเดตทุนวิจัยสำเร็จ',
    'fund_deleted' => 'ลบทุนวิจัยสำเร็จ',

    //cpresearchV2/resources/views/research_projects/index.blade.php
    'research_project' => 'โครงการวิจัย',
    'research_project_year' => 'ปี',
    'research_project_name' => 'ชื่อโครงการ',
    'research_project_head' => 'ผู้รับผิดชอบโครงการ',
    'research_project_member' => 'สมาชิก',

    //cpresearchV2/app/Http/Controllers/ResearchProjectController.php
    'research_project_created' => 'สร้างโครงการวิจัยสำเร็จ',
    'research_project_updated' => 'อัปเดตโครงการวิจัยสำเร็จ',
    'research_project_deleted' => 'ลบโครงการวิจัยสำเร็จ',

    //cpresearchV2/resources/views/research_groups/index.blade.php
    'research_group' => 'กลุ่มวิจัย',
    'research_group_name' => 'ชื่อกลุ่มวิจัย',
    'research_group_head' => 'หัวหน้ากลุ่มวิจัย',
    'research_group_member' => 'สมาชิกกลุ่มวิจัย',

    //cpresearchV2/app/Http/Controllers/ResearchGroupController.php
    'research_group_created' => 'สร้างกลุ่มวิจัยสำเร็จ!',
    'research_group_updated' => 'อัปเดตกลุ่มวิจัยสำเร็จ!',
    'research_group_deleted' => 'ลบกลุ่มวิจัยสำเร็จ!',

    //cpresearchV2/resources/views/papers/index.blade.php
    'published_research' => 'วารผลงานตีพิมพ์',
    'published_research_name' => 'ชื่องานวิจัย',
    'published_research_type' => 'ประเภท',
    'published_research_year' => 'ปีที่ตีพิมพ์',
    'published_research_call_paper' => 'เรียกงานวิจัย',

    //cpresearchV2/app/Http/Controllers/PaperController.php
    'paper_created' => 'สร้างข้อมูลงานวิจัยสำเร็จ',
    'paper_updated' => 'อัปเดตข้อมูลงานวิจัยสำเร็จ',

    //cpresearchV2/resources/views/books/index.blade.php
    'book' => 'หนังสือ',
    'book_name' => 'ชื่อหนังสือ',
    'book_year' => 'ปี',
    'book_source' => 'สถานที่ตีพิมพ์',
    'book_page' => 'หน้า',

    //cpresearchV2/app/Http/Controllers/BookController.php
    'book_created' => 'สร้างข้อมูลหนังสือสำเร็จ',
    'book_updated' => 'อัปเดตข้อมูลหนังสือสำเร็จ',
    'book_deleted' => 'ลบข้อมูลหนังสือสำเร็จ',

    //cpresearchV2/resources/views/patents/index.blade.php
    'patent' => 'ผลงานวิชาการอื่นๆ',
    'patent_name' => 'ชื่อ',
    'patent_type' => 'ประเภท',
    'patent_date' => 'วันที่จดทะเบียน',
    'patent_number' => 'เลขทะเบียน',
    'patent_author' => 'ผู้จัดทำ',

    //cpresearchV2/app/Http/Controllers/PatentController.php
    'patent_created' => 'สร้างสิทธิบัตรสำเร็จ',
    'patent_updated' => 'อัปเดตสิทธิบัตรสำเร็จ',
    'patent_deleted' => 'ลบสิทธิบัตรสำเร็จ',

    //cpresearchV2/resources/views/users/index.blade.php
    'users' => 'ผู้ใช้',
    'user_name' => 'ชื่อ',
    'user_email' => 'อีเมล',
    'user_role' => 'บทบาท',
    'user_department' => 'สาขาวิชา',
    'user_new_user' => 'เพิ่มผู้ใช้ใหม่',
    'user_import_new_user' => 'นำเข้าผู้ใช้ใหม่',

    //cpresearchV2/app/Http/Controllers/UserController.php
    'user_created_successfully' => 'สร้างผู้ใช้สำเร็จ',
    'user_updated_successfully' => 'อัปเดตผู้ใช้สำเร็จ',
    'user_deleted_successfully' => 'ลบผู้ใช้สำเร็จ',
];
