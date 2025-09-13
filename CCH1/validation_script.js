// function to display error messages
function printError(elemId, hintMsg) {
    document.getElementById(elemId).textContent = hintMsg;
}

// validate query
function validateQueryForm() {
    
    let first_name = document.getElementById("query_first_name").value.trim();
    let last_name = document.getElementById("query_last_name").value.trim();
    let email = document.getElementById("query_email").value.trim();
    let contact_number = document.getElementById("query_contact_number").value.trim();
    let inquiry = document.getElementById("query_inquiry").value.trim();

    let firstNameErr = emailErr = lastNameErr = contactErr = inquiryErr = true;

    // first name
    if (first_name === "") {
        printError("first_name_err", "Please enter your first name.");
    } else {
        let regex = /^[A-Za-z\s]+$/;
        if (!regex.test(first_name)) {
            printError("first_name_err", "First name can only contain letters.");
        } else {
            printError("first_name_err", "");
            firstNameErr = false;
        }
    }
// name
    if (last_name === "") {
        printError("last_name_err", "Please enter your last name.");
    } else {
        let regex = /^[A-Za-z\s]+$/;
        if (!regex.test(last_name)) {
            printError("last_name_err", "Last name can only contain letters.");
        } else {
            printError("last_name_err", "");
            lastNameErr = false;
        }
    }

    // email
    if (email === "") {
        printError("email_err", "Please enter your email address.");
    } else {
        let regex = /^\S+@\S+\.\S+$/;
        if (!regex.test(email)) {
            printError("email_err", "Please enter a valid email address.");
        } else {
            printError("email_err", "");
            emailErr = false;
        }
    }

    // Validate Contact Number 
    if (contact_number === "") {
        printError("contact_err", "Please enter your contact number.");
    } else {
        let regex = /^\+94\s\d{3}(-?\d{3}){2}$/;
        if (!regex.test(contact_number)) {
            printError("contact_err", "Enter a valid contact number.");
        } else {
            printError("contact_err", "");
            contactErr = false;
        }
    }

    // Validate Inquiry 
    if (inquiry === "") {
        printError("inquiry_err", "Please enter your inquiry.");
    } else {
        printError("inquiry_err", "");
        inquiryErr = false;
    }

    // No submission if there are errors
    if (firstNameErr || lastNameErr || emailErr || contactErr || inquiryErr) {
        return false;
    } else {
        alert("Form submitted successfully!");
        return true;
    }
}

// reset Error Messages
function resetErrors() {
    document.getElementById("firstNameErr").textContent = "";
    document.getElementById("lastNameErr").textContent = "";
    document.getElementById("emailErr").textContent = "";
    document.getElementById("contactErr").textContent = "";
    document.getElementById("inquiryErr").textContent = "";
}

