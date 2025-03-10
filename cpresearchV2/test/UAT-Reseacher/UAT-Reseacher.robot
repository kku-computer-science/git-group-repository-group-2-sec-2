*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         http://127.0.0.1:8000/
${Lecturer_URL}  ${URL}researchers/2
${Master_Student_URL}  ${URL}researchers/7
${BROWSER}     Chrome

# Language Buttons
${LANG_MENU}   //a[@id='navbarDropdownMenuLink']
${LANG_EN}     //a[normalize-space()='English']
${LANG_TH}     //a[normalize-space()='ไทย']
${LANG_CN}     //a[normalize-space()='中文']

# Researchers Dropdown Menu
${RESEARCHERS_MENU}    //a[@id='navbarDropdown']
${RESEARCHERS_LIST}    //ul[contains(@class, 'dropdown-menu') and @aria-labelledby='navbarDropdown']
${Lecturer_ROLE_EN}  //ul[contains(@class, 'dropdown-menu')]//a[contains(text(),'Lecturer')]
${Master_Student_ROLE_EN}  //ul[contains(@class, 'dropdown-menu')]//a[contains(text(),'Master Student')]

# Expertise Label
${EXPERTISE_LABEL_EN}    //p[contains(@class,'card-text-1') and contains(text(),'Expertise')]
${EXPERTISE_LABEL_TH}    //p[contains(@class,'card-text-1') and contains(text(),'ความเชี่ยวชาญ')]
${EXPERTISE_LABEL_CN}    //p[contains(@class,'card-text-1') and contains(text(),'专长')]

# Punyaphol Elements
${CHECK_PUNYAPHOL_EN}    //h5[contains(text(),'Punyaphol Horata, Ph.D.')]
${CHECK_PUNYAPHOL_TH}    //h5[contains(text(),'รศ.ดร. ปัญญาพล หอระตะ')]
${CHECK_PUNYAPHOL_CN}    //h5[contains(text(),'Punyaphol Horata, 博士')]

${POSITION_PUNYAPHOL_EN}  //h5[contains(text(),'Associate Professor')]
${POSITION_PUNYAPHOL_CN}  //h5[contains(text(),'副教授')]

${EXPERTISE_PUNYAPHOL_EN}   //div[@class='card-expertise']/p[contains(text(),'Machine Learning and Intelligent Systems')]
${EXPERTISE_PUNYAPHOL_TH}   //div[@class='card-expertise']/p[contains(text(),'การเรียนรู้ของเครื่องและระบบอัจฉริยะ')]
${EXPERTISE_PUNYAPHOL_CN}   //div[@class='card-expertise']/p[contains(text(),'机器学习与智能系统')]

${SEARCH_NAME_PUNYAPHOL}   Punyaphol

# Arfat Elements
${CHECK_ARFAT_EN}   //h5[contains(text(),'Arfat Ahmad Khan, Ph.D.')]
${CHECK_ARFAT_TH}   //h5[contains(text(),'อ.ดร. Arfat Ahmad Khan')]
${CHECK_ARFAT_CN}   //h5[contains(text(),'Arfat Ahmad Khan, 博士')]

${POSITION_ARFAT_EN}  //h5[contains(text(),'Lecturer')]
${POSITION_ARFAT_CN}  //h5[contains(text(),'讲师')]

${EXPERTISE_ARFAT_EN}   //div[@class='card-expertise']/p[contains(text(),'Internet Security')]
${EXPERTISE_ARFAT_TH}   //div[@class='card-expertise']/p[contains(text(),'การรักษาความปลอดภัยของอินเทอร์เน็ต')]
${EXPERTISE_ARFAT_CN}   //div[@class='card-expertise']/p[contains(text(),'互联网安全')]

${SEARCH_NAME_ARFAT}   Arfat

# Fan Element
${CHECK_FAN_EN}   //h5[contains(text(),'Fan Bingbing')]
${CHECK_FAN_TH}   //h5[contains(text(),'Fan Bingbing')]
${CHECK_FAN_CN}   //h5[contains(text(),'范冰冰')]

