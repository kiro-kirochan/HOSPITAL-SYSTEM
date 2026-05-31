// ============================================================
// main.js — Hospitality (eDoc-inspired UI)
// ============================================================

// Search table rows — checks both the page search bar and topbar search
function searchTable() {
    const input = document.getElementById("searchInput") || document.getElementById("topSearchInput");
    if (!input) return;
    const filter = input.value.toLowerCase();
    const table = document.querySelector("table");
    if (!table) return;
    const rows = table.getElementsByTagName("tr");
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let found = false;
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                found = true;
                break;
            }
        }
        rows[i].style.display = found ? "" : "none";
    }
}

// Also wire topbar search
document.addEventListener("DOMContentLoaded", function () {
    const topSearch = document.getElementById("topSearchInput");
    if (topSearch) {
        topSearch.addEventListener("keyup", searchTable);
    }
});

// ============================================================
// Delete confirmation overlay
// ============================================================
function openConfirm(deleteUrl) {
    document.getElementById("confirmBox").style.display = "flex";
    document.getElementById("confirmYes").href = deleteUrl;
}

function closeConfirm() {
    document.getElementById("confirmBox").style.display = "none";
}

// ============================================================
// Form validation
// ============================================================
function validateForm() {
    const pid = document.getElementById("pid");
    const did = document.getElementById("did");
    if (pid && pid.value == "0") {
        alert("Please select a patient.");
        return false;
    }
    if (did && did.value == "0") {
        alert("Please select a doctor.");
        return false;
    }
    return true;
}
