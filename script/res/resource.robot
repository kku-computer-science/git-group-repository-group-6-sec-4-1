*** Settings ***
Documentation     A resource file with reusable keywords and variables.
...
Library          SeleniumLibrary
Library          BuiltIn
Library          DateTime

*** Variables ***
${SERVER}         https://csrdms6s468.cpkkuhost.com
${CHROME_BROWSER_PATH}    ${EXECDIR}${/}Chrome${/}chrome.exe
${CHROME_DRIVER_PATH}    ${EXECDIR}${/}Chrome${/}chromedriver.exe
${DELAY}          0

${VALID USER}     ngamnij@kku.ac.th
${VALID PASSWORD}    123456789

${Admin USER}     admin@gmail.com
${Admin PASSWORD}    12345678

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
    Title Should Be    Dashboard

Dashboard Page Should Be Not Open
    Title Should Be    Login

Admin Dashboard Page Should Be Open
    Title Should Be    Dashboard
    Wait Until Element Is Visible    //a[@href="https://csrdms6s468.cpkkuhost.com/logs"]

Submit Credentials
    Click Button    Log In

Submit Fail
    Click Button    Log In
    Title Should Be    Login
Logout from system
    Wait Until Element Is Visible    //a[@href="https://csrdms6s468.cpkkuhost.com/logout"]    10s    Logout link not found
    Click Element    //a[@href="https://csrdms6s468.cpkkuhost.com/logout"]

Input Username
    [Arguments]    ${username}
    Input Text    username    ${username}

Input Password
    [Arguments]    ${password}
    Input Text    password    ${password}

Verify Recent User Activity Logs
    ${current_time}=    Get Current Date    result_format=datetime
    ${five_minutes_ago}=    Subtract Time From Date    ${current_time}    5 minutes    datetime
    ${table}=    Get WebElements    css:div.card:nth-child(3) table    # Adjust locator to target the third card (User Activity Logs table)
    ${rows}=    Get WebElements    css:div.card:nth-child(3) table tbody tr    # Adjust locator to target table rows in the user activity table

    ${expected_email}=    Set Variable    ngamnij@kku.ac.th
    ${expected_action}=    Set Variable    login

    ${found}=    Set Variable    ${False}
    FOR    ${row}    IN    @{rows}
        ${cells}=    Get WebElements    ${row} css:td    # Adjust locator to target table cells
        ${email}=    Get Text    ${cells}[0]    # Email is in the first column
        ${action}=    Get Text    ${cells}[1]    # Action is in the second column

        # Fetch timestamp from the log (assuming we need to query or simulate it from the controller data)
        ${timestamp}=    Get Text    ${cells}[0]    # If timestamp is not visible, we might need to adjust logic or use API data
        ${log_time}=    Convert Date    ${timestamp}    datetime    %Y-%m-%d %H:%M:%S

        Run Keyword If    '${log_time}' >= '${five_minutes_ago}'    Log    Checking log from ${timestamp}

        IF    '${email}' == '${expected_email}' and '${action}' == '${expected_action}' and '${log_time}' >= '${five_minutes_ago}'
            Set Test Variable    ${found}    ${True}
            Exit For Loop
        END
    END

    Should Be True    ${found}    Expected user activity log for Email '${expected_email}' and Action '${expected_action}' in the last 5 minutes not found.

Fill Paper Form With Ngamnij
    # Select publication sources (e.g., Scopus and TCI, related to Ngamnij's research)
    Select From List By Value    css:select[name="cat[]"]    1    # Select "Scopus"
    Select From List By Value    css:select[name="cat[]"]    3    # Select "TCI"

    # Fill paper name
    Input Text    name=paper_name    Research on Renewable Energy by Ngamnij

    # Fill abstract
    Input Text    name=abstract    This research explores renewable energy solutions developed by Ngamnij Arch-int and team.

    # Fill keyword (semicolon-separated with a space)
    Input Text    name=keyword    renewable energy; sustainable development; Ngamnij research

    # Select paper type
    Select From List By Value    name=paper_type    Journal

    # Select paper subtype
    Select From List By Value    name=paper_subtype    Article

    # Select publication
    Select From List By Value    name=publication    International Journal

    # Fill source title
    Input Text    name=paper_sourcetitle    Journal of Renewable Energy Studies

    # Fill publication year
    Input Text    name=paper_yearpub    2025

    # Fill volume
    Input Text    name=paper_volume    15

    # Fill issue
    Input Text    name=paper_issue    2

    # Fill citation
    Input Text    name=paper_citation    50

    # Fill page
    Input Text    name=paper_page    1-15

    # Fill DOI
    Input Text    name=paper_doi    10.1234/renewable-energy-ngamnij

    # Fill funder
    Input Text    name=paper_funder    1000000    # Assuming an integer for funding amount

    # Fill URL
    Input Text    name=paper_url    https://www.research.ngamnij.com

    # Fill internal author (select "งามนิจ อาจอินทร์" or relevant name)
    Select From List By Value    css:select[name="moreFields[0][userid]"]    2    # Select "งามนิจ อาจอินทร์" (value=2 from your dropdown)
    Select From List By Value    css:select[name="pos[]"]    1    # Select "First Author" for internal author

    # Add external author (if needed, you can add dynamically, but for simplicity, we’ll fill one)
    Input Text    css:input[name="fname[]"]    John
    Input Text    css:input[name="lname[]"]    Doe
    Select From List By Value    css:select[name="pos2[]"]    2    # Select "Co-Author" for external author

    # Optionally add more authors dynamically (if the "+" button exists)
    # Click Button    css:button#add-btn2    # Uncomment and adjust if you want to add more internal authors
    # Click Button    css:button#add    # Uncomment and adjust if you want to add more external authors

Verify Submission Success
    Wait Until Page Contains    Paper submitted successfully    timeout=10s    # Adjust success message based on your app
    Location Should Be    http://127.0.0.1:8000/papers    # Adjust URL based on redirect after submission

Submit Paper Form
    Click Button    css:button[name="submit"]