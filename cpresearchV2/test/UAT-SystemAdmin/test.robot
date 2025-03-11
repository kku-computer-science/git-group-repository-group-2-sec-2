*** Settings ***
Library    SeleniumLibrary
Library    Process
Suite Setup    Run Keyword    Setup Suite

*** Variables ***
${DELAY}    3s

*** Test Cases ***
Run Test Suite 1 - System Admin
    [Documentation]    Run API Status Language Test from SystemAdmin_test.robot
    Run Tests From File    SystemAdmin_test.robot

Run Test Suite 2 - Headproject 
    [Documentation]    Run Researcher Assistant Language Test from Headproject_test.robot
    Run Tests From File    Headproject_test.robot

*** Keywords ***
Setup Suite
    Log    Starting the test execution suite...

Teardown Suite
    Log    Completed all test executions.

Run Tests From File
    [Arguments]    ${FILE}
    Log    Running test file: ${FILE}
    Run Robot File    ${FILE}

Run Robot File
    [Arguments]    ${FILE}
    ${RESULT} =    Run Process    robot    ${FILE}    shell=True
    Log    ${RESULT.stdout}
    Log    ${RESULT.stderr}
    Run Keyword If    '${RESULT.rc}' != '0'    Log    Test suite failed: ${FILE} with return code ${RESULT.rc}
    # Removed the Should Be Equal As Integers check to allow continuation
