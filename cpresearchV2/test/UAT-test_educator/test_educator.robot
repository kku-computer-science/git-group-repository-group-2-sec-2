*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${BASE_URL}    https://soften2sec267.cpkkuhost.com
${URL}         ${BASE_URL}/login
${BROWSER}     firefox
${USERNAME}    rojanha@kku.ac.th
${PASSWORD}    123456789
${DELAY}       0.2
${TIMEOUT}     10s

# XPaths ของปุ่มเปลี่ยนภาษา
${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']
${LANG_THAI}      xpath=//a[@href='${BASE_URL}/lang/th']
${LANG_CHINESE}   xpath=//a[@href='${BASE_URL}/lang/zh']
${LANG_ENGLISH}   xpath=//a[@href='${BASE_URL}/lang/en']

*** Test Cases ***
TC:01 Login
    [Documentation]    Test Switch Language For Educator
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login To website

TC:02 Find Element To Click and Go To Department Page
    Click Target Menu
    Go To departments Page

TC:03 ตรวจสอบการเปลียนภาษาใน Department Page
    Check Context EN
    Change Language And Check Context   ${LANG_THAI}
    Check Context TH
    Change Language And Check Context  ${LANG_CHINESE}
    Check Context ZH
    Change Language And Check Context  ${LANG_ENGLISH}

TC:04 Find Element To Click and Go To Program Page
    Go To programs Page

TC:05 ตรวจสอบการเปลียนภาษาใน Department Page
    Check Context EN in programs
    Change Language And Check Context   ${LANG_THAI}
    Check Context TH in programs
    Change Language And Check Context  ${LANG_CHINESE}
    Check Context ZH in programs
    Change Language And Check Context  ${LANG_ENGLISH}

TC:06 Logout and Close Browser
    Logout



*** Keywords ***
Login To website
    Wait Until Element Is Visible    name=username    timeout=${TIMEOUT}
    Input Text    name=username    ${USERNAME}
    Input Text    name=password    ${PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}

Click Target Menu
    Wait Until Element Is Visible  xpath=//a[contains(@href, '/departments')]  timeout=10s 

Go To departments Page
    Click Element   xpath=/html/body/div/div/nav/ul/li[5]
    Capture Page Screenshot
    Log    Navigated to departments page

Go To programs Page
    Click Element   xpath=/html/body/div/div/nav/ul/li[6]
    Capture Page Screenshot
    Log     Navigated to programs page
    
Check Context EN
    Log     Checking Context
    Wait Until Element Is Visible   xpath=/html/body/div/div/div/div/div/div/div/div[2]/table/tbody/tr/td[2]    timeout=${TIMEOUT}
    Element Text Should Be      xpath=/html/body/div/div/div/div/div/div/div/div[2]/table/tbody/tr/td[2]      Department of Computer Science
    Capture Page Screenshot

Check Context TH
    Log     Checking Context
    Wait Until Element Is Visible   xpath=/html/body/div/div/div/div/div/div/div/div[2]/table/tbody/tr/td[2]    timeout=${TIMEOUT}
    Element Text Should Be      xpath=/html/body/div/div/div/div/div/div/div/div[2]/table/tbody/tr/td[2]       สาขาวิชาวิทยาการคอมพิวเตอร์     
    Capture Page Screenshot

Check Context ZH
    Log     Checking Context
    Wait Until Element Is Visible   xpath=/html/body/div/div/div/div/div/div/div/div[2]/table/tbody/tr/td[2]    timeout=${TIMEOUT}
    Element Text Should Be      xpath=/html/body/div/div/div/div/div/div/div/div[2]/table/tbody/tr/td[2]      计算机科学系    
    Capture Page Screenshot

Check Context EN in programs
    Log     Checking Context
    Wait Until Element Is Visible   xpath=/html/body/div/div/div/div/div[1]/div/div/table/tbody/tr[1]/td[2]    timeout=${TIMEOUT}
    Element Text Should Be      xpath=/html/body/div/div/div/div/div[1]/div/div/table/tbody/tr[1]/td[2]      Computer Science
    Capture Page Screenshot

Check Context TH in programs
    Log     Checking Context
    Wait Until Element Is Visible   xpath=/html/body/div/div/div/div/div[1]/div/div/table/tbody/tr[1]/td[2]    timeout=${TIMEOUT}
    Element Text Should Be      xpath=/html/body/div/div/div/div/div[1]/div/div/table/tbody/tr[1]/td[2]       สาขาวิชาวิทยาการคอมพิวเตอร์     
    Capture Page Screenshot

Check Context ZH in programs
    Log     Checking Context
    Wait Until Element Is Visible   xpath=/html/body/div/div/div/div/div[1]/div/div/table/tbody/tr[1]/td[2]    timeout=${TIMEOUT}
    Element Text Should Be      xpath=/html/body/div/div/div/div/div[1]/div/div/table/tbody/tr[1]/td[2]      计算机科学   
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