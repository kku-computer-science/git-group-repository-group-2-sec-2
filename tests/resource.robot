*** Settings ***
Library           SeleniumLibrary

*** Variables ***
${SERVER}         soften2sec267.cpkkuhost.com
${DELAY}          1
${BROWSER}  Chrome
${USERNAME}  pusadee@kku.ac.th  # เปลี่ยนเป็น username สำหรับทดสอบ
${PASSWORD}  123456789  # เปลี่ยนเป็นรหัสผ่านสำหรับทดสอบ
${URL}      http://${SERVER}/login
${CHROME_BROWSER_PATH}    ${EXECDIR}${/}ChromeForTesting${/}chrome.exe
${CHROME_DRIVER_PATH}    ${EXECDIR}${/}ChromeForTesting${/}chromedriver.exe

*** Keywords ***
Open Browser To Form Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")
# [selenium >= 4.10] chrome_options change to options
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${URL}
    Form Page Should Be Open

Form Page Should Be Open
    Title Should Be    Customer Inquiry

Go To Form Page
    Go To    ${URL}
    Form Page Should Be Open

