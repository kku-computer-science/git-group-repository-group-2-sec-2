*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         http://127.0.0.1:8000/login
${BROWSER}     chrome
${USERNAME}    chitsutha@kku.ac.th
${PASSWORD}    123456789
${USERNAME_ADMIN}    admin@gmail.com
${PASSWORD_ADMIN}    12345678
${DELAY}       0.2
${TIMEOUT}     10s

*** Test Cases ***
Call Paper
    [Documentation]    Test Call Paper
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window
    Login As User
    Go To Published Research Tab
    Click Call Paper
    Wait For Paper
    Logout
    Login As Admin
    Go To Research API
    Close Browser

*** Keywords ***
Login As User
    Wait Until Element Is Visible    name=username    timeout=${TIMEOUT}
    Input Text    name=username    ${USERNAME}
    Input Text    name=password    ${PASSWORD}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}

Go To Published Research Tab
    Wait Until Element Is Visible    xpath=//*[@id="sidebar"]/ul/li[8]/a    timeout=${TIMEOUT}
    Click Element    xpath=//*[@id="sidebar"]/ul/li[8]/a
    Wait Until Element Is Visible    xpath=//*[@id="ManagePublications"]/ul/li[1]    timeout=${TIMEOUT}
    Click Element    xpath=//*[@id="ManagePublications"]/ul/li[1]
    Set Selenium Speed    ${DELAY}

Click Call Paper
    Wait Until Element Is Visible    xpath=/html/body/div/div/div/div/div/div/div/a[2]    timeout=${TIMEOUT}
    Click Element    xpath=/html/body/div/div/div/div/div/div/div/a[2]
    Set Selenium Speed    ${DELAY}

Wait For Paper
    Sleep    15s

Logout
    Wait Until Element Is Visible    xpath=/html/body/div/nav/div[2]/ul[2]/li[3]/a    timeout=${TIMEOUT}
    Click Element    xpath=/html/body/div/nav/div[2]/ul[2]/li[3]/a
    Set Selenium Speed    ${DELAY}

Login As Admin
    Wait Until Element Is Visible    name=username    timeout=${TIMEOUT}
    Input Text    name=username    ${USERNAME_ADMIN}
    Input Text    name=password    ${PASSWORD_ADMIN}
    Click Button    xpath=//button[@type='submit']
    Set Selenium Speed    ${DELAY}

Go To Research API
    Wait Until Element Is Visible    xpath=//*[@id="sidebar"]/ul/li[17]/a    timeout=${TIMEOUT}
    Click Element    xpath=//*[@id="sidebar"]/ul/li[17]/a
    Sleep    5s
    Set Selenium Speed    ${DELAY}