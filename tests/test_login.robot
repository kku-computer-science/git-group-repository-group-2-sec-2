*** Settings ***
Library  SeleniumLibrary

*** Variables ***
${SERVER}         127.0.0.1:8000
${DELAY}          1
${BROWSER}        Chrome
${USERNAME}       pusadee@kku.ac.th  # เปลี่ยนเป็น username สำหรับทดสอบ
${PASSWORD}       123456789  # เปลี่ยนเป็นรหัสผ่านสำหรับทดสอบ
${INVALID_USERNAME}   pusadee
${INVALID_PASSWORD}   1234
${URL}            http://${SERVER}/login

*** Test Cases ***
# ✅ กรณีที่ 1: ไม่กรอกทั้งชื่อและรหัสผ่าน
User Login With Empty Username And Password
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Please enter username and password  timeout=10s
    Capture Page Screenshot
    Close Browser

# ✅ กรณีที่ 2: กรอกเฉพาะชื่อถูก แต่ไม่กรอกรหัสผ่าน
User Login With Correct Username Only
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Please enter password  timeout=10s
    Capture Page Screenshot
    Close Browser

# ✅ กรณีที่ 3: กรอกเฉพาะชื่อผิด แต่ไม่กรอกรหัสผ่าน
User Login With Incorrect Username Only
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${INVALID_USERNAME}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Please enter password  timeout=10s
    Capture Page Screenshot
    Close Browser

# ✅ กรณีที่ 4: กรอกเฉพาะรหัสผ่านถูก แต่ไม่กรอกชื่อ
User Login With Correct Password Only
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Please enter username  timeout=10s
    Capture Page Screenshot
    Close Browser

# ✅ กรณีที่ 5: กรอกเฉพาะรหัสผ่านผิด แต่ไม่กรอกชื่อ
User Login With Incorrect Password Only
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=password  ${INVALID_PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Please enter username  timeout=10s
    Capture Page Screenshot
    Close Browser

# ✅ กรณีที่ 6: กรอกชื่อผิด และรหัสผ่านผิด
User Login With Incorrect Credentials
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${INVALID_USERNAME}
    Input Text  id=password  ${INVALID_PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Invalid username or password  timeout=10s
    Capture Page Screenshot
    Close Browser

# ✅ กรณีที่ 7: กรอกชื่อถูก และรหัสผ่านผิด
User Login With Correct Username And Incorrect Password
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${INVALID_PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Invalid username or password  timeout=10s
    Capture Page Screenshot
    Close Browser

# ✅ กรณีที่ 8: กรอกชื่อผิด และรหัสผ่านถูก
User Login With Incorrect Username And Correct Password
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${INVALID_USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Invalid username or password  timeout=10s
    Capture Page Screenshot
    Close Browser

# ✅ กรณีที่ 9: กรอกชื่อและรหัสผ่านถูกต้อง
User Can Successfully Login
    Open Browser  ${URL}  ${BROWSER}
    Wait Until Element Is Visible  id=username  timeout=10s
    Input Text  id=username  ${USERNAME}
    Input Text  id=password  ${PASSWORD}
    Click Button  xpath=//button[text()='Log In']
    Wait Until Page Contains  Dashboard  timeout=10s
    Capture Page Screenshot
    Close Browser
