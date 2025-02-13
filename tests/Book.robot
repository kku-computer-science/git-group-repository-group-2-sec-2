*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         127.0.0.1:8000
${DELAY}          1
${BROWSER}        Chrome
${USERNAME}       pusadee@kku.ac.th
${PASSWORD}       123456789
${URL}            http://${SERVER}/login
${URL_BOOKS}      http://${SERVER}/books
${URL_BOOKS_CREATE}  http://${SERVER}/books/create

# XPaths
${SIDEBAR_BOOKS}        //*[@id="sidebar"]/ul/li[8]/a/span
${ADD_BOOK_BUTTON}      //a[contains(@href, '/books/create')]
${INPUT_BOOK_NAME}      //input[@name='ac_name']
${INPUT_BOOK_SOURCETITLE}      //input[@name='ac_sourcetitle']
${INPUT_BOOK_PAGES}         //input[@name='ac_page']
${INPUT_BOOK_DATE}         //input[@name='ac_year']
${SUBMIT_BUTTON}          //button[@type='submit' and contains(text(), 'Submit')]
${CANCEL_BUTTON}       //button[contains(text(), 'Cancel')]

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

Click Book In Sidebar
    Wait Until Element Is Visible  ${SIDEBAR_BOOKS}  timeout=5s
    Click Element  ${SIDEBAR_BOOKS}
    Click Element  xpath=//a[@href='#ManagePublications']
    Wait Until Element Is Visible  id=ManagePublications  timeout=5s
    Page Should Contain Element  xpath=//a[contains(@href, '/books') and contains(text(), 'Book')]
    # คลิก BOOK
    Click Element  xpath=//a[contains(@href, '/books') and contains(text(), 'Book')]
    Capture Page Screenshot
    Sleep  1s

Click Button "ADD"
    Wait Until Element Is Visible  ${ADD_BOOK_BUTTON}  timeout=5s
    Click Element  ${ADD_BOOK_BUTTON}
    Wait Until Page Contains  เพิ่มหนังสือ  timeout=5s
    Capture Page Screenshot
    Sleep  1s

Set Book Date
    [Arguments]  ${date}
    Execute JavaScript    document.querySelector('input[name="ac_year"]').value = '${date}'
    Execute JavaScript    document.querySelector('input[name="ac_year"]').dispatchEvent(new Event('change'))

Fill Book Form
    [Documentation]  กรอกข้อมูลหนังสือ
    Wait Until Element Is Visible  ${INPUT_BOOK_NAME}  timeout=5s
    Input Text  ${INPUT_BOOK_NAME}  Testttttttttttttttttt

    Wait Until Element Is Visible  ${INPUT_BOOK_SOURCETITLE}  timeout=5s
    Input Text  ${INPUT_BOOK_SOURCETITLE}  Pearson Education

    Input Text    ${INPUT_BOOK_DATE}      01112025
    Sleep    10s

    Wait Until Element Is Visible  ${INPUT_BOOK_PAGES}   timeout=5s
    Input Text  ${INPUT_BOOK_PAGES}  1136

    Capture Page Screenshot

Submit Book Form
    [Documentation]  คลิกปุ่ม Submit และตรวจสอบว่าบันทึกสำเร็จ
    Wait Until Element Is Visible  ${SUBMIT_BUTTON}  timeout=5s
    Scroll Element Into View  ${SUBMIT_BUTTON}
    Click Button  ${SUBMIT_BUTTON}
    Sleep  1s
    Capture Page Screenshot

Cancel Book Form
    Click Button  ${CANCEL_BUTTON}
    Sleep  1s
    Capture Page Screenshot

*** Test Cases ***
User Can Submit a Book
    Open Browser And Login
    Click Book In Sidebar
    Click Button "ADD"
    Fill Book Form
    Submit Book Form
    Close Browser