*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${BROWSER}    Firefox
${URL}    https://soften2sec267.cpkkuhost.com

# ✅ ปุ่มเปลี่ยนภาษา
${LANG_DROPDOWN}    xpath=//*[@id="navbarDropdownMenuLink"]
${EN_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'English')]
${TH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), 'ไทย')]
${CH_BUTTON}    xpath=//div[@class='dropdown-menu show']//a[contains(text(), '中文')]

# ✅ XPath ขององค์ประกอบหลัก
${LOGO}        xpath=//*[@id="navbar"]/div/a/img  
${BANNER1}     xpath=//*[@id="carouselExampleIndicators"]/div[2]/div[1]/img  
${BANNER2}     xpath=//*[@id="carouselExampleIndicators"]/div[2]/div[2]/img
${NEXT_BUTTON}    xpath=//*[@id="carouselExampleIndicators"]/button[2]/span[1]  
${BAR_CHART}   xpath=//canvas[@id="barChart1"]
${TARGET_ELEMENT}    xpath=//div[@class='container mt-3']
${TEXT_ELEMENT}    xpath=/html/body/div/div[3]/div/div[1]//*[@id="all"]/p

${PAPER2_BUTTON}    xpath=//*[@id="paper2"]/p/button
${MODAL_BUTTON}    xpath=//*[@id="myModal"]/div/div/div[3]/button

# ✅ XPath สำหรับเลื่อนและคลิกปุ่ม 2022
${PUBLICATIONS_SECTION}    xpath=/html/body/div/div[5]
${YEAR_2022_BUTTON}    xpath=//button[contains(text(), '2022')]

# ✅ XPath ของคำที่ต้องไม่เปลี่ยน
${SCOPUS_TEXT}    xpath=//*[@id="scopus"]/p
${WOS_TEXT}       xpath=//*[@id="wos"]/p
${TCI_TEXT}       xpath=//*[@id="tci"]/p

# ✅ XPath ของลิงก์ที่ต้องกด
${URL_LINK}       xpath=//*[@id="paper2"]/p/a[1]
${DOI_LINK}       xpath=//*[@id="paper2"]/p/a[2]

# ✅ ข้อความที่คาดหวังในแต่ละภาษา
&{EXPECTED_TEXTS}    
...    en=SUMMARY    
...    th=จำนวนทั้งหมด    
...    zh=摘要    

*** Test Cases ***
Test Website Functionality in All Languages
    Open Browser And Prepare

    # ✅ เริ่มที่ภาษาอังกฤษ (ค่าเริ่มต้น)
    Log To Console    *** Running Tests in English ***
    Test Website Functionality    en

    # ✅ เปลี่ยนเป็นภาษาไทย และทดสอบ
    Log To Console    *** Changing to Thai ***
    Change Language    th    ${TH_BUTTON}
    Test Website Functionality    th

    # ✅ เปลี่ยนเป็นภาษาจีน และทดสอบ
    Log To Console    *** Changing to Chinese ***
    Change Language    zh    ${CH_BUTTON}
    Test Website Functionality    zh

    Close Browser

*** Keywords ***
Open Browser And Prepare
    Open Browser    ${URL}    ${BROWSER}
    Delete All Cookies
    Execute JavaScript    window.localStorage.clear();
    Execute JavaScript    window.sessionStorage.clear();
    Reload Page
    Maximize Browser Window
    Set Selenium Speed    0.3s

Scroll To Top
    Log To Console    --- Scrolling to Top ---
    Execute JavaScript    window.scrollTo(0, 0);
    Sleep    2s
    Capture Page Screenshot    scrolled_to_top.png

Change Language
    [Arguments]    ${CURRENT_LANGUAGE}    ${LANGUAGE_XPATH}

    Log To Console    --- Changing Language to ${CURRENT_LANGUAGE} ---

    Scroll To Top  # ✅ เลื่อนขึ้นไปบนสุดก่อนเปลี่ยนภาษา

    Click Element    ${LANG_DROPDOWN}
    Wait Until Element Is Visible    ${LANGUAGE_XPATH}    5s
    Click Element    ${LANGUAGE_XPATH}

    Sleep    3s
    Reload Page  

    Capture Page Screenshot    language_changed_${CURRENT_LANGUAGE}.png

