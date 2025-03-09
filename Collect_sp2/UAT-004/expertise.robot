*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${DELAY}          1
${BROWSER}        Firefox
${USERNAME}       pusadee@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${URL_EXPERTISE}  http://${SERVER}/expertise

# XPaths ของปุ่มเปลี่ยนภาษา
${LANGUAGE_DROPDOWN}     //a[@id="navbarDropdownMenuLink"]
${LANGUAGE_EN}           //a[@href="http://localhost:8000/lang/en"]
${LANGUAGE_TH}           //a[@href="http://localhost:8000/lang/th"]
${LANGUAGE_CN}           //a[@href="http://localhost:8000/lang/zh"]

# XPaths ของ Expertise Page (ภาษาอังกฤษ)
${EXPERTISE_TITLE_EN}    //h3[contains(text(), 'Expertise')]
${BUTTON_ADD_EXPERTISE_EN}    //button[contains(text(), 'Add Expertise')]

# XPaths ของ Expertise Page (ภาษาไทย)
${EXPERTISE_TITLE_TH}    //h3[contains(text(), 'ความเชี่ยวชาญ')]
${BUTTON_ADD_EXPERTISE_TH}    //button[contains(text(), 'เพิ่มความเชี่ยวชาญ')]

# XPaths ของ Expertise Page (ภาษาจีน)
${EXPERTISE_TITLE_CN}    //h3[contains(text(), '专长')]
${BUTTON_ADD_EXPERTISE_CN}    //button[contains(text(), '添加专长')]

*** Keywords ***
Open Browser And Login
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Dashboard  timeout=10s
    Capture Page Screenshot
    Sleep  1s

Navigate To Expertise
    Go To  ${URL_EXPERTISE}
    Wait Until Page Contains  Expertise  timeout=10s
    Capture Page Screenshot

Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_DROPDOWN}  timeout=5s
    Click Element  ${LANGUAGE_DROPDOWN}
    Capture Page Screenshot
    Sleep  1s

Select English Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_EN}  timeout=5s
    Click Element  ${LANGUAGE_EN}
    Sleep  2s
    Capture Page Screenshot

Verify Expertise Language English
    Wait Until Element Is Visible  ${EXPERTISE_TITLE_EN}  timeout=5s
    Page Should Contain Element  ${BUTTON_ADD_EXPERTISE_EN}
    Capture Page Screenshot

Select Thai Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_TH}  timeout=5s
    Click Element  ${LANGUAGE_TH}
    Sleep  2s
    Capture Page Screenshot

Verify Expertise Language Thai
    Wait Until Element Is Visible  ${EXPERTISE_TITLE_TH}  timeout=5s
    Page Should Contain Element  ${BUTTON_ADD_EXPERTISE_TH}
    Capture Page Screenshot

Select Chinese Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_CN}  timeout=5s
    Click Element  ${LANGUAGE_CN}
    Sleep  2s
    Capture Page Screenshot

Verify Expertise Language Chinese
    Wait Until Element Is Visible  ${EXPERTISE_TITLE_CN}  timeout=5s
    Page Should Contain Element  ${BUTTON_ADD_EXPERTISE_CN}
    Capture Page Screenshot

*** Test Cases ***
User Can Change Language To English And Verify Expertise Page
    Open Browser And Login
    Navigate To Expertise
    Select English Language
    Verify Expertise Language English
    Close Browser

User Can Change Language To Thai And Verify Expertise Page
    Open Browser And Login
    Navigate To Expertise
    Select Thai Language
    Verify Expertise Language Thai
    Close Browser

User Can Change Language To Chinese And Verify Expertise Page
    Open Browser And Login
    Navigate To Expertise
    Select Chinese Language
    Verify Expertise Language Chinese
    Close Browser
