*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}    http://127.0.0.1:8000/login
${BROWSER}    Edge
${USERNAME}    punhor1@kku.ac.th
${PASSWORD}    123456789

*** Test Cases ***
Click Language Dropdown
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Sleep    2s  # รอให้เว็บโหลดเต็มที่

    
    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง

    # คลิกเลือกภาษาไทย
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/th']
    Sleep    3s  # รอให้หน้าเปลี่ยนภาษา


    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง

    # คลิกเลือกภาษาจีน
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/zh']
    Sleep    3s  # รอให้หน้าเปลี่ยนภาษา

    # คลิกปุ่มเปลี่ยนภาษา (Dropdown)
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง

    # คลิกเลือกภาษาอังกฤษ
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/en']
    Sleep    3s  # รอให้หน้าเปลี่ยนภาษา

    # กรอกค่า username
    Input Text    xpath=//input[@id='username']    ${USERNAME}
    Sleep    2s  # รอให้ค่าปรากฏ

    # กรอกค่า Password
    Input Text    xpath=//input[@id='password']    ${PASSWORD}
    Sleep    1s

    

    # กดปุ่ม Login
    Click Button    xpath=//button[@type='submit']
    Sleep    6s  # รอให้ระบบโหลดหลังจาก Login

    
    # คลิกปุ่ม Dropdown เปลี่ยนภาษา
    Click Element    xpath=//a[contains(@class, 'nav-link dropdown-toggle')]
    Sleep    2s  # รอ dropdown แสดง

    # คลิกเลือกภาษาไทย
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/en']
    Sleep    3s  # รอให้หน้าเปลี่ยนภาษา

    # คลิกปุ่ม Dropdown เปลี่ยนภาษา
    Click Element    xpath=//a[@id='navbarDropdownMenuLink']
    Sleep    2s  # รอ dropdown แสดง

    # คลิกเลือกภาษาจีน (中文)
    Click Element    xpath=//a[@href='http://127.0.0.1:8000/lang/zh']
    Sleep    3s  # รอให้หน้าเปลี่ยนภาษา
    # บันทึกภาพหลังจากเปิด dropdown
    #Capture Page Screenshot

    # บันทึกภาพหลังจากกรอก Username
    #Capture Page Screenshot
    

    # บันทึกภาพหลังจากเปิด dropdown
    #Capture Page Screenshot