Test Website Functionality
    [Arguments]    ${CURRENT_LANGUAGE}

    # ✅ ตรวจสอบโลโก้
    Element Should Be Visible    ${LOGO}
    Capture Page Screenshot  logo_${CURRENT_LANGUAGE}.png
    Log To Console  ✅ LOGO is visible!

    # ✅ ตรวจสอบแบนเนอร์เริ่มต้น (Banner 1)
    Element Should Be Visible    ${BANNER1}
    Capture Page Screenshot  initial_banner_${CURRENT_LANGUAGE}.png
    Log To Console  ✅ First banner is visible!

    # ✅ กดปุ่มเปลี่ยน Banner
    Wait Until Element Is Visible    ${NEXT_BUTTON}    10s
    Click Element    ${NEXT_BUTTON}
    Sleep    3s
    Capture Page Screenshot  new_banner_${CURRENT_LANGUAGE}.png
    Log To Console  ✅ Banner1 to Banner2 changed successfully!

    # ✅ ตรวจสอบแบนเนอร์เปลี่ยนแล้ว
    Element Should Be Visible    ${BANNER2}
    Log To Console  ✅ Second banner is visible!
    
    # ✅ เลื่อนหน้าไปยังกราฟ
    Element Should Be Visible    ${TARGET_ELEMENT}
    Execute JavaScript    window.scrollBy(0, 500);
    Sleep    3s
    Execute JavaScript    window.scrollBy(0, 500);
    Capture Page Screenshot  scrolled_to_graph_${CURRENT_LANGUAGE}.png
    Log To Console  ✅ Scrolling to Graph

    # ✅ ตรวจสอบว่ากราฟมีอยู่จริง
    Page Should Contain Element    ${BAR_CHART}
    Wait Until Keyword Succeeds    5x    2s    Execute JavaScript    return typeof Chart !== 'undefined' && Chart.instances && Object.keys(Chart.instances).length > 0;
    Log To Console  ✅ Graph is present!

    # ✅ ตรวจสอบข้อความใน Section
    Wait Until Element Is Visible    ${TEXT_ELEMENT}    10s
    ${actual_text} =    Get Text    ${TEXT_ELEMENT}
    Log  Found Text: ${actual_text}
    Log To Console   ✅ Checking Text in Target Column 

    # ✅ เลือกข้อความที่คาดหวังตามภาษา
    ${expected_text} =    Set Variable    ${EXPECTED_TEXTS["${CURRENT_LANGUAGE}"]}

    # ✅ ตรวจสอบว่าข้อความที่พบตรงกับค่าที่คาดหวังหรือไม่
    Should Be Equal    ${actual_text}    ${expected_text}    Text does not match the expected language!

    Capture Page Screenshot  text_check_${CURRENT_LANGUAGE}.png

    # ✅ ตรวจสอบคำที่ไม่เปลี่ยนแปลง
    Verify Fixed Text    ${SCOPUS_TEXT}    SCOPUS
    Verify Fixed Text    ${WOS_TEXT}    WOS
    Verify Fixed Text    ${TCI_TEXT}    TCI
    Log To Console  ✅ Checking Fixed Texts (SCOPUS, WOS, TCI)

    # ✅ เลื่อนหน้าไปยัง "Publications (In the Last 5 Years)"
    Execute JavaScript    window.scrollTo(0, document.body.scrollHeight)
    Sleep    2s
    Capture Page Screenshot  scrolled_to_publications_${CURRENT_LANGUAGE}.png
    Log To Console   ✅ Scrolling to Publications Section 

    # ✅ กดปุ่มปี 2022
    Wait Until Element Is Visible    ${YEAR_2022_BUTTON}    timeout=5s
    Click Element    ${YEAR_2022_BUTTON}
    Sleep    2s
    Capture Page Screenshot  clicked_2022_${CURRENT_LANGUAGE}.png
    Log To Console  ✅ Clicking 2022 Publications

    # ✅ กดลิงก์ URL (Scopus) และปิดแท็บ
    Log To Console    🔄 Clicking and Closing URL Link
    Click Scopus Link
    Log To Console    ✅ Clicking and Closing URL Link

    # ✅ กดลิงก์ DOI และปิดแท็บ
    Log To Console    🔄 Clicking and Closing DOI Link
    Click DOI Link
    Log To Console    ✅ Clicking and Closing DOI Link
    
    # ✅ กดปุ่ม Paper2 และปิดโมดัล
    Log To Console    🔄 Navigating to Paper2 Button using TAB
    Press Keys    None    TAB
    Sleep    0.3s
    Press Keys    None    TAB
    Sleep    0.3s
    Press Keys    None    TAB
    Sleep    0.3s
    Press Keys    None    SHIFT+TAB
    Sleep    0.3s
    Press Keys    None    SHIFT+TAB
    Sleep    0.3s
    Press Keys    None    ENTER
    Sleep    2s
    Capture Page Screenshot    paper2_${CURRENT_LANGUAGE}.png

    Wait Until Element Is Visible    ${MODAL_BUTTON}    timeout=5s
    Click Element    ${MODAL_BUTTON}
    Sleep    2s
    Capture Page Screenshot  modal_closed_${CURRENT_LANGUAGE}.png

