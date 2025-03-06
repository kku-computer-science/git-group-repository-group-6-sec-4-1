*** Settings ***
Documentation     A test suite with a single test for valid login.
...
...               This test has a workflow that is created using keywords in
...               the imported resource file.
Resource          res/resource.robot
Library    XML

*** Test Cases ***
TC001 Log in as User 
    Open Browser To login Page
    Input Username    ${VALID USER}
    Input Password    ${VALID PASSWORD}
    Submit Credentials
    Dashboard Page Should Be Open
    Logout from system

    Login Page Should Be Open
    Input Username    ${Admin USER}
    Input Password    ${Admin PASSWORD}
    Submit Credentials
    Dashboard Page Should Be Open
    Verify Recent User Activity Logs
    Logout from system
    Login Page Should Be Open

Tc002 Log in as User and add 
    Open Browser To login Page
    Input Username    ${VALID USER}
    Input Password    ${VALID PASSWORD}
    Submit Credentials
    Dashboard Page Should Be Open
    Go to create Paper

    Fill Paper Form With Ngamnij
    Submit Paper Form


    