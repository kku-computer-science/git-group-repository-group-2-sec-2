*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         soften2sec267.cpkkuhost.com
${DELAY}          1
${BROWSER}        Firefox
${USERNAME}       punhor1
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${DELAY}       0.2
${TIMEOUT}     10s
${LANG_DROPDOWN}    xpath=//*[@id="navbarDropdownMenuLink"]
${EN_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'English')]
${TH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'ไทย')]
${CH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), '中文')]

*** Test Cases ***
Test Switching Between All Languages
    Open Browser    ${URL}    ${BROWSER}
    Delete All Cookies
    Execute JavaScript    window.localStorage.clear();
    Execute JavaScript    window.sessionStorage.clear();
    Reload Page
    Maximize Browser Window
    Set Selenium Speed    0.3s

    Change Language To Thai
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    
    Change Language To English
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    
    Change Language To Chinese
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    Close Browser

Open Browser And Login Fail
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Change Language To Thai
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Wait Until Element Is Visible  id=username  timeout=5s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    Capture Page Screenshot
    Sleep  1s

    Change Language To Chinese
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Wait Until Element Is Visible  id=username  timeout=5s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    Capture Page Screenshot
    Sleep  1s

    Change Language To English
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Wait Until Element Is Visible  id=username  timeout=5s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    Capture Page Screenshot
    Sleep  2s
    Close Browser

*** Keywords ***
Check Languages Context EN
    Log    Checking Languages Context EN
    Wait Until Element Is Visible    xpath=/html/body/div/div[2]/div[2]/h1    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div[2]/div[2]/h1   ACCOUNT LOGIN
    Capture Page Screenshot

Check Languages Context TH
    Log    Checking Languages Context TH
    Wait Until Element Is Visible    xpath=/html/body/div/div[2]/div[2]/h1    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div[2]/div[2]/h1   เข้าสู่ระบบ
    Capture Page Screenshot

Check Languages Context ZH
    Log    Checking Languages Context ZH
    Wait Until Element Is Visible    xpath=/html/body/div/div[2]/div[2]/h1    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div[2]/div[2]/h1   账户登录
    Capture Page Screenshot

Change Language To Thai
    Mouse Over    ${LANG_DROPDOWN}
    Sleep    1s
    Click Element    ${LANG_DROPDOWN}
    Wait Until Element Is Visible    ${TH_BUTTON}    timeout=5s
    Click Element    ${TH_BUTTON}
    Sleep    3s
    Check Languages Context TH

Change Language To English
    Mouse Over    ${LANG_DROPDOWN}
    Sleep    1s
    Click Element    ${LANG_DROPDOWN}
    Wait Until Element Is Visible    ${EN_BUTTON}    timeout=5s
    Click Element    ${EN_BUTTON}
    Sleep    3s
    Check Languages Context EN

Change Language To Chinese
    Mouse Over    ${LANG_DROPDOWN}
    Sleep    1s
    Click Element    ${LANG_DROPDOWN}
    Wait Until Element Is Visible    ${CH_BUTTON}    timeout=5s
    Click Element    ${CH_BUTTON}
    Sleep    3s
    Check Languages Context ZH