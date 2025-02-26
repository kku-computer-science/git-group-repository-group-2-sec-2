*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${DELAY}          1
${BROWSER}        Firefox
${USERNAME}       pusadee@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login

# XPaths
${LANGUAGE_DROPDOWN}     //a[@id="navbarDropdownMenuLink"]
${LANGUAGE_EN}           //a[@href="http://localhost:8000/lang/en"]
${LANGUAGE_TH}           //a[@href="http://localhost:8000/lang/th"]
${LANGUAGE_CN}           //a[@href="http://localhost:8000/lang/zh"]

${SIDEBAR_BOOKS}        //*[@id="sidebar"]/ul/li[8]/a/span

# XPaths ของ Navbar (ภาษาอังกฤษ)
${NAV_DASHBOARD}              //span[@class="menu-title" and contains(text(), 'Dashboard')]
${NAV_PROFILE}                //li[@class="nav-item nav-category" and contains(text(), 'Profile')]
${NAV_USER_PROFILE}           //span[@class="menu-title" and contains(text(), 'User Profile')]
${NAV_OPTION}                //li[@class="nav-item nav-category" and contains(text(), 'Option')]
${NAV_MANAGE_FUND}            //span[@class="menu-title" and contains(text(), 'Manage Fund')]
${NAV_RESEARCH_PROJECT}       //span[@class="menu-title" and contains(text(), 'Research Project')]
${NAV_RESEARCH_GROUP}         //span[@class="menu-title" and contains(text(), 'Research Group')]
${NAV_MANAGE_PUBLICATIONS}    //span[@class="menu-title" and contains(text(), 'Manage Publications')]
${NAV_PUBLISHED_RESEARCH}     //span[@class="menu-title" and contains(text(), 'Published research')]
${NAV_BOOK}                   //span[@class="menu-title" and contains(text(), 'Book')]
${NAV_OTHER_PUBLICATIONS}     //span[@class="menu-title" and contains(text(), 'Other Academic Works')]

# XPaths ของ Navbar (ภาษาไทย)
${NAV_DASHBOARD_TH}              //span[@class="menu-title" and contains(text(), 'แผงควบคุม')]
${NAV_PROFILE_TH}                //li[@class="nav-item nav-category" and contains(text(), 'โปรไฟล์')]
${NAV_USER_PROFILE_TH}           //span[@class="menu-title" and contains(text(), 'โปรไฟล์ผู้ใช้')]
${NAV_OPTION_TH}                //li[@class="nav-item nav-category" and contains(text(), 'ตัวเลือก')]
${NAV_MANAGE_FUND_TH}            //span[@class="menu-title" and contains(text(), 'กองทุน')]
${NAV_RESEARCH_PROJECT_TH}       //span[@class="menu-title" and contains(text(), 'โครงการวิจัย')]
${NAV_RESEARCH_GROUP_TH}         //span[@class="menu-title" and contains(text(), 'กลุ่มวิจัย')]
${NAV_MANAGE_PUBLICATIONS_TH}    //span[@class="menu-title" and contains(text(), 'การจัดการสิ่งพิมพ์')]
${NAV_PUBLISHED_RESEARCH_TH}     //span[@class="menu-title" and contains(text(), 'งานวิจัยที่เผยแพร่')]
${NAV_BOOK_TH}                   //span[@class="menu-title" and contains(text(), 'หนังสือ')]
${NAV_OTHER_PUBLICATIONS_TH}     //span[@class="menu-title" and contains(text(), 'ผลงานวิชาการอื่นๆ')]

