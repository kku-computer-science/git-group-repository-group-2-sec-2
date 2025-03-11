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

${LANG_DROPDOWN}  xpath=//a[@id='navbarDropdownMenuLink']  
${LANG_THAI}      xpath=//a[contains(@href, '/lang/th')]
${LANG_CHINESE}   xpath=//a[contains(@href, '/lang/zh')]
${LANG_ENGLISH}   xpath=//a[contains(@href, '/lang/en')]

# Language Codes
${LANG_THAI_CODE}        th
${LANG_CHINESE_CODE}     zh
${LANG_ENGLISH_CODE}     en

${CERT_CONTAINER}  xpath=/html/body/div/div/div/div/div  # XPath ของคอนเทนต์ในหน้า Certificate
${CERT_TEXT_ENG}   Certificate Form\nWelcome to the Certificate Form page. Please proceed with your submission.  # ข้อความที่คาดหวังในภาษาอังกฤษ
${CERT_TEXT_CHI}   证书表单\n欢迎来到证书表单页面。请继续提交您的信息。  # ข้อความที่คาดหวังในภาษาจีน
${CERT_TEXT_THAI}  แบบฟอร์มใบรับรอง\nยินดีต้อนรับสู่หน้าแบบฟอร์มใบรับรอง กรุณาดำเนินการส่งข้อมูลของคุณ  # ข้อความที่คาดหวังในภาษาไทย

${NAV_CERTIFICATE}  xpath=/html/body/div/div/nav//a[contains(@href, '/certificateform')]  # XPath ของลิงก์ Certificate Form ในเมนู


*** Keywords ***
Change Language And Check Context
    [Arguments]  ${LANG_OPTION}  ${LANG_CODE}  ${EXPECTED_TEXT}
    Change Language  ${LANG_OPTION}  ${LANG_CODE}
    Verify Certificate Page Text  ${EXPECTED_TEXT}  

Change Language
    [Arguments]  ${LANG_OPTION}  ${LANG_CODE}
    Wait Until Element Is Visible  ${LANG_DROPDOWN}  timeout=10s  
    Execute JavaScript    document.getElementById('navbarDropdownMenuLink').click();  
    Click Element  ${LANG_DROPDOWN}  
    Sleep  1s  
    Wait Until Element Is Visible  ${LANG_OPTION}  timeout=5s  
    Click Element  ${LANG_OPTION}  
    Sleep  1s  

    Capture Page Screenshot  language_${LANG_CODE}.png  # 📸 จับภาพหน้าจอหลังเปลี่ยนภาษา
    Log  Changed language to ${LANG_CODE}

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

Logout
    Wait Until Element Is Visible    xpath=//a[contains(text(), 'Logout')]    timeout=10s  
    Execute JavaScript    document.getElementById('logout-form').submit();  
    Sleep    2s  
    Wait Until Page Contains    Login    timeout=10s  
    Capture Page Screenshot    logout.png  # 📸 จับภาพหลัง Logout
    Log    Successfully logged out

*** Test Cases ***
Login
    Open Browser  ${URL}  ${BROWSER}  # เปิดเบราว์เซอร์และไปที่หน้า Login
    Maximize Browser Window  # ขยายหน้าต่างเบราว์เซอร์ให้เต็มจอ
    Open Browser And Login  # ทำการล็อกอินเข้าสู่ระบบ

Verify Certificate Form Link
    Click Target Menu  # คลิกเมนูที่ต้องการ
    Verify Certificate Form Link  # ตรวจสอบว่ามีลิงก์ Certificate Form หรือไม่
    Click Certificate Form Link  # คลิกเข้าไปที่หน้า Certificate Form


Change Language to Thai
    Change Language And Check Context  ${LANG_THAI}  ${LANG_THAI_CODE}  ${CERT_TEXT_THAI}  # เปลี่ยนภาษาเป็นไทยและตรวจสอบเนื้อหา

Change Language to Chinese
    Change Language And Check Context  ${LANG_CHINESE}  ${LANG_CHINESE_CODE}  ${CERT_TEXT_CHI}  # เปลี่ยนภาษาเป็นจีนและตรวจสอบเนื้อหา

Change Language to English
    Change Language And Check Context  ${LANG_ENGLISH}  ${LANG_ENGLISH_CODE}  ${CERT_TEXT_ENG}  # เปลี่ยนภาษาเป็นอังกฤษและตรวจสอบเนื้อหา

Logout
    Logout 
    Close Browser  # ปิดเบราว์เซอร์