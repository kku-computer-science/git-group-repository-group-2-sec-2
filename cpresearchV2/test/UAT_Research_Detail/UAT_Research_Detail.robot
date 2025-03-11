*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         http://127.0.0.1:8000/researchers/2
${EXPECTED_URL}  ${URL}researchers/2
${BROWSER}     Edge

# Language Buttons
${LANG_MENU}   //a[@id='navbarDropdownMenuLink']
${LANG_EN}     //a[normalize-space()='English']
${LANG_TH}     //a[normalize-space()='ไทย']
${LANG_CN}     //a[normalize-space()='中文']

# Researchers Dropdown Menu
${RESEARCHERS_MENU}    //a[@id='navbarDropdown']
${RESEARCHERS_LIST}    //ul[contains(@class, 'dropdown-menu') and @aria-labelledby='navbarDropdown']
${RESEARCHER_ROLE_EN}  //ul[contains(@class, 'dropdown-menu')]//a[contains(text(),'Lecturer')]

# Elements for Checking Language
${CHECK_EN}    //h5[contains(text(),'Punyaphol Horata, Ph.D.')]
${CHECK_TH}    //h5[contains(text(),'รศ.ดร. ปัญญาพล หอระตะ')]
${CHECK_CN}    //h5[contains(text(),'Punyaphol Horata, 博士')]

# Profile Elements
${EMAIL_TEXT_EN}   //h6[contains(@class,'card-text1') and contains(text(),'Email:')]
${PUBLICATIONS_TITLE_EN}    //h6[contains(@class,'title-pub') and contains(text(),'Publications')]
${EMAIL_TEXT_TH}   //h6[contains(@class,'card-text1') and contains(text(),'อีเมล:')]
${PUBLICATIONS_TITLE_TH}    //h6[contains(@class,'title-pub') and contains(text(),'ผลงานตีพิมพ์')]
${EMAIL_TEXT_CN}   //h6[contains(@class,'card-text1') and contains(text(),'电子邮件:')]
${PUBLICATIONS_TITLE_CN}    //h6[contains(@class,'title-pub') and contains(text(),'出版物')]

# Tabs for Publications
${TAB_SUMMARY_EN}      //button[@id='home-tab']
${TAB_SCOPUS_EN}       //button[@id='scopus-tab']
${TAB_WOS_EN}          //button[@id='wos-tab']
${TAB_TCI_EN}          //button[@id='tci-tab']
${TAB_BOOK_EN}         //button[@id='book-tab']
${TAB_OTHER_EN}        //button[@id='other-tab']
${TAB_SCHOLAR_EN}      //button[@id='scholar-tab']
${EXPORT_BTN_EN}    //button[contains(text(), 'Export to Excel')]

*** Test Cases ***

    
Change Language To English
    [Documentation]  คลิกเปลี่ยนภาษาเป็น English และตรวจสอบว่ามีคำว่า English อยู่ในหน้า
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Sleep    2s

    # คลิกเมนูภาษา
    Wait Until Element Is Visible    ${LANG_MENU}    timeout=5s
    Click Element    ${LANG_MENU}
    Sleep    1s

    # คลิกที่ English
    Wait Until Element Is Visible    ${LANG_EN}    timeout=5s
    Click Element    ${LANG_EN}
    Sleep    2s

    # ตรวจสอบว่ามีคำว่า English ปรากฏบนหน้า
    Wait Until Page Contains    English    timeout=5s



Find And Click On Punyaphol Horata
    [Documentation]  ค้นหาชื่อ Punyaphol Horata, Ph.D. และคลิกเพื่อเข้าสู่หน้าโปรไฟล์

    # เลื่อนจอลงเพื่อให้เห็นรายชื่ออาจารย์
    Execute Javascript    window.scrollBy(0, 500)
    Sleep    2s

    # รอจนกว่าชื่อ Punyaphol Horata, Ph.D. จะปรากฏ
    Wait Until Page Contains Element    //h5[contains(text(),'Punyaphol Horata, Ph.D.')]    timeout=5s

    # คลิกที่ชื่อ Punyaphol Horata, Ph.D.
    Click Element    //h5[contains(text(),'Punyaphol Horata, Ph.D.')]

    # รอให้หน้าโปรไฟล์โหลดเสร็จ
    Sleep    2s
    Capture Page Screenshot    after_click_punyaphol.png