${SEARCH_NAME_FAN}   Fan 

# Search Fields
${SEARCH_BOX}      //input[@name='textsearch']
${SEARCH_BTN_EN}   //button[contains(text(),'Search')]
${SEARCH_BTN_TH}   //button[contains(text(),'ค้นหา')]
${SEARCH_BTN_CN}   //button[normalize-space()='搜索']

*** Keywords ***
Open Browser And Navigate To Home
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Sleep    2s

Navigate To Researchers Lecturer Page
    Wait Until Element Is Visible    ${RESEARCHERS_MENU}    timeout=10s
    Mouse Over    ${RESEARCHERS_MENU}
    Click Element    ${RESEARCHERS_MENU}
    Sleep    1s
    Wait Until Element Is Visible    ${RESEARCHERS_LIST}    timeout=10s
    Click Element    ${Lecturer_ROLE_EN}  
    Sleep    2s
    Wait Until Location Is    ${Lecturer_URL}    timeout=10s
    Wait Until Page Contains Element    ${CHECK_PUNYAPHOL_EN}    timeout=20s

Navigate To Researchers Master Student Page
    Wait Until Element Is Visible    ${RESEARCHERS_MENU}    timeout=10s
    Mouse Over    ${RESEARCHERS_MENU}
    Click Element    ${RESEARCHERS_MENU}
    Sleep    1s
    Wait Until Element Is Visible    ${RESEARCHERS_LIST}    timeout=10s
    Click Element    ${Master_Student_ROLE_EN}  
    Sleep    2s
    Wait Until Location Is    ${Master_Student_URL}    timeout=10s
    Wait Until Page Contains Element    ${CHECK_FAN_EN}    timeout=20s

Change Language And Search
    [Arguments]    ${language}    ${search_btn}    ${expected_result}    ${check_language}    ${position_check}    ${expertise_label}    ${expertise_check}    ${search_text}
    
    Wait Until Element Is Visible    ${LANG_MENU}    timeout=10s
    Click Element    ${LANG_MENU}
    Sleep    1s
    Run Keyword If    '${language}' == 'CN'    Scroll Element Into View    ${LANG_CN}
    Run Keyword If    '${language}' == 'TH'    Click Element    ${LANG_TH}
    Run Keyword If    '${language}' == 'EN'    Click Element    ${LANG_EN}
    Run Keyword If    '${language}' == 'CN'    Click Element    ${LANG_CN}
    Sleep    2s
    Wait Until Page Contains Element    ${check_language}    timeout=10s

    # ตรวจสอบ Label ของ Expertise (คำว่า "Expertise", "ความเชี่ยวชาญ", "专长")
    ${EXPERTISE_LABEL_EXISTS}    Run Keyword And Return Status    Page Should Contain Element    ${expertise_label}    timeout=10s
    Run Keyword If    ${EXPERTISE_LABEL_EXISTS}    Wait Until Page Contains Element    ${expertise_label}    timeout=10s

    # ตรวจสอบ Position ถ้ามี
    ${POSITION_EXISTS}    Run Keyword And Return Status    Page Should Contain Element    ${position_check}    timeout=10s
    Run Keyword If    ${POSITION_EXISTS}    Wait Until Page Contains Element    ${position_check}    timeout=10s

    # ตรวจสอบ Expertise ถ้ามี
    ${EXPERTISE_EXISTS}    Run Keyword And Return Status    Page Should Contain Element    ${expertise_check}    timeout=10s
    Run Keyword If    ${EXPERTISE_EXISTS}    Wait Until Page Contains Element    ${expertise_check}    timeout=10s

    Wait Until Element Is Visible    ${SEARCH_BOX}    timeout=10s
    Input Text    ${SEARCH_BOX}    ${search_text}
    Click Element    ${search_btn}
    Sleep    2s
    Wait Until Page Contains Element    ${expected_result}    timeout=10s

