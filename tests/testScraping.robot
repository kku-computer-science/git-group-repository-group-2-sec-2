*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         http://127.0.0.1:8000/login
${BROWSER}     chrome
${USERNAME}    chitsutha@kku.ac.th
${PASSWORD}    123456789
${DELAY}       0.2
${TIMEOUT}     10s
${MAX_WAIT}    180s  # กำหนดเวลาโหลด Call Paper สูงสุด 3 นาที (180 วินาที)

*** Test Cases ***
Call Paper
    [Documentation]    Test Call Paper
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Published Research Tab
    Wait For Call Paper Or Fail
    Click First View Button
    Wait For Paper
    Verify Google Scholar URL
    Close Browser

*** Keywords ***
Login As User
    Wait Until Element Is Visible    name=username    timeout=${TIMEOUT}
    Input Text    name=username    ${USERNAME}
    Input Text    name=password    ${PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}

Go To Published Research Tab
    Wait Until Element Is Visible    xpath=//*[@id="sidebar"]/ul/li[8]/a    timeout=${TIMEOUT}
    Click Element    xpath=//*[@id="sidebar"]/ul/li[8]/a
    Wait Until Element Is Visible    xpath=//*[@id="ManagePublications"]/ul/li[1]    timeout=${TIMEOUT}
    Click Element    xpath=//*[@id="ManagePublications"]/ul/li[1]
    Set Selenium Speed    ${DELAY}

Wait For Call Paper Or Fail
    [Documentation]    ตรวจสอบว่า Call Paper โหลดเสร็จภายใน 2-3 นาที มิฉะนั้นให้ FAIL
    ${status}=    Run Keyword And Return Status    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/a[2]    timeout=${MAX_WAIT}
    Run Keyword If    not ${status}    Fail    Call Paper ใช้เวลาโหลดเกิน 3 นาที!

Click First View Button
    [Documentation]    ใช้ JavaScript คลิกปุ่ม "รูปตา" ของ Paper แถวแรก
    Wait Until Element Is Visible    xpath=//table[@id='example1']/tbody/tr[1]/td[5]/form/li[1]/a    timeout=${TIMEOUT}
    Execute JavaScript    document.evaluate("//table[@id='example1']/tbody/tr[1]/td[5]/form/li[1]/a", document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.click();

Wait For Paper
    Sleep    15s

Verify Google Scholar URL
    [Documentation]    ตรวจสอบว่า URL มีคำว่า "scholar.google.com"
    ${paper_url}=    Get Element Attribute    xpath=//a[contains(@href, 'scholar.google.com')]    href
    Log    Extracted URL: ${paper_url}
    Should Contain    ${paper_url}    scholar.google.com
    Set Window Size    1400    900
    Execute JavaScript    document.body.style.zoom='80%'
    Capture Page Screenshot
