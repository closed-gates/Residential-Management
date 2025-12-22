// Mock Data for the System
const requests = [
    { unit: "A-102", issue: "Leaking Pipe", status: "Pending" },
    { unit: "B-205", issue: "AC Repair", status: "In Progress" },
    { unit: "C-101", issue: "Broken Lock", status: "Resolved" }
];

const tableBody = document.getElementById('tableBody');

// Function to load requests into the table
function loadRequests() {
    tableBody.innerHTML = requests.map(req => `
        <tr>
            <td>${req.unit}</td>
            <td>${req.issue}</td>
            <td><span class="status-tag">${req.status}</span></td>
            <td><button class="action-btn">Manage</button></td>
        </tr>
    `).join('');
}

// Event Listener for the button
document.getElementById('addResidentBtn').addEventListener('click', () => {
    alert('This would open a form to add a new resident!');
});

// Initialize
window.onload = loadRequests;