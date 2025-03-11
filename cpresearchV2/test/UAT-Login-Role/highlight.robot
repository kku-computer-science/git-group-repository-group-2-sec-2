*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${BROWSER}        Firefox
${SERVER}         https://soften2sec267.cpkkuhost.com
${DELAY}          3
${USERNAME}       thanlao@kku.ac.th
${PASSWORD}       123456789

${URL}            ${SERVER}/login

${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']
${LANG_THAI}      xpath=//a[@href='${SERVER}/lang/th']
${LANG_CHINESE}   xpath=//a[@href='${SERVER}/lang/zh']
${LANG_ENGLISH}   xpath=//a[@href='${SERVER}/lang/en']

${HIGHLIGHT_TAB}  xpath=//*[@id="sidebar"]/ul/li[6]/a
${HIGHLIGHT_HEADER}  xpath=/html/body/div/div/div/div/div/h2

${LOGOUT_BUTTON}  xpath=/html/body/div/nav/div[2]/ul[2]/li[4]/a

*** Test Cases ***
Login, Go to Highlight Tab, Change Language, and Logout
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Open Browser And Login
    Click Highlight Menu
    Change Language And Verify  ${LANG_THAI}   ไฮไลท์
    Change Language And Verify  ${LANG_CHINESE}  亮点
    Change Language And Verify  ${LANG_ENGLISH}  Highlight
    Logout
    Close Browser

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

Change Language And Verify
    [Arguments]  ${LANG_OPTION}  ${EXPECTED_TEXT}
    
    Log To Console  \n🔄 กำลังเปลี่ยนภาษาเป็น ${EXPECTED_TEXT}...
    
    Wait Until Element Is Visible  ${LANG_DROPDOWN}  timeout=10s
    Execute JavaScript    document.getElementById('navbarDropdownMenuLink').click();
    Click Element  ${LANG_DROPDOWN}
    Sleep  2s
    Wait Until Element Is Visible  ${LANG_OPTION}  timeout=5s
    Click Element  ${LANG_OPTION}
    Sleep  2s
    Capture Page Screenshot
    Log    Changed language to ${EXPECTED_TEXT}

    # Verify Highlight Tab text
    ${tab_text} =    Get Text    ${HIGHLIGHT_TAB}
    Should Be Equal As Strings    ${tab_text}    ${EXPECTED_TEXT}
    Log To Console  ✅ ตรวจสอบแท็บ Highlight: ${tab_text} (ถูกต้อง)

    # Verify Highlight Header text
    ${header_text} =    Get Text    ${HIGHLIGHT_HEADER}
    Should Be Equal As Strings    ${header_text}    ${EXPECTED_TEXT}
    Log To Console  ✅ ตรวจสอบหัวข้อ Highlight: ${header_text} (ถูกต้อง)

Logout
    Wait Until Element Is Visible  ${LOGOUT_BUTTON}  timeout=10s
    Click Element  ${LOGOUT_BUTTON}
    Sleep  2s
    Capture Page Screenshot
    Log To Console  ✅ ออกจากระบบสำเร็จ
    Log  Successfully logged out