const recordsPerPage = 6; // number of records to display per page
let currentPage = 1; // number of the current page
let filteredDoctors = doctors; // stores all doctors in filtered doctors variable

function displayDoctors(page) {
    const startIndex = (page - 1) * recordsPerPage;  // calculating the starting index of the records
    const endIndex = startIndex + recordsPerPage;  // ending index of records per page
    const paginatedDoctors = filteredDoctors.slice(startIndex, endIndex);
    
    const tableBody = document.getElementById('tableBody');  // table body element to insert rows
    tableBody.innerHTML = ''; // clears any existing rows so table will be empty
    
    // loops through sliced array filteredDoctors to print a row for each doctor in the table
    paginatedDoctors.forEach(doctor => {
        const row = `<tr>
            <td>${doctor.staff_id}</td>
            <td>Dr ${doctor.name}</td>
            <td>${doctor.specialty}</td>
            <td>${doctor.email}</td>
            <td>${doctor.qualifications}</td>
            <td>${doctor.contact_number}</td>
        </tr>`;
        tableBody.innerHTML += row; // add new row
    });

    updatePagination();
}
function updatePagination() {
    const pagination = document.getElementById("pagination"); 
    pagination.innerHTML = ""; // clear old pagination
    totalPages = Math.ceil(filteredDoctors.length / recordsPerPage); 
    if (totalPages <= 1) return; // no pagination needed if only 1 page

    for (let i = 1; i <= totalPages; i++) // creates link for each page number
        {
        const listItem = document.createElement("li"); // creating new list item aka page number
        const pageLink = document.createElement("a"); // creating new link

        pageLink.href = "javascript:void(0)"; // prevents page reload
        pageLink.innerText = i; // sets the page number text
        pageLink.classList.add("page-link"); // this is CSS
        pageLink.setAttribute("data-page", i); // store page number

        pageLink.addEventListener("click", function () {
            changePage(i);
        });

        if (i === currentPage) {
            pageLink.style.fontWeight = "bold"; // highlight active page
        }

        listItem.appendChild(pageLink);  // page link becomes list number
        pagination.appendChild(listItem); // displaying pagination
    }
}


// changes current page to specific page number then displays results again
function changePage(page) {
    currentPage = page;
    displayDoctors(currentPage);
}

function filterDoctors() {
    const input = document.getElementById('searchInput').value.toLowerCase();  // turns searched value to all loweercase
    // filters doctors array
    filteredDoctors = doctors.filter(doctor =>
        doctor.name.toLowerCase().includes(input) || 
        doctor.specialty.toLowerCase().includes(input)
    );

    // if no match, no results
    if (filteredDoctors.length === 0) {
        document.getElementById('tableBody').innerHTML = '<tr><td colspan="6">No results found.</td></tr>';
        document.getElementById('pagination').innerHTML = ''; // clear pagination if no results
    } 
    // if match, display matched results
    else {
        currentPage = 1; // reset to the first page and display there
        displayDoctors(currentPage); // display filtered doctors
    }
}

// default display
displayDoctors(currentPage);

function toggleForm(formId) {
    var form = document.getElementById(formId);
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}



