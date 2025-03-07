*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         soften2sec267.cpkkuhost.com
${DELAY}          1
${BROWSER}        Chrome
${USERNAME}       pusadee@kku.ac.th  # เปลี่ยนเป็น username สำหรับทดสอบ
${PASSWORD}       123456789  # เปลี่ยนเป็นรหัสผ่านสำหรับทดสอบ
${URL}            http://${SERVER}/login
${URL_DASHBOARD}  http://${SERVER}/dashboard
${URL_RESEARCH_PUBLIC}         http://${SERVER}/papers
${URL_RESEARCH_PUBLIC_CREATE}  http://${SERVER}/papers/create

# XPaths
${SIDEBAR_MANAGE_PUBLIC}       //*[@id="sidebar"]/ul/li[8]/a/span
${ADD_RESEARCH_PUBLIC_BUTTON}    //a[contains(@href, '/papers/create')]

# ช่องกรอกข้อมูล
${INPUT_JOURNAL_TITLE}       //input[@name='journal_title']
${INPUT_ABSTRACT}            //textarea[@name='abstract']
${INPUT_KEYWORD}             //input[@name='keyword']

${INPUT_PAPER_NAME}       //input[@name="paper_name"]
${INPUT_ABSTRACT}       //input[@name="abstract"]
${INPUT_KEYWORD}                  //input[@name="keyword"]

${DROPDOWN_PAPER_TYPE}    //select[@id="paper_type"]
${DROPDOWN_PAPER_SUBTYPE}              //select[@id="paper_subtype"]
${DROPDOWN_PUBLICATION}              //select[@id="publication"]
${INPUT_SOURCETITLE}                  //input[@name="paper_sourcetitle"]
${INPUT_PAPER_YEAR}       //input[@name="paper_yearpub"]
${INPUT_PAPER_VOLUME}       //input[@name="paper_volume"]
${INPUT_PAPER_ISSUE}       //input[@name="paper_issue"]
${INPUT_PAPER_CITATION}       //input[@name="paper_citation"]
${INPUT_PAPER_PAGE}       //input[@name="paper_page"]
${INPUT_PAPER_DOI}       //input[@name="paper_doi"]
${INPUT_PAPER_FUNDER}       //input[@name="paper_funder"]
${INPUT_PAPER_URL}       //input[@name="paper_url"]
${INPUT_AUTHOR_FNAME}       //input[@name="fname[]"]
${INPUT_AUTHOR_LNAME}       //input[@name="lname[]"]
${SUBMIT_BUTTON}                //button[@type='submit' and contains(text(), 'Submit')]
${BACK_BUTTON}                  //button[contains(text(), 'Back')]

# ${DELETE_RESEARCH_GROUP}    //*[@id="example1"]/tbody/tr[2]/td[5]/form/button
# ${CONFIRM_DELETE_BUTTON}   //button[contains(@class, 'swal-button--confirm')]
# ${DELETE_SUCCESS_OK}       //button[contains(@class, 'swal-button--confirm')]

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

Click Research Group In Sidebar
    Wait Until Element Is Visible  ${SIDEBAR_MANAGE_PUBLIC}  timeout=5s
    Click Element  ${SIDEBAR_MANAGE_PUBLIC}
    Click Element  xpath=//a[@href='#ManagePublications']
    Wait Until Element Is Visible  id=ManagePublications  timeout=5s
    Page Should Contain Element  xpath=//a[contains(@href, '/papers') and contains(text(), 'Published research')]
    # คลิก Published Research
    Click Element  xpath=//a[contains(@href, '/papers') and contains(text(), 'Published research')]
    Capture Page Screenshot
    Sleep  1s

Click Button "ADD"
    Wait Until Element Is Visible  ${ADD_RESEARCH_PUBLIC_BUTTON}  timeout=5s
    Click Element  ${ADD_RESEARCH_PUBLIC_BUTTON}
    Wait Until Page Contains  Published research  timeout=5s

Select Dropdown Option
    [Arguments]    ${option_text}
    Click Element    //div[contains(@class,'filter-option')]  # คลิก dropdown
    Sleep    1s  # รอ dropdown แสดงผล
    Click Element    //div[contains(@class,'dropdown-menu')]//a[contains(text(), '${option_text}')]
    Sleep    1s  # รอ dropdown อัปเดตค่า


