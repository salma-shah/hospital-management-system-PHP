document.addEventListener("DOMContentLoaded", function () {
    let toggleButton = document.getElementById("dropdown-button");
    let feedbackForm = document.getElementById("feedback-form");

    if (toggleButton && feedbackForm) {
    toggleButton.addEventListener("click", function () {
        if (feedbackForm.style.display === "none" || feedbackForm.style.display === "") {
            feedbackForm.style.display = "block";
        } else {
            feedbackForm.style.display = "none";
        }
        
    }) };
});

function displayThankYouQueryMessage () {
    alert('Thank you for your inquiry! We will get back to you soon.');
}

function displayThankYouFeedbackMessage () {
    alert('Thank you for your feedback! We hope to improve our service for our clients, always!');
}

function displayInvalidMessage () {
    alert('Your login name or passsword is invalid.');
}

function displaySuccessfulAddingStaffMessage () {
    alert('Staff member was added to the database successfully!');
}

function displaySuccessfulStaffUpdateMessage () {
    alert("The staff member's details have been updated successfully!");
}

function displaySuccessfulNewAccount () {
    alert("The user account was created successfully!");
}

function displayFailedNewAccount () {
    alert("There was an error in creating the user account.");
}


function displayFooter () {
    fetch("page_footer.html")  // fetching the footer file
    .then(response => response.text())  // reads the text file as html, plain text
    .then(data => document.getElementById("footer-placeholder").innerHTML = data);  // inserts the footer data into the division placeholder
}

function openRoom(evt, roomName) {

    var i, roomcontent, tablinks;

    //  all elements with class="tabcontent" and hide them
     roomcontent = document.getElementsByClassName("roomcontent");
    for ( i = 0; i < roomcontent.length; i++) {
        roomcontent[i].style.display = "none";
    }
  
    //  all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for ( i = 0; i < tablinks.length; i++) {
      tablinks[i].classList.remove("active");
    }
  
    // display current tab, and add an 'active' class to the button that opened the tab
    document.getElementById(roomName).style.display = "block";
    evt.currentTarget.classList.add("active");
  }

  // first tab by default
document.addEventListener("DOMContentLoaded", function() {
    let firstTabContent = document.querySelector(".roomcontent");
    let firstTabLink = document.querySelector(".tablinks");

    if (firstTabContent) firstTabContent.style.display = "block";
    if (firstTabLink) firstTabLink.classList.add("active"); 
});


function toggleForm(formId) {
    var form = document.getElementById(formId);
    // check if form is hidden, if so, display it 
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

// hide the modal 
function closeModal() {
    document.getElementById("staffDetailsModal").style.display = "none";
}

// close modal if clicked outside the content
window.onclick = function(event) {
    var modal = document.getElementById("staffDetailsModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

document.addEventListener("DOMContentLoaded", function () {
    let addButton = document.getElementById("add-button");
    let addStaffModal = document.getElementById("addStaffModal");
    let closeAddModal = document.getElementById("closeAddModal");

    // add staff modal
    if (addButton) {
        addButton.addEventListener("click", function () {
            addStaffModal.style.display = "block";
        });
    }

    //close it
    if (closeAddModal) {
        closeAddModal.addEventListener("click", function () {
            addStaffModal.style.display = "none";
        });
    }

    let updateButtons = document.querySelectorAll('.update-button');
    let updateStaffModal = document.getElementById("updateStaffModal");
    let closeUpdateModal = document.getElementById("closeUpdateModal");
    
    // loop through every button in updateButtons
    updateButtons.forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("updateId").value = this.getAttribute("data-staff-id") || '';
            document.getElementById("updateName").value = this.getAttribute("data-name") || '';
            document.getElementById("updateEmail").value = this.getAttribute("data-email") || '';
            document.getElementById("updateContact").value = this.getAttribute("data-contact_number") || '';
            document.getElementById("updateRole").value = this.getAttribute("data-role") || '';
            document.getElementById("updateDepartment").value = this.getAttribute("data-department") || '';
            document.getElementById("updateSpecialty").value = this.getAttribute("data-specialty") || '';
            document.getElementById("updateQualifications").value = this.getAttribute("data-qualifications") || '';
            document.getElementById("updateShift").value = this.getAttribute("data-shift_schedule") || '';

            updateStaffModal.style.display = "block"; 
        });
    });

    if (closeUpdateModal) {
        closeUpdateModal.addEventListener("click", function () {
            updateStaffModal.style.display = "none";
        });
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target === addStaffModal || event.target === updateStaffModal) {
            addStaffModal.style.display = "none";
            updateStaffModal.style.display = "none";
        }
    };


// add user modal
    let addUserAccountButton = document.getElementById("addUserAccountButton");
    let createUserAccountModal = document.getElementById("createUserAccountModal");
    let closeAddUserModal = document.getElementById("closeAddUserModal");

    // show it
    if (addUserAccountButton) {
        addUserAccountButton.addEventListener("click", function () {
            createUserAccountModal.style.display = "block";
        });
    }

    // close it
    if (closeAddUserModal) {
        closeAddUserModal.addEventListener("click", function () {
            createUserAccountModal.style.display = "none";
        });
    }
});


function showDetails(id, name, email, contact, role, department, specialty, qualifications, shift) {
    // set modal content
    document.getElementById('modalId').innerText = id;
    document.getElementById('modalName').innerText = name;
    document.getElementById('modalEmail').innerText = email;
    document.getElementById('modalContact').innerText = contact;
    document.getElementById('modalRole').innerText = role;
    document.getElementById('modalDepartment').innerText = department;
    document.getElementById('modalSpecialty').innerText = specialty;
    document.getElementById('modalQualifications').innerText = qualifications;
    document.getElementById('modalShift').innerText = shift;

    // show modal
    document.getElementById('staffDetailsModal').style.display = 'block';
}

// function to pre-fill update fields for user ease
function preFillUpdateFields(id, name, email, contact, role, department, specialty, qualifications, shift) {
    document.getElementById('updateId').value = id;
    document.getElementById('updateName').value = name;
    document.getElementById('updateEmail').value = email;
    document.getElementById('updateContact').value = contact;
    document.getElementById('updateRole').value = role;
    document.getElementById('updateDepartment').value = department;
    document.getElementById('updateSpecialty').value = specialty;
    document.getElementById('updateQualifications').value = qualifications;
    document.getElementById('updateShift').value = shift;
    //finds the corressponding field by its ID then fills in those fields with its values
    // Show update modal
    document.getElementById('updateStaffModal').style.display = 'block';
}

// Function to close the details modal
function closeModal() {
    document.getElementById('staffDetailsModal').style.display = 'none';
}

// Function to close the update modal
function closeUpdateModal() {
    document.getElementById('updateStaffModal').style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function () {
    const accordions = document.querySelectorAll(".accordion");

    accordions.forEach(accordion => {
        accordion.addEventListener("click", function () {
            // Toggle active class
            this.classList.toggle("active");

            // Show or hide the panel
            let panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    });
});






