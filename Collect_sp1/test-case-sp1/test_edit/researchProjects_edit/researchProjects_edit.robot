*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         127.0.0.1:8000
${DELAY}          1
${BROWSER}        Chrome
${USERNAME}       pusadee@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${URL_DASHBOARD}  http://${SERVER}/dashboard
${URL_RESPROJECT}      http://${SERVER}/researchProjects
${URL_RESPROJECT_CREATE}  http://${SERVER}/researchProjects/create

# XPaths
${SIDEBAR_RESPROJECT}   //*[@id="sidebar"]/ul/li[6]/a/span
${ADD_RESPROJECT_BUTTON}       //a[contains(@href, '/researchProjects/create')]
${INPUT_RESPROJECT_NAME}        //input[@name='project_name']
${INPUT_START_DATE}     //input[@name="project_start"]
${INPUT_END_DATE}       //input[@name="project_end"]
${DROPDOWN_FUND}       //select[@name="fund"]
${OPTION_FUND_PROJECT}   //select[@name="fund_id"]/option[contains(text(), 'โครงการ')]
${INPUT_YEAR}          //input[@name="project_year"]
${INPUT_BUDGET}        //input[@name="budget"]
${DROPDOWN_DEPARTMENT}   //select[@id="dep"]
${OPTION_DEPARTMENT_CS}  //select[@id="dep"]/option[contains(text(), 'สาขาวิชาวิทยาการคอมพิวเตอร์')]
${DROPDOWN_STATUS}   //select[@id="status"]
${OPTION_STATUS_CLOSED}  //select[@id="status"]/option[contains(text(), 'ปิดโครงการ')]
${SELECT_RESPONSIBLE_PERSON}   //*[@id="select2-head0-container"]

${SUBMIT_BUTTON}          //button[@type='submit' and contains(text(), 'Submit')]
${DELETE_RESPROJECT}    //*[@id="example1"]/tbody/tr[2]/td[5]/form/li[3]/button
${CONFIRM_DELETE_BUTTON}   //button[contains(@class, 'swal-button--confirm')]
${DELETE_SUCCESS_OK}       //button[contains(@class, 'swal-button--confirm')]

*** Test Cases ***
User Can Submit And Edit Research Project
    Open Browser And Login
    Go To  ${URL_RESPROJECT_CREATE}
    Fill Research Project Form
    Submit Research Project Form
    Go To Research Project List
    Open Research Project For Edit
    Edit Research Project Name
    Submit Research Project Form
    Close Browser

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

Go To Research Project List
    [Documentation]  กลับไปที่หน้ารายการโครงการวิจัย
    Go To  ${URL_RESPROJECT}
    Capture Page Screenshot

Open Research Project For Edit
    [Documentation]  เปิดโครงการวิจัยล่าสุดเพื่อทำการแก้ไข
    Wait Until Element Is Visible  //table/tbody/tr[1]/td[1]/a  timeout=10s
    Click Element  //table/tbody/tr[1]/td[1]/a
    Wait Until Page Contains  แก้ไขข้อมูลโครงการวิจัย  timeout=10s
    Capture Page Screenshot

Edit Research Project Name
    [Documentation]  แก้ไขชื่อโครงการวิจัยก่อนกด Submit
    Wait Until Element Is Visible  ${INPUT_RESPROJECT_NAME}  timeout=10s
    Clear Element Text  ${INPUT_RESPROJECT_NAME}
    Input Text  ${INPUT_RESPROJECT_NAME}  Edited_ระบบแปลภาษาไทย-อีสาน
    Capture Page Screenshot

Fill Research Project Form
    [Documentation]  กรอกข้อมูลโครงการวิจัย
    Wait Until Element Is Visible  ${INPUT_RESPROJECT_NAME}  timeout=10s
    Input Text  ${INPUT_RESPROJECT_NAME}  Test_ระบบแปลภาษาไทย-อีสาน
    Input Text    ${INPUT_START_DATE}     01112025
    Sleep    10s
    Input Text    ${INPUT_END_DATE}       02112025
    Sleep    10s
    Select From List By Label  ${DROPDOWN_FUND}  โครงการ
    Wait Until Element Is Visible  ${INPUT_YEAR}  timeout=5s
    Input Text  ${INPUT_YEAR}  2024
    Wait Until Element Is Visible  ${INPUT_BUDGET}  timeout=5s
    Input Text  ${INPUT_BUDGET}  5000000
    Select From List By Label  ${DROPDOWN_DEPARTMENT}  สาขาวิชาวิทยาการคอมพิวเตอร์
    Select From List By Label  ${DROPDOWN_STATUS}  ปิดโครงการ
    Select Responsible Person

Select Responsible Person
    [Documentation]  เลือกอาจารย์ที่รับผิดชอบโครงการ
    Wait Until Element Is Visible  ${SELECT_RESPONSIBLE_PERSON}  timeout=5s
    Click Element  ${SELECT_RESPONSIBLE_PERSON}
    Input Text  xpath=//span[@class='select2-search select2-search--dropdown']/input  พุธษดี ศิริแสงตระกูล
    Sleep  2s
    Press Keys  xpath=//span[@class='select2-search select2-search--dropdown']/input  ENTER
    Sleep  1s

Submit Research Project Form
    [Documentation]  กดปุ่ม Submit เพื่อบันทึกโครงการวิจัย
    Wait Until Element Is Visible  ${SUBMIT_BUTTON}  timeout=5s
    Scroll Element Into View  ${SUBMIT_BUTTON}
    Click Button  ${SUBMIT_BUTTON}
    Sleep  2s
    Capture Page Screenshot