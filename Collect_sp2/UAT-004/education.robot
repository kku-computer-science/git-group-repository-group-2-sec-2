*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         localhost:8000
${DELAY}          1
${BROWSER}        Firefox
${USERNAME}       pusadee@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${URL_EDUCATION}  http://${SERVER}/education

# XPaths ของปุ่มเปลี่ยนภาษา
${LANGUAGE_DROPDOWN}     //a[@id="navbarDropdownMenuLink"]
${LANGUAGE_EN}           //a[@href="http://localhost:8000/lang/en"]
${LANGUAGE_TH}           //a[@href="http://localhost:8000/lang/th"]
${LANGUAGE_CN}           //a[@href="http://localhost:8000/lang/zh"]

# XPaths ของ Education Page (ภาษาอังกฤษ)
${EDUCATION_TITLE_EN}        //h3[contains(text(), 'Education History')]
${LABEL_BACHELOR_EN}        //label[contains(text(), 'Bachelor\'s Degree')]
${LABEL_MASTER_EN}          //label[contains(text(), 'Master\'s Degree')]
${LABEL_PHD_EN}            //label[contains(text(), 'Doctoral Degree')]
${LABEL_UNIVERSITY_EN}     //label[contains(text(), 'University Name')]
${LABEL_DEGREE_EN}         //label[contains(text(), 'Degree Name')]
${LABEL_GRAD_YEAR_EN}      //label[contains(text(), 'Year of Graduation')]
${BUTTON_UPDATE_EN}        //button[contains(text(), 'Update')]

# XPaths ของ Education Page (ภาษาไทย)
${EDUCATION_TITLE_TH}        //h3[contains(text(), 'ประวัติการศึกษา')]
${LABEL_BACHELOR_TH}        //label[contains(text(), 'ปริญญาตรี')]
${LABEL_MASTER_TH}          //label[contains(text(), 'ปริญญาโท')]
${LABEL_PHD_TH}            //label[contains(text(), 'ปริญญาเอก')]
${LABEL_UNIVERSITY_TH}     //label[contains(text(), 'ชื่อมหาวิทยาลัย')]
${LABEL_DEGREE_TH}         //label[contains(text(), 'ชื่อวุฒิปริญญา')]
${LABEL_GRAD_YEAR_TH}      //label[contains(text(), 'ปี พ.ศ. ที่จบ')]
${BUTTON_UPDATE_TH}        //button[contains(text(), 'อัปเดต')]

# XPaths ของ Education Page (ภาษาจีน)
${EDUCATION_TITLE_CN}        //h3[contains(text(), '教育经历')]
${LABEL_BACHELOR_CN}        //label[contains(text(), '学士学位')]
${LABEL_MASTER_CN}          //label[contains(text(), '硕士学位')]
${LABEL_PHD_CN}            //label[contains(text(), '博士学位')]
${LABEL_UNIVERSITY_CN}     //label[contains(text(), '大学名称')]
${LABEL_DEGREE_CN}         //label[contains(text(), '学位名称')]
${LABEL_GRAD_YEAR_CN}      //label[contains(text(), '毕业年份')]
${BUTTON_UPDATE_CN}        //button[contains(text(), '更新')]

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

Navigate To Education
    Go To  ${URL_EDUCATION}
    Wait Until Page Contains  Education  timeout=10s
    Capture Page Screenshot

Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_DROPDOWN}  timeout=5s
    Click Element  ${LANGUAGE_DROPDOWN}
    Capture Page Screenshot
    Sleep  1s

Select English Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_EN}  timeout=5s
    Click Element  ${LANGUAGE_EN}
    Sleep  2s
    Capture Page Screenshot

Verify Education Language English
    Wait Until Element Is Visible  ${EDUCATION_TITLE_EN}  timeout=5s
    Page Should Contain Element  ${LABEL_BACHELOR_EN}
    Page Should Contain Element  ${LABEL_MASTER_EN}
    Page Should Contain Element  ${LABEL_PHD_EN}
    Page Should Contain Element  ${LABEL_UNIVERSITY_EN}
    Page Should Contain Element  ${LABEL_DEGREE_EN}
    Page Should Contain Element  ${LABEL_GRAD_YEAR_EN}
    Page Should Contain Element  ${BUTTON_UPDATE_EN}
    Capture Page Screenshot

Select Thai Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_TH}  timeout=5s
    Click Element  ${LANGUAGE_TH}
    Sleep  2s
    Capture Page Screenshot

Verify Education Language Thai
    Wait Until Element Is Visible  ${EDUCATION_TITLE_TH}  timeout=5s
    Page Should Contain Element  ${LABEL_BACHELOR_TH}
    Page Should Contain Element  ${LABEL_MASTER_TH}
    Page Should Contain Element  ${LABEL_PHD_TH}
    Page Should Contain Element  ${LABEL_UNIVERSITY_TH}
    Page Should Contain Element  ${LABEL_DEGREE_TH}
    Page Should Contain Element  ${LABEL_GRAD_YEAR_TH}
    Page Should Contain Element  ${BUTTON_UPDATE_TH}
    Capture Page Screenshot

Select Chinese Language
    Click Language Dropdown
    Wait Until Element Is Visible  ${LANGUAGE_CN}  timeout=5s
    Click Element  ${LANGUAGE_CN}
    Sleep  2s
    Capture Page Screenshot

Verify Education Language Chinese
    Wait Until Element Is Visible  ${EDUCATION_TITLE_CN}  timeout=5s
    Page Should Contain Element  ${LABEL_BACHELOR_CN}
    Page Should Contain Element  ${LABEL_MASTER_CN}
    Page Should Contain Element  ${LABEL_PHD_CN}
    Page Should Contain Element  ${LABEL_UNIVERSITY_CN}
    Page Should Contain Element  ${LABEL_DEGREE_CN}
    Page Should Contain Element  ${LABEL_GRAD_YEAR_CN}
    Page Should Contain Element  ${BUTTON_UPDATE_CN}
    Capture Page Screenshot

*** Test Cases ***
User Can Change Language To English And Verify Education Page
    Open Browser And Login
    Navigate To Education
    Select English Language
    Verify Education Language English
    Close Browser

User Can Change Language To Thai And Verify Education Page
    Open Browser And Login
    Navigate To Education
    Select Thai Language
    Verify Education Language Thai
    Close Browser

User Can Change Language To Chinese And Verify Education Page
    Open Browser And Login
    Navigate To Education
    Select Chinese Language
    Verify Education Language Chinese
    Close Browser