Verify Summary And SCOPUS Tabs
    [Documentation]  ตรวจสอบว่าแท็บ Summary และ SCOPUS มีข้อความถูกต้อง

    # เลื่อนจอลง
    Execute Javascript    window.scrollBy(0, 400)
    Sleep    2s

    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='home-tab']    timeout=5s
    Element Text Should Be    //button[@id='home-tab']    Summary

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scopus-tab']    timeout=5s
    Element Text Should Be    //button[@id='scopus-tab']    SCOPUS

Verify Table Headers
    [Documentation]  ตรวจสอบว่าหัวตาราง No, Year, Author มีข้อความถูกต้อง

    # ตรวจสอบว่า "No." ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'No.')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'No.')]    No.

    # ตรวจสอบว่า "Year" ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'Year')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'Year')]    Year

    # ตรวจสอบว่า "Author" ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'Author')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'Author')]    Author

Verify Tab Names
    [Documentation]  ตรวจสอบว่าชื่อแท็บถูกต้อง

    # ตรวจสอบชื่อแท็บ
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='home-tab']    timeout=5s
    Element Text Should Be    //button[@id='home-tab']    Summary

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scopus-tab']    timeout=5s
    Element Text Should Be    //button[@id='scopus-tab']    SCOPUS
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='wos-tab']    timeout=5s
    Element Text Should Be    //button[@id='wos-tab']    Web of Science

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='tci-tab']    timeout=5s
    Element Text Should Be    //button[@id='tci-tab']    TCI
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='book-tab']    timeout=5s
    Element Text Should Be    //button[@id='book-tab']    Book
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='patent-tab']    timeout=5s
    Element Text Should Be    //button[@id='patent-tab']    Other

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scholar-tab']    timeout=5s
    Element Text Should Be    //button[@id='scholar-tab']    Scholar

    

Click Tabs And Verify Table Headers
    [Documentation]  คลิกแต่ละแท็บและตรวจสอบว่าตารางมี No, Year, Author ถูกต้อง

    # ฟังก์ชันช่วยเหลือในการกดแท็บและตรวจสอบตาราง
    Click Tab And Check Table    //button[@id='home-tab']    Summary
    Click Tab And Check Table    //button[@id='scopus-tab']    SCOPUS
    Click Tab And Check Table    //button[@id='wos-tab']    Web of Science
    Click Tab And Check Table    //button[@id='tci-tab']    TCI
    Click Tab And Check Table    //button[@id='book-tab']    Book
    Click Tab And Check Table    //button[@id='patent-tab']    Other
    Click Tab And Check Table    //button[@id='scholar-tab']    Scholar


Change Language To English
    [Documentation]  คลิกเปลี่ยนภาษาเป็น ไทย และตรวจสอบว่ามีคำว่า ไทย อยู่ในหน้า
    
    Execute Javascript    window.scrollTo(0, 0)
    Sleep    1s  # รอให้หน้าเลื่อนขึ้นก่อนทำงานต่อ
    # คลิกเมนูภาษา
    Wait Until Element Is Visible    ${LANG_MENU}    timeout=5s
    Click Element    ${LANG_MENU}
    Sleep    1s

    # คลิกที่ TH
    Wait Until Element Is Visible    ${LANG_TH}    timeout=5s
    Click Element    ${LANG_TH}
    Sleep    2s

    # ตรวจสอบว่ามีคำว่า TH ปรากฏบนหน้า
    Wait Until Page Contains    ไทย    timeout=5s
    

Verify Summary And SCOPUS Tabs
    [Documentation]  ตรวจสอบว่าแท็บ งานทั้งหมด และ SCOPUS มีข้อความถูกต้อง

    # เลื่อนจอลง
    Execute Javascript    window.scrollBy(0, 400)
    Sleep    2s

    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='home-tab']    timeout=5s
    Element Text Should Be    //button[@id='home-tab']    งานทั้งหมด

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scopus-tab']    timeout=5s
    Element Text Should Be    //button[@id='scopus-tab']    SCOPUS


