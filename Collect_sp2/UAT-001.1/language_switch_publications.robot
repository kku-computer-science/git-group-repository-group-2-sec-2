*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${BROWSER}    Chrome
${URL}    https://soften2sec267.cpkkuhost.com/

# ตัวแปรสำหรับการเปลี่ยนภาษา
${LANG_DROPDOWN}    xpath=//*[@id="navbarDropdownMenuLink"]
${EN_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'English')]
${TH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'ไทย')]
${CH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), '中文')]
${LANGUAGE_TEXT}    xpath=//h1  # ตรวจสอบข้อความหลัก

# ตัวแปรสำหรับการกดปุ่ม "2022"
${YEAR_2022_BUTTON}    xpath=//button[contains(text(), '2022')]

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
    Reload Page  
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Scroll Down And Click 2022  
    Capture Page Screenshot  th_publications_page.png  # ✅ บันทึกหลังจากกด 2022

    Change Language To English
    Reload Page
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Scroll Down And Click 2022  
    Capture Page Screenshot  en_publications_page.png  # ✅ บันทึกหลังจากกด 2022

    Change Language To Chinese
    Reload Page
    ${text} =    Get Text    ${LANG_DROPDOWN}
    Log  Current language: ${text}
    Scroll Down And Click 2022  
    Capture Page Screenshot  ch_publications_page.png  # ✅ บันทึกหลังจากกด 2022

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

Scroll Down And Click 2022
    Execute JavaScript    window.scrollTo(0, document.body.scrollHeight)
    Sleep    2s
    Click Year 2022

Click Year 2022
    Wait Until Element Is Visible    ${YEAR_2022_BUTTON}    timeout=5s
    Click Element    ${YEAR_2022_BUTTON}
    Sleep    2s
