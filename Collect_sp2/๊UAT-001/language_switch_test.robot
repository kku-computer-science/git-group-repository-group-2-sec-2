*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${BROWSER}    Chrome
${URL}    http://127.0.0.1:8000
${LANG_DROPDOWN}    xpath=//*[@id="navbarDropdownMenuLink"]
${EN_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'English')]
${TH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'ไทย')]
${CH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), '中文')]
${LANGUAGE_TEXT}    xpath=//h1  # ตรวจสอบข้อความหลัก

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
