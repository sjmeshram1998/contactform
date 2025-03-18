
window.onload = function () {
    // Attach listeners for each field to hide error messages on user input
    document.applicationForm.email.addEventListener('input', validateEmail);
    document.applicationForm.date.addEventListener('input', validateDate);
    document.applicationForm.fname.addEventListener('input', validateFname);
    document.applicationForm.mobile_no.addEventListener('input', validateMobileNo);
    document.applicationForm.experience.addEventListener('input', validateExperience);
    document.applicationForm.current_company_name.addEventListener('input', validateCompanyName);
    document.applicationForm.current_salary.addEventListener('input', validateCurrentSalary);
    document.applicationForm.expected_salary.addEventListener('input', validateExpectedSalary);
    document.applicationForm.notice_period.addEventListener('input', validateNoticePeriod);
    document.applicationForm.work_before.addEventListener('input', validateWorkBefore);
    document.getElementsByName('position').forEach(function (radio) {
        radio.addEventListener('change', validatePosition);
    });
    document.getElementById('other_position').addEventListener('input', validatePosition);

    // document.applicationForm.about_opportunity.addEventListener('input',validateAboutOpportunity);


    document.applicationForm.about_opportunity.addEventListener('change', validateAboutOpportunity);
    document.getElementById('other_opportunity').addEventListener('input', validateAboutOpportunity);
    
};

function validateForm() {
    let email = document.applicationForm.email.value;
    let date = document.applicationForm.date.value;
    let fname = document.applicationForm.fname.value;
    let mobile_no = document.applicationForm.mobile_no.value;
    let experience = document.applicationForm.experience.value;
    let current_company_name = document.applicationForm.current_company_name.value;
    let current_salary = document.applicationForm.current_salary.value;
    let expected_salary = document.applicationForm.expected_salary.value;
    let notice_period = document.applicationForm.notice_period.value;
    let positionRadios = document.getElementsByName('position');
    let otherPosition = document.getElementById('other_position').value;
    let work_before = document.applicationForm.work_before.value;
    let about_opportunity = document.applicationForm.about_opportunity.value;
    let isValid = true;

    // Reset all error messages
    resetErrorMessages();

    // Email validation
    if (email === "") {
        document.getElementById('emailError').innerHTML = "Email Must Be Filled Out.";
        isValid = false;
    } else {
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            document.getElementById('emailError').innerHTML = "Please enter a valid email address.";
            isValid = false;
        }
    }

    // Date validation
    if (date === "") {
        document.getElementById('dateError').innerHTML = "Date Must Be Filled Out.";
        isValid = false;
    }

    // Full name validation
    if (fname === "") {
        document.getElementById('fnameError').innerHTML = "Full Name must be filled out";
        isValid = false;
    } else {
        let namePattern = /^[A-Za-z\s]+$/;
        if (!namePattern.test(fname)) {
            document.getElementById('fnameError').innerHTML = "Full Name should only contain alphabets and spaces.";
            isValid = false;
        }
    }

    // Mobile number validation
    if (mobile_no === "") {
        document.getElementById('mobileNoError').innerHTML = "Mobile No Must Be Filled Out";
        isValid = false;
    } else {
        let mobileNoPattern = /^(7|8|9)\d{9}$/;
        if (!mobileNoPattern.test(mobile_no)) {
            document.getElementById('mobileNoError').innerHTML = "Enter Valid Mobile No";
            isValid = false;
        }
    }

    // Experience validation
    if (experience === "") {
        document.getElementById('experienceError').innerHTML = "Enter Valid Experience, Only Numbers";
        isValid = false;
    } else {
        if (isNaN(experience) || experience < 0 || experience > 50) {
            document.getElementById('experienceError').innerHTML = "Experience should be a valid number (0-50).";
            isValid = false;
        }
    }

    // Current/Last company validation
    if (current_company_name === "") {
        document.getElementById('currentCompanyNameError').innerHTML = "Enter Current/Last Company Name";
        isValid = false;
    } else {
        let currentCompanyNamePattern = /^[A-Za-z0-9\s\-\.]+$/;
        if (!currentCompanyNamePattern.test(current_company_name)) {
            document.getElementById('currentCompanyNameError').innerHTML = "Enter Valid Company Name";
            isValid = false;
        }
    }

    // Current salary validation
    if (current_salary === "") {
        document.getElementById('currentSalaryError').innerHTML = "Current Salary must be filled out";
        isValid = false;
    } else {
        let currentSalaryPattern = /^\d{1,10}$/;
        if (!currentSalaryPattern.test(current_salary)) {
            document.getElementById('currentSalaryError').innerHTML = "Enter Valid Salary Includes Only Numbers";
            isValid = false;
        }
    }

    // Expected salary validation
    if (expected_salary === "") {
        document.getElementById('expectedSalaryError').innerHTML = "Expected Salary Must Be Filled Out";
        isValid = false;
    } else {
        let expectedSalaryPattern = /^\d{1,10}$/;
        if (!expectedSalaryPattern.test(expected_salary)) {
            document.getElementById('expectedSalaryError').innerHTML = "Enter Valid Salary Includes Only Numbers";
            isValid = false;
        }
    }

    // Notice period validation
    if (notice_period === "") {
        document.getElementById('noticePeriodError').innerHTML = "Notice Period Must Be Filled Out";
        isValid = false;
    }

    // Role selection validation
    let positionError = document.getElementById('positionError');
    positionError.innerHTML = "";
    let positionSelected = false;
    for (let i = 0; i < positionRadios.length; i++) {
        if (positionRadios[i].checked) {
            positionSelected = true;
            break;
        }
    }

    if (document.getElementById('other').checked) {
        if (otherPosition.trim() === "") {
            positionError.innerHTML = "Please specify the role if 'Other' is selected.";
            isValid = false;
        }
    } else {
        if (!positionSelected) {
            positionError.innerHTML = "Please Select a role";
            isValid = false;
        }
    }

    // Work Before validation
    if (work_before === "") {
        document.getElementById('workBeforeError').innerHTML = "Please Select a role";
        isValid = false;
    }

    // About Opportunity section starts
    if(!validateAboutOpportunity()){
      
        isValid = false;
    }

    return isValid;

}

