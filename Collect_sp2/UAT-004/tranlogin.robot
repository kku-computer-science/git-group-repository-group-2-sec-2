*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${DELAY}          1
${BROWSER}        Firefox
${URL}            http://${SERVER}/login

# XPaths ของปุ่มเปลี่ยนภาษา
${LANGUAGE_DROPDOWN}     //a[@id="navbarDropdownMenuLink"]
${LANGUAGE_EN}           //a[@href="http://localhost:8000/lang/en"]
${LANGUAGE_TH}           //a[@href="http://localhost:8000/lang/th"]
${LANGUAGE_CN}           //a[@href="http://localhost:8000/lang/zh"]

# XPaths ของ Login Page (ภาษาอังกฤษ)
${LOGIN_TITLE_EN}        //h2[contains(text(), 'Account Login')]
${LABEL_USERNAME_EN}     //label[contains(text(), 'Username')]
${LABEL_PASSWORD_EN}     //label[contains(text(), 'Password')]
${BUTTON_LOGIN_EN}       //button[contains(text(), 'Log In')]

# XPaths ของ Login Page (ภาษาไทย)
${LOGIN_TITLE_TH}        //h2[contains(text(), 'เข้าสู่ระบบบัญชี')]
${LABEL_USERNAME_TH}     //label[contains(text(), 'ชื่อผู้ใช้')]
${LABEL_PASSWORD_TH}     //label[contains(text(), 'รหัสผ่าน')]
${BUTTON_LOGIN_TH}       //button[contains(text(), 'เข้าสู่ระบบ')]

# XPaths ของ Login Page (ภาษาจีน)
${LOGIN_TITLE_CN}        //h2[contains(text(), '账户登录')]
${LABEL_USERNAME_CN}     //label[contains(text(), '用户名')]
${LABEL_PASSWORD_CN}     //label[contains(text(), '密码')]
${BUTTON_LOGIN_CN}       //button[contains(text(), '登录')]

*** Keywords ***
Open Browser And Navigate To Login
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Wait Until Element Is Visible  ${BUTTON_LOGIN_EN}  timeout=10s
    Capture Page Screenshot
    Sleep  1s

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

Verify Login Page Language English
    Wait Until Element Is Visible  ${LOGIN_TITLE_EN}  timeout=5s
    Page Should Contain Element  ${LABEL_USERNAME_EN}
    Page Should Contain Element  ${LABEL_PASSWORD_EN}
    Page Should Contain Element  ${BUTTON_LOGIN_EN}
    Capture Page Screenshot

Select Thai Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_TH}  timeout=5s
    Click Element  ${LANGUAGE_TH}
    Sleep  2s
    Capture Page Screenshot

Verify Login Page Language Thai
    Wait Until Element Is Visible  ${LOGIN_TITLE_TH}  timeout=5s
    Page Should Contain Element  ${LABEL_USERNAME_TH}
    Page Should Contain Element  ${LABEL_PASSWORD_TH}
    Page Should Contain Element  ${BUTTON_LOGIN_TH}
    Capture Page Screenshot

Select Chinese Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_CN}  timeout=5s
    Click Element  ${LANGUAGE_CN}
    Sleep  2s
    Capture Page Screenshot

Verify Login Page Language Chinese
    Wait Until Element Is Visible  ${LOGIN_TITLE_CN}  timeout=5s
    Page Should Contain Element  ${LABEL_USERNAME_CN}
    Page Should Contain Element  ${LABEL_PASSWORD_CN}
    Page Should Contain Element  ${BUTTON_LOGIN_CN}
    Capture Page Screenshot

*** Test Cases ***
User Can Change Language To English And Verify Login Page
    Open Browser And Navigate To Login
    Select English Language
    Verify Login Page Language English
    Close Browser

User Can Change Language To Thai And Verify Login Page
    Open Browser And Navigate To Login
    Select Thai Language
    Verify Login Page Language Thai
    Close Browser

User Can Change Language To Chinese And Verify Login Page
    Open Browser And Navigate To Login
    Select Chinese Language
    Verify Login Page Language Chinese
    Close Browser