Click And Close Link
    [Arguments]    ${ELEMENT_XPATH}
    Wait Until Element Is Visible    ${ELEMENT_XPATH}    5s
    Click Element    ${ELEMENT_XPATH}
    Sleep    3s
    Switch Window    NEW
    Capture Page Screenshot    link_opened.png
    Close Window
    Switch Window    MAIN
    Log To Console    Successfully closed the link tab
    
Verify Fixed Text
    [Arguments]    ${ELEMENT_XPATH}    ${EXPECTED_TEXT}
    ${actual_text} =    Get Text    ${ELEMENT_XPATH}
    Should Be Equal    ${actual_text}    ${EXPECTED_TEXT}    Fixed text '${EXPECTED_TEXT}' has changed!

Click Scopus Link
    # ✅ ตรวจสอบว่า accordion ปี 2022 เปิดอยู่หรือไม่
    ${is_open}    Execute JavaScript    return document.querySelector('div#collapse2022').classList.contains('show');
    Run Keyword If    not ${is_open}    Execute JavaScript    document.querySelector('button[aria-controls="collapse2022"]').click();
    Sleep    2s

    # ✅ รอให้ URL ปรากฏ
    Wait Until Element Is Visible    xpath=//div[@id="collapse2022"]//a[contains(@href, 'scopus.com')]    timeout=10s

    # ✅ คลิกลิงก์ให้เปิดแท็บใหม่
    Click Element    xpath=//div[@id="collapse2022"]//a[contains(@href, 'scopus.com')]
    Sleep    3s

    # ✅ สลับไปแท็บใหม่ (Scopus) แล้วปิด
    Switch Window    NEW
    Sleep    2s
    Close Window
    Switch Window    MAIN
    Sleep    2s

Click DOI Link
    # ✅ ตรวจสอบว่า accordion ปี 2022 เปิดอยู่หรือไม่
    ${is_open}    Execute JavaScript    return document.querySelector('div#collapse2022').classList.contains('show');
    Run Keyword If    not ${is_open}    Execute JavaScript    document.querySelector('button[aria-controls="collapse2022"]').click();
    Sleep    2s

    # ✅ รอให้ DOI ปรากฏ
    Wait Until Element Is Visible    xpath=//div[@id="collapse2022"]//a[contains(@href, 'doi.org')]    timeout=10s

    # ✅ คลิกลิงก์ให้เปิดแท็บใหม่
    Click Element    xpath=//div[@id="collapse2022"]//a[contains(@href, 'doi.org')]
    Sleep    3s

    # ✅ สลับไปแท็บใหม่ (DOI) แล้วปิด
    Switch Window    NEW
    Sleep    2s
    Close Window
    Switch Window    MAIN
    Sleep    2s

