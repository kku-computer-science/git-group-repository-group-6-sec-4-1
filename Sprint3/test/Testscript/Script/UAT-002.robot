*** Settings ***
Documentation     A test suite with a single test for valid login.
Resource          res/resource.robot

*** Test Cases ***
TC006 Login in as Admin User and Call Debug Error Paths
    Open Browser To Login Page
    Input Username    ${Admin USER}
    Input Password    ${Admin PASSWORD}
    Submit Credentials
    Admin Dashboard Should Be Open

    Call Debug Error Page    /debug/error/400    Debug: Triggered HTTP 400 error    5    xpath=/html/body/div/div[1]/div/div/div[3]/div/div[1]/div
    Call Debug Error Page    /debug/error/401    Unauthorized    4    xpath=//div[contains(@class, 'text-lg') and contains(text(), 'Unauthorized')]
    Call Debug Error Page    /debug/error/402    Debug: Triggered HTTP 402 error    3    xpath=//div[contains(@class, 'text-lg') and contains(text(), 'Debug: Triggered HTTP 402 error')]
    Call Debug Error Page    /debug/error/403    Debug: Triggered HTTP 403 error    2    xpath=//div[contains(@class, 'text-lg') and contains(text(), 'Debug: Triggered HTTP 403 error')]
    Call Debug Error Page    /debug/error/404    Not Found    2    xpath=//div[contains(@class, 'text-lg') and contains(text(), 'Not Found')]
    Call Debug Error Page    /debug/error/405    Debug: Triggered HTTP 405 error    1    xpath=//div[contains(@class, 'text-lg') and contains(text(), 'Debug: Triggered HTTP 405 error')]

    Go To    ${DASHBOARD}
    Admin Dashboard Should Be Open
    Verify No Error Message
    Verify HTTP Errors Chart    ${EXPECTED_STATUS_CODES}

    Close Browser

*** Variables ***
@{EXPECTED_STATUS_CODES}    400    401    402    403    404    405