function validateFeedback() {
    let name = document.getElementById("feedbackName").value.trim();
    let email = document.getElementById("feedbackEmail").value.trim();
    let contact = document.getElementById("feedbackContactNumber").value.trim();
    let docName = document.getElementById("docName").value;
    let review = document.getElementById("review").value.trim();
    let suggestions = document.getElementById("suggestions").value.trim();
    

    // Get selected radio buttons
    let feedbackSatisfaction = document.querySelector('input[name="feedbackSatisfaction"]:checked');
    let consultantDoctor = document.querySelector('input[name="consultantDoctor"]:checked');
    let pharmacy = document.querySelector('input[name="pharmacy"]:checked');
    let medsAndCare = document.querySelector('input[name="medsAndCare"]:checked');
    let appointment = document.querySelector('input[name="appointment"]:checked');
    let onlineRegister = document.querySelector('input[name="onlineRegister"]:checked');

    let nameErr = emailErr = contactErr = docErr = reviewErr = suggestionsErr = 
    feedbackSatisfactionErr = consultantDoctorErr = pharmacyErr = medsAndCareErr = 
    appointmentErr = onlineRegisterErr = true;

    // Name validation
    if (name === "" || /\d/.test(name)) {
        printError("feedbackNameErr", "Enter a valid name.");
    } else {
        printError("feedbackNameErr", "");
        nameErr = false;
    }

      // Doctor selection validation
      if (docName === "") {
        printError("docNameErr", "Please select a doctor.");
    } else {
        printError("docNameErr", "");
        docErr = false;
    }

    // Email validation
    let emailRegex = /^\S+@\S+\.\S+$/;
    if (email === "" || !emailRegex.test(email)) {
        printError("feedbackEmailErr", "Enter a valid email.");
    } else {
        printError("feedbackEmailErr", "");
        emailErr = false;
    }

    // Contact number validation (Sri Lankan format)
    let contactRegex = /^\+94\s\d{3}(-?\d{3}){2}$/;
    if (contact === "" || !contactRegex.test(contact)) {
        printError("feedbackContactNumberErr", "Enter a valid Sri Lankan contact number.");
    } else {
        printError("feedbackContactNumberErr", "");
        contactErr = false;
    }

    // Doctor selection validation
    if (docName === "") {
        printError("docNameErr", "Please select a doctor.");
    } else {
        printError("docNameErr", "");
        docErr = false;
    }

    // Review validation
    if (review === "") {
        printError("reviewErr", "Please enter your review.");
    } else {
        printError("reviewErr", "");
        reviewErr = false;
    }

    // Suggestions validation
    if (suggestions === "") {
        printError("suggestionsErr", "Please enter your suggestions.");
    } else {
        printError("suggestionsErr", "");
        suggestionsErr = false;
    }

    // Radio Button Validations
    if (feedbackSatisfaction === null) {
        printError("feedbackSatisfactionErr", "Please select an option for satisfaction.");
    } else {
        printError("feedbackSatisfactionErr", "");
        feedbackSatisfactionErr = false;
    }

    if (consultantDoctor === null) {
        printError("consultantDoctorErr", "Please rate the consultant doctor.");
    } else {
        printError("consultantDoctorErr", "");
        consultantDoctorErr = false;
    }

    if (pharmacy === null) {
        printError("pharmacyErr", "Please rate the pharmacy.");
    } else {
        printError("pharmacyErr", "");
        pharmacyErr = false;
    }

    if (medsAndCare === null) {
        printError("medsAndCareErr", "Please rate the medication & care.");
    } else {
        printError("medsAndCareErr", "");
        medsAndCareErr = false;
    }

    if (appointment === null) {
        printError("appointmentErr", "Please rate the appointment process.");
    } else {
        printError("appointmentErr", "");
        appointmentErr = false;
    }

    if (onlineRegister === null) {
        printError("onlineRegisterErr", "Please rate the online registration process.");
    } else {
        printError("onlineRegisterErr", "");
        onlineRegisterErr = false;
    }

    // Stop form submission if errors exist
    return !(nameErr || emailErr || contactErr || docErr || reviewErr || suggestionsErr || 
              feedbackSatisfactionErr || consultantDoctorErr || pharmacyErr || 
              medsAndCareErr || appointmentErr || onlineRegisterErr);
}

function validateAppointmentForm() {
    // retrieving values from form fields
    let name = document.forms["appointmentForm"]["patient_name"].value.trim();
    let contact = document.forms["appointmentForm"]["patient_contact"].value.trim();
    let email = document.forms["appointmentForm"]["email"].value.trim();
    let doctor = document.forms["appointmentForm"]["doctor_id"].value;
    let date = document.forms["appointmentForm"]["appointment_date"].value;
    let time = document.forms["appointmentForm"]["appointment_time"].value;

    // Defining error variables with default values
    let nameErr = contactErr = emailErr = doctorErr = dateErr = timeErr = false;

    // Validate Name
    if (name === "") {
        printError("name_err", "Please enter your name");
        nameErr = true;
    } else {
        let regex = /^[a-zA-Z\s]+$/;
        if (!regex.test(name)) {
            printError("name_err", "Please enter a valid name");
            nameErr = true;
        } else {
            printError("name_err", "");
        }
    }

    //  contact num
    if (contact === "") {
        printError("contact_err", "Please enter your contact number");
        contactErr = true;
    } else {
        let regex = /^\+94\s\d{3}(-?\d{3}){2}$/;
        if (!regex.test(contact)) {
            printError("contact_err", "Please enter a valid Sri Lankan mobile number");
            contactErr = true;
        } else {
            printError("contact_err", "");
        }
    }

    // email address
    if (email === "") {
        printError("email_err", "Please enter your email address");
        emailErr = true;
    } else {
        let regex = /^\S+@\S+\.\S+$/;
        if (!regex.test(email)) {
            printError("email_err", "Please enter a valid email address");
            emailErr = true;
        } else {
            printError("email_err", "");
        }
    }

    // ddoctor needs to be selected
    if (doctor === "Select") {
        printError("doctor_err", "Please select a doctor");
        doctorErr = true;
    } else {
        printError("doctor_err", "");
    }

    //appointment date cant be in past
    if (date === "") {
        printError("date_err", "Please select an appointment date");
        dateErr = true;
    } else {
        let today = new Date().toISOString().split("T")[0];  // takes today's date, splits it then compares
        if (date < today) {
            printError("date_err", "The date cannot be in the past.");
            dateErr = true;
        } else {
            printError("date_err", "");
        }
    }

    //  time
    if (time === "select") {
        printError("time_err", "Please select a time slot");
        timeErr = true;
    } else {
        printError("time_err", "");
    }

    // stop form submission if there are errors
    if (nameErr || contactErr || emailErr || doctorErr || dateErr || timeErr) {
        return false; 
    }

    return true; // Allow form submission
}