Verify Table Headers
    [Documentation]  ตรวจสอบว่าหัวตาราง ลำดับที่, ปีที่ตีพิมพ์, ผู้แต่ง มีข้อความถูกต้อง

    # ตรวจสอบว่า "No." ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'ลำดับที่')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'ลำดับที่')]    ลำดับที่

    # ตรวจสอบว่า "Year" ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'ปีที่ตีพิมพ์')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'ปีที่ตีพิมพ์')]    ปีที่ตีพิมพ์

    # ตรวจสอบว่า "Author" ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'ผู้แต่ง')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'ผู้แต่ง')]    ผู้แต่ง

Verify Tab Names
    [Documentation]  ตรวจสอบว่าชื่อแท็บถูกต้อง

    # ตรวจสอบชื่อแท็บ
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='home-tab']    timeout=5s
    Element Text Should Be    //button[@id='home-tab']    งานทั้งหมด

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scopus-tab']    timeout=5s
    Element Text Should Be    //button[@id='scopus-tab']    SCOPUS
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='wos-tab']    timeout=5s
    Element Text Should Be    //button[@id='wos-tab']    Web of Science

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='tci-tab']    timeout=5s
    Element Text Should Be    //button[@id='tci-tab']    TCI
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='book-tab']    timeout=5s
    Element Text Should Be    //button[@id='book-tab']    หนังสือ
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='patent-tab']    timeout=5s
    Element Text Should Be    //button[@id='patent-tab']    อื่นๆ

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scholar-tab']    timeout=5s
    Element Text Should Be    //button[@id='scholar-tab']    Scholar


Click Tabs And Verify Table Headers
    [Documentation]  คลิกแต่ละแท็บและตรวจสอบว่าตารางมี ลำดับที่, ปีที่ตีพิมพ์, ผู้แต่ง ถูกต้อง

    # ฟังก์ชันช่วยเหลือในการกดแท็บและตรวจสอบตาราง
    Click Tab And Check Table    //button[@id='home-tab']    งานทั้งหมด
    Click Tab And Check Table    //button[@id='scopus-tab']    SCOPUS
    Click Tab And Check Table    //button[@id='wos-tab']    Web of Science
    Click Tab And Check Table    //button[@id='tci-tab']    TCI
    Click Tab And Check Table    //button[@id='book-tab']    หนังสือ
    Click Tab And Check Table    //button[@id='patent-tab']    อื่นๆ
    Click Tab And Check Table    //button[@id='scholar-tab']    Scholar


Change Language To CN
    [Documentation]  คลิกเปลี่ยนภาษาเป็น 中文 และตรวจสอบว่ามีคำว่า 中文 อยู่ในหน้า
    Execute Javascript    window.scrollTo(0, 0)
    Sleep    1s  # รอให้หน้าเลื่อนขึ้นก่อนทำงานต่อ

    # คลิกเมนูภาษา
    Wait Until Element Is Visible    ${LANG_MENU}    timeout=5s
    Click Element    ${LANG_MENU}
    Sleep    1s

    # คลิกที่ English
    Wait Until Element Is Visible    ${LANG_CN}    timeout=5s
    Click Element    ${LANG_CN}
    Sleep    2s

    # ตรวจสอบว่ามีคำว่า China ปรากฏบนหน้า
    Wait Until Page Contains    中文    timeout=5s


Verify Summary And SCOPUS Tabs
    [Documentation]  ตรวจสอบว่าแท็บ 摘要 และ SCOPUS มีข้อความถูกต้อง

    # เลื่อนจอลง
    Execute Javascript    window.scrollBy(0, 400)
    Sleep    2s

    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='home-tab']    timeout=5s
    Element Text Should Be    //button[@id='home-tab']    摘要

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scopus-tab']    timeout=5s
    Element Text Should Be    //button[@id='scopus-tab']    SCOPUS

