*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}    http://127.0.0.1:8000/profile
${BROWSER}    chrome
${USERNAME}    chitsutha@kku.ac.th
${PASSWORD}    123456789
${EMPTY}
${DELAY}    0.2

*** Test Cases ***
Update Profile Information
    [Documentation]    Test updating profile information
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Profile Page
    Activate Account Tab
    Fill Profile Form
    Submit Form
    Verify Update Success
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
    Select From List By Value    name=title_name_en    Miss
    Input Text    name=fname_en    Chitsutha
    Input Text    name=lname_en    Soomlek
    Input Text    name=fname_th    ชิตสุธา
    Input Text    name=lname_th    สุ่มเล็ก
    Input Text    name=email    chitsutha@kku.ac.th
    Select From List By Value    name=academic_ranks_en    Associate Professor
    Select From List By Value    name=academic_ranks_th    รองศาสตราจารย์
    Set Selenium Speed    ${DELAY}

Submit Form
    Click Button    xpath=//button[contains(text(),'Update')]
    Set Selenium Speed    ${DELAY}

Verify Update Success
     Wait Until Page Contains    Your account is updated!
    Set Selenium Speed    ${DELAY}