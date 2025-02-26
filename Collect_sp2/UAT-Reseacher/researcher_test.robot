*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         https://soften2sec267.cpkkuhost.com/
${EXPECTED_URL}  ${URL}researchers/2
${BROWSER}     Chrome

# Language Buttons
${LANG_MENU}   //a[@id='navbarDropdownMenuLink']
${LANG_EN}     //a[normalize-space()='English']
${LANG_TH}     //a[normalize-space()='ไทย']
${LANG_CN}     //a[normalize-space()='中文']

# Researchers Dropdown Menu
${RESEARCHERS_MENU}    //a[@id='navbarDropdown']
${RESEARCHERS_LIST}    //ul[contains(@class, 'dropdown-menu') and @aria-labelledby='navbarDropdown']
${RESEARCHER_ROLE_EN}  //ul[contains(@class, 'dropdown-menu')]//a[contains(text(),'Lecturer')]

# Elements for Checking Language
${CHECK_EN}    //h5[contains(text(),'Sartra Wongthanavasu, Ph.D.')]
${CHECK_TH}    //h5[contains(text(),'ศ.ดร. ศาสตรา วงศ์ธนวสุ')]
${CHECK_CN}    //h5[contains(text(),'Sartra Wongthanavasu, 博士')]

# Position Elements (ไม่ใช้ในภาษาไทย)
${POSITION_EN}  //h5[contains(text(),'Professor')]
${POSITION_CN}  //h5[contains(text(),'教授')]

# Expertise Elements
${EXPERTISE_LABEL_EN}  //p[contains(text(),'Expertise')]
${EXPERTISE_LABEL_TH}  //p[contains(text(),'ความเชี่ยวชาญ')]
${EXPERTISE_LABEL_CN}  //p[contains(text(),'专长')]

# Search Fields
${SEARCH_BOX}      //input[@name='textsearch']
${SEARCH_BTN_EN}   //button[contains(text(),'Search')]
${SEARCH_BTN_TH}   //button[contains(text(),'ค้นหา')]
${SEARCH_BTN_CN}   //button[normalize-space()='搜索']

# Search Names
${SEARCH_NAME_EN}   Sartra
${SEARCH_NAME_TH}   ศาสตรา
${SEARCH_NAME_CN}   Sartra

# Search Results
${RESULT_EN}   //h5[contains(text(),'Sartra Wongthanavasu, Ph.D.')]
${RESULT_TH}   //h5[contains(text(),'ศ.ดร. ศาสตรา วงศ์ธนวสุ')]
${RESULT_CN}   //h5[contains(text(),'Sartra Wongthanavasu, 博士')]

*** Keywords ***
Navigate To Researchers Page
    [Documentation]  เปิดเบราว์เซอร์และไปที่หน้าผู้วิจัย (Researchers)
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Sleep    2s
    
    Wait Until Element Is Visible    ${RESEARCHERS_MENU}    timeout=5s
    Mouse Over    ${RESEARCHERS_MENU}
    Click Element    ${RESEARCHERS_MENU}
    Sleep    1s

    Wait Until Element Is Visible    ${RESEARCHERS_LIST}    timeout=5s
    Click Element    ${RESEARCHER_ROLE_EN}  
    Sleep    2s
    
    Wait Until Location Is    ${EXPECTED_URL}    timeout=5s
    Capture Page Screenshot    after_click_lecturer.png
    Wait Until Page Contains Element    ${CHECK_EN}    timeout=5s

Change Language And Search
    [Arguments]    ${language}    ${search_btn}    ${expected_result}    ${check_language}    ${position_check}    ${expertise_label}    ${search_text}
    [Documentation]  ทดสอบการเปลี่ยนภาษาเป็น ${language} และค้นหาชื่ออาจารย์

    Wait Until Element Is Visible    ${LANG_MENU}    timeout=5s
    Click Element    ${LANG_MENU}
    Sleep    1s

    Run Keyword If    '${language}' == 'CN'    Scroll Element Into View    ${LANG_CN}

    Run Keyword If    '${language}' == 'TH'    Click Element    ${LANG_TH}
    Run Keyword If    '${language}' == 'EN'    Click Element    ${LANG_EN}
    Run Keyword If    '${language}' == 'CN'    Click Element    ${LANG_CN}

    Sleep    2s
    Wait Until Page Contains Element    ${check_language}    timeout=5s
    Run Keyword If    '${language}' != 'TH'    Wait Until Page Contains Element    ${position_check}    timeout=5s
    Wait Until Page Contains Element    ${expertise_label}    timeout=5s

    Wait Until Element Is Visible    ${SEARCH_BOX}    timeout=5s
    Input Text    ${SEARCH_BOX}    ${search_text}
    Click Element    ${search_btn}
    Sleep    2s

    Wait Until Page Contains Element    ${expected_result}    timeout=5s

*** Test Cases ***
Test Change Language And Search By Name
    [Documentation]  ทดสอบเปลี่ยนภาษาและค้นหาชื่ออาจารย์แทน "Big Data Analytics"
    Navigate To Researchers Page
    Change Language And Search    EN    ${SEARCH_BTN_EN}    ${RESULT_EN}    ${CHECK_EN}    ${POSITION_EN}    ${EXPERTISE_LABEL_EN}    ${SEARCH_NAME_EN}
    Change Language And Search    TH    ${SEARCH_BTN_TH}    ${RESULT_TH}    ${CHECK_TH}    ${EMPTY}    ${EXPERTISE_LABEL_TH}    ${SEARCH_NAME_TH}
    Change Language And Search    CN    ${SEARCH_BTN_CN}    ${RESULT_CN}    ${CHECK_CN}    ${POSITION_CN}    ${EXPERTISE_LABEL_CN}    ${SEARCH_NAME_CN}
    Close Browser
