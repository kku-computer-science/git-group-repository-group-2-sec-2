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
    # คลิกที่ "Lecturer"
    Click Element    xpath=//ul[contains(@class, 'dropdown-menu show')]//a[contains(text(), 'Lecturer')]    
    # รอให้หน้าโหลด
    Sleep    3s
    # เลื่อนลงมาให้เห็นโปรไฟล์คนแรก
    Scroll Element Into View    xpath=(//div[contains(@class, 'card-body')])[1]
    Sleep    2s  # รอให้โหลด
    # คลิกที่โปรไฟล์ของนักวิจัยคนแรก
    Wait Until Element Is Visible    xpath=(//div[contains(@class, 'card-body')])[1]    5s
    Click Element    xpath=(//div[contains(@class, 'card-body')])[1]

    # รอให้หน้าโปรไฟล์โหลด
    Sleep    3s
    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs
    ${tabs}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    2s  # รอให้เนื้อหาโหลด
        # Capture Page Screenshot
    END
    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง
    # คลิกที่ "ไทย"
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/th']
    Sleep    3s  # รอหน้าเปลี่ยนภาษา
    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs
    ${tabs}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    2s  # รอให้เนื้อหาโหลด
        #Capture Page Screenshot
    END
    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง
    # คลิกที่ "中文"
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/zh']
    Sleep    3s  # รอหน้าเปลี่ยนภาษา
    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs
    ${tabs}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    2s  # รอให้เนื้อหาโหลด
        #Capture Page Screenshot
    END