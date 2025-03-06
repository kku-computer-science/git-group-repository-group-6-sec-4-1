*** Settings ***
Documentation     A test suite with a single test for valid login.
...
...               This test has a workflow that is created using keywords in
...               the imported resource file.
Resource          res/resource.robot

*** Test Cases ***
TC002
    Open Browser To Login Page
    Input Username    ${VALID USER}
    Input Password    ${VALID PASSWORD}
    Submit Credentials
    Set Selenium Speed    ${DELAY}
    Dashboard Page Should Be Open
    Logout from system
    Login Page Should Be Open
    [Teardown]    Close Browser

TC003
    Open Browser To Login Page
    Input Username    ${Admin USER}
    Input Password    ${Admin PASSWORD}
    Submit Credentials
    Set Selenium Speed    ${DELAY}
    Dashboard Page Should Be Open
    Admin Dashboard Page Should Be Open
    Logout from system
    Login Page Should Be Open
    [Teardown]    Close Browser