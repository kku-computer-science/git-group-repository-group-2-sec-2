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
    Sleep    2s
    # เลื่อนลงมาให้เห็นโปรไฟล์คนแรก
    Scroll Element Into View    xpath=(//div[contains(@class, 'card-body')])[1]
    Sleep    2s  # รอให้โหลด
    # คลิกที่โปรไฟล์ของนักวิจัยคนแรก
    Wait Until Element Is Visible    xpath=(//div[contains(@class, 'card-body')])[1]    5s
    Click Element    xpath=(//div[contains(@class, 'card-body')])[1]

    # รอให้หน้าโปรไฟล์โหลด
    Sleep    2s
    
    # เลื่อนจอลงล่างสุด
    Execute Javascript    window.scrollBy(0, 500)  # เลื่อนลง 500 พิกเซล

    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs
    ${tabs}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    1s  # รอให้เนื้อหาโหลด
        # Capture Page Screenshot
    END
    #เลื่อนขึ้นบนสุด
    Execute Javascript    window.scrollTo(0, -500)
    Sleep    2s
    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง
    # คลิกที่ "ไทย"
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/th']
    Sleep    2s  # รอหน้าเปลี่ยนภาษา

    # เลื่อนจอลงล่างสุด
    Execute Javascript    window.scrollBy(0, 500)  # เลื่อนลง 500 พิกเซล

    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs
    ${tabs}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    2s  # รอให้เนื้อหาโหลด
        #Capture Page Screenshot
    END
    #เลื่อนขึ้นบนสุด
    Execute Javascript    window.scrollTo(0, -500)
    Sleep    2s

    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง
    # คลิกที่ "中文"
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/zh']
    Sleep    2s  # รอหน้าเปลี่ยนภาษา
    # เลื่อนจอลงล่างสุด
    Execute Javascript    window.scrollBy(0, 500)  # เลื่อนลง 500 พิกเซล

    # วนลูปกดปุ่มแท็บทุกอันใน nav-tabs
    ${tabs}=    Get WebElements    xpath=//ul[@class='nav nav-tabs']/li/button
    FOR    ${tab}    IN    @{tabs}
        Scroll Element Into View    ${tab}
        Click Element    ${tab}
        Sleep    2s  # รอให้เนื้อหาโหลด
        #Capture Page Screenshot
    END
    #เลื่อนขึ้นบนสุด
    Execute Javascript    window.scrollTo(0, -500)
    Sleep    2s

    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง
    # คลิกที่ "中文"
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/en']
    Sleep    2s  # รอหน้าเปลี่ยนภาษา

    # เลื่อนจอลงล่าง
    Execute Javascript    window.scrollBy(0, 500)  # เลื่อนลง 500 พิกเซล
    Sleep   2s
    # ใส่ข้อความ "Reasoning in inconsistent prioritized knowledge bases:"
    Input Text    xpath=//input[@type='search']    Reasoning in inconsistent prioritized knowledge bases:
    Sleep    2s  # รอให้ระบบทำงาน

    # ลบข้อความเก่าออก
    Press Keys    xpath=//input[@type='search']    CTRL+A    # เลือกข้อความทั้งหมด
    Sleep    1s  # รอให้ระบบทำงาน
    Press Keys    xpath=//input[@type='search']    BACKSPACE  # ลบข้อความที่เลือก

    Sleep    3s  # รอให้ระบบเคลียร์ข้อมูล

    # ใส่ข้อความใหม่ "Teerawat Polsawat Apisak Pattanachak"
    Input Text    xpath=//input[@type='search']    Teerawat Polsawat Apisak Pattanachak
    Sleep    2s  # รอให้ระบบทำงาน

    # ลบข้อความเก่าออก
    Press Keys    xpath=//input[@type='search']    CTRL+A    # เลือกข้อความทั้งหมด
    Sleep    1s  # รอให้ระบบทำงาน
    Press Keys    xpath=//input[@type='search']    BACKSPACE  # ลบข้อความที่เลือก

    Sleep    3s  # รอให้ระบบเคลียร์ข้อมูล

    # ใส่ข้อความใหม่ "Conference Proceeding	"
    Input Text    xpath=//input[@type='search']    Conference Proceeding	
    Sleep    2s  # รอให้ระบบทำงาน

    # ลบข้อความเก่าออก
    Press Keys    xpath=//input[@type='search']    CTRL+A    # เลือกข้อความทั้งหมด
    Sleep    1s  # รอให้ระบบทำงาน
    Press Keys    xpath=//input[@type='search']    BACKSPACE  # ลบข้อความที่เลือก

    Sleep    3s  # รอให้ระบบเคลียร์ข้อมูล

    # ใส่ข้อความใหม่ "International Journal of Electrical and Computer Engineering"
    Input Text    xpath=//input[@type='search']    International Journal of Electrical and Computer Engineering	
    Sleep    2s  # รอให้ระบบทำงาน

    # ลบข้อความเก่าออก
    Press Keys    xpath=//input[@type='search']    CTRL+A    # เลือกข้อความทั้งหมด
    Sleep    1s  # รอให้ระบบทำงาน
    Press Keys    xpath=//input[@type='search']    BACKSPACE  # ลบข้อความที่เลือก

    Sleep    3s  # รอให้ระบบเคลียร์ข้อมูล

    # ใส่ข้อความใหม่ "Scopus"
    Input Text    xpath=//input[@type='search']    Scopus	
    Sleep    2s  # รอให้ระบบทำงาน

    #เลื่อนขึ้นบนสุด
    Execute Javascript    window.scrollTo(0, -500)
    Sleep    2s

    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง
    # คลิกที่ "中文"
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/zh']
    Sleep    2s  # รอหน้าเปลี่ยนภาษา
    # เลื่อนจอลงล่างสุด
    Execute Javascript    window.scrollBy(0, 500)  # เลื่อนลง 500 พิกเซล
    Sleep    2s
    # ใส่ข้อความใหม่ "期刊"
    Input Text    xpath=//input[@type='search']    期刊	
    Sleep    4s  # รอให้ระบบทำงาน