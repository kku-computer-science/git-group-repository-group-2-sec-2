<?php
return [
    // cpresearchV2\resources\views\layouts\layout.blade.php
    'Home'                          => 'Home',
    'Researchers'                   => 'Researchers',
    'ResearchProj'                  => 'Research Project',
    'ResearchGroup'                 => 'Research Group',
    'Report'                        => 'Reports',
    'expertise'                     => 'Research interests',
    'education'                     => 'Education',
    'publications2'                 => 'Publications',
    'login'                         => 'Login',

    // cpresearchV2\resources\views\home.blade.php
    'publications'                  => 'Publications (In the Last 5 Years)',
    'reference'                     => 'Reference',
    'before'                        => 'Before',
    // 'report_total_articles'      => 'Report the total number of articles (5 years: cumulative)',
    // 'number'                     => 'Number',

    // cpresearchV2\resources\views\research_proj.blade.php
    'project_service_or_research'   => 'Academic Service/ Research Project',
    'order'                         => 'No.',
    'year'                          => 'Year',
    'project_name'                  => 'Project Name',
    'details'                       => 'More details',
    'project_leader'                => 'Project Leader',
    'status'                        => 'Status',
    'research_fund_type'            => 'Research Fund Type',
    'funding_agency'                => 'Funding Agency',
    'responsible_department'        => 'Responsible Department',
    'allocated_budget'              => 'Allocated Budget',
    'project_duration'              => 'Project Duration',
    'to'                            => 'to',
    'closed'                        => 'Closed',
    'currency'                      => 'Baht',


    // cpresearchV2\resources\views\welcome.blade.php
    'welcome_message' => 'Welcome to the research data management system of the Department of Computer Science',

    //cpresearchV2/resources/views/funds/index.blade.php
    'fund' => 'fund',
    'no_dot' => 'No.',
    'fund_name' => 'Fund Name',
    'fund_type' => 'Fund Type',
    'fund_level' => 'Fund Level',
    'action' => 'Action',
    'search' => 'Search',
    'show' => 'Show',
    'entries' => 'entries',
    'add' => 'Add',
    'showing' => 'Showing',
    'to' => 'to',
    'of' => 'of',
    'previous' => 'Previous',
    'next' => 'Next',

    //cpresearchV2/app/Http/Controllers/FundController.php
    'fund_created' => 'Fund created successfully.',
    'fund_updated' => 'Fund updated successfully.',
    'fund_deleted' => 'Fund deleted successfully.',

    //cpresearchV2/resources/views/research_projects/index.blade.php
    'research_project' => 'Research Project',
    'research_project_name' => 'Project Name',
    'research_project_year' => 'Year',
    'research_project_head' => 'Head',
    'research_project_member' => 'Member',

    //cpresearchV2/app/Http/Controllers/ResearchProjectController.php
    'research_project_created' => 'Research project created successfully.',
    'research_project_updated' => 'Research project updated successfully.',
    'research_project_deleted' => 'Research project deleted successfully.',

    //cpresearchV2/resources/views/research_groups/index.blade.php
    'research_group' => 'Research Group',
    'research_group_name' => 'Group Name',
    'research_group_head' => 'Head',
    'research_group_member' => 'Member',

    //cpresearchV2/app/Http/Controllers/ResearchGroupController.php
    'research_group_created' => 'Research group created successfully!',
    'research_group_updated' => 'Research group updated successfully!',
    'research_group_deleted' => 'Research group deleted successfully!',

    //cpresearchV2/resources/views/papers/index.blade.php
    'published_research' => 'Published Research',
    'published_research_name' => 'Paper Name',
    'published_research_type' => 'Paper Type',
    'published_research_year' => 'Publication year',
    'published_research_call_paper' => 'Call Paper',

    //cpresearchV2/app/Http/Controllers/PaperController.php
    'paper_created' => 'Paper created successfully.',
    'paper_updated' => 'Paper updated successfully.',

    //cpresearchV2/resources/views/books/index.blade.php
    'book' => 'Book',
    'book_name' => 'Book Name',
    'book_year' => 'Year',
    'book_source' => 'Source',
    'book_page' => 'Page',

    //cpresearchV2/app/Http/Controllers/BookController.php
    'book_created' => 'Book created successfully.',
    'book_updated' => 'Book updated successfully.',
    'book_deleted' => 'Book deleted successfully.',

    //cpresearchV2/resources/views/patents/index.blade.php
    'patent' => 'Other academic works',
    'patent_name' => 'Name',
    'patent_type' => 'Type',
    'patent_date' => 'Registration Date',
    'patent_number' => 'Registration Number',
    'patent_author' => 'Author',

    //cpresearchV2/app/Http/Controllers/PatentController.php
    'patent_created' => 'Patent created successfully.',
    'patent_updated' => 'Patent updated successfully.',
    'patent_deleted' => 'Patent deleted successfully.',

    //cpresearchV2/resources/views/users/index.blade.php
    'users' => 'Users',
    'user_name' => 'Name',
    'user_email' => 'Email',
    'user_role' => 'Roles',
    'user_department' => 'Department',
    'user_new_user' => 'New User',
    'user_import_new_user' => 'Import New User',

    //cpresearchV2/app/Http/Controllers/UserController.php
    'user_created_successfully' => 'User created successfully.',
    'user_updated_successfully' => 'User updated successfully.',
    'user_deleted_successfully' => 'User deleted successfully.',

    //cpresearchV2/resources/views/roles/index.blade.php
    'roles' => 'Roles',
    'role_name' => 'Name',

    //cpresearchV2/app/Http/Controllers/RoleController.php
    'role_created' => 'Role created successfully.',
    'role_updated' => 'Role updated successfully.',
    'role_deleted' => 'Role deleted successfully.',

    //cpresearchV2/app/Http/Controllers/RoleController.php
    'permissions' => '​Permissions',
    'permission_name' => 'Name',
    'permission_new' => 'New Permission',

    //cpresearchV2/app/Http/Controllers/PermissionController.php
    'permission_created' => 'Permission created successfully.',
    'permission_updated' => 'Permission updated successfully.',
    'permission_deleted' => 'Permission deleted successfully.',

    //cpresearchV2/resources/views/departments/index.blade.php
    'departments' => 'Departments',
    'department_name' => 'Name',
    'department_new' => 'New Department',

    //cpresearchV2/app/Http/Controllers/DepartmentController.php
    'department_created' => 'Department created successfully.',
    'department_updated' => 'Department updated successfully.',
    'department_deleted' => 'Department deleted successfully.',

    //cpresearchV2/resources/views/programs/index.blade.php
    'programs' => 'Programs',
    'program_name' => 'Name',
    'program_degree' => 'Degree',

    //cpresearchV2/app/Http/Controllers/ProgramController.php
    'program_created' => 'Program entry created successfully.',
    'program_updated' => 'Program data is updated successfully.',
    'program_deleted' => 'Program deleted successfully.',

];
