*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}            https://soften2sec267.cpkkuhost.com/login
${BROWSER}        Chrome
${USERNAME}       punhor1@kku.ac.th
${PASSWORD}       123456789

*** Test Cases ***
Navigate To Patents And View Details
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Wait Until Element Is Visible    id=username
    Input Text    id=username    ${USERNAME}
    Input Text    id=password    ${PASSWORD}
    Click Button    xpath=//button[contains(text(),'Log In')]
    Sleep    2s
    Location Should Contain    /dashboard

    # ✅ คลิกที่เมนู Manage Publications
    Click Element    xpath=//*[@id="sidebar"]/ul/li[8]/a
    Sleep    1s  # รอให้เมนูโหลด

    # ✅ รอให้เมนู "Patents" ปรากฏ
    Wait Until Element Is Visible    xpath=//*[@id="ManagePublications"]/ul/li[3]/a    timeout=5s

    # ✅ คลิกที่ "Patents"
    Click Element    xpath=//*[@id="ManagePublications"]/ul/li[3]/a
    Sleep    2s
    Location Should Contain    /patents

    # ✅ รอให้ปุ่ม "ลูกตา" ปรากฏ
    Wait Until Element Is Visible    xpath=//*[@id="example1"]/tbody[1]/tr/td[7]/form/li[1]/a    timeout=10s

    # ✅ เลื่อนหน้าจอให้ปุ่มลูกตาอยู่ในมุมมอง
    Scroll Element Into View    xpath=//*[@id="example1"]/tbody[1]/tr/td[7]/form/li[1]/a

    # ✅ แคปหน้าจอก่อนกดปุ่ม "ลูกตา" (บันทึกเป็นไฟล์ใหม่ทุกครั้ง)
    Capture Page Screenshot

    # ✅ ใช้วิธีคลิก <a> แทน <i>
    Click Element    xpath=//*[@id="example1"]/tbody[1]/tr/td[7]/form/li[1]/a
    Sleep    2s

    # ✅ ถ้ายังไม่ได้ให้ลองใช้ JavaScript คลิก
    Execute JavaScript    document.evaluate('//*[@id="example1"]/tbody[1]/tr/td[7]/form/li[1]/a', document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.click();
    Sleep    2s

    # ✅ รอให้ URL เปลี่ยนไปเป็นหน้ารายละเอียด
    Wait Until Location Contains    /patents/    timeout=5s

    # ✅ แคปหน้าจอหลังจากเข้าหน้ารายละเอียด (บันทึกเป็นไฟล์ใหม่ทุกครั้ง)
    Capture Page Screenshot

    # ✅ ตรวจสอบว่ามีข้อความ "รายละเอียดสิทธิบัตร" ในหน้า View
    Wait Until Page Contains    รายละเอียดสิทธิบัตร    timeout=5s

    Close Browser