# XPaths ของ Navbar (ภาษาจีน)
${NAV_DASHBOARD_CN}              //span[@class="menu-title" and contains(text(), '仪表板')]
${NAV_PROFILE_CN}                //li[@class="nav-item nav-category" and contains(text(), '个人资料')]
${NAV_USER_PROFILE_CN}           //span[@class="menu-title" and contains(text(), '用户资料')]
${NAV_OPTION_CN}                //li[@class="nav-item nav-category" and contains(text(), '选项')]
${NAV_MANAGE_FUND_CN}            //span[@class="menu-title" and contains(text(), '基金管理')]
${NAV_RESEARCH_PROJECT_CN}       //span[@class="menu-title" and contains(text(), '研究项目')]
${NAV_RESEARCH_GROUP_CN}         //span[@class="menu-title" and contains(text(), '研究小组')]
${NAV_MANAGE_PUBLICATIONS_CN}    //span[@class="menu-title" and contains(text(), '出版物管理')]
${NAV_PUBLISHED_RESEARCH_CN}     //span[@class="menu-title" and contains(text(), '已发表研究')]
${NAV_BOOK_CN}                   //span[@class="menu-title" and contains(text(), '书籍')]
${NAV_OTHER_PUBLICATIONS_CN}     //span[@class="menu-title" and contains(text(), '其他学术成果')]

*** Keywords ***
Open Browser And Login
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Dashboard  timeout=10s
    Capture Page Screenshot
    Sleep  1s

Click Language Dropdown
    [Documentation]  คลิก dropdown เพื่อเลือกภาษา
    Wait Until Element Is Visible  ${LANGUAGE_DROPDOWN}  timeout=5s
    Click Element  ${LANGUAGE_DROPDOWN}
    Capture Page Screenshot
    Sleep  1s

Select English Language
    [Documentation]  เลือกภาษาอังกฤษ
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_EN}  timeout=5s
    Click Element  ${LANGUAGE_EN}
    Sleep  2s
    Capture Page Screenshot

Click Book In Sidebar
    Wait Until Element Is Visible  ${SIDEBAR_BOOKS}  timeout=5s
    Click Element  ${SIDEBAR_BOOKS}
    Click Element  xpath=//a[@href='#ManagePublications']
    Wait Until Element Is Visible  id=ManagePublications  timeout=5s
    Page Should Contain Element  xpath=//a[contains(@href, '/books') and contains(text(), 'Book')]
    # คลิก BOOK
    Click Element  xpath=//a[contains(@href, '/books') and contains(text(), 'Book')]
    Capture Page Screenshot
    Sleep  1s

Verify Navbar Language English
    [Documentation]  ตรวจสอบ Navbar เป็นภาษาอังกฤษ
    Wait Until Element Is Visible  ${NAV_DASHBOARD}  timeout=5s
    Page Should Contain Element  ${NAV_PROFILE}
    Page Should Contain Element  ${NAV_OTHER_PUBLICATIONS}
    Capture Page Screenshot

Select Thai Language
    [Documentation]  เลือกภาษาไทย
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_TH}  timeout=5s
    Click Element  ${LANGUAGE_TH}
    Sleep  2s
    Capture Page Screenshot

Verify Navbar Language Thai
    [Documentation]  ตรวจสอบ Navbar เป็นภาษาไทย
    Wait Until Element Is Visible  ${NAV_DASHBOARD_TH}  timeout=5s
    Page Should Contain Element  ${NAV_PROFILE_TH}
    Page Should Contain Element  ${NAV_OTHER_PUBLICATIONS_TH}
    Capture Page Screenshot

Select Chinese Language
    [Documentation]  เลือกภาษาจีน
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_CN}  timeout=5s
    Click Element  ${LANGUAGE_CN}
    Sleep  2s
    Capture Page Screenshot

Verify Navbar Language Chinese
    [Documentation]  ตรวจสอบ Navbar เป็นภาษาจีน
    Wait Until Element Is Visible  ${NAV_DASHBOARD_CN}  timeout=5s
    Page Should Contain Element  ${NAV_PROFILE_CN}
    Page Should Contain Element  ${NAV_OTHER_PUBLICATIONS_CN}
    Capture Page Screenshot

*** Test Cases ***
User Can Change Language To English And Verify Navbar
    Open Browser And Login
    Select English Language
    Click Book In Sidebar
    Verify Navbar Language English
    Close Browser

User Can Change Language To Thai And Verify Navbar
    Open Browser And Login
    Select Thai Language
    Click Book In Sidebar
    Verify Navbar Language Thai
    Close Browser

User Can Change Language To Chinese And Verify Navbar
    Open Browser And Login
    Select Chinese Language
    Click Book In Sidebar
    Verify Navbar Language Chinese
    Close Browser