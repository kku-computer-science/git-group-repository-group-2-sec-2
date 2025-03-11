*** Settings ***
Library    SeleniumLibrary

*** Variables ***
# ${URL}         http://127.0.0.1:8000/login
${URL}         https://soften2sec267.cpkkuhost.com/login
${BROWSER}     firefox
${USERNAME}    punhor1@kku.ac.th
${PASSWORD}    123456789
${DELAY}       0.2
${TIMEOUT}     10s



# XPaths ของปุ่มเปลี่ยนภาษา
${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']
${LANG_THAI}      xpath=//a[@href='https://soften2sec267.cpkkuhost.com/lang/th']
${LANG_CHINESE}   xpath=//a[@href='https://soften2sec267.cpkkuhost.com/lang/zh']
${LANG_ENGLISH}   xpath=//a[@href='https://soften2sec267.cpkkuhost.com/lang/en']


# ${LANG_THAI}      xpath=//a[@href='http://127.0.0.1:8000/lang/th']
# ${LANG_CHINESE}   xpath=//a[@href='hhttp://127.0.0.1:8000/lang/zh']
# ${LANG_ENGLISH}   xpath=//a[@href='http://127.0.0.1:8000/lang/en']

*** Test Cases ***
๊UAT-HeadProject-Role
    [Documentation]    Test Switch Language For HeadProject
    [Teardown]    No Operation
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login To website
    Click Target Menu
    Go To Assistant Researcher Page
    Check Assistant Researcher Context EN
    Change Language And Check Context  ${LANG_THAI}
    Check Assistant Researcher Context TH
    Change Language And Check Context  ${LANG_CHINESE}
    Check Assistant Researcher Context ZH
    Change Language And Check Context  ${LANG_ENGLISH}
    Logout

*** Keywords ***
Login To website
    Wait Until Element Is Visible    name=username    timeout=${TIMEOUT}
    Input Text    name=username    ${USERNAME}
    Input Text    name=password    ${PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}


Click Target Menu
    Wait Until Element Is Visible  xpath=//a[contains(@href, '/assistant-researcher')]  timeout=10s
    
    
Go To Assistant Researcher Page
    Click Element    xpath=//a[contains(@href, '/assistant-researcher')] 
    Capture Page Screenshot
    Log    Navigated to Assisant-Researcher Page

Check Assistant Researcher Context EN
    Log    Checking Assistant Researcher Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2    Assistant Wanted
    Capture Page Screenshot

Check Assistant Researcher Context TH
    Log    Checking Assistant Researcher Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2    ต้องการผู้ช่วยวิจัย
    Capture Page Screenshot

Check Assistant Researcher Context ZH
    Log    Checking Assistant Researcher Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2    招聘研究助理
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