// Helper functions to reset error messages starts
function resetErrorMessages() {
    document.getElementById('emailError').innerHTML = "";
    document.getElementById('dateError').innerHTML = "";
    document.getElementById('fnameError').innerHTML = "";
    document.getElementById('mobileNoError').innerHTML = "";
    document.getElementById('experienceError').innerHTML = "";
    document.getElementById('currentCompanyNameError').innerHTML = "";
    document.getElementById('currentSalaryError').innerHTML = "";
    document.getElementById('expectedSalaryError').innerHTML = "";
    document.getElementById('noticePeriodError').innerHTML = "";
    document.getElementById('workBeforeError').innerHTML = "";
    document.getElementById('positionError').innerHTML = "";
    document.getElementById('aboutOpportunityError').innerHTML = "";
}
// Helper functions to reset error messages ends

// Validation functions for each input field
function validateEmail() {
    let email = document.applicationForm.email.value;
    let emailError = document.getElementById('emailError');
    emailError.innerHTML = "";
    if (email !== "") {
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            emailError.innerHTML = "Please enter a valid email address.";
        }
    }
}

function validateDate() {
    let date = document.applicationForm.date.value;
    let dateError = document.getElementById('dateError');
    dateError.innerHTML = "";
    if (date === "") {
        dateError.innerHTML = "Date Must Be Filled Out.";
    }
}

function validateFname() {
    let fname = document.applicationForm.fname.value;
    let fnameError = document.getElementById('fnameError');
    fnameError.innerHTML = "";
    if (fname === "") {
        fnameError.innerHTML = "Full Name must be filled out";
    } else {
        let namePattern = /^[A-Za-z\s]+$/;
        if (!namePattern.test(fname)) {
            fnameError.innerHTML = "Full Name should only contain alphabets and spaces.";
        }
    }
}

function validateMobileNo() {
    let mobile_no = document.applicationForm.mobile_no.value;
    let mobileNoError = document.getElementById('mobileNoError');
    mobileNoError.innerHTML = "";
    if (mobile_no !== "") {
        let mobileNoPattern = /^(7|8|9)\d{9}$/;
        if (!mobileNoPattern.test(mobile_no)) {
            mobileNoError.innerHTML = "Enter Valid Mobile No";
        }
    }
}

function validateExperience() {
    let experience = document.applicationForm.experience.value;
    let experienceError = document.getElementById('experienceError');
    experienceError.innerHTML = "";
    if (experience !== "") {
        if (isNaN(experience) || experience < 0 || experience > 50) {
            experienceError.innerHTML = "Experience should be a valid number (0-50).";
        }
    }
}

function validateCompanyName() {
    let current_company_name = document.applicationForm.current_company_name.value;
    let companyNameError = document.getElementById('currentCompanyNameError');
    companyNameError.innerHTML = "";
    if (current_company_name !== "") {
        let currentCompanyNamePattern = /^[A-Za-z0-9\s\-\.]+$/;
        if (!currentCompanyNamePattern.test(current_company_name)) {
            companyNameError.innerHTML = "Enter Valid Company Name";
        }
    }
}