Fill Research Publication Form
    [Documentation]  กรอกข้อมูลวารสารผลงานตีพิมพ์
    Wait Until Element Is Visible  ${INPUT_PAPER_NAME}  timeout=5s
    Input Text  ${INPUT_PAPER_NAME}  TESTTTTTTTTTTTTT

    Wait Until Element Is Visible  ${INPUT_ABSTRACT}  timeout=5s
    Input Text  ${INPUT_ABSTRACT}  This paper explores TEST.

    Wait Until Element Is Visible  ${INPUT_KEYWORD}  timeout=5s
    Input Text  ${INPUT_KEYWORD}  AI, Test

    # เลือกประเภทเอกสาร
    Wait Until Element Is Visible  ${DROPDOWN_PAPER_TYPE}  timeout=5s
    Scroll Element Into View  ${DROPDOWN_PAPER_TYPE}  
    Click Element  ${DROPDOWN_PAPER_TYPE}
    Sleep  1s
    Scroll Element Into View  ${DROPDOWN_PAPER_TYPE}  
    Execute JavaScript    document.querySelector('select[id="paper_type"]').value = 'Journal'
    Sleep  1s
    # Select From List By Label  ${DROPDOWN_PAPER_TYPE}  "Journal"

    # เลือกหมวดหมู่ย่อยของเอกสาร
    Wait Until Element Is Visible  ${DROPDOWN_PAPER_SUBTYPE}  timeout=5s
    Scroll Element Into View  ${DROPDOWN_PAPER_SUBTYPE}
    Click Element  ${DROPDOWN_PAPER_SUBTYPE}
    Sleep  1s
    Scroll Element Into View  ${DROPDOWN_PAPER_SUBTYPE}  
    Execute JavaScript    document.querySelector('select[id="paper_subtype"]').value = 'Conference Paper'
    Sleep  1s

    # เลือกที่ตีพิมพ์
    Wait Until Element Is Visible  ${DROPDOWN_PUBLICATION}  timeout=5s
    Scroll Element Into View  ${DROPDOWN_PUBLICATION}
    Click Element  ${DROPDOWN_PUBLICATION}
    Sleep  1s
    Scroll Element Into View  ${DROPDOWN_PUBLICATION}  
    Execute JavaScript    document.querySelector('select[id="publication"]').value = 'International Journal'
    Sleep  1s

    # กรอกแหล่งที่มาของเอกสาร
    Scroll Element Into View  ${INPUT_SOURCETITLE}
    Input Text  ${INPUT_SOURCETITLE}  IEEE Transactions on AI

    # กรอกปีที่ตีพิมพ์
    Scroll Element Into View  ${INPUT_PAPER_YEAR}
    Input Text  ${INPUT_PAPER_YEAR}  2024

    # กรอก Volume, Issue, Citation, Page, DOI
    Scroll Element Into View  ${INPUT_PAPER_VOLUME}
    Input Text  ${INPUT_PAPER_VOLUME}  42
    Input Text  ${INPUT_PAPER_ISSUE}  5
    Input Text  ${INPUT_PAPER_CITATION}  100
    Input Text  ${INPUT_PAPER_PAGE}  123-145
    Input Text  ${INPUT_PAPER_DOI}  10.1109/xyz.2024.123456

    # กรอก Funder และ URL
    Scroll Element Into View  ${INPUT_PAPER_FUNDER}
    Input Text  ${INPUT_PAPER_FUNDER}  National Research Council
    Input Text  ${INPUT_PAPER_URL}  https://ieeexplore.ieee.org/document/123456

    # กรอกชื่อผู้แต่ง
    Input Text  ${INPUT_AUTHOR_FNAME}  John
    Input Text  ${INPUT_AUTHOR_LNAME}  Doe

    Capture Page Screenshot

Submit Research Publication Form
    [Documentation]  กดปุ่ม Submit เพื่อบันทึกวารสารผลงานตีพิมพ์
    Wait Until Element Is Visible  ${SUBMIT_BUTTON}  timeout=10s
    Scroll Element Into View  ${SUBMIT_BUTTON}
    Wait Until Element Is Enabled  ${SUBMIT_BUTTON}  timeout=5s
    Sleep  1s
    Execute JavaScript    document.querySelector("button[type='submit']").click()
    Sleep  2s
    Capture Page Screenshot


# Delete Research Group
#     [Documentation]  ลบทุนที่ต้องการ กด OK และรีเฟรชหน้า
#     Wait Until Element Is Visible  ${DELETE_RESEARCH_GROUP}  timeout=5s
#     Scroll Element Into View  ${DELETE_RESEARCH_GROUP}
#     Click Element  ${DELETE_RESEARCH_GROUP}
#     Sleep  2s
#     # กด OK เพื่อยืนยันการลบ
#     Wait Until Element Is Visible  ${CONFIRM_DELETE_BUTTON}  timeout=5s
#     Execute JavaScript    document.querySelector('.swal-button--confirm').click()
#     Sleep  2s
#     # กด OK หลังจาก Delete Successfully
#     Wait Until Element Is Visible  ${DELETE_SUCCESS_OK}  timeout=5s
#     Execute JavaScript    document.querySelector('.swal-button--confirm').click()
#     Sleep  2s
#     Capture Page Screenshot
#     # รีเฟรชหน้าโดยใช้ JavaScript
#     Execute JavaScript    window.location.reload();
#     Sleep  3s
#     Capture Page Screenshot

*** Test Cases ***
User Can Submit Research Publication
    Open Browser And Login
    Click Research Group In Sidebar
    Click Button "ADD"
    Fill Research Publication Form
    Submit Research Publication Form
    Close Browser


# User Can Delete Research Group
#     Open Browser And Login
#     Click Research Group In Sidebar
#     Delete Research Group
#     Close Browser