*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${DELAY}          1
${BROWSER}        Firefox
${USERNAME}       punhor1@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${URL_PROFILE}    http://${SERVER}/profile
${DELAY}       0.2
${TIMEOUT}     10s
# XPaths ของปุ่มเปลี่ยนภาษา
${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']
${LANG_THAI}      xpath=//a[@href='http://${SERVER}/lang/th']
${LANG_CHINESE}   xpath=//a[@href='http://${SERVER}/lang/zh']
${LANG_ENGLISH}   xpath=//a[@href='http://${SERVER}/lang/en']

${ACCOUNT}   //*[@id="account-tab"]
${PASSWORDT}    //*[@id="password-tab"]
${EXPERTISE}    //*[@id="expertise-tab"]
${EDUCATION}   //*[@id="education-tab"]


*** Keywords ***
Open Browser And Login
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    Wait Until Page Contains  Dashboard  timeout=10s
    Capture Page Screenshot
    Sleep  1s

Navigate To User Profile EN
    Go To  ${URL_PROFILE}
    Sleep  2s
    Capture Page Screenshot
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Sleep  2s
    Check Profile Setting Context EN
    Capture Page Screenshot
    Wait Until Element Is Visible  ${PASSWORDT}  timeout=5s
    Click Element  ${PASSWORDT}
    Sleep  2s
    Check Password Setting Context EN
    Capture Page Screenshot
    Wait Until Element Is Visible  ${EXPERTISE}  timeout=5s
    Click Element  ${EXPERTISE}
    Sleep  2s
    Check Expertise Context EN
    Capture Page Screenshot
    Wait Until Element Is Visible  ${EDUCATION}  timeout=5s
    Click Element  ${EDUCATION}
    Sleep  2s
    Check Education Background Context EN
    Capture Page Screenshot

Navigate To User Profile TH
    Go To  ${URL_PROFILE}
    Sleep  2s
    Capture Page Screenshot
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Sleep  2s
    Check Profile Setting Context TH
    Capture Page Screenshot
    Wait Until Element Is Visible  ${PASSWORDT}  timeout=5s
    Click Element  ${PASSWORDT}
    Sleep  2s
    Check Password Setting Context TH
    Capture Page Screenshot
    Wait Until Element Is Visible  ${EXPERTISE}  timeout=5s
    Click Element  ${EXPERTISE}
    Sleep  2s
    Check Expertise Context TH
    Capture Page Screenshot
    Wait Until Element Is Visible  ${EDUCATION}  timeout=5s
    Click Element  ${EDUCATION}
    Sleep  2s
    Check Education Background Context TH
    Capture Page Screenshot

Navigate To User Profile ZH
    Go To  ${URL_PROFILE}
    Sleep  2s
    Capture Page Screenshot
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Sleep  2s
    Check Profile Setting Context ZH
    Capture Page Screenshot
    Wait Until Element Is Visible  ${PASSWORDT}  timeout=5s
    Click Element  ${PASSWORDT}
    Sleep  2s
    Check Password Setting Context ZH
    Capture Page Screenshot
    Wait Until Element Is Visible  ${EXPERTISE}  timeout=5s
    Click Element  ${EXPERTISE}
    Sleep  2s
    Check Expertise Context ZH
    Capture Page Screenshot
    Wait Until Element Is Visible  ${EDUCATION}  timeout=5s
    Click Element  ${EDUCATION}
    Sleep  2s
    Check Education Background Context ZH
    Capture Page Screenshot


Check Profile Setting Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    Profile Setting
    Capture Page Screenshot

Check Profile Setting Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    ตั้งค่าโปรไฟล์
    Capture Page Screenshot

Check Profile Setting Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    个人资料设置
    Capture Page Screenshot

Check Password Setting Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="changePasswordAdminForm"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="changePasswordAdminForm"]/h3    Password Setting
    Capture Page Screenshot

Check Password Setting Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="changePasswordAdminForm"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="changePasswordAdminForm"]/h3    ตั้งค่ารหัสผ่าน
    Capture Page Screenshot

Check Password Setting Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="changePasswordAdminForm"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="changePasswordAdminForm"]/h3    密码设置
    Capture Page Screenshot

Check Expertise Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="expertise"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="expertise"]/h3    Expertise
    Capture Page Screenshot

Check Expertise Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="expertise"]/h3   timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="expertise"]/h3    ความเชี่ยวชาญ
    Capture Page Screenshot

Check Expertise Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="expertise"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="expertise"]/h3    专长
    Capture Page Screenshot

Check Education Background Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="EdInfoForm"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="EdInfoForm"]/h3    Education Background
    Capture Page Screenshot

Check Education Background Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="EdInfoForm"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="EdInfoForm"]/h3    ประวัติการศึกษา
    Capture Page Screenshot

Check Education Background Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="EdInfoForm"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="EdInfoForm"]/h3    教育背景
    Capture Page Screenshot

Change Language And Check Context
    [Arguments]  ${LANG_OPTION}
    Change Language  ${LANG_OPTION}
Change Language
    [Arguments]  ${LANG_OPTION}
    Wait Until Element Is Visible  ${LANG_DROPDOWN}  timeout=10s
    Execute JavaScript    document.getElementById('navbarDropdownMenuLink').click();
    Click Element  ${LANG_DROPDOWN}
    Sleep  2s
    Wait Until Element Is Visible  ${LANG_OPTION}  timeout=5s
    Click Element  ${LANG_OPTION}
    Sleep  2s
    Capture Page Screenshot
    Log    Changed language to ${LANG_OPTION}

*** Test Cases ***

Test Switching Between All Languages
    Open Browser And Login
    Change Language And Check Context  ${LANG_THAI}
    Navigate To User Profile TH
    Change Language And Check Context  ${LANG_CHINESE}
    Navigate To User Profile ZH
    Change Language And Check Context  ${LANG_ENGLISH}
    Navigate To User Profile EN
    Close Browser




