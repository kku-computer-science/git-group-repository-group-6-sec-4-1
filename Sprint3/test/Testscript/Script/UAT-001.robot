*** Settings ***
Documentation     A test suite with a single test for valid login.
...
...               This test has a workflow that is created using keywords in
...               the imported resource file.
Resource          res/resource.robot


*** Test Cases ***
TC003 Log in as VALID USER1 To Store Data Into Log File
    Open Browser To login Page
    Input Username    ${VALID USER1}
    Input Password    ${VALID PASSWORD}
    Submit Credentials
    Dashboard Page Should Be Open
    Logout from system
    Login Page Should Be Open
    Close Browser

TC004 Log in as VALID USER2 To Store Data Into Log File
    Open Browser To login Page
    Input Username    ${VALID USER2}
    Input Password    ${VALID PASSWORD}
    Submit Credentials
    Dashboard Page Should Be Open
    Logout from system
    Login Page Should Be Open
    Close Browser

TC005 Log in as Admin User To Verify Log File
    Open Browser To login Page
    Input Username    ${Admin USER}
    Input Password    ${Admin PASSWORD}
    Submit Credentials

    Admin Dashboard Should Be Open
    ${table_headers}=    Get Most Active Table Headers    
    ${table_data}=    Get Most Active Table Rows  # Assume this returns data like ['1', 'admin@gmail.com', '8', '2', 'ngamnij@kku.ac.th', '7', '3', 'chakso@kku.ac.th', '2']

    # Split the data into rows manually
    ${row_1}=    Create List    ${table_data}[0]    ${table_data}[1]    ${table_data}[2]
    ${row_2}=    Create List    ${table_data}[3]    ${table_data}[4]    ${table_data}[5]
    ${row_3}=    Create List    ${table_data}[6]    ${table_data}[7]    ${table_data}[8]

    # Check if the rows match the expected values
    Lists Should Be Equal    ${row_1}    ${EXPECTED_ROW_1}
    Lists Should Be Equal    ${row_2}    ${EXPECTED_ROW_2}
    Lists Should Be Equal    ${row_3}    ${EXPECTED_ROW_3}

    Logout from system
    Login Page Should Be Open
    Close Browser