const exportTableToCSV = (tableElement, filename, excludeColumns = []) => {
    const headerRow = Array.from(tableElement.querySelectorAll('thead th'))
        .filter((th, index) => !excludeColumns.includes(index))
        .map(th => th.textContent);

    const rows = Array.from(tableElement.querySelectorAll('tbody tr'))
        .map(row => Array.from(row.children)
            .filter((cell, index) => !excludeColumns.includes(index))
            // .map(cell => cell.textContent)
            .map(cell => {
                // Exclude styled elements
                const rawText = cell.textContent.replace(/\s*\[.*\]/, '');
                return rawText.trim();
            })
        );

    rows.unshift(headerRow);

    const csv = Papa.unparse(rows);
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);

    const link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', filename);
    link.style.display = 'none';
    document.body.appendChild(link);

    link.click();

    URL.revokeObjectURL(url);
    document.body.removeChild(link);
};

// Call the function to export product table when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const exportProductButton = document.getElementById('export-product-button');
    const productTable = document.getElementById('product-table');

    exportProductButton.addEventListener('click', () => {
        exportTableToCSV(productTable, 'product-table.csv', [6, 11]); // Exclude "Status" and "Action" columns
    });
});

// Call the function to export history table when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const exportHistoryButton = document.getElementById('export-history-button');
    const historyTable = document.getElementById('history-table');

    exportHistoryButton.addEventListener('click', () => {
        exportTableToCSV(historyTable, 'history-table.csv');
    });
});
