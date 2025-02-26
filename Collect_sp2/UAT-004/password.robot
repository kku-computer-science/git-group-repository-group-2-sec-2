*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${DELAY}          1
${BROWSER}        Firefox
${USERNAME}       pusadee@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${URL_PASSWORD}   http://${SERVER}/password

# XPaths ของปุ่มเปลี่ยนภาษา
${LANGUAGE_DROPDOWN}     //a[@id="navbarDropdownMenuLink"]
${LANGUAGE_EN}           //a[@href="http://localhost:8000/lang/en"]
${LANGUAGE_TH}           //a[@href="http://localhost:8000/lang/th"]
${LANGUAGE_CN}           //a[@href="http://localhost:8000/lang/zh"]

# XPaths ของ Password Page (ภาษาอังกฤษ)
${PASSWORD_TITLE_EN}        //h3[contains(text(), 'Password Settings')]
${LABEL_OLD_PASSWORD_EN}    //label[contains(text(), 'Old password')]
${LABEL_NEW_PASSWORD_EN}    //label[contains(text(), 'New password')]
${LABEL_CONFIRM_PASSWORD_EN}   //label[contains(text(), 'Confirm new password')]
${BUTTON_UPDATE_EN}         //button[contains(text(), 'Update')]

# XPaths ของ Password Page (ภาษาไทย)
${PASSWORD_TITLE_TH}        //h3[contains(text(), 'ตั้งค่ารหัสผ่าน')]
${LABEL_OLD_PASSWORD_TH}    //label[contains(text(), 'รหัสผ่านเดิม')]
${LABEL_NEW_PASSWORD_TH}    //label[contains(text(), 'รหัสผ่านใหม่')]
${LABEL_CONFIRM_PASSWORD_TH}    //label[contains(text(), 'ยืนยันรหัสผ่านใหม่')]
${BUTTON_UPDATE_TH}         //button[contains(text(), 'อัปเดต')]

# XPaths ของ Password Page (ภาษาจีน)
${PASSWORD_TITLE_CN}        //h3[contains(text(), '密码设置')]
${LABEL_OLD_PASSWORD_CN}    //label[contains(text(), '旧密码')]
${LABEL_NEW_PASSWORD_CN}    //label[contains(text(), '新密码')]
${LABEL_CONFIRM_PASSWORD_CN}   //label[contains(text(), '确认新密码')]
${BUTTON_UPDATE_CN}         //button[contains(text(), '更新')]

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

Navigate To Password Settings
    Go To  ${URL_PASSWORD}
    Wait Until Page Contains  Password Settings  timeout=10s
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

Verify Password Page Language English
    Wait Until Element Is Visible  ${PASSWORD_TITLE_EN}  timeout=5s
    Page Should Contain Element  ${LABEL_OLD_PASSWORD_EN}
    Page Should Contain Element  ${LABEL_NEW_PASSWORD_EN}
    Page Should Contain Element  ${LABEL_CONFIRM_PASSWORD_EN}
    Page Should Contain Element  ${BUTTON_UPDATE_EN}
    Capture Page Screenshot

Select Thai Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_TH}  timeout=5s
    Click Element  ${LANGUAGE_TH}
    Sleep  2s
    Capture Page Screenshot

Verify Password Page Language Thai
    Wait Until Element Is Visible  ${PASSWORD_TITLE_TH}  timeout=5s
    Page Should Contain Element  ${LABEL_OLD_PASSWORD_TH}
    Page Should Contain Element  ${LABEL_NEW_PASSWORD_TH}
    Page Should Contain Element  ${LABEL_CONFIRM_PASSWORD_TH}
    Page Should Contain Element  ${BUTTON_UPDATE_TH}
    Capture Page Screenshot

Select Chinese Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_CN}  timeout=5s
    Click Element  ${LANGUAGE_CN}
    Sleep  2s
    Capture Page Screenshot

Verify Password Page Language Chinese
    Wait Until Element Is Visible  ${PASSWORD_TITLE_CN}  timeout=5s
    Page Should Contain Element  ${LABEL_OLD_PASSWORD_CN}
    Page Should Contain Element  ${LABEL_NEW_PASSWORD_CN}
    Page Should Contain Element  ${LABEL_CONFIRM_PASSWORD_CN}
    Page Should Contain Element  ${BUTTON_UPDATE_CN}
    Capture Page Screenshot

*** Test Cases ***
User Can Change Language To English And Verify Password Page
    Open Browser And Login
    Navigate To Password Settings
    Select English Language
    Verify Password Page Language English
    Close Browser

User Can Change Language To Thai And Verify Password Page
    Open Browser And Login
    Navigate To Password Settings
    Select Thai Language
    Verify Password Page Language Thai
    Close Browser

User Can Change Language To Chinese And Verify Password Page
    Open Browser And Login
    Navigate To Password Settings
    Select Chinese Language
    Verify Password Page Language Chinese
    Close Browser
