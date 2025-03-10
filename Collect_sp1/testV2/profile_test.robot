*** Settings ***
Library    SeleniumLibrary
Library    BuiltIn

*** Variables ***
${URL}    http://127.0.0.1:8000/profile
${BROWSER}    chrome
${USERNAME}    chitsutha@kku.ac.th
${PASSWORD}    123456789
${EMPTY}
${DELAY}    0.1

*** Test Cases ***
Valid Profile Update
    [Documentation]    Test updating profile with valid information
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Profile Page
    Activate Account Tab
    Fill Profile Form
    Submit Form
    Verify Update Success
    Close Browser

Empty First Name English
    [Documentation]    Test updating profile with empty English first name
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Profile Page
    Activate Account Tab
    Fill Profile Form Empty Fname En
    Submit Form
    Verify Update Not Success
    Close Browser

Empty Last Name English
    [Documentation]    Test updating profile with empty English last name
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Profile Page
    Activate Account Tab
    Fill Profile Form Empty Lname En
    Submit Form
    Verify Update Not Success
    Close Browser

Empty First Name Thai
    [Documentation]    Test updating profile with empty Thai first name
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Profile Page
    Activate Account Tab
    Fill Profile Form Empty Fname Th
    Submit Form
    Verify Update Not Success
    Close Browser

Empty Last Name Thai
    [Documentation]    Test updating profile with empty Thai last name
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Profile Page
    Activate Account Tab
    Fill Profile Form Empty Lname Th
    Submit Form
    Verify Update Not Success
    Close Browser

Invalid Email Format
    [Documentation]    Test updating profile with invalid email format
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Profile Page
    Activate Account Tab
    Fill Profile Form Invalid Email
    Submit Form
    Verify Update Not Success
    Close Browser

Empty Email
    [Documentation]    Test updating profile with empty email
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Profile Page
    Activate Account Tab
    Fill Profile Form Empty Email
    Submit Form
    Verify Update Not Success
    Close Browser

*** Keywords ***
Login As User
    Input Text    name=username    ${USERNAME}
    Input Text    name=password    ${PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}

Go To Profile Page
    Go To    ${URL}

Activate Account Tab
    Click Element    id=account-tab
    Wait Until Page Contains    Profile Settings
    Set Selenium Speed    ${DELAY}

Fill Profile Form
    Wait Until Element Is Visible    name=title_name_en
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Select From List By Value    name=title_name_en    Miss
    Input Text    name=fname_en    Chitsutha
    Input Text    name=lname_en    Soomlek
    Input Text    name=fname_th    ชิตสุธา
    Input Text    name=lname_th    สุ่มเล็ก
    Input Text    name=email    chitsutha@kku.ac.th
    Set Selenium Speed    ${DELAY}

Fill Profile Form Empty Fname En
    Wait Until Element Is Visible    name=title_name_en
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Select From List By Value    name=title_name_en    Miss
    Input Text    name=fname_en    ${EMPTY}
    Input Text    name=lname_en    Soomlek
    Input Text    name=fname_th    ชิตสุธา
    Input Text    name=lname_th    สุ่มเล็ก
    Input Text    name=email    chitsutha@kku.ac.th
    Set Selenium Speed    ${DELAY}

Fill Profile Form Empty Lname En
    Wait Until Element Is Visible    name=title_name_en
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Select From List By Value    name=title_name_en    Miss
    Input Text    name=fname_en    Chitsutha
    Input Text    name=lname_en    ${EMPTY}
    Input Text    name=fname_th    ชิตสุธา
    Input Text    name=lname_th    สุ่มเล็ก
    Input Text    name=email    chitsutha@kku.ac.th
    Set Selenium Speed    ${DELAY}

Fill Profile Form Empty Fname Th
    Wait Until Element Is Visible    name=title_name_en
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Select From List By Value    name=title_name_en    Miss
    Input Text    name=fname_en    Chitsutha
    Input Text    name=lname_en    Soomlek
    Input Text    name=fname_th    ${EMPTY}
    Input Text    name=lname_th    สุ่มเล็ก
    Input Text    name=email    chitsutha@kku.ac.th
    Set Selenium Speed    ${DELAY}

Fill Profile Form Empty Lname Th
    Wait Until Element Is Visible    name=title_name_en
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Select From List By Value    name=title_name_en    Miss
    Input Text    name=fname_en    Chitsutha
    Input Text    name=lname_en    Soomlek
    Input Text    name=fname_th    ชิตสุธา
    Input Text    name=lname_th    ${EMPTY}
    Input Text    name=email    chitsutha@kku.ac.th
    Set Selenium Speed    ${DELAY}

Fill Profile Form Invalid Email
    Wait Until Element Is Visible    name=title_name_en
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Select From List By Value    name=title_name_en    Miss
    Input Text    name=fname_en    Chitsutha
    Input Text    name=lname_en    Soomlek
    Input Text    name=fname_th    ชิตสุธา
    Input Text    name=lname_th    สุ่มเล็ก
    Input Text    name=email    invalid.email
    Set Selenium Speed    ${DELAY}

Fill Profile Form Empty Email
    Wait Until Element Is Visible    name=title_name_en
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Select From List By Value    name=title_name_en    Miss
    Input Text    name=fname_en    Chitsutha
    Input Text    name=lname_en    Soomlek
    Input Text    name=fname_th    ชิตสุธา
    Input Text    name=lname_th    สุ่มเล็ก
    Input Text    name=email    ${EMPTY}
    Set Selenium Speed    ${DELAY}

Fill Profile Form No Title
    Wait Until Element Is Visible    name=title_name_en
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Select From List By Value    name=title_name_en    ${EMPTY}
    Input Text    name=fname_en    Chitsutha
    Input Text    name=lname_en    Soomlek
    Input Text    name=fname_th    ชิตสุธา
    Input Text    name=lname_th    สุ่มเล็ก
    Input Text    name=email    chitsutha@kku.ac.th
    Set Selenium Speed    ${DELAY}

Submit Form
    Click Button    xpath=//button[contains(text(),'Update')]
    Set Selenium Speed    ${DELAY}

Verify Update Success
    Wait Until Page Contains    Your account is updated!
    Set Selenium Speed    ${DELAY}

Verify Update Not Success
    ${status}=    Run Keyword And Return Status    Wait Until Element Contains    xpath=/html/body/div[2]/div/div[3]    Your account is updated!    10s
    Run Keyword If    ${status}==True    Fail    "Your account is updated!" appeared in the specified element within 10 seconds, test failed.
    Log    "Text did not appear within 10 seconds, test passed."