function validateRegForm() {
    let name = document.forms["registerForm"]["patient_name"].value.trim();
    let contact = document.forms["registerForm"]["patient_contact"].value.trim();
    let email = document.forms["registerForm"]["patient_email"].value.trim();
    let test = document.forms["registerForm"]["test_id"].value.trim();
    let registrationDate = document.forms["registerForm"]["registration_date"].value;

    let nameErr = false;
    let contactErr = false;
    let emailErr = false;
    let dateErr = false;
    let testErr = false;


if (name === "") {
    printError("name_err", "Please enter your name");
    nameErr = true;
} else {
    let regex = /^[a-zA-Z\s]+$/;
    if (!regex.test(name)) {
        printError("name_err", "Please enter a valid name");
        nameErr = true;
    } else {
        printError("name_err", "");
    }
}

    if (contact === "") {
        printError("contact_err", "Please enter your contact number");
        contactErr = true;
    } else {
        let regex = /^\+94\s\d{3}(-?\d{3}){2}$/;
        if (!regex.test(contact)) {
            printError("contact_err", "Please enter a valid Sri Lankan mobile number");
            contactErr = true;
        } else {
            printError("contact_err", "");
        }
    }

    if (email === "") {
        printError("email_err", "Please enter your email address");
        emailErr = true;
    } else {
        let regex = /^\S+@\S+\.\S+$/;
        if (!regex.test(email)) {
            printError("email_err", "Please enter a valid email address");
            emailErr = true;
        } else {
            printError("email_err", "");
        }
    }

    if (test === "Select") {
        printError("test_err", "Please select a test");
        testErr = true;
    } else {
        printError("test_err", "");
    }

    if (registrationDate === "") {
        printError("date_err", "Please select a registration date");
        dateErr = true;
    } else {
        let today = new Date().toISOString().split("T")[0];
        if (registrationDate < today) {
            printError("date_err", "Date cannot be in the past");
            dateErr = true;
        } else {
            printError("date_err", "");
        }
    }

    if (nameErr || contactErr || emailErr || dateErr) {
        return false; // prevent form submission
    }

    return true; // allow form submission
}

function validatePaymentForm() {
    // Clear previous error messages
    printError("registration_err", "");
    printError("amount_err", "");
    printError("card_type_err", "");

    // Get values from the form
    const registrationId = document.forms["paymentForm"]["registration_id"].value.trim();
    const amount = document.forms["paymentForm"]["amount"].value.trim();
    const cardType = document.querySelector('input[name="card_type"]:checked');

    let hasError = false;
    let cardError = false;

    // Validate Registration ID
    if (registrationId === "") {
        printError("registration_err", "Registration ID is required.");
        hasError = true;
    }

    // Validate Amount
    if (amount === "") {
        printError("amount_err", "Amount is required.");
        hasError = true;
    }

    // Validate Card Type Selection
    if (!cardType) {
        printError("card_type_err", "Please select a payment method.");
        cardError = true;
    }

    if (hasError || cardError) {
        return false; // no form submission
    }

    return true; // allow form submission
}

