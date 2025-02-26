*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${DELAY}          1
${BROWSER}        Firefox
${USERNAME}       pusadee@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${URL_PROFILE}    http://${SERVER}/profile

# XPaths ของปุ่มเปลี่ยนภาษา
${LANGUAGE_DROPDOWN}     //a[@id="navbarDropdownMenuLink"]
${LANGUAGE_EN}           //a[@href="http://localhost:8000/lang/en"]
${LANGUAGE_TH}           //a[@href="http://localhost:8000/lang/th"]
${LANGUAGE_CN}           //a[@href="http://localhost:8000/lang/zh"]

# XPaths ของ Profile Page (ภาษาอังกฤษ)
${PROFILE_TITLE_EN}        //h3[contains(text(), 'Profile Settings')]
${LABEL_ACADEMIC_RANKS_EN}    //label[contains(text(), 'Academic Ranks')]
${LABEL_NAME_TITLE_EN}     //label[contains(text(), 'Name title')]
${LABEL_FIRST_NAME_EN}     //label[contains(text(), 'First name (English)')]
${LABEL_LAST_NAME_EN}      //label[contains(text(), 'Last name (English)')]
${LABEL_EMAIL_EN}          //label[contains(text(), 'Email')]
${BUTTON_UPDATE_EN}        //button[contains(text(), 'Update')]

# XPaths ของ Profile Page (ภาษาไทย)
${PROFILE_TITLE_TH}        //h3[contains(text(), 'ตั้งค่าข้อมูลโปรไฟล์')]
${LABEL_ACADEMIC_RANKS_TH}    //label[contains(text(), 'ตำแหน่งทางวิชาการ')]
${LABEL_NAME_TITLE_TH}     //label[contains(text(), 'คำนำหน้า')]
${LABEL_FIRST_NAME_TH}     //label[contains(text(), 'ชื่อ (ภาษาอังกฤษ)')]
${LABEL_LAST_NAME_TH}      //label[contains(text(), 'นามสกุล (ภาษาอังกฤษ)')]
${LABEL_EMAIL_TH}          //label[contains(text(), 'อีเมล')]
${BUTTON_UPDATE_TH}        //button[contains(text(), 'อัปเดต')]

# XPaths ของ Profile Page (ภาษาจีน)
${PROFILE_TITLE_CN}        //h3[contains(text(), '个人资料设置')]
${LABEL_ACADEMIC_RANKS_CN}    //label[contains(text(), '学术职称')]
${LABEL_NAME_TITLE_CN}     //label[contains(text(), '姓名称谓')]
${LABEL_FIRST_NAME_CN}     //label[contains(text(), '名字（英语）')]
${LABEL_LAST_NAME_CN}      //label[contains(text(), '姓氏（英语）')]
${LABEL_EMAIL_CN}          //label[contains(text(), '电子邮件')]
${BUTTON_UPDATE_CN}        //button[contains(text(), '更新')]

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

Navigate To User Profile
    Go To  ${URL_PROFILE}
    Wait Until Page Contains  Profile Settings  timeout=10s
    Capture Page Screenshot

Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_DROPDOWN}  timeout=5s
    Click Element  ${LANGUAGE_DROPDOWN}
    Capture Page Screenshot
    Sleep  1s

Select English Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_EN}  timeout=5s
    Click Element  ${LANGUAGE_EN}
    Sleep  2s
    Capture Page Screenshot

Verify User Profile Language English
    Wait Until Element Is Visible  ${PROFILE_TITLE_EN}  timeout=5s
    Page Should Contain Element  ${LABEL_ACADEMIC_RANKS_EN}
    Page Should Contain Element  ${LABEL_NAME_TITLE_EN}
    Page Should Contain Element  ${LABEL_FIRST_NAME_EN}
    Page Should Contain Element  ${LABEL_LAST_NAME_EN}
    Page Should Contain Element  ${LABEL_EMAIL_EN}
    Page Should Contain Element  ${BUTTON_UPDATE_EN}
    Capture Page Screenshot

Select Thai Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_TH}  timeout=5s
    Click Element  ${LANGUAGE_TH}
    Sleep  2s
    Capture Page Screenshot

Verify User Profile Language Thai
    Wait Until Element Is Visible  ${PROFILE_TITLE_TH}  timeout=5s
    Page Should Contain Element  ${LABEL_ACADEMIC_RANKS_TH}
    Page Should Contain Element  ${LABEL_NAME_TITLE_TH}
    Page Should Contain Element  ${LABEL_FIRST_NAME_TH}
    Page Should Contain Element  ${LABEL_LAST_NAME_TH}
    Page Should Contain Element  ${LABEL_EMAIL_TH}
    Page Should Contain Element  ${BUTTON_UPDATE_TH}
    Capture Page Screenshot

Select Chinese Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_CN}  timeout=5s
    Click Element  ${LANGUAGE_CN}
    Sleep  2s
    Capture Page Screenshot

Verify User Profile Language Chinese
    Wait Until Element Is Visible  ${PROFILE_TITLE_CN}  timeout=5s
    Page Should Contain Element  ${LABEL_ACADEMIC_RANKS_CN}
    Page Should Contain Element  ${LABEL_NAME_TITLE_CN}
    Page Should Contain Element  ${LABEL_FIRST_NAME_CN}
    Page Should Contain Element  ${LABEL_LAST_NAME_CN}
    Page Should Contain Element  ${LABEL_EMAIL_CN}
    Page Should Contain Element  ${BUTTON_UPDATE_CN}
    Capture Page Screenshot

*** Test Cases ***
User Can Change Language To English And Verify Profile
    Open Browser And Login
    Navigate To User Profile
    Select English Language
    Verify User Profile Language English
    Close Browser

User Can Change Language To Thai And Verify Profile
    Open Browser And Login
    Navigate To User Profile
    Select Thai Language
    Verify User Profile Language Thai
    Close Browser

User Can Change Language To Chinese And Verify Profile
    Open Browser And Login
    Navigate To User Profile
    Select Chinese Language
    Verify User Profile Language Chinese
    Close Browser
