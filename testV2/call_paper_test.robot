*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}         http://127.0.0.1:8000/login
${BROWSER}     chrome
${USERNAME}    chitsutha@kku.ac.th
${PASSWORD}    123456789
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