function validateCreateUserForm() {
    let user = document.forms["createUserAccountForm"]["user"].value.trim();
    let password = document.forms["createUserAccountForm"]["password"].value.trim();
    let confirmPassword = document.forms["createUserAccountForm"]["confirm_password"].value.trim();
    let email = document.forms["createUserAccountForm"]["email"].value.trim();
    let role = document.forms["createUserAccountForm"]["role"].value.trim();
   
    let userErr = passwordErr = confirmPasswordErr = emailErr = roleErr = false;

    // Validate username (no empty values allowed)
    if (user.trim() === "") {
        printError("user_err", "User name is required.");
        userErr = true;
    } else {
        printError("user_err", "");
    }

    // Validate password (minimum 6 characters)
    if (password.length < 6) {
        printError("password_err", "Password must be at least 6 characters.");
        passwordErr = true;
    } else {
        printError("password_err", "");
    }

    // Validate confirm password and password must match
    if (confirmPassword !== password) {
        printError("confirm_password_err", "Passwords do not match.");
        confirmPasswordErr = true;
    } else {
        printError("confirm_password_err", "");
    }

    // Validate email
    let emailRegex = /^\S+@\S+\.\S+$/;
    if (email.trim() === "" || !emailRegex.test(email)) {
        printError("email_err", "Enter a valid email.");
        emailErr = true;
    } else {
        printError("email_err", "");
    }

    // Validate role 
    if (role === "") {
        printError("role_err", "Role is required.");
        roleErr = true;
    } else {
        printError("role_err", "");
    }

    // Stop form submission if errors exist
    if (userErr || passwordErr || confirmPasswordErr || emailErr || roleErr){
        return false;
    };

    return true;
}

function validateAddStaffForm() {
    let name = document.forms["addStaffForm"]["name"].value.trim();
    let email = document.forms["addStaffForm"]["email"].value.trim();
    let contactNumber = document.forms["addStaffForm"]["contact_number"].value.trim();
    let role = document.forms["addStaffForm"]["role"].value.trim();
    let department = document.forms["addStaffForm"]["department"].value.trim();
    let specialty = document.forms["addStaffForm"]["specialty"].value.trim();
    let qualifications = document.forms["addStaffForm"]["qualifications"].value.trim();
    let shiftSchedule = document.forms["addStaffForm"]["shift_schedule"].value.trim();

    let nameErr = emailErr = contactNumberErr = roleErr = departmentErr = specialtyErr = qualificationsErr = shiftScheduleErr = false;

    // Validate name
    if (name === "") {
        printError("name_err", "Name is required.");
        nameErr = true;
    } else {
        printError("name_err", "");
    }

    // Validate email
    let emailRegex = /^\S+@\S+\.\S+$/;
    if (email === "" || !emailRegex.test(email)) {
        printError("email_err", "Enter a valid email.");
        emailErr = true;
    } else {
        printError("email_err", "");
    }

    const contactNumberPattern = /^\+94\s\d{3}(-?\d{3}){2}$/;
    if (contactNumber === "" || !contactNumberPattern.test(contactNumber)) {
        printError("contact_number_err", "Please enter a valid contact number.");
        contactNumberErr = true;
    } else {
        printError("contact_number_err", "");
    }

    // Validate role 
    if (role === "") {
        printError("role_err", "Role is required.");
        roleErr = true;
    } else {
        printError("role_err", "");
    }

    // Validate department 
    if (department === "") {
        printError("department_err", "Department is required.");
        departmentErr = true;
    } else {
        printError("department_err", "");
    }

    // Validate specialty 
    if (specialty === "") {
        printError("specialty_err", "Specialty is required.");
        specialtyErr = true;
    } else {
        printError("specialty_err", "");
    }

    // Validate qualifications 
    if (qualifications === "") {
        printError("qualifications_err", "Qualifications are required.");
        qualificationsErr = true;
    } else {
        printError("qualifications_err", "");
    }

    // Validate shift schedule 
    if (shiftSchedule === "") {
        printError("shift_schedule_err", "Shift Schedule is required.");
        shiftScheduleErr = true;
    } else {
        printError("shift_schedule_err", "");
    }

    // no form submission if errors exist
    if (nameErr || emailErr || contactNumberErr || roleErr || departmentErr || specialtyErr || qualificationsErr || shiftScheduleErr) {
        return false;
    }

    return true;
}


