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
*** Keywords ***
Open Browser And Login
    Open Browser  ${URL}  ${BROWSER}
    Maximize Browser Window
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//html/body/div/div[2]/div[3]/form/div[4]/button
    Wait Until Page Contains  Dashboard  timeout=10s
    Capture Page Screenshot
    Sleep  1s

Change Language And Check Context
    [Arguments]  ${LANG_OPTION}
    Change Language  ${LANG_OPTION}
Change Language
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

Click Manage Fund In Sidebar EN
    Wait Until Element Is Visible  ${SIDEBAR_MANAGE_FUND}  timeout=5s
    Click Element  ${SIDEBAR_MANAGE_FUND}
    Check Manage Fund Context EN
    Capture Page Screenshot
    Sleep  1s

Click Manage Fund In Sidebar TH
    Wait Until Element Is Visible  ${SIDEBAR_MANAGE_FUND}  timeout=5s
    Click Element  ${SIDEBAR_MANAGE_FUND}
    Check Manage Fund Context TH
    Capture Page Screenshot
    Sleep  1s

Click Manage Fund In Sidebar ZH
    Wait Until Element Is Visible  ${SIDEBAR_MANAGE_FUND}  timeout=5s
    Click Element  ${SIDEBAR_MANAGE_FUND}
    Check Manage Fund Context ZH
    Capture Page Screenshot
    Sleep  1s

Click ManagePublications In Sidebar EN
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
    # คลิก BOOK
    Click Element  xpath=//a[contains(@href, '/books') and contains(text(), 'Book')]
    Check Book Context EN
    Capture Page Screenshot
    Sleep  1s
    # คลิก Other academic works
    Click Element  xpath=//a[contains(@href, '/patents') and contains(text(), 'Other academic works')]
    Check Other academic works Context EN
    Capture Page Screenshot
    Sleep  1s


Click ManagePublications In Sidebar TH
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
    # คลิก BOOK
    Click Element  xpath=//a[contains(@href, '/books') and contains(text(), 'หนังสือ')]
    Check Book Context TH
    Capture Page Screenshot
    Sleep  1s
    # คลิก Other academic works
    Click Element  xpath=//a[contains(@href, '/patents') and contains(text(), 'ผลงานวิชาการอื่นๆ')]
    Check Other academic works Context TH
    Capture Page Screenshot
    Sleep  1s


Click ManagePublications In Sidebar ZH
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
    # คลิก BOOK
    Click Element  xpath=//a[contains(@href, '/books') and contains(text(), '书籍')]
    Check Book Context ZH
    Capture Page Screenshot
    Sleep  1s
    # คลิก Other academic works
    Click Element  xpath=//a[contains(@href, '/patents') and contains(text(), '其他学术作品')]
    Check Other academic works Context ZH
    Capture Page Screenshot
    Sleep  1s

Click Research Projects In Sidebar EN
    Wait Until Element Is Visible  ${SIDEBAR_RESPROJECT}  timeout=5s
    Click Element  ${SIDEBAR_RESPROJECT}
    Check Research Projects Context EN
    Capture Page Screenshot
    Sleep  1s

Click Research Projects In Sidebar TH
    Wait Until Element Is Visible  ${SIDEBAR_RESPROJECT}  timeout=5s
    Click Element  ${SIDEBAR_RESPROJECT}
    Check Research Projects Context TH
    Capture Page Screenshot
    Sleep  1s

Click Research Projects In Sidebar ZH
    Wait Until Element Is Visible  ${SIDEBAR_RESPROJECT}  timeout=5s
    Click Element  ${SIDEBAR_RESPROJECT}
    Check Research Projects Context ZH
    Capture Page Screenshot
    Sleep  1s

Click Research Group In Sidebar EN
    Wait Until Element Is Visible  ${SIDEBAR_RESEARCH_GROUP}  timeout=5s
    Click Element  ${SIDEBAR_RESEARCH_GROUP}
    Check Research Group Context EN
    Capture Page Screenshot
    Sleep  1s