Verify Table Headers
    [Documentation]  ตรวจสอบว่าหัวตาราง 编号, 年份, 作者 มีข้อความถูกต้อง

    # ตรวจสอบว่า "No." ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'编号')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'编号')]    编号

    # ตรวจสอบว่า "Year" ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'年份')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'年份')]    年份

    # ตรวจสอบว่า "Author" ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //th[contains(text(),'作者')]    timeout=5s
    Element Text Should Be    //th[contains(text(),'作者')]    作者

Verify Tab Names
    [Documentation]  ตรวจสอบว่าชื่อแท็บถูกต้อง

    # ตรวจสอบชื่อแท็บ
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='home-tab']    timeout=5s
    Element Text Should Be    //button[@id='home-tab']    摘要

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scopus-tab']    timeout=5s
    Element Text Should Be    //button[@id='scopus-tab']    SCOPUS
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='wos-tab']    timeout=5s
    Element Text Should Be    //button[@id='wos-tab']    Web of Science

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='tci-tab']    timeout=5s
    Element Text Should Be    //button[@id='tci-tab']    TCI
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='book-tab']    timeout=5s
    Element Text Should Be    //button[@id='book-tab']    书籍
    # ตรวจสอบว่าแท็บ Summary ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='patent-tab']    timeout=5s
    Element Text Should Be    //button[@id='patent-tab']    其他

    # ตรวจสอบว่าแท็บ SCOPUS ปรากฏและมีข้อความถูกต้อง
    Wait Until Element Is Visible    //button[@id='scholar-tab']    timeout=5s
    Element Text Should Be    //button[@id='scholar-tab']    Scholar

    

Click Tabs And Verify Table Headers
    [Documentation]  คลิกแต่ละแท็บและตรวจสอบว่าตารางมี 编号, 年份, 作者 ถูกต้อง

    # ฟังก์ชันช่วยเหลือในการกดแท็บและตรวจสอบตาราง
    Click Tab And Check Table    //button[@id='home-tab']    摘要
    Click Tab And Check Table    //button[@id='scopus-tab']    SCOPUS
    Click Tab And Check Table    //button[@id='wos-tab']    Web of Science
    Click Tab And Check Table    //button[@id='tci-tab']    TCI
    Click Tab And Check Table    //button[@id='book-tab']    书籍
    Click Tab And Check Table    //button[@id='patent-tab']    其他
    Click Tab And Check Table    //button[@id='scholar-tab']    Scholar
    

End
    Execute Javascript    window.scrollTo(0, 0)
    Sleep    1s  # รอให้หน้าเลื่อนขึ้นก่อนทำงานต่อ

    Close Browser

*** Keywords ***
Click Tab And Check Table
    [Arguments]    ${tab_xpath}    ${tab_name}
    [Documentation]  กดที่แท็บและตรวจสอบว่ามีหัวข้อ No, Year, Author หรือข้ามถ้าไม่มี

    # คลิกแท็บ
    Wait Until Element Is Visible    ${tab_xpath}    timeout=5s
    Click Element    ${tab_xpath}
    Sleep    2s  # รอให้ข้อมูลโหลด


    # ตั้งค่าตารางที่เป็น active tab
    ${TABLE}    Set Variable    //div[contains(@class,'tab-pane') and contains(@class,'active')]//table[contains(@class,'dataTable')]
    ${TABLE_HEADER_NO}    Set Variable    ${TABLE}//th[contains(text(),'No.')]
    ${TABLE_HEADER_YEAR}  Set Variable    ${TABLE}//th[contains(text(),'Year')]
    ${TABLE_HEADER_AUTHOR}    Set Variable    ${TABLE}//th[contains(text(),'Author')]

    # เช็คว่ามี No. และ Year อยู่ในตารางหรือไม่
    ${NO_EXISTS}    Run Keyword And Return Status    Page Should Contain Element    ${TABLE_HEADER_NO}
    ${YEAR_EXISTS}  Run Keyword And Return Status    Page Should Contain Element    ${TABLE_HEADER_YEAR}

    Run Keyword If    ${NO_EXISTS}==True and ${YEAR_EXISTS}==True    Run Table Validation    ${TABLE_HEADER_NO}    ${TABLE_HEADER_YEAR}    ${TABLE_HEADER_AUTHOR}
    Run Keyword If    ${NO_EXISTS}==False or ${YEAR_EXISTS}==False    Log    Skipping ${tab_name} (No table headers found)
    
    Log    Checked tab ${tab_name} successfully.