function validateCurrentSalary() {
    let current_salary = document.applicationForm.current_salary.value;
    let currentSalaryError = document.getElementById('currentSalaryError');
    currentSalaryError.innerHTML = "";
    if (current_salary !== "") {
        let currentSalaryPattern = /^\d{1,10}$/;
        if (!currentSalaryPattern.test(current_salary)) {
            currentSalaryError.innerHTML = "Enter Valid Salary Includes Only Numbers";
        }
    }
}

function validateExpectedSalary() {
    let expected_salary = document.applicationForm.expected_salary.value;
    let expectedSalaryError = document.getElementById('expectedSalaryError');
    expectedSalaryError.innerHTML = "";
    if (expected_salary !== "") {
        let expectedSalaryPattern = /^\d{1,10}$/;
        if (!expectedSalaryPattern.test(expected_salary)) {
            expectedSalaryError.innerHTML = "Enter Valid Salary Includes Only Numbers";
        }
    }
}

function validateNoticePeriod() {
    let notice_period = document.applicationForm.notice_period.value;
    let noticePeriodError = document.getElementById('noticePeriodError');
    noticePeriodError.innerHTML = "";
    if (notice_period === "") {
        noticePeriodError.innerHTML = "Notice Period Must Be Filled Out";
    }
}

function validateWorkBefore() {
    let work_before = document.applicationForm.work_before.value;
    let workBeforeError = document.getElementById('workBeforeError');
    workBeforeError.innerHTML = "";
    if (work_before === "") {
        workBeforeError.innerHTML = "Please Select a role";
    }
}

// validate position starts
function validatePosition() {
    let positionRadios = document.getElementsByName('position');
    let positionError = document.getElementById('positionError');
    positionError.innerHTML = "";
    let positionSelected = false;
    for (let i = 0; i < positionRadios.length; i++) {
        if (positionRadios[i].checked) {
            positionSelected = true;
            break;
        }
    }

    if (document.getElementById('other').checked) {
        let otherPosition = document.getElementById('other_position').value;
        if (otherPosition.trim() === "") {
            positionError.innerHTML = "Please specify the role if 'Other' is selected.";
        }
    } else {
        if (!positionSelected) {
            positionError.innerHTML = "Please Select a role";
        }
    }
}

// validate position ends

// Validate opportunity starts

function validateAboutOpportunity(){
    let about_opportunity =  document.applicationForm.about_opportunity.value;
    let other_opportunity = document.getElementById('other_opportunity').value;
    let aboutOpportunityError = document.getElementById('aboutOpportunityError');
    aboutOpportunityError.innerHTML = "";

    
        if(about_opportunity === ""){
            aboutOpportunityError.innerHTML = "Please Select";
          return false;
        }
        else if(about_opportunity === "Other" && other_opportunity === ""){
            aboutOpportunityError.innerHTML = "Please specify the opportunity";
            return false;
        }
        
        return true;

}   
// Validate opportunity ends


// Other field for Opportunity starts


function showOtherField(){
    let opportunitySelectedValue = document.getElementById('about_opportunity').value;
    let otherOpportunityValue =  document.getElementById('about_opportunity_other');
    let aboutOpportunityError = document.getElementById('aboutOpportunityError');
        aboutOpportunityError.innerHTML = "";
    if(opportunitySelectedValue === "Other"){
        otherOpportunityValue.style.display = 'block';
    }
    else{
        otherOpportunityValue.style.display = 'none';
    }
}

// Other field for Opportunity ends


// ALERT MESSAGES STARS
window.onload = function(){
    var formMessage = document.getElementById("message-container");
    var fileMessage = document.getElementById("fileMessage");
    var emailErrorMessage = document.getElementById("email-message-container");
    var flashMessage = document.getElementById('flashMessage');
    let deleteAllMessage = document.getElementById('deleteAllMsg');
    var authenticationMessage = document.getElementById('authenticationMessage');

    if(formMessage !== null){
        formMessage.style.display = 'block';
        setTimeout(function(){
            formMessage.style.display = 'none';
        }, 5000);

    }
    if(fileMessage !== null){
        fileMessage.style.display = 'block';
        setTimeout(function(){
            fileMessage.style.display = 'none';
        },5000)
    }




    if(emailErrorMessage !== null){
        emailErrorMessage.style.display = 'block';
        setTimeout(function(){
            emailErrorMessage.style.display =  'none';
        },5000)
    }

    if(flashMessage !== null){
        setTimeout(function(){
            flashMessage.style.display = 'none';
        },5000)
    }


    if (deleteAllMessage !== null) {
        setTimeout(function() {
            deleteAllMessage.style.display = 'none';
        }, 3000); // Hide the message after 3 seconds
    }

    if(authenticationMessage !== null){
        setTimeout(function(){
            authenticationMessage.style.display = 'none';
        },3000)
    }

}
// ALERT MESSAGES ENDS


