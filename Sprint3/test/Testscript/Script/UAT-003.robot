*** Settings ***
Documentation     A test suite with a single test for valid login.
...
...               This test has a workflow that is created using keywords in
...               the imported resource file.
Resource          res/resource.robot

*** Test Cases ***
TC007 Log in as Admin USER and enter the wrong password to save the data to the table.
    Open Browser To login Page
    Input Username    ${Admin USER}
    FOR    ${i}    IN RANGE    11    
        Input Password    ${Wrong PASSWORD}
        Submit Credentials
        Sleep    1s
    END

    Input Password    ${Admin PASSWORD}
    Submit Credentials
    Admin Dashboard Should Be Open

    Wait Until Element Is Visible  xpath=//a[contains(@class, 'btn-outline-info') and contains(., 'ตรวจสอบ')]  5s
    Scroll Element Into View  xpath=//a[contains(@class, 'btn-outline-info') and contains(., 'ตรวจสอบ')]
    Click Element  xpath=//a[contains(@class, 'btn-outline-info') and contains(., 'ตรวจสอบ')]


    Close Browser

    


TC008 Log in as Admin USER and check Most Active User table data
    Open Browser To login Page
    Input Username    ${Admin USER}
    Input Password    ${Admin PASSWORD}
    Submit Credentials
    Admin Dashboard Should Be Open
    Wait Until Page Contains  Most Active User (Top 10)  10s
    Element Should Be Visible  xpath=//table[@class='table table-hover']
    Execute Javascript    var element = document.evaluate("(//table[@class='table table-hover']//tbody/tr[1]//a[contains(text(),'ดู')])[1]", document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue; element.scrollIntoView(true); element.click();
    

    # ตรวจสอบให้แน่ใจว่าข้อมูลกิจกรรมโหลดเสร็จ
    Wait Until Element Is Visible    xpath=//div[contains(@class, 'activity-log-content')] 
    Close Browser



