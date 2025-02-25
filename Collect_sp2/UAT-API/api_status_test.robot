*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         http://127.0.0.1:8000/login
${URL_PROFILE}    http://127.0.0.1:8000/profile
${BROWSER}     chrome
${USERNAME_ADMIN}    admin@gmail.com
${PASSWORD_ADMIN}    12345678
${DELAY}       0.2
${TIMEOUT}     10s

# XPaths ของปุ่มเปลี่ยนภาษา
${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']
${LANG_THAI}      xpath=//a[@href='http://127.0.0.1:8000/lang/th']
${LANG_CHINESE}   xpath=//a[@href='http://127.0.0.1:8000/lang/zh']
${LANG_ENGLISH}   xpath=//a[@href='http://127.0.0.1:8000/lang/en']

*** Test Cases ***
Test Switch Language For API status
    [Documentation]    Test Switch Language For API status
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As Admin
    Navigate To User Profile
    Go To Research API
    Set Selenium Speed    0.3s
    Change Language  ${LANG_THAI}
    Change Language  ${LANG_CHINESE}
    Change Language  ${LANG_ENGLISH}
    Close Browser

*** Keywords ***
Login As Admin
    Wait Until Element Is Visible    name=username    timeout=${TIMEOUT}
    Input Text    name=username    ${USERNAME_ADMIN}
    Input Text    name=password    ${PASSWORD_ADMIN}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}

Go To Research API
    Wait Until Element Is Visible    xpath=//*[@id="sidebar"]/ul/li[17]/a   timeout=${TIMEOUT}
    Click Element    xpath=//*[@id="sidebar"]/ul/li[17]/a
    Sleep    5s
    Set Selenium Speed    ${DELAY}

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

Navigate To User Profile
    Go To  ${URL_PROFILE}
    Sleep  2s
    Capture Page Screenshot