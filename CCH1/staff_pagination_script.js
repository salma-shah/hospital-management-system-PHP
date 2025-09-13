const recordsPerPage = 6;
let currentPage = 1;
let filteredStaff = staff;

function confirmDelete(staffId) {
    if (confirm("Are you sure you want to delete this staff member? This action cannot be reversed.")) {
        window.location.href = "manage_staff_data.php?delete=" + staffId;
    }
}

function displayStaff(page) {
    const startIndex = (page - 1) * recordsPerPage;
    const endIndex = startIndex + recordsPerPage;
    const paginatedStaff = filteredStaff.slice(startIndex, endIndex); 
    
    const staffContainer = document.getElementById('staffContainer');
    staffContainer.innerHTML = '';

    paginatedStaff.forEach(member => {
        let staffCard = document.createElement("div");
        staffCard.classList.add("staff-item");
        staffCard.innerHTML = `
            <h3><strong>Staff ID: </strong>${member.staff_id}</h3>
            <h3>${member.name}</h3>
            <p><strong>Role:</strong> ${member.role}</p>
            <p><strong>Email:</strong> ${member.email}</p>
            <p><strong>Contact:</strong> ${member.contact_number}</p>
            <div class="staff-buttons">
                <button onclick="showDetails('${member.staff_id}', '${member.name}', '${member.email}', '${member.contact_number}', '${member.role}', '${member.department}', '${member.specialty}', '${member.qualifications}', '${member.shift_schedule}')">View Details</button>
                <button onclick="preFillUpdateFields('${member.staff_id}', '${member.name}', '${member.email}', '${member.contact_number}', '${member.role}', '${member.department}', '${member.specialty}', '${member.qualifications}', '${member.shift_schedule}')">Update</button>
                <button onclick="confirmDelete('${member.staff_id}')">Delete Staff</button>
            </div>
        `;

        // calls showDetails function, then stores each value into a space for each member, and it should match with the values in showDetails function
        // preFill works similiarly  
        staffContainer.appendChild(staffCard);  // new card created, content populated, then it is added to the main container
    });

    updatePagination();
}

function updatePagination() {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    const totalPages = Math.ceil(filteredStaff.length / recordsPerPage);
    for (let i = 1; i <= totalPages; i++) {
        pagination.innerHTML += `<li>
            <a href="javascript:void(0)" onclick="changePage(${i})" class="${i === currentPage ? 'active' : ''}">${i}</a>
        </li>`;
    }
    // create new page number and check if i is the current page. if so, apply the necessary class.
}

function changePage(page) {
    currentPage = page;  // current page becomes another page
    displayStaff(currentPage); // that page details shown
}

function filterStaff() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    // filters array by name, role, id , specialty
    filteredStaff = staff.filter(staff =>
        staff.staff_id.toLowerCase().includes(input) || 
        staff.name.toLowerCase().includes(input) || 
        staff.specialty.toLowerCase().includes(input) || 
        staff.role.toLowerCase().includes(input)
    );

    // if no match, no results
    if (filteredStaff.length === 0) {
        document.getElementById('staffContainer').innerHTML = '<tr><td colspan="6">No results found.</td></tr>';
        document.getElementById('pagination').innerHTML = ''; // Clear pagination if no results
    } 
    // if match, displays matched results
    else {
        currentPage = 1; // reset to the first page
        displayStaff(currentPage); // display filtered doctors
    }
}

displayStaff(currentPage);