*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}    http://127.0.0.1:8000/profile
${PROFILE_URL}    http://localhost:8000/profile
${BROWSER}    chrome
${VALID_USERNAME}    chitsutha@kku.ac.th
${VALID_PASSWORD}    123456789
${INVALID_USERNAME}    invalid_username@example.com
${INVALID_PASSWORD}    invalid_password

*** Test Cases ***
Invalid Login Attempt
    [Documentation]    Test logging in with invalid username or password
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Attempt Invalid Login    ${INVALID_USERNAME}    ${VALID_PASSWORD}
    Verify Invalid Login
    Attempt Invalid Login    ${VALID_USERNAME}    ${INVALID_PASSWORD}
    Verify Invalid Login
    Attempt Invalid Login    ${INVALID_USERNAME}    ${INVALID_PASSWORD}
    Verify Invalid Login
    Close Browser

*** Keywords ***
Attempt Invalid Login
    [Arguments]    ${username}    ${password}
    Input Text    name=username    ${username}
    Input Text    name=password    ${password}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    0.3

Verify Invalid Login
    Wait Until Page Contains    Login Failed: Your user ID or password is incorrect

Submit Form
    Click Button    xpath=//button[@type='submit']
