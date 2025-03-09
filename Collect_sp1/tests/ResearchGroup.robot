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
${URL_RESEARCH_GROUP}         http://${SERVER}/researchGroups
${URL_RESEARCH_GROUP_CREATE}  http://${SERVER}/researchGroups/create

# XPaths
${SIDEBAR_RESEARCH_GROUP}       //*[@id="sidebar"]/ul/li[7]/a/span
${ADD_RESEARCH_GROUP_BUTTON}    //a[contains(@href, '/researchGroups/create')]

${INPUT_RESEARCH_NAME_TH}       //input[@name="group_name_th"]
${INPUT_RESEARCH_NAME_EN}       //input[@name="group_name_en"]
${TEXTAREA_DESC_TH}             //textarea[@name="group_desc_th"]
${TEXTAREA_DESC_EN}             //textarea[@name="group_desc_en"]
${TEXTAREA_DETAIL_TH}           //textarea[@name="group_detail_th"]
${TEXTAREA_DETAIL_EN}           //textarea[@name="group_detail_en"]

${INPUT_IMAGE}                  //input[@name="group_image"]
${DROPDOWN_LEADER}              //select[@name="group_leader"]
${DROPDOWN_STATUS}              //select[@name="status"]
${BUTTON_ADD_MEMBER}            //button[contains(@class, 'btn-add-member')]

${SUBMIT_BUTTON}                //button[@type='submit' and contains(text(), 'Submit')]
${BACK_BUTTON}                  //button[contains(text(), 'Back')]

${DELETE_RESEARCH_GROUP}    //*[@id="example1"]/tbody/tr[6]/td[5]/form/button
${CONFIRM_DELETE_BUTTON}   //button[contains(@class, 'swal-button--confirm')]
${DELETE_SUCCESS_OK}       //button[contains(@class, 'swal-button--confirm')]

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
    Wait Until Element Is Visible  ${SIDEBAR_RESEARCH_GROUP}  timeout=5s
    Click Element  ${SIDEBAR_RESEARCH_GROUP}
    Capture Page Screenshot
    Sleep  1s

Click Button "ADD"
    Wait Until Element Is Visible  ${ADD_RESEARCH_GROUP_BUTTON}  timeout=5s
    Click Element  ${ADD_RESEARCH_GROUP_BUTTON}
    Wait Until Page Contains  กลุ่มวิจัย  timeout=5s


Fill Research Group Form
    [Documentation]  กรอกข้อมูลกลุ่มวิจัย
    Wait Until Element Is Visible  ${INPUT_RESEARCH_NAME_TH}  timeout=5s
    Input Text  ${INPUT_RESEARCH_NAME_TH}  กลุ่มวิจัย AI & Data Science

    Wait Until Element Is Visible  ${INPUT_RESEARCH_NAME_EN}  timeout=5s
    Input Text  ${INPUT_RESEARCH_NAME_EN}  AI & Data Science Research Group

    Wait Until Element Is Visible  ${TEXTAREA_DESC_TH}  timeout=5s
    Input Text  ${TEXTAREA_DESC_TH}  กลุ่มวิจัยที่เน้น AI และ Data Science

    Wait Until Element Is Visible  ${TEXTAREA_DESC_EN}  timeout=5s
    Input Text  ${TEXTAREA_DESC_EN}  Research group focusing on AI and Data Science

    Wait Until Element Is Visible  ${TEXTAREA_DETAIL_TH}  timeout=5s
    Input Text  ${TEXTAREA_DETAIL_TH}  รายละเอียดเพิ่มเติมเกี่ยวกับกลุ่มวิจัย AI

    Wait Until Element Is Visible  ${TEXTAREA_DETAIL_EN}  timeout=5s
    Input Text  ${TEXTAREA_DETAIL_EN}  More details about AI research group

    Capture Page Screenshot

Submit Research Group Form
    [Documentation]  กดปุ่ม Submit เพื่อบันทึกกลุ่มวิจัย
    Wait Until Element Is Visible  ${SUBMIT_BUTTON}  timeout=5s
    Scroll Element Into View  ${SUBMIT_BUTTON}
    Click Button  ${SUBMIT_BUTTON}
    Sleep  2s
    Capture Page Screenshot

Delete Research Group
    [Documentation]  ลบทุนที่ต้องการ กด OK และรีเฟรชหน้า
    Wait Until Element Is Visible  ${DELETE_RESEARCH_GROUP}  timeout=5s
    Scroll Element Into View  ${DELETE_RESEARCH_GROUP}
    Click Element  ${DELETE_RESEARCH_GROUP}
    Sleep  2s
    # กด OK เพื่อยืนยันการลบ
    Wait Until Element Is Visible  ${CONFIRM_DELETE_BUTTON}  timeout=5s
    Execute JavaScript    document.querySelector('.swal-button--confirm').click()
    Sleep  2s
    # กด OK หลังจาก Delete Successfully
    Wait Until Element Is Visible  ${DELETE_SUCCESS_OK}  timeout=5s
    Execute JavaScript    document.querySelector('.swal-button--confirm').click()
    Sleep  2s
    Capture Page Screenshot
    # รีเฟรชหน้าโดยใช้ JavaScript
    Execute JavaScript    window.location.reload();
    Sleep  3s
    Capture Page Screenshot

*** Test Cases ***
User Can Submit Research Group
    Open Browser And Login
    Click Research Group In Sidebar
    Click Button "ADD"
    Fill Research Group Form
    Submit Research Group Form
    Close Browser
User Can Delete Research Group
    Open Browser And Login
    Click Research Group In Sidebar
    Delete Research Group
    Close Browser