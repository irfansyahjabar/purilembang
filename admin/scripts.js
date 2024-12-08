// Search table functionality
function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#transactionTable tbody tr");

    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        let match = false;

        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().indexOf(input) > -1) {
                match = true;
            }
        });

        if (match) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

// Sort table functionality
function sortTable(columnIndex) {
    const table = document.getElementById("transactionTable");
    const rows = Array.from(table.querySelectorAll("tbody tr"));

    let isAscending = table.getAttribute("data-sort-order") === "asc";

    rows.sort((rowA, rowB) => {
        const cellA = rowA.querySelectorAll("td")[columnIndex].textContent.trim().toLowerCase();
        const cellB = rowB.querySelectorAll("td")[columnIndex].textContent.trim().toLowerCase();

        if (isAscending) {
            return cellA.localeCompare(cellB);
        } else {
            return cellB.localeCompare(cellA);
        }
    });

    isAscending = !isAscending;
    table.setAttribute("data-sort-order", isAscending ? "asc" : "desc");

    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";
    rows.forEach(row => tbody.appendChild(row));
}

// Confirm delete functionality
function confirmDelete() {
    return confirm("Are you sure you want to delete this transaction?");
}
