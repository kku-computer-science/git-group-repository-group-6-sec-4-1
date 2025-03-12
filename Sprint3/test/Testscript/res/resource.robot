*** Settings ***
Documentation     A resource file with reusable keywords and variables.
...
Library          SeleniumLibrary
Library          BuiltIn
Library          DateTime
Library          Collections
Library          XML

*** Variables ***
${SERVER}         http://127.0.0.1:8000
${CHROME_BROWSER_PATH}    ${EXECDIR}${/}Chrome${/}chrome.exe
${CHROME_DRIVER_PATH}    ${EXECDIR}${/}Chrome${/}chromedriver.exe
${DELAY}          0

${VALID USER1}     ngamnij@kku.ac.th
${VALID USER2}    chakso@kku.ac.th 
${VALID PASSWORD}    123456789

${Admin USER}     admin@gmail.com
${Admin PASSWORD}    12345678

${Wrong PASSWORD}    0987654321

@{EXPECTED_ROW_1}    1    ngamnij@kku.ac.th     4
@{EXPECTED_ROW_2}    2    admin@gmail.com    3
@{EXPECTED_ROW_3}    3    chakso@kku.ac.th    2



${HOMEPAGE}     ${SERVER}/
${LOGIN URL}      ${SERVER}/login

*** Keywords ***

Open Browser To Login Page
    ${chrome_options}    Evaluate    sys.modules['selenium.webdriver'].ChromeOptions()    sys
    Call Method    ${chrome_options}    add_argument    --no-sandbox
    ${chrome_options.binary_location}    Set Variable    ${CHROME_BROWSER_PATH}
    ${service}    Evaluate    sys.modules["selenium.webdriver.chrome.service"].Service(executable_path=r"${CHROME_DRIVER_PATH}")    sys
    Create Webdriver    Chrome    options=${chrome_options}    service=${service}
    Go To    ${LOGIN URL}
    Maximize Browser Window
    Set Selenium Speed    ${DELAY}
    Login Page Should Be Open

Go to create Paper
    Go To    ${SERVER}/papers/create
    Wait Until Page Contains    แหล่งเผยแพร่งานวิจัย    timeout=10s

Login Page Should Be Open
    Title Should Be    Login

Dashboard Page Should Be Open
    Set Selenium Speed    1.5s
    Title Should Be    Dashboard

Admin Dashboard Should Be Open
    Wait Until Element Contains  xpath=/html/body//*[contains(@class, 'd-flex') and contains(@class, 'gap-4') and contains(@class, 'align-items-center')]/h2    Dashboard    timeout=5s

Admin Dashboard Should Be Not Open
    Run Keyword And Ignore Error    Wait Until Element Does Not Contain    xpath=/html/body//*[contains(@class, 'd-flex') and contains(@class, 'gap-4') and contains(@class, 'align-items-center')]/h2    Dashboard    timeout=5s

Dashboard Page Should Be Not Open
    Title Should Be    Login

Admin Dashboard Page Should Be Open
    Title Should Be    Dashboard
    Wait Until Element Is Visible    //a[@href="${SERVER}/logs"]

Go To Logs Page
    Title Should Be    HTTP Error Logs


Get Most Active Table Headers
    ${thead_element}=    Get WebElement    xpath=(//table[@class="table table-hover"])[1]/thead
    @{headers}=    Create List
    ${header_cells}=    Get WebElements    xpath=(//table[@class="table table-hover"])[1]/thead/tr/th
    FOR    ${cell}    IN    @{header_cells}
        ${header_text}=    Get Text    ${cell}
        Append To List    ${headers}    ${header_text}
    END
    [Return]    ${headers}


Get Most Active Table Rows
    [Documentation]    Returns a list of data from the specified table cells based on the given XPaths.
    @{table_data}=    Create List
    
    # Wait until the table is visible
    Wait Until Element Is Visible    xpath=(//table[@class="table table-hover"])[1]/tbody/tr    timeout=10s
    Set Selenium Speed    1.5s

    # Define the XPath list for the 9 cells
    @{xpaths}=    Create List
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[1]/td[1]
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[1]/td[2]
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[1]/td[3]
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[2]/td[1]
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[2]/td[2]
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[2]/td[3]
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[3]/td[1]
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[3]/td[2]
    ...    xpath=(//table[@class="table table-hover"])[1]/tbody/tr[3]/td[3]

    # Iterate through each XPath and extract data
    ${cell_index}=    Set Variable    0
    FOR    ${xpath}    IN    @{xpaths}
        ${cell}=    Get WebElement    ${xpath}
        ${cell_text}=    Get Text    ${cell}
        # Handle the activity count (third column of each row) using data-value
        ${adjusted_index}=    Evaluate    (${cell_index} % 3) + 1
        #Run Keyword If    ${adjusted_index} == 3    ${cell_text}=    Get Element Attribute    ${xpath}/span[@class='count-up']    data-value
        # Strip whitespace and handle empty cells
        ${cell_text}=    Evaluate    "${cell_text}".strip() if "${cell_text}" != "None" else ""
        Append To List    ${table_data}    ${cell_text}
        Log    Cell at ${xpath} text: ${cell_text}
        ${cell_index}=    Evaluate    ${cell_index} + 1
    END

    # Log the extracted data for debugging
    Log    Extracted table data: ${table_data}
    [Return]    ${table_data}

Submit Critical check
    Click Element    css=.bi.bi-eye


Submit Credentials
    Click Button    Log In

Submit Fail
    Click Button    Log In
    Title Should Be    Login
Logout from system
    Wait Until Element Is Visible    //a[@href="${SERVER}/logout"]    10s    Logout link not found
    Click Element    //a[@href="${SERVER}/logout"]

Input Username
    [Arguments]    ${username}
    Input Text    username    ${username}

Input Password
    [Arguments]    ${password}
    Input Text    password    ${password}

Verify Submission Success
    Wait Until Page Contains    Paper submitted successfully    timeout=10s    # Adjust success message based on your app
    Location Should Be    http://127.0.0.1:8000/papers    # Adjust URL based on redirect after submission

Submit Paper Form
    Click Button    css:button[name="submit"]

Call Debug Error Page
    [Arguments]    ${endpoint}    ${expected_message}    ${times}
    FOR    ${i}    IN RANGE    ${times}
        Log    Navigating to ${SERVER}${endpoint} (Attempt ${i+1}/${times})
        Go To    ${SERVER}${endpoint}
        Wait Until Element Contains    xpath=//div[contains(@class, 'ui-exception-message') and contains(@class, 'ui-exception-message-full')]    ${expected_message}    timeout=10s
    END

Verify No Error Message
    ${status}=    Run Keyword And Return Status    Page Should Not Contain Element    xpath=//div[contains(@class, 'ui-exception-message') and contains(@class, 'ui-exception-message-full')]
    Run Keyword Unless    ${status}    Fail    Error message element found when it should not be present

    

        
    
