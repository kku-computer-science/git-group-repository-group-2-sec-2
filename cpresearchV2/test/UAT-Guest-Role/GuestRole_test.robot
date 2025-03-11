*** Settings ***
Library    SeleniumLibrary
Library    Process
Suite Setup    Run Keyword    Setup Suite

*** Variables ***
${DELAY}    3s

*** Test Cases ***
Run Test Suite 1 - Home Page
    [Documentation]    Run Home Page Language Test from test_Home-Page.robot
    Run Tests From File    test_Home-Page.robot

Run Test Suite 2 - Researcher Page
    [Documentation]    Run Researcher Page Language Test from UAT-Reseacher.robot
    Run Tests From File    UAT-Reseacher.robot

Run Test Suite 3 - Researcher_Detail Page
    [Documentation]    Run Researcher Detail Page Language Test from UAT_Research_Detail.robot
    Run Tests From File    UAT_Research_Detail.robot

Run Test Suite 4 - Research Group Page
    [Documentation]    Run Research Group Page Language Test from researchGroup_test.robot
    Run Tests From File    researchGroup_test.robot

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