Reset Search To Show All
    Wait Until Element Is Visible    ${SEARCH_BOX}    timeout=10s
    Clear Element Text    ${SEARCH_BOX}
    Click Element    ${SEARCH_BTN_EN}
    Sleep    2s

*** Test Cases ***
เปิดเบราว์เซอร์และไปที่หน้าผู้วิจัย
    Open Browser And Navigate To Home
    Navigate To Researchers Lecturer Page
    Wait Until Page Contains    Punyaphol Horata    timeout=15s
    Sleep    2s

TC_01: ทดสอบข้อมูลอาจารย์ Punyaphol
    Change Language And Search    TH    ${SEARCH_BTN_TH}    ${CHECK_PUNYAPHOL_TH}    ${CHECK_PUNYAPHOL_TH}    ${EMPTY}    ${EXPERTISE_LABEL_TH}    ${EXPERTISE_PUNYAPHOL_TH}    ${SEARCH_NAME_PUNYAPHOL}
    Change Language And Search    CN    ${SEARCH_BTN_CN}    ${CHECK_PUNYAPHOL_CN}    ${CHECK_PUNYAPHOL_CN}    ${POSITION_PUNYAPHOL_CN}    ${EXPERTISE_LABEL_CN}    ${EXPERTISE_PUNYAPHOL_CN}    ${SEARCH_NAME_PUNYAPHOL}
    Change Language And Search    EN    ${SEARCH_BTN_EN}    ${CHECK_PUNYAPHOL_EN}    ${CHECK_PUNYAPHOL_EN}    ${POSITION_PUNYAPHOL_EN}    ${EXPERTISE_LABEL_EN}    ${EXPERTISE_PUNYAPHOL_EN}    ${SEARCH_NAME_PUNYAPHOL}
    Sleep    2s
    Reset Search To Show All
    Sleep    2s

TC_02: ทดสอบข้อมูลอาจารย์ Arfat
    Change Language And Search    TH    ${SEARCH_BTN_TH}    ${CHECK_ARFAT_TH}    ${CHECK_ARFAT_TH}    ${EMPTY}    ${EXPERTISE_LABEL_TH}    ${EXPERTISE_ARFAT_TH}    ${SEARCH_NAME_ARFAT}
    Change Language And Search    CN    ${SEARCH_BTN_CN}    ${CHECK_ARFAT_CN}    ${CHECK_ARFAT_CN}    ${POSITION_ARFAT_CN}    ${EXPERTISE_LABEL_CN}    ${EXPERTISE_ARFAT_CN}    ${SEARCH_NAME_ARFAT}
    Change Language And Search    EN    ${SEARCH_BTN_EN}    ${CHECK_ARFAT_EN}    ${CHECK_ARFAT_EN}    ${POSITION_ARFAT_EN}    ${EXPERTISE_LABEL_EN}    ${EXPERTISE_ARFAT_EN}    ${SEARCH_NAME_ARFAT}
    Sleep    2s
    Navigate To Researchers Master Student Page
    Wait Until Page Contains    Fan Bingbing    timeout=15s
    Sleep    2s

TC_03: ทดสอบข้อมูล Fan Bingbing
    Change Language And Search    TH    ${SEARCH_BTN_TH}    ${CHECK_FAN_TH}    ${CHECK_FAN_TH}    ${EMPTY}    ${EXPERTISE_LABEL_TH}    ${EMPTY}    ${SEARCH_NAME_FAN}
    Change Language And Search    CN    ${SEARCH_BTN_CN}    ${CHECK_FAN_CN}    ${CHECK_FAN_CN}    ${EMPTY}    ${EXPERTISE_LABEL_CN}    ${EMPTY}    ${SEARCH_NAME_FAN}
    Change Language And Search    EN    ${SEARCH_BTN_EN}    ${CHECK_FAN_EN}    ${CHECK_FAN_EN}    ${EMPTY}    ${EXPERTISE_LABEL_EN}    ${EMPTY}    ${SEARCH_NAME_FAN}

    Close Browser