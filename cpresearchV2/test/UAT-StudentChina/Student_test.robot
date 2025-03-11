*** Settings ***
Library    SeleniumLibrary

*** Variables ***
#will fix later when the server is ready
# ${SERVER}           soften2sec267.cpkkuhost.com
# ${URL_LOGIN}        ${SERVER}/login  # URL ของหน้า Login

${SERVER}           http://127.0.0.1:8000
${URL_LOGIN}        ${SERVER}/login  # URL ของหน้า Login

${BROWSER}          Chrome

# Language Dropdown & Language Selection
${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']  
${LANG_THAI}      xpath=//a[@href='${SERVER}/lang/th']  
${LANG_CHINESE}   xpath=//a[@href='${SERVER}/lang/zh']  
${LANG_ENGLISH}   xpath=//a[@href='${SERVER}/lang/en']  

# Language Codes
${LANG_THAI_CODE}        th
${LANG_CHINESE_CODE}     zh
${LANG_ENGLISH_CODE}     en

# Login Student account
${USERNAME}         fanbing@kkumail.com
${PASSWORD}         123456789

# Elements for Navigation Bar
${NAV_RESEARCH_PROJECT}        xpath=//a[contains(@href, '/researchProjects') and contains(span, 'Research Project')]
${NAV_RESEARCH_GROUP}          xpath=//a[contains(@href, '/researchGroups') and contains(span, 'Research Group')]
${NAV_RESEARCH_PUBLICATION}    xpath=//a[@data-bs-toggle='collapse' and contains(span, 'Manage Publications')]
${NAV_CERTIFICATE}             xpath=//a[contains(@href, '/certificateform') and span[contains(text(), 'Certificate Form')]]

# Certificate Form Container & Expected Texts
${CERT_CONTAINER}    xpath=/html/body/div/div/div/div/div
${CERT_TEXT_ENG}   Certificate Form\nWelcome to the Certificate Form page. Please proceed with your submission.
${CERT_TEXT_CHI}   证书表单\n欢迎来到证书表单页面。请继续提交您的信息。
${CERT_TEXT_THAI}  แบบฟอร์มใบรับรอง\nยินดีต้อนรับสู่หน้าแบบฟอร์มใบรับรอง กรุณาดำเนินการส่งข้อมูลของคุณ  

*** Keywords ***
Open Browser And Login
    Open Browser  ${URL_LOGIN}  ${BROWSER}  
    Maximize Browser Window  
    Wait Until Element Is Visible  id=username  timeout=10s  
    Input Text  id=username  ${USERNAME}  
    Input Text  id=password  ${PASSWORD}  
    Capture Page Screenshot  Login.png
    Click Button  xpath=//button[@type='submit']  
    Wait Until Page Contains  Dashboard  timeout=10s  
    Capture Page Screenshot  dashboard.png  # 📸 จับภาพหน้าจอ Dashboard
    Sleep  1s  

Change Language And Check Context
    [Arguments]  ${LANG_OPTION}  ${LANG_CODE}  ${EXPECTED_TEXT}
    Change Language  ${LANG_OPTION}  ${LANG_CODE}
    Verify Certificate Page Text  ${EXPECTED_TEXT}  


Change Language
    [Arguments]  ${LANG_OPTION}  ${LANG_CODE}
    Wait Until Element Is Visible  ${LANG_DROPDOWN}  timeout=10s  
    Execute JavaScript    document.getElementById('navbarDropdownMenuLink').click();  
    Click Element  ${LANG_DROPDOWN}  
    Sleep  1s  
    Wait Until Element Is Visible  ${LANG_OPTION}  timeout=5s  
    Click Element  ${LANG_OPTION}  
    Sleep  1s  

    Capture Page Screenshot  language_${LANG_CODE}.png  # 📸 จับภาพหน้าจอหลังเปลี่ยนภาษา
    Log  Changed language to ${LANG_CODE}

Check If Navigation Element Exists
    [Arguments]  ${NAV_LINK}  ${ELEMENT_NAME}
    ${EXISTS}=  Run Keyword And Return Status  SeleniumLibrary.Element Should Be Visible  ${NAV_LINK}  
    Run Keyword If  ${EXISTS}  Log  ✅ ${ELEMENT_NAME} is visible  
    Run Keyword If  not ${EXISTS}  Log  ❌ ${ELEMENT_NAME} is NOT found  

Verify And Click Navigation Link
    [Arguments]  ${NAV_LINK}  ${EXPECTED_TEXT}
    Sleep  2s
    Scroll Element Into View  ${NAV_LINK}  
    SeleniumLibrary.Wait Until Element Is Visible  ${NAV_LINK}  timeout=10s  
    ${TEXT}=  Get Text  ${NAV_LINK}
    Should Contain  ${TEXT}  ${EXPECTED_TEXT}  
    Log  Found navigation link: ${TEXT}  
    Click Element  ${NAV_LINK}  
    Wait Until Page Contains  ${EXPECTED_TEXT}  timeout=10s 
    Capture Page Screenshot  certificate_form.png  # 📸 จับภาพหน้าจอ Certificate Form
    Sleep  5s 

Verify Certificate Page Text
    [Arguments]  ${EXPECTED_TEXT}
    Wait Until Element Is Visible  ${CERT_CONTAINER}  timeout=10s  
    ${ACTUAL_TEXT}=  Get Text  ${CERT_CONTAINER}  
    Should Be Equal  ${ACTUAL_TEXT}  ${EXPECTED_TEXT}  
    Log  Verified text: ${ACTUAL_TEXT}  

Logout
    Wait Until Element Is Visible    xpath=//a[contains(text(), 'Logout')]    timeout=10s  
    Execute JavaScript    document.getElementById('logout-form').submit();  
    Sleep    2s  
    Capture Page Screenshot    logout.png
    Wait Until Page Contains    Login    timeout=10s  
    Log    Successfully logged out



*** Test Cases ***
Login Test
    Open Browser And Login

Dashboard Test
    Maximize Browser Window  
    Wait Until Page Contains  Dashboard  timeout=10s  
    Verify And Click Navigation Link  ${NAV_RESEARCH_PUBLICATION}  Manage Publications  
    Capture Page Screenshot  Show Element.png  

Verify Research Project Navigation
    Check If Navigation Element Exists  ${NAV_RESEARCH_PROJECT}  Research Project  

Verify Research Group Navigation
    Check If Navigation Element Exists  ${NAV_RESEARCH_GROUP}  Research Group  

Verify Manage Publications Navigation
    Check If Navigation Element Exists  ${NAV_RESEARCH_PUBLICATION}  Manage Publications  

Verify Certificate Form Navigation
    Verify And Click Navigation Link  ${NAV_CERTIFICATE}  Certificate Form  

Check Certificate Form in Thai
    Change Language And Check Context  ${LANG_THAI}  ${LANG_THAI_CODE}  ${CERT_TEXT_THAI} 

Check Certificate Form in Chinese
    Change Language And Check Context  ${LANG_CHINESE}  ${LANG_CHINESE_CODE}  ${CERT_TEXT_CHI}  

Check Certificate Form in English
    Change Language And Check Context  ${LANG_ENGLISH}  ${LANG_ENGLISH_CODE}  ${CERT_TEXT_ENG} 
    
Logout Test
    Logout  
    Close Browser  