Click Research Group In Sidebar TH
    Wait Until Element Is Visible  ${SIDEBAR_RESEARCH_GROUP}  timeout=5s
    Click Element  ${SIDEBAR_RESEARCH_GROUP}
    Check Research Group Context TH
    Capture Page Screenshot
    Sleep  1s

Click Research Group In Sidebar ZH
    Wait Until Element Is Visible  ${SIDEBAR_RESEARCH_GROUP}  timeout=5s
    Click Element  ${SIDEBAR_RESEARCH_GROUP}
    Check Research Group Context ZH
    Capture Page Screenshot
    Sleep  1s

Click User Profile In Sidebar EN
    Go To  ${URL_PROFILE}
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Check Profile Setting Context EN
    Capture Page Screenshot
    Sleep  1s

Click User Profile In Sidebar TH
    Go To  ${URL_PROFILE}
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Check Profile Setting Context TH
    Capture Page Screenshot
    Sleep  1s

Click User Profile In Sidebar ZH
    Go To  ${URL_PROFILE}
    Wait Until Element Is Visible  ${ACCOUNT}  timeout=5s
    Click Element  ${ACCOUNT}
    Check Profile Setting Context ZH
    Capture Page Screenshot
    Sleep  1s

Check Profile Setting Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    Profile Setting
    Capture Page Screenshot

Check Profile Setting Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    ตั้งค่าโปรไฟล์
    Capture Page Screenshot

Check Profile Setting Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=//*[@id="account"]/h3    timeout=${TIMEOUT}
    Element Text Should Be    xpath=//*[@id="account"]/h3    个人资料设置
    Capture Page Screenshot

Check Manage Fund Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    Fund
    Capture Page Screenshot

Check Manage Fund Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    ทุนวิจัย
    Capture Page Screenshot

Check Manage Fund Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4   基金
    Capture Page Screenshot

Check Research Projects Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    Research Project
    Capture Page Screenshot

Check Research Projects Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    โครงการวิจัย
    Capture Page Screenshot

Check Research Projects Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4   研究項目
    Capture Page Screenshot

Check Research Group Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    Research Group
    Capture Page Screenshot

Check Research Group Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    กลุ่มวิจัย
    Capture Page Screenshot

Check Research Group Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4   研究小組
    Capture Page Screenshot

Check Published Research Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    Published Research
    Capture Page Screenshot

Check Published Research Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    วารผลงานตีพิมพ์
    Capture Page Screenshot

Check Published Research Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4   已發表的研究
    Capture Page Screenshot

Check Book Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    Book
    Capture Page Screenshot

Check Book Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    หนังสือ
    Capture Page Screenshot

Check Book Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4   书籍
    Capture Page Screenshot

Check Other academic works Context EN
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    Other Academic Works
    Capture Page Screenshot

Check Other academic works Context TH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4    ผลงานวิชาการอื่นๆ
    Capture Page Screenshot

Check Other academic works Context ZH
    Log    Checking Context
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/h4    timeout=${TIMEOUT}
    Element Text Should Be    xpath=/html/body/div/div/div/div/div/div/div/h4   其他学术作品
    Capture Page Screenshot

*** Test Cases ***
Test Navbar
    Open Browser And Login
    Change Language And Check Context  ${LANG_THAI}
    Click User Profile In Sidebar TH
    Click Manage Fund In Sidebar TH
    Click Research Projects In Sidebar TH
    Click Research Group In Sidebar TH
    Click ManagePublications In Sidebar TH

    Change Language And Check Context  ${LANG_CHINESE}
    Click User Profile In Sidebar ZH
    Click Manage Fund In Sidebar ZH
    Click Research Projects In Sidebar ZH
    Click Research Group In Sidebar ZH
    Click ManagePublications In Sidebar ZH

    Change Language And Check Context  ${LANG_ENGLISH}
    Click User Profile In Sidebar EN
    Click Manage Fund In Sidebar EN
    Click Research Projects In Sidebar EN
    Click Research Group In Sidebar EN
    Click ManagePublications In Sidebar EN
    Close Browser

