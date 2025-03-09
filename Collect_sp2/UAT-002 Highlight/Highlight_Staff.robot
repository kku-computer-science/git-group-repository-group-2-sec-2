*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         https://soften2sec267.cpkkuhost.com/
${DELAY}          1
${BROWSER}        Chrome
${USERNAME}       staff@gmail.com
${PASSWORD}       123456789

${URL}            ${SERVER}/login

${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']
${LANG_THAI}      xpath=//a[@href='${SERVER}/lang/th']
${LANG_CHINESE}   xpath=//a[@href='${SERVER}/lang/zh']
${LANG_ENGLISH}   xpath=//a[@href='${SERVER}/lang/en']

${HIGHLIGHT_TAB}  xpath=//*[@id="sidebar"]/ul/li[12]/a

*** Test Cases ***
Login, Go to Highlight Tab, and Change Language
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Open Browser And Login
    Click Highlight Menu
    Change Language  ${LANG_THAI}
    Change Language  ${LANG_CHINESE}
    Change Language  ${LANG_ENGLISH}

*** Keywords ***
Open Browser And Login
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Wait Until Element Is Visible  xpath=//button[@type='submit']  timeout=10s
    Click Button  xpath=//button[@type='submit']
    Wait Until Page Contains  Dashboard  timeout=10s
    Capture Page Screenshot
    Sleep  1s

Click Highlight Menu
    Wait Until Element Is Visible  ${HIGHLIGHT_TAB}  timeout=10s
    Click Element  ${HIGHLIGHT_TAB}
    Sleep  2s
    Capture Page Screenshot

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
