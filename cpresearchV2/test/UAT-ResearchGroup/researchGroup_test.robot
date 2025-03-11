*** Settings ***
Library    SeleniumLibrary

*** Variables ***
# Server
${SERVER}       soften2sec267.cpkkuhost.com
# ${SERVER}       127.0.0.1:8000
${EXPECTED_URL}  http://${SERVER}/researchgroup
${BROWSER}     firefox

# Language Buttons
${LANG_MENU}   //a[@id='navbarDropdownMenuLink']
${LANG_EN}     //a[normalize-space()='English']
${LANG_TH}     //a[normalize-space()='ไทย']
${LANG_CN}     //a[normalize-space()='中文']

# ELEMENTS FOR CHECKING RESEARCH GROUP 
${RESEARCH_GROUP_EN}    //div[contains(@class,'container')]//p[normalize-space()='Research Group']
${RESEARCH_GROUP_TH}    //div[contains(@class,'container')]//p[normalize-space()='กลุ่มวิจัย']
${RESEARCH_GROUP_CN}    //div[contains(@class,'container')]//p[normalize-space()='研究小組']

# Lab Supervisor
${LAB_SUPERVISOR_EN}    //h2[contains(text(),'Laboratory Supervisor')]
${LAB_SUPERVISOR_TH}    //h2[contains(text(),'ผู้ควบคุมห้องปฏิบัติการ')]
${LAB_SUPERVISOR_CN}    //h2[contains(text(),'实验室主管')]

# Elements for Checking Advanced GIS Technology (AGT) card 1
${CARD_ONE}     (//div[contains(@class,'card mb-4')])[1]

# Title in each language
${AGT_NAME_EN}    //h5[contains(text(),'Advanced GIS Technology (AGT)')]
${AGT_NAME_TH}    //h5[contains(text(),'เทคโนโลยี GIS ขั้นสูง (AGT)')]
${AGT_NAME_CN}    //h5[contains(text(),'Advanced GIS Technology (AGT)')]

# Researchers
${AGT_RESHEARCHER_PIPAT_EN}        ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'Asst. Prof. Dr. Pipat Reungsang')]
${AGT_RESHEARCHER_PIPAT_TH}        ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'ผศ.ดร. พิพัธน์ เรืองแสง')]
${AGT_RESHEARCHER_PIPAT_CN}        ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'助理教授 博士 Pipat Reungsang')]

${AGT_RESHEARCHER_CHAIYAPORN_EN}   ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'Assoc. Prof. Dr. Chaiyapon Keeratikasikorn')]
${AGT_RESHEARCHER_CHAIYAPORN_TH}   ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'รศ.ดร. ชัยพล กีรติกสิกร')]
${AGT_RESHEARCHER_CHAIYAPORN_CN}   ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'副教授 博士 Chaiyapon Keeratikasikorn')]

${AGT_RESHEARCHER_NAGON_EN}        ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'Asst. Prof. Dr. Nagon Watanakij')]
${AGT_RESHEARCHER_NAGON_TH}        ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'ผศ.ดร. ณกร วัฒนกิจ')]
${AGT_RESHEARCHER_NAGON_CN}        ${CARD_ONE}//h2[contains(@class,'card-text-2') and contains(string(.),'助理教授 博士 Nagon Watanakij')]

# Description
${AGT_DESC_EN}    To conduct research and provide academic services in the fields of Internet, GIS, Health GIS, and Hydrologic modeling with GIS.
${AGT_DESC_TH}    เพื่อดำเนินการวิจัยและให้บริการวิชาการในสาขาอินเทอร์เน็ต GIS สุขภาพ GIS และแบบจำลองทางอุทกวิทยาด้วย GIS
${AGT_DESC_CN}    在Internet，GIS，Health GIS和GIS的水文建模领域进行研究并提供学术服务。

# More Details Button
${MORE_DETAILS_BTN_EN}    (//div[contains(@class,'btn btn-primary') and contains(string(.),'More details')])
${MORE_DETAILS_BTN_TH}    (//div[contains(@class,'btn btn-primary') and contains(string(.),'รายละเอียดเพิ่มเติม')])
${MORE_DETAILS_BTN_CN}    (//div[contains(@class,'btn btn-primary') and contains(string(.),'详细信息')])


*** Keywords ***
Navigate To Research Group Page
    Open Browser    ${EXPECTED_URL}    ${BROWSER}
    Maximize Browser Window
    Sleep    3s
    Wait Until Page Contains Element    ${AGT_NAME_EN}    timeout=15s
    Capture Page Screenshot    researchgroup_initial.png

Change Language
    [Arguments]    ${language}
    Click Element    ${LANG_MENU}
    Sleep    0.5s
    Run Keyword If    '${language}' == 'TH'    Click Element    ${LANG_TH}
    Run Keyword If    '${language}' == 'EN'    Click Element    ${LANG_EN}
    Run Keyword If    '${language}' == 'CN'    Click Element    ${LANG_CN}
    Sleep    1s
    Capture Page Screenshot    after_change_language_${language}.png

Check Research Group Page
    [Arguments]    ${language}    ${research_group}    ${lab_supervisor}    ${agt_name}    ${researcher1}    ${researcher2}    ${researcher3}    ${description}    ${more_detail}
    Change Language    ${language}
    Sleep    2s
    Wait Until Page Contains Element    ${research_group}    timeout=20s
    Wait Until Page Contains Element    ${lab_supervisor}    timeout=15s
    Wait Until Page Contains Element    ${agt_name}    timeout=15s
    Wait Until Page Contains Element    ${researcher1}    timeout=15s
    Wait Until Page Contains Element    ${researcher2}    timeout=15s
    Wait Until Page Contains Element    ${researcher3}    timeout=15s
    Wait Until Page Contains    ${description}    timeout=15s
    Capture Page Screenshot    researchgroup_${language}.png


*** Test Cases ***
Test Research Group in Thai
    Navigate To Research Group Page
    Check Research Group Page    TH    ${RESEARCH_GROUP_TH}    ${LAB_SUPERVISOR_TH}    ${AGT_NAME_TH}    ${AGT_RESHEARCHER_PIPAT_TH}    ${AGT_RESHEARCHER_CHAIYAPORN_TH}    ${AGT_RESHEARCHER_NAGON_TH}    ${AGT_DESC_TH}    ${MORE_DETAILS_BTN_TH}

Test Research Group in English
    Check Research Group Page    EN    ${RESEARCH_GROUP_EN}    ${LAB_SUPERVISOR_EN}    ${AGT_NAME_EN}    ${AGT_RESHEARCHER_PIPAT_EN}    ${AGT_RESHEARCHER_CHAIYAPORN_EN}    ${AGT_RESHEARCHER_NAGON_EN}    ${AGT_DESC_EN}    ${MORE_DETAILS_BTN_EN}

Test Research Group in Chinese
    Check Research Group Page    CN    ${RESEARCH_GROUP_CN}    ${LAB_SUPERVISOR_CN}    ${AGT_NAME_CN}    ${AGT_RESHEARCHER_PIPAT_CN}    ${AGT_RESHEARCHER_CHAIYAPORN_CN}    ${AGT_RESHEARCHER_NAGON_CN}    ${AGT_DESC_CN}    ${MORE_DETAILS_BTN_CN}

    Close Browser
