*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         soften2sec267.cpkkuhost.com
${DELAY}          1
${BROWSER}        Firefox
${USERNAME}       punhor1@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${URL_PROFILE}    http://${SERVER}/profile
${URL_HEAD}    http://${SERVER}/assistant-researcher
${DELAY}       0.2
${TIMEOUT}     10s
# XPaths ของปุ่มเปลี่ยนภาษา
${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']
${LANG_THAI}      xpath=//a[@href='http://${SERVER}/lang/th']
${LANG_CHINESE}   xpath=//a[@href='http://${SERVER}/lang/zh']
${LANG_ENGLISH}   xpath=//a[@href='http://${SERVER}/lang/en']

${SIDEBAR_MANAGE_FUND}   //*[@id="sidebar"]/ul/li[5]/a/span
${SIDEBAR_BOOKS}        //*[@id="sidebar"]/ul/li[8]/a/span
${SIDEBAR_MANAGE_PUBLIC}       //*[@id="sidebar"]/ul/li[8]/a/span
${SIDEBAR_RESPROJECT}   //*[@id="sidebar"]/ul/li[6]/a/span
${SIDEBAR_RESEARCH_GROUP}       //*[@id="sidebar"]/ul/li[7]/a/span
${ACCOUNT}   //*[@id="account-tab"]
${VIEW_BUTTON}       //*[@id="example1"]/tbody[1]/tr[5]/td[5]/form/li[1]/a

*** Keywords ***
Zoom Out
    [Documentation]    ซูมออกหน้าเว็บเพื่อลดขนาดการแสดงผล
    Execute Javascript    document.body.style.zoom="60%"

Open Browser And Login
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Zoom Out
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    Wait Until Page Contains  Dashboard  timeout=10s
    Capture Page Screenshot
    Sleep  1s

Change Language And Check Context
    Zoom Out
    [Arguments]  ${LANG_OPTION}
    Change Language  ${LANG_OPTION}
Change Language
    Zoom Out
    [Arguments]  ${LANG_OPTION}
    Wait Until Element Is Visible  ${LANG_DROPDOWN}  timeout=10s
    Execute JavaScript    document.getElementById('navbarDropdownMenuLink').click();
    Click Element  ${LANG_DROPDOWN}
    Sleep  2s
    Wait Until Element Is Visible  ${LANG_OPTION}  timeout=5s
    Click Element  ${LANG_OPTION}
    Sleep  2s
    Capture Page Screenshot
    Log    Changed language to ${LANG_OPTION}


Click ManagePublications In Sidebar EN
    Zoom Out
    Wait Until Element Is Visible  ${SIDEBAR_MANAGE_PUBLIC}  timeout=5s
    Click Element  ${SIDEBAR_MANAGE_PUBLIC}
    Click Element  xpath=//a[@href='#ManagePublications']
    Wait Until Element Is Visible  id=ManagePublications  timeout=5s
    Page Should Contain Element  xpath=//a[contains(@href, '/papers') and contains(text(), 'Published research')]
    # คลิก Published Research
    Click Element  xpath=//a[contains(@href, '/papers') and contains(text(), 'Published research')]
    Check Published Research Context EN
    Capture Page Screenshot
    Sleep  1s


Click ManagePublications In Sidebar TH
    Zoom Out
    Wait Until Element Is Visible  ${SIDEBAR_MANAGE_PUBLIC}  timeout=5s
    Click Element  ${SIDEBAR_MANAGE_PUBLIC}
    Click Element  xpath=//a[@href='#ManagePublications']
    Wait Until Element Is Visible  id=ManagePublications  timeout=5s
    Page Should Contain Element  xpath=//a[contains(@href, '/papers') and contains(text(), 'งานวิจัยที่ได้รับการตีพิมพ์')]
    # คลิก Published Research
    Click Element  xpath=//a[contains(@href, '/papers') and contains(text(), 'งานวิจัยที่ได้รับการตีพิมพ์')]
    Check Published Research Context TH
    Capture Page Screenshot
    Sleep  1s


Click ManagePublications In Sidebar ZH
    Zoom Out
    Wait Until Element Is Visible  ${SIDEBAR_MANAGE_PUBLIC}  timeout=5s
    Click Element  ${SIDEBAR_MANAGE_PUBLIC}
    Click Element  xpath=//a[@href='#ManagePublications']
    Wait Until Element Is Visible  id=ManagePublications  timeout=5s
    Page Should Contain Element  xpath=//a[contains(@href, '/papers') and contains(text(), '已发表研究')]
    # คลิก Published Research
    Click Element  xpath=//a[contains(@href, '/papers') and contains(text(), '已发表研究')]
    Check Published Research Context ZH
    Capture Page Screenshot
    Sleep  1s


Click User Profile In Sidebar EN
    Zoom Out
    Go To  ${URL_PROFILE}
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Check Profile Setting Context EN
    Capture Page Screenshot
    Sleep  1s

Click User Profile In Sidebar TH
    Zoom Out
    Go To  ${URL_PROFILE}
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Check Profile Setting Context TH
    Capture Page Screenshot
    Sleep  1s

Click User Profile In Sidebar ZH
    Zoom Out
    Go To  ${URL_PROFILE}
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Check Profile Setting Context ZH
    Capture Page Screenshot
    Sleep  1s

Click Assistant Wanted In Sidebar EN
    Zoom Out
    Go To  ${URL_HEAD}
    Check For Head Project Context EN
    Capture Page Screenshot
    Sleep  1s

Click Assistant Wanted In Sidebar TH
    Zoom Out
    Go To  ${URL_HEAD}
    Check For Head Project Context TH
    Capture Page Screenshot
    Sleep  1s

Click Assistant Wanted In Sidebar ZH
    Zoom Out
    Go To  ${URL_HEAD}
    Check For Head Project Context ZH
    Capture Page Screenshot
    Sleep  1s


Check Profile Setting Context EN
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    Profile Setting
    #เช็ค คำที่เปลี่ยน ชื่อคำนำหน้า
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[3]/div/label   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[3]/div/label    Name Title
    #เช็ค คำที่ไม่เปลี่ยน Scholar ID
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[9]/div/label   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[9]/div/label    Scholar ID
    Capture Page Screenshot

Check Profile Setting Context TH
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    ตั้งค่าโปรไฟล์
    #เช็ค คำที่เปลี่ยน ชื่อคำนำหน้า
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[3]/div/label   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[3]/div/label    คำนำหน้าชื่อ
    #เช็ค คำที่ไม่เปลี่ยน Scholar ID
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[9]/div/label   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[9]/div/label    Scholar ID
    Capture Page Screenshot

Check Profile Setting Context ZH
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    个人资料设置
    #เช็ค คำที่เปลี่ยน ชื่อคำนำหน้า
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[3]/div/label   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[3]/div/label    姓名标题
    #เช็ค คำที่ไม่เปลี่ยน Scholar ID
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[9]/div/label   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div[1]/div/div[2]/div[1]/form/div[1]/div[9]/div/label    Scholar ID
    Capture Page Screenshot

Check DOI Context EN 
#เช็ค คำที่ไม่เปลี่ยน DOI
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div[3]/div/div/div/div/div/div/div[13]/p[1]/b   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div[3]/div/div/div/div/div/div/div[13]/p[1]/b    DOI
    Capture Page Screenshot

Check DOI Context TH
#เช็ค คำที่ไม่เปลี่ยน DOI
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div[3]/div/div/div/div/div/div/div[13]/p[1]/b   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div[3]/div/div/div/div/div/div/div[13]/p[1]/b    DOI
    Capture Page Screenshot

Check DOI Context ZH
#เช็ค คำที่ไม่เปลี่ยน DOI
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div[3]/div/div/div/div/div/div/div[13]/p[1]/b   timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div[3]/div/div/div/div/div/div/div[13]/p[1]/b    DOI
    Capture Page Screenshot

Check Published Research Context EN
#เช็ค คำที่เปลี่ยน ชื่อหน้า Published Research
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    Published Research
    Capture Page Screenshot

Check Published Research Context TH
#เช็ค คำที่เปลี่ยน ชื่อหน้า Published Research
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    วารผลงานตีพิมพ์
    Capture Page Screenshot

Check Published Research Context ZH
#เช็ค คำที่เปลี่ยน ชื่อหน้า Published Research
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4   已發表的研究
    Capture Page Screenshot

Click Button "VIEW"
    Zoom Out
    Wait Until Element Is Visible  ${VIEW_BUTTON}  timeout=5s
    ${is_visible}=    Set Variable    False  
    WHILE    not ${is_visible}    limit=50
        ${is_visible}=  Run Keyword And Return Status    Element Should Be Visible    xpath=//*[@id="example1"]/tbody[1]/tr[5]/td[5]/form/li[1]
        Run Keyword If    not ${is_visible}  
        ...    Execute JavaScript    window.scrollBy(0, 100);  
        Sleep  0.5s
    END
    ${element}=  Get WebElement  xpath=//*[@id="example1"]/tbody[1]/tr[5]/td[5]/form/li[1]
    Execute JavaScript    arguments[0].scrollIntoView({"behavior": "smooth", "block": "center"});  ARGUMENTS  ${element}
    Sleep  1s  # รอให้การเลื่อนเสร็จสิ้น
    Click Element  xpath=//*[@id="example1"]/tbody[1]/tr[5]/td[5]/form/li[1]
    Wait Until Page Contains  Journal Details  timeout=5s

Check Journal Details Context EN
#เช็ค คำที่เปลี่ยน ชื่อหน้า Journal Details
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div[3]/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div[3]/div/div/div/div/div/div/h4    Journal Details    
    Capture Page Screenshot

Check Journal Details Context TH
#เช็ค คำที่เปลี่ยน ชื่อหน้า Journal Details
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div[3]/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div[3]/div/div/div/div/div/div/h4    รายละเอียดงานวารสาร    
    Capture Page Screenshot

Check Journal Details Context ZH
#เช็ค คำที่เปลี่ยน ชื่อหน้า Journal Details
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div[3]/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div[3]/div/div/div/div/div/div/h4    期刊详情    
    Capture Page Screenshot

Check For Head Project Context EN
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2    Assistant Wanted
    Capture Page Screenshot

Check For Head Project Context TH
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2    ต้องการผู้ช่วยวิจัย
    Capture Page Screenshot

Check For Head Project Context ZH
    Zoom Out
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/h2    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/h2   招聘研究助理
    Capture Page Screenshot



*** Test Cases ***
Test Teacher
    Open Browser And Login
    Change Language And Check Context  ${LANG_THAI}
    Change Language And Check Context  ${LANG_CHINESE}
    Change Language And Check Context  ${LANG_ENGLISH}
Test Profile Teacher
    Click User Profile In Sidebar EN
    Change Language And Check Context  ${LANG_THAI}
    Click User Profile In Sidebar TH
    Change Language And Check Context  ${LANG_CHINESE}
    Click User Profile In Sidebar ZH
    Change Language And Check Context  ${LANG_ENGLISH}
Test Journal
    Click ManagePublications In Sidebar EN
    Change Language And Check Context  ${LANG_THAI}
    Change Language And Check Context  ${LANG_CHINESE}
    Change Language And Check Context  ${LANG_ENGLISH}
    Click Button "VIEW"
    Zoom Out
    Change Language And Check Context  ${LANG_THAI}
    Check Journal Details Context TH
    Check DOI Context TH
    Change Language And Check Context  ${LANG_CHINESE}
    Check Journal Details Context ZH
    Check DOI Context ZH
    Change Language And Check Context  ${LANG_ENGLISH}
    Check Journal Details Context EN
    Check DOI Context EN
    Click ManagePublications In Sidebar EN
    Close Browser
