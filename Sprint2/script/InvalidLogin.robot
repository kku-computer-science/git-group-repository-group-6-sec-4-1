*** Settings ***
Documentation     A test suite with a single test for valid login.
...
...               This test has a workflow that is created using keywords in
...               the imported resource file.
Resource          res/resource.robot

*** Test Cases ***

TC004
    Open Browser To Login Page
    Submit Credentials
    Login Page Should Be Open
    Dashboard Page Should Be Not Open
    [Teardown]    Close Browser

TC005
    Open Browser To Login Page
    [Teardown]    Close Browser

TC006
    Open Browser To Login Page
    Submit Fail
    [Teardown]    Close Browser
