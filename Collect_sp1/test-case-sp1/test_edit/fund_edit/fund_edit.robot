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
${EDIT_FUND_BUTTON}      //*[@id="example1"]/tbody/tr[2]/td[5]/form/li[2]/a  # ปุ่มแก้ไข
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
${DELETE_FUND_BUTTON}    //*[@id="example1"]/tbody/tr[2]/td[5]/form/li[3]/button
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

Fill Fund Form
    [Arguments]  ${fund_type}  ${fund_name}  ${support_unit}  ${fund_level}
    Wait Until Element Is Visible  ${DROPDOWN_FUND_TYPE}  timeout=5s
    Click Element  ${DROPDOWN_FUND_TYPE}
    Select From List By Label  ${DROPDOWN_FUND_TYPE}  ${fund_type}
    Sleep  1s
    Click Element  ${DROPDOWN_FUND_LEVEL}
    Execute JavaScript    document.querySelector('select[name="fund_level"]').value = '${fund_level}'
    Sleep  1s
    Input Text  ${INPUT_FUND_NAME}  ${fund_name}
    Input Text  ${INPUT_SUPPORT_UNIT}  ${support_unit}
    Capture Page Screenshot

Submit Fund Form
    Wait Until Element Is Visible  ${SUBMIT_BUTTON}  timeout=5s
    Scroll Element Into View  ${SUBMIT_BUTTON}
    Click Button  ${SUBMIT_BUTTON}
    Sleep  1s
    Capture Page Screenshot

Edit Fund
    [Documentation]  เปิดหน้าแก้ไขทุนและเปลี่ยนแปลงข้อมูล
    Wait Until Element Is Visible  ${EDIT_FUND_BUTTON}  timeout=5s
    Scroll Element Into View  ${EDIT_FUND_BUTTON}
    Click Element  ${EDIT_FUND_BUTTON}
    Sleep  2s
    Capture Page Screenshot
    Wait Until Element Is Visible  ${INPUT_FUND_NAME}  timeout=10s
    Input Text  ${INPUT_FUND_NAME}  updated_fund
    Input Text  ${INPUT_SUPPORT_UNIT}  updated_support_unit
    Capture Page Screenshot
    Submit Fund Form

Delete Fund
    Wait Until Element Is Visible  ${DELETE_FUND_BUTTON}  timeout=5s
    Scroll Element Into View  ${DELETE_FUND_BUTTON}
    Click Element  ${DELETE_FUND_BUTTON}
    Sleep  2s
    Wait Until Element Is Visible  ${CONFIRM_DELETE_BUTTON}  timeout=5s
    Execute JavaScript    document.querySelector('.swal-button--confirm').click()
    Sleep  2s
    Wait Until Element Is Visible  ${DELETE_SUCCESS_OK}  timeout=5s
    Execute JavaScript    document.querySelector('.swal-button--confirm').click()
    Sleep  2s
    Capture Page Screenshot
    Execute JavaScript    window.location.reload();
    Sleep  3s
    Capture Page Screenshot

*** Test Cases ***
User Can Add, Edit, And Delete Fund
    Open Browser And Login
    Click Manage Fund In Sidebar
    Click Button "ADD"
    Fill Fund Form  ทุนภายใน  test_fund  test_support  กลาง
    Submit Fund Form
    Edit Fund
    Delete Fund
    Close Browser
