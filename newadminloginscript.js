// script.js
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Initial tab selection
document.getElementsByClassName("tablinks")[0].click();

// Function to display complaints with images
function displayComplaints(complaints, tabId, showApproveButton) {
    var tab = document.getElementById(tabId);
    tab.innerHTML = ""; // Clear existing data



    for (var i = 0; i < complaints.length; i++) {
        var complaint = complaints[i];
        var complaintElement = document.createElement("div");
        complaintElement.innerHTML = `
            <p>AADHAR NUMBER    :${complaint.aadhar}</p>
            <p>NAME             :${complaint.name}</p>
            <p>PHONE NUMBER     :${complaint.phone}</p>
            <p>HOSPITAL NAME    :${complaint.hospital_name}</p>
            <p>HOSPITAL CITY    :${complaint.hospital_city}</p>
            <p>CONDITION        :${complaint.condition}</p>
            <p>CASE DESCRIPTION :${complaint.case_description}</p>
            <img src="${complaint.image_path}" alt="Complaint Image from cases">
            <img src="${complaint.PhotoData}" alt="Complaint Image uhh from your_table_name">
        `;
        
        // Check if the approve button should be shown
        if (showApproveButton) {
            complaintElement.innerHTML += `
                <button onclick="approveComplaint('${complaint.uuid}')">Approve</button>
            `;
        }

        tab.appendChild(complaintElement);
    }
}

// AJAX request to fetch registered complaints from the server
function fetchRegisteredComplaints() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var complaints = JSON.parse(this.responseText);
            displayComplaints(complaints, "Registered", true);
        }
    };

    xhttp.open("GET", "newadminloginregistertab.php", true);
    xhttp.send();
}

// AJAX request to fetch approved complaints from the server
function fetchApprovedComplaints() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var complaints = JSON.parse(this.responseText);
            displayComplaints(complaints, "Approved", false);
        }
    };

    xhttp.open("GET", "approved_complaints.php", true);
    xhttp.send();
}

// AJAX request to approve a complaint and move it to the "Approved" tab
function approveComplaint(complaintId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            fetchRegisteredComplaints(); // Refresh the "Registered" tab
            fetchApprovedComplaints();   // Refresh the "Approved" tab
        }
    };

    xhttp.open("POST", "approve.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("complaintId=" + complaintId);
}

// Fetch registered complaints when the page loads
window.onload = function () {
    fetchRegisteredComplaints();
    fetchApprovedComplaints(); // Fetch approved complaints initially
};