*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         http://127.0.0.1:8000/login
${BROWSER}     chrome
${USERNAME_ADMIN}    admin@gmail.com
${PASSWORD_ADMIN}    12345678
${DELAY}       0.2
${TIMEOUT}     10s

*** Test Cases ***
Call Paper
    [Documentation]    Test Switch Language For API status
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As Admin
    Go To Research API
    Set Selenium Speed    0.3s

    Change Language To Thai
    Reload Page  # ✅ เพิ่ม Reload Page หลังเปลี่ยนภาษา
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Capture Page Screenshot  th_page.png

    Change Language To English
    Reload Page
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Capture Page Screenshot  en_page.png

    Change Language To Chinese
    Reload Page
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Capture Page Screenshot  ch_page.png

    Close Browser


*** Keywords ***
Login As Admin
    Wait Until Element Is Visible    name=username    timeout=${TIMEOUT}
    Input Text    name=username    ${USERNAME_ADMIN}
    Input Text    name=password    ${PASSWORD_ADMIN}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}

Go To Research API
    Wait Until Element Is Visible    xpath=//*[@id="sidebar"]/ul/li[17]/a    timeout=${TIMEOUT}
    Click Element    xpath=//*[@id="sidebar"]/ul/li[17]/a
    Sleep    5s
    Set Selenium Speed    ${DELAY}

Change Language To Thai
    Mouse Over    ${LANG_DROPDOWN}
    Sleep    1s
    Click Element    ${LANG_DROPDOWN}
    Wait Until Element Is Visible    ${TH_BUTTON}    timeout=5s
    Click Element    ${TH_BUTTON}
    Sleep    3s

Change Language To English
    Mouse Over    ${LANG_DROPDOWN}
    Sleep    1s
    Click Element    ${LANG_DROPDOWN}
    Wait Until Element Is Visible    ${EN_BUTTON}    timeout=5s
    Click Element    ${EN_BUTTON}
    Sleep    3s

Change Language To Chinese
    Mouse Over    ${LANG_DROPDOWN}
    Sleep    1s
    Click Element    ${LANG_DROPDOWN}
    Wait Until Element Is Visible    ${CH_BUTTON}    timeout=5s
    Click Element    ${CH_BUTTON}
    Sleep    3s