Run Table Validation
    [Arguments]    ${TABLE_HEADER_NO}    ${TABLE_HEADER_YEAR}    ${TABLE_HEADER_AUTHOR}
    [Documentation]  ตรวจสอบว่า No, Year, Author มีอยู่ในตาราง

    Wait Until Element Is Visible    ${TABLE_HEADER_NO}    timeout=5s
    Element Text Should Be    ${TABLE_HEADER_NO}    No.

    Wait Until Element Is Visible    ${TABLE_HEADER_YEAR}    timeout=5s
    Element Text Should Be    ${TABLE_HEADER_YEAR}    Year

    Wait Until Element Is Visible    ${TABLE_HEADER_AUTHOR}    timeout=5s
    Element Text Should Be    ${TABLE_HEADER_AUTHOR}    Author

Click Tab And Check Table CN
    [Arguments]    ${tab_xpath}    ${tab_name}
    [Documentation]  กดที่แท็บและตรวจสอบว่ามีหัวข้อ No, Year, Author หรือข้ามถ้าไม่มี

    # คลิกแท็บ
    Wait Until Element Is Visible    ${tab_xpath}    timeout=5s
    Click Element    ${tab_xpath}
    Sleep    2s  # รอให้ข้อมูลโหลด


    # ตั้งค่าตารางที่เป็น active tab
    ${TABLE}    Set Variable    //div[contains(@class,'tab-pane') and contains(@class,'active')]//table[contains(@class,'dataTable')]
    ${TABLE_HEADER_NO}    Set Variable    ${TABLE}//th[contains(text(),'编号')]
    ${TABLE_HEADER_YEAR}  Set Variable    ${TABLE}//th[contains(text(),'年份')]
    ${TABLE_HEADER_AUTHOR}    Set Variable    ${TABLE}//th[contains(text(),'作者')]

    # เช็คว่ามี No. และ Year อยู่ในตารางหรือไม่
    ${NO_EXISTS}    Run Keyword And Return Status    Page Should Contain Element    ${TABLE_HEADER_NO}
    ${YEAR_EXISTS}  Run Keyword And Return Status    Page Should Contain Element    ${TABLE_HEADER_YEAR}

    Run Keyword If    ${NO_EXISTS}==True and ${YEAR_EXISTS}==True    Run Table Validation    ${TABLE_HEADER_NO}    ${TABLE_HEADER_YEAR}    ${TABLE_HEADER_AUTHOR}
    Run Keyword If    ${NO_EXISTS}==False or ${YEAR_EXISTS}==False    Log    Skipping ${tab_name} (No table headers found)
    
    Log    Checked tab ${tab_name} successfully.

Run Table Validation CN
    [Arguments]    ${TABLE_HEADER_NO}    ${TABLE_HEADER_YEAR}    ${TABLE_HEADER_AUTHOR}
    [Documentation]  ตรวจสอบว่า 编号, 年份, 作者 มีอยู่ในตาราง

    Wait Until Element Is Visible    ${TABLE_HEADER_NO}    timeout=5s
    Element Text Should Be    ${TABLE_HEADER_NO}    编号

    Wait Until Element Is Visible    ${TABLE_HEADER_YEAR}    timeout=5s
    Element Text Should Be    ${TABLE_HEADER_YEAR}    年份

    Wait Until Element Is Visible    ${TABLE_HEADER_AUTHOR}    timeout=5s
    Element Text Should Be    ${TABLE_HEADER_AUTHOR}    作者
#*** Keywords ***



#*** Test Cases ***

    
#*** Keywords ***




#*** Test Cases ***


    
#*** Keywords ***


#*** Keywords ***


#*** Test Cases ***
