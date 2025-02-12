*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}    http://127.0.0.1:8000/
${BROWSER}    Edge

*** Test Cases ***
Click Researchers Menu and Browse Profiles
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Sleep    2s  # รอให้เว็บโหลดเต็มที่

    # ใช้ JavaScript คลิกเพื่อเปิด dropdown
    Execute Javascript    document.querySelector("a[data-bs-toggle='dropdown']").click()
    Sleep    2s  # รอ dropdown แสดง

    # คลิกที่ "Computer Science"
    Click Element    xpath=//ul[contains(@class, 'dropdown-menu show')]//a[contains(text(), 'Computer Science')]
    
    # รอให้หน้าโหลด
    Sleep    3s
    Capture Page Screenshot  # บันทึกภาพหน้า Computer Science

    # เลื่อนลงมาให้เห็นโปรไฟล์คนแรก
    Scroll Element Into View    xpath=(//div[contains(@class, 'card-body')])[1]
    Sleep    2s  # รอให้โหลด

    # คลิกที่โปรไฟล์ของนักวิจัยคนแรก
    Wait Until Element Is Visible    xpath=(//div[contains(@class, 'card-body')])[1]    5s
    Click Element    xpath=(//div[contains(@class, 'card-body')])[1]

    # รอให้หน้าโปรไฟล์โหลด
    Sleep    3s
    Capture Page Screenshot  # บันทึกภาพโปรไฟล์

    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs
    ${tabs}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    2s  # รอให้เนื้อหาโหลด
        Capture Page Screenshot
    END

    # กลับไปที่หน้า Researchers (คลิกที่เมนู RESEARCHERS)
    Click Element    xpath=//a[@data-bs-toggle='dropdown']
    Sleep    3s  # รอให้ dropdown โหลด
    Capture Page Screenshot  # บันทึกภาพ Researchers

    # ใช้ JavaScript เปิด dropdown ใหม่อีกครั้ง
    Execute Javascript    document.querySelector("a[data-bs-toggle='dropdown']").click()
    Sleep    2s  # รอ dropdown แสดง

    # ไปที่ "Information Technology" โดยใช้ `Go To`
    Go To    http://127.0.0.1:8000/researchers/2
    Wait Until Location Is    http://127.0.0.1:8000/researchers/2    5s
    Capture Page Screenshot  # บันทึกภาพหน้า Information Technology

    # เลื่อนลงมาให้เห็นโปรไฟล์นักวิจัยคนแรก
    Scroll Element Into View    xpath=(//a[contains(@href, '/detail/')])[1]
    Sleep    2s  # รอให้โหลด

    # คลิกที่โปรไฟล์นักวิจัยคนแรก
    Wait Until Element Is Visible    xpath=(//a[contains(@href, '/detail/')])[1]    5s
    Click Element    xpath=(//a[contains(@href, '/detail/')])[1]

    # รอให้หน้าโปรไฟล์โหลด
    Sleep    3s
    Capture Page Screenshot  # บันทึกภาพหน้าโปรไฟล์ของนักวิจัยใน Information Technology

    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs ของโปรไฟล์นักวิจัยใน Information Technology
    ${tabs_it}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs_it}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    2s  # รอให้เนื้อหาโหลด
        Capture Page Screenshot  # บันทึกภาพของแต่ละแท็บ
    END

    # กลับไปที่หน้า Researchers (คลิกที่เมนู RESEARCHERS)
    Click Element    xpath=//a[@data-bs-toggle='dropdown']
    Sleep    3s  # รอให้ dropdown โหลด
    Capture Page Screenshot  # บันทึกภาพ Researchers

    # ใช้ JavaScript เปิด dropdown ใหม่อีกครั้ง
    Execute Javascript    document.querySelector("a[data-bs-toggle='dropdown']").click()
    Sleep    2s  # รอ dropdown แสดง

    # ไปที่ "Information Technology" โดยใช้ `Go To`
    Go To    http://127.0.0.1:8000/researchers/3
    Wait Until Location Is    http://127.0.0.1:8000/researchers/3   5s
    Capture Page Screenshot  # บันทึกภาพหน้า Information Technology

    # เลื่อนลงมาให้เห็นโปรไฟล์นักวิจัยคนแรก
    Scroll Element Into View    xpath=(//a[contains(@href, '/detail/')])[1]
    Sleep    2s  # รอให้โหลด

    # คลิกที่โปรไฟล์นักวิจัยคนแรก
    Wait Until Element Is Visible    xpath=(//a[contains(@href, '/detail/')])[1]    5s
    Click Element    xpath=(//a[contains(@href, '/detail/')])[1]

    # รอให้หน้าโปรไฟล์โหลด
    Sleep    3s
    Capture Page Screenshot  # บันทึกภาพหน้าโปรไฟล์ของนักวิจัยใน Information Technology

    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs ของโปรไฟล์นักวิจัยใน Information Technology
    ${tabs_it}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs_it}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    2s  # รอให้เนื้อหาโหลด
        Capture Page Screenshot  # บันทึกภาพของแต่ละแท็บ
    END
    Close Browser
