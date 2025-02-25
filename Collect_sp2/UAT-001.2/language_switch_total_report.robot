*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${BROWSER}    Chrome
${URL}    http://127.0.0.1:8000

# ตัวแปรสำหรับการเปลี่ยนภาษา
${LANG_DROPDOWN}    xpath=//*[@id="navbarDropdownMenuLink"]
${EN_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'English')]
${TH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'ไทย')]
${CH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), '中文')]
${LANGUAGE_TEXT}    xpath=//h1  # ตรวจสอบข้อความหลัก

# ตัวแปรสำหรับตำแหน่งที่ต้องเลื่อน
${TARGET_ELEMENT}    xpath=//div[@class='container mt-3']

*** Test Cases ***
Test Switching Between All Languages
    Open Browser    ${URL}    ${BROWSER}
    Delete All Cookies
    Execute JavaScript    window.localStorage.clear();
    Execute JavaScript    window.sessionStorage.clear();
    Reload Page
    Maximize Browser Window
    Set Selenium Speed    0.3s

    Scroll To Target And Capture    en_test_page.png
    Change Language To Thai
    Scroll To Target And Capture    th_test_page.png
    Change Language To Chinese
    Scroll To Target And Capture    ch_test_page.png

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

Scroll To Target And Capture
    [Arguments]    ${screenshot_name}
    Wait Until Element Is Visible    xpath=/html/body/div/div[3]    timeout=10s
    ${y_position} =    Execute JavaScript    return document.evaluate('/html/body/div/div[3]', document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.getBoundingClientRect().top + window.scrollY - 100;
    Execute JavaScript    window.scrollTo({ top: ${y_position}, behavior: 'smooth' });
    Sleep    2s
    Capture Page Screenshot    ${screenshot_name}

