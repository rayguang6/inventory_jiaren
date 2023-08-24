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
        const excludeColumns = [13]; // Exclude "Action" columns
        exportTableToCSV(productTable, 'product-table.csv', excludeColumns);
    });
});

// Call the function to export history table when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {

    // export history report to csv
    const exportHistoryButton = document.getElementById('export-history-button');
    const historyTable = document.getElementById('history-table');

    exportHistoryButton.addEventListener('click', () => {
        exportTableToCSV(historyTable, 'history-table.csv');
    });

});

// Call the function to good table when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {

    // export good status product to csv
    const exportGoodButton = document.getElementById('export-good-button');
    const goodTable = document.getElementById('status-good-table');

    exportGoodButton.addEventListener('click', () => {
        const excludeColumns = [6]; // Exclude "Action" columns
        exportTableToCSV(goodTable, 'status-good.csv', excludeColumns);
    });

});
// Call the function to warning table when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {

    // export warning status product to csv
    const exportWarningButton = document.getElementById('export-warning-button');
    const warningTable = document.getElementById('status-warning-table');

    exportWarningButton.addEventListener('click', () => {
        const excludeColumns = [6]; // Exclude "Action" columns
        exportTableToCSV(warningTable, 'status-warning.csv', excludeColumns);
    });

});

// Call the function to remark table when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {

    // export warning status product to csv
    const exportRemarkButton = document.getElementById('export-remark-button');
    const remarkTable = document.getElementById('remark-table');

    exportRemarkButton.addEventListener('click', () => {
        const excludeColumns = [13]; // Exclude "Action" columns
        exportTableToCSV(remarkTable, 'remarks.csv', excludeColumns);
    });

});
