*** Settings ***
Library  SeleniumLibrary  # ใช้ SeleniumLibrary สำหรับควบคุมเบราว์เซอร์

*** Variables ***
${SERVER}         soften2sec267.cpkkuhost.com  # กำหนดเซิร์ฟเวอร์ที่ใช้ทดสอบ
${DELAY}          1  # ระยะเวลารอโดยเริ่มต้น
${BROWSER}        Chrome  # เบราว์เซอร์ที่ใช้ในการทดสอบ
${USERNAME}       605020077-3  # ชื่อผู้ใช้สำหรับล็อกอิน
${PASSWORD}       605020077-3  # รหัสผ่านสำหรับล็อกอิน

${URL}            http://${SERVER}/login  # URL ของหน้า Login
${URL_CERIFICATE}     http://${SERVER}/certificate  # URL ของหน้า Certificate
${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']  # XPath ของ dropdown เปลี่ยนภาษา
${LANG_THAI}      xpath=//a[@href='http://${SERVER}/lang/th']  # XPath ของปุ่มเปลี่ยนเป็นภาษาไทย
${LANG_CHINESE}   xpath=//a[@href='http://${SERVER}/lang/zh']  # XPath ของปุ่มเปลี่ยนเป็นภาษาจีน
${LANG_ENGLISH}   xpath=//a[@href='http://${SERVER}/lang/en']  # XPath ของปุ่มเปลี่ยนเป็นภาษาอังกฤษ

${CERT_CONTAINER}  xpath=/html/body/div/div/div/div/div  # XPath ของคอนเทนต์ในหน้า Certificate
${CERT_TEXT_ENG}   Certificate Form\nWelcome to the Certificate Form page. Please proceed with your submission.  # ข้อความที่คาดหวังในภาษาอังกฤษ
${CERT_TEXT_CHI}   证书表单\n欢迎来到证书表单页面。请继续提交您的信息。  # ข้อความที่คาดหวังในภาษาจีน
${CERT_TEXT_THAI}  แบบฟอร์มใบรับรอง\nยินดีต้อนรับสู่หน้าแบบฟอร์มใบรับรอง กรุณาดำเนินการส่งข้อมูลของคุณ  # ข้อความที่คาดหวังในภาษาไทย

${NAV_CERTIFICATE}  xpath=/html/body/div/div/nav//a[contains(@href, '/certificateform')]  # XPath ของลิงก์ Certificate Form ในเมนู

*** Test Cases ***
Change Language Before Login
    Open Browser  ${URL}  ${BROWSER}  # เปิดเบราว์เซอร์และไปที่หน้า Login
    Maximize Browser Window  # ขยายหน้าต่างเบราว์เซอร์ให้เต็มจอ
    Open Browser And Login  # ทำการล็อกอินเข้าสู่ระบบ
    Click Target Menu  # คลิกเมนูที่ต้องการ
    Verify Certificate Form Link  # ตรวจสอบว่ามีลิงก์ Certificate Form หรือไม่
    Click Certificate Form Link  # คลิกเข้าไปที่หน้า Certificate Form
    Change Language And Check Context  ${LANG_THAI}  ${CERT_TEXT_THAI}  # เปลี่ยนภาษาเป็นไทยและตรวจสอบเนื้อหา
    Change Language And Check Context  ${LANG_CHINESE}  ${CERT_TEXT_CHI}  # เปลี่ยนภาษาเป็นจีนและตรวจสอบเนื้อหา
    Change Language And Check Context  ${LANG_ENGLISH}  ${CERT_TEXT_ENG}  # เปลี่ยนภาษาเป็นอังกฤษและตรวจสอบเนื้อหา
    Close Browser  # ปิดเบราว์เซอร์

*** Keywords ***
Change Language And Check Context
    [Arguments]  ${LANG_OPTION}  ${EXPECTED_TEXT}
    Change Language  ${LANG_OPTION}  # เรียกใช้ฟังก์ชันเปลี่ยนภาษา
    Verify Certificate Page Text  ${EXPECTED_TEXT}  # ตรวจสอบเนื้อหาหลังเปลี่ยนภาษา

Change Language
    [Arguments]  ${LANG_OPTION}
    Wait Until Element Is Visible  ${LANG_DROPDOWN}  timeout=10s  # รอให้ dropdown แสดงขึ้นมา
    Execute JavaScript    document.getElementById('navbarDropdownMenuLink').click();  # ใช้ JavaScript คลิก dropdown
    Click Element  ${LANG_DROPDOWN}  # คลิก dropdown เปลี่ยนภาษา
    Sleep  2s  # รอให้เมนูเปลี่ยนแสดงผล
    Wait Until Element Is Visible  ${LANG_OPTION}  timeout=5s  # รอให้ตัวเลือกภาษาปรากฏ
    Click Element  ${LANG_OPTION}  # คลิกเลือกภาษา
    Sleep  2s  # รอให้หน้าเว็บโหลดใหม่
    Capture Page Screenshot  # จับภาพหน้าจอหลังเปลี่ยนภาษา
    Log    Changed language to ${LANG_OPTION}  # บันทึก Log

Verify Certificate Page Text
    [Arguments]  ${EXPECTED_TEXT}
    Wait Until Element Is Visible  ${CERT_CONTAINER}  timeout=10s  # รอให้คอนเทนต์ปรากฏ
    ${ACTUAL_TEXT}=  Get Text  ${CERT_CONTAINER}  # ดึงข้อความจากหน้าเว็บ
    Should Be Equal  ${ACTUAL_TEXT}  ${EXPECTED_TEXT}  # ตรวจสอบว่าข้อความตรงกับที่คาดหวังหรือไม่
    Log  Verified text: ${ACTUAL_TEXT}  # บันทึก Log

Verify Certificate Form Link
    Wait Until Element Is Visible  ${NAV_CERTIFICATE}  timeout=10s  # รอให้ลิงก์ Certificate Form ปรากฏ
    ${TEXT}=  Get Text  ${NAV_CERTIFICATE}  # ดึงข้อความจากลิงก์
    Should Contain  ${TEXT}  Certificate Form  # ตรวจสอบว่าข้อความต้องมี "Certificate Form"
    Log  Found Certificate Form link: ${TEXT}  # บันทึก Log

Click Certificate Form Link
    Click Element  ${NAV_CERTIFICATE}  # คลิกลิงก์ Certificate Form
    Sleep  2s  # รอให้หน้าโหลด
    Capture Page Screenshot  # จับภาพหน้าจอหลังคลิก

Open Browser And Login
    Wait Until Element Is Visible  id=username  timeout=10s  # รอให้ช่อง username แสดงขึ้นมา
    Input Text  id=username  ${USERNAME}  # กรอกชื่อผู้ใช้
    Input Text  id=password  ${PASSWORD}  # กรอกรหัสผ่าน
    Wait Until Element Is Visible  xpath=//button[@type='submit']  timeout=10s  # รอให้ปุ่ม Submit แสดงขึ้นมา
    Click Button  xpath=//button[@type='submit']  # คลิกปุ่ม Login
    Wait Until Page Contains  Dashboard  timeout=10s  # รอให้หน้า Dashboard โหลดสำเร็จ
    Capture Page Screenshot  # จับภาพหน้าจอหลังล็อกอินสำเร็จ
    Sleep  1s  # รอการเปลี่ยนหน้า

Click Target Menu
    Wait Until Element Is Visible  xpath=//a[contains(@href, '/certificateform')]  timeout=10s  # รอให้เมนู Certificate Form ปรากฏ
    Click Element  xpath=//a[contains(@href, '/certificateform')]  # คลิกเมนู Certificate Form
    Sleep  2s  # รอให้หน้าโหลด
    Capture Page Screenshot  # จับภาพหน้าจอหลังคลิกเมนู

