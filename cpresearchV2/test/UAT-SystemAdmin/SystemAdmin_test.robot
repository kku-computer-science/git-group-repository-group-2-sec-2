*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         http://127.0.0.1:8000/login
# ${URL}         https://soften2sec267.cpkkuhost.com/login
${BROWSER}     firefox
${USERNAME_ADMIN}    nantas@kku.ac.th
${PASSWORD_ADMIN}    123456789
${DELAY}       0.2
${TIMEOUT}     10s

# XPaths ของปุ่มเปลี่ยนภาษา
${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']
# ${LANG_THAI}      xpath=//a[@href='https://soften2sec267.cpkkuhost.com/lang/th']
# ${LANG_CHINESE}   xpath=//a[@href='https://soften2sec267.cpkkuhost.com/lang/zh']
# ${LANG_ENGLISH}   xpath=//a[@href='https://soften2sec267.cpkkuhost.com/lang/en']

${LANG_THAI}      xpath=//a[@href='http://127.0.0.1:8000/lang/th']
${LANG_CHINESE}   xpath=//a[@href='http://127.0.0.1:8000/lang/zh']
${LANG_ENGLISH}   xpath=//a[@href='http://127.0.0.1:8000/lang/en']

*** Test Cases ***
UAT-SystemAdmin-Role
    [Documentation]    Test Switch Language For SystemAdmin
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As Admin
    Click Target Menu
    Go To API Status Page
    Check API Status Context EN
    Change Language And Check Context  ${LANG_THAI}
    Check API Status Context TH
    Change Language And Check Context  ${LANG_CHINESE}
    Check API Status Context ZH
    Change Language And Check Context  ${LANG_ENGLISH}
    Logout
    Close Browser

*** Keywords ***
Login As Admin
    Wait Until Element Is Visible    name=username    timeout=${TIMEOUT}
    Input Text    name=username    ${USERNAME_ADMIN}
    Input Text    name=password    ${PASSWORD_ADMIN}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}

Click Target Menu
    Wait Until Element Is Visible  xpath=//a[contains(@href, '/apistatus')]  timeout=10s  

Go To API Status Page
    Click Element    xpath=//a[contains(@href, '/apistatus')]  
    Capture Page Screenshot
    Log    Navigated to API Status Page

Check API Status Context EN
    Log    Checking API Status Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2    API Status
    Capture Page Screenshot

Check API Status Context TH
    Log    Checking API Status Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2    สถานะ API
    Capture Page Screenshot

Check API Status Context ZH
    Log    Checking API Status Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2    API 状态
    Capture Page Screenshot

Change Language And Check Context
    [Arguments]  ${LANG_OPTION}
    Change Language  ${LANG_OPTION}

Change Language
    [Arguments]  ${LANG_OPTION}
    Wait Until Element Is Visible  ${LANG_DROPDOWN}  timeout=10s
    Execute JavaScript    document.getElementById('navbarDropdownMenuLink').click();
    Click Element  ${LANG_DROPDOWN}
    Sleep  1s
    Wait Until Element Is Visible  ${LANG_OPTION}  timeout=5s
    Click Element  ${LANG_OPTION}
    Sleep  1s
    Capture Page Screenshot
    Log    Changed language to ${LANG_OPTION}

Logout
    Wait Until Element Is Visible    xpath=//a[contains(text(), 'Logout')]    timeout=10s  
    Execute JavaScript    document.getElementById('logout-form').submit();  
    Sleep    2s  
    Capture Page Screenshot    logout.png
    Wait Until Page Contains    Login    timeout=10s  
    Log    Successfully logged out
