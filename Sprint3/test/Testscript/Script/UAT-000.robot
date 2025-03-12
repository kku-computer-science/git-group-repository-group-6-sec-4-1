*** Settings ***
Documentation     A test suite with a single test for valid login.
...
...               This test has a workflow that is created using keywords in
...               the imported resource file.
Resource          res/resource.robot

*** Test Cases ***

TC001 Log in as No permission User 
    Open Browser To login Page
    Input Username    ${VALID USER1}
    Input Password    ${VALID PASSWORD}
    Submit Credentials
    Dashboard Page Should Be Open
    Admin Dashboard Should Be Not Open
    Logout from system
    Login Page Should Be Open
    Close Browser

TC002 Log in as Admin User
    Open Browser To login Page
    Input Username    ${Admin USER}
    Input Password    ${Admin PASSWORD}
    Submit Credentials
    Dashboard Page Should Be Open
    Admin Dashboard Should Be Open
    Logout from system
    Login Page Should Be Open
    Close Browser