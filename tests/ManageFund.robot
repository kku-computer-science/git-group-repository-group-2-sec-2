*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         127.0.0.1:8000
${DELAY}          1
${BROWSER}        Chrome
${USERNAME}       pusadee@kku.ac.th  # เปลี่ยนเป็น username สำหรับทดสอบ
${PASSWORD}       123456789  # เปลี่ยนเป็นรหัสผ่านสำหรับทดสอบ
${URL}            http://${SERVER}/login
${URL_DASHBOARD}  http://${SERVER}/dashboard
${URL_FUNDS}      http://${SERVER}/funds
${URL_FUNDS_CREATE}  http://${SERVER}/funds/create

# XPaths
${SIDEBAR_MANAGE_FUND}   //*[@id="sidebar"]/ul/li[5]/a/span
${ADD_FUND_BUTTON}       //a[contains(@href, '/funds/create')]
${DROPDOWN_FUND_TYPE}    //select[@id="fund_type"]
${OPTION_FUND_EXTERNAL}   //select[@id='fund_type']/option[@value='ทุนภายนอก']
${OPTION_FUND_INTERNAL}   //select[@id='fund_type']/option[@value='ทุนภายใน']
${DROPDOWN_FUND_LEVEL}    //select[@name="fund_level"]
${OPTION_FUND_LOW}        //select[@name="fund_level"]/option[@value='ล่าง']
${OPTION_FUND_MID}        //select[@name="fund_level"]/option[@value='กลาง']
${OPTION_FUND_HIGH}       //select[@name="fund_level"]/option[@value='สูง']
${INPUT_FUND_NAME}        //input[@name='fund_name']
${INPUT_SUPPORT_UNIT}     //input[@name='support_resource']
${SUBMIT_BUTTON}          //button[@type='submit' and contains(text(), 'Submit')]
${DELETE_FUND_EXTERNAL}    //*[@id="example1"]/tbody/tr[2]/td[5]/form/li[3]/button
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

Click Manage Fund In Sidebar
    Wait Until Element Is Visible  ${SIDEBAR_MANAGE_FUND}  timeout=5s
    Click Element  ${SIDEBAR_MANAGE_FUND}
    Wait Until Page Contains  Manage Fund  timeout=5s
    Capture Page Screenshot
    Sleep  1s

Click Button "ADD"
    Wait Until Element Is Visible  ${ADD_FUND_BUTTON}  timeout=5s
    Click Element  ${ADD_FUND_BUTTON}
    Wait Until Page Contains  เพิ่มทุนวิจัย  timeout=5s

Fill Fund Form Internal
    [Documentation]  เลือกประเภททุน, กรอกข้อมูล และเตรียมกด Submit
    Wait Until Element Is Visible  ${DROPDOWN_FUND_TYPE}  timeout=5s
    Wait Until Element Is Visible  ${DROPDOWN_FUND_LEVEL}  timeout=5s
    # เลือกประเภททุน
    Click Element  ${DROPDOWN_FUND_TYPE}
    Select From List By Label  ${DROPDOWN_FUND_TYPE}  ทุนภายใน
    Sleep  1s
    # เลือกระดับทุน (ใช้ Click และ Select)
    Click Element  ${DROPDOWN_FUND_LEVEL}
    Sleep  1s
    Execute JavaScript    document.querySelector('select[name="fund_level"]').value = 'กลาง'
    Sleep  1s
    # กรอกข้อมูลฟอร์ม
    Input Text  ${INPUT_FUND_NAME}  testภายใน
    Input Text  ${INPUT_SUPPORT_UNIT}  testttt
    Capture Page Screenshot

Fill Fund Form External
    [Documentation]  เลือกประเภททุน, กรอกข้อมูล และเตรียมกด Submit
    Wait Until Element Is Visible  ${DROPDOWN_FUND_TYPE}  timeout=5s
    Wait Until Element Is Visible  ${DROPDOWN_FUND_LEVEL}  timeout=5s
    # เลือกประเภททุน
    Click Element  ${DROPDOWN_FUND_TYPE}
    Select From List By Label  ${DROPDOWN_FUND_TYPE}  ทุนภายนอก
    Sleep  1s
    # กรอกข้อมูลฟอร์ม
    Input Text  ${INPUT_FUND_NAME}  testภายนอก
    Input Text  ${INPUT_SUPPORT_UNIT}  testttt
    Capture Page Screenshot


Submit Fund Form
    [Documentation]  คลิกปุ่ม Submit และตรวจสอบว่าบันทึกสำเร็จ
    Wait Until Element Is Visible  ${SUBMIT_BUTTON}  timeout=5s
    Scroll Element Into View  ${SUBMIT_BUTTON}
    Click Button  ${SUBMIT_BUTTON}
    Sleep  1s
    Capture Page Screenshot

Delete Fund
    [Documentation]  ลบทุนที่ต้องการ กด OK และรีเฟรชหน้า
    Wait Until Element Is Visible  ${DELETE_FUND_EXTERNAL}  timeout=5s
    Scroll Element Into View  ${DELETE_FUND_EXTERNAL}
    Click Element  ${DELETE_FUND_EXTERNAL}
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
User Can Fill Fund Form And Submit
    Open Browser And Login
    Click Manage Fund In Sidebar
    Click Button "ADD"
    Fill Fund Form Internal
    Submit Fund Form
    Close Browser
User Can Delete Fund
    Open Browser And Login
    Click Manage Fund In Sidebar
    Delete Fund
    Close Browser
    
User Can Fill Fund Form And Submit
    Open Browser And Login
    Click Manage Fund In Sidebar
    Click Button "ADD"
    Fill Fund Form External
    Submit Fund Form
    Close Browser
User Can Delete Fund
    Open Browser And Login
    Click Manage Fund In Sidebar
    Delete Fund
    Close Browser
