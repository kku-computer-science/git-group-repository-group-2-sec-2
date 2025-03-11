*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}            https://soften2sec267.cpkkuhost.com/login
${BROWSER}        Chrome
${USERNAME}       punhor1@kku.ac.th
${PASSWORD}       123456789

*** Test Cases ***
Navigate To Funds And View Details
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Wait Until Element Is Visible    id=username
    Input Text    id=username    ${USERNAME}
    Input Text    id=password    ${PASSWORD}
    Click Button    xpath=//button[contains(text(),'Log In')]
    Sleep    2s
    Location Should Contain    /dashboard

    # ไปที่หน้า Funds
    Click Link    xpath=//a[contains(@href, '/funds')]
    Sleep    2s
    Location Should Contain    /funds

    # รอให้ปุ่ม "ลูกตา" แสดงผล
    Wait Until Element Is Visible    xpath=//*[@id="example1"]/tbody/tr[1]/td[5]/form/li[1]/a    timeout=10s

    # เลื่อนหน้าจอให้ปุ่มลูกตาอยู่ในมุมมอง
    Scroll Element Into View    xpath=//*[@id="example1"]/tbody/tr[1]/td[5]/form/li[1]/a

    # แคปหน้าจอก่อนกดปุ่ม
    Capture Page Screenshot

    # กดปุ่ม "ลูกตา" ของรายการทุนแรก
    Click Element    xpath=//*[@id="example1"]/tbody/tr[1]/td[5]/form/li[1]/a
    Sleep    2s

    # รอให้ URL เปลี่ยนไปเป็นหน้ารายละเอียด
    Wait Until Location Contains    /funds/    timeout=5s

    # แคปหน้าจอหลังจากเข้าหน้ารายละเอียด
    Capture Page Screenshot

    # ตรวจสอบว่ามีข้อความ "รายละเอียดทุนวิจัย" ในหน้า View
    Wait Until Page Contains    รายละเอียดทุนวิจัย    timeout=5s

    Close Browser
