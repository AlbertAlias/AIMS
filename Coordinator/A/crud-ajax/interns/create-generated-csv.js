document.getElementById('exportCSVButton').addEventListener('click', function() {
    window.location.href = 'controller/interns/create-generated-csv.php'; // Adjust the path as necessary
});

// document.getElementById("exportCSVButton").addEventListener("click", function() {
//     // Define the CSV headers
//     const headers = [
//         'last_name',
//         'first_name',
//         'middle_name',
//         'suffix',
//         'gender',
//         'address',
//         'birthdate',
//         'civil_status',
//         'personal_email',
//         'contact_number',
//         'studentID',
//         'department_id',
//         'account_email',
//         'password',
//         '@aims.edu.ph' // Optional header for the domain
//     ];

//     // Create an array to hold the CSV rows
//     const rows = [headers];

//     // Create a number of empty rows with the required formulas
//     const numberOfRows = 10; // Adjust this number as needed
//     for (let i = 0; i < numberOfRows; i++) {
//         const emptyRow = [
//             '', // last_name
//             '', // first_name
//             '', // middle_name
//             '', // suffix
//             '', // gender
//             '', // address
//             '', // birthdate
//             '', // civil_status
//             '', // personal_email
//             '', // contact_number
//             '', // studentID
//             '', // department_id
//             '=IF(B' + (i + 2) + '="", "", CONCATENATE(B' + (i + 2) + ',"@aims.edu.ph"))', // account_email (using studentID)
//             '=IF(G' + (i + 2) + '="", "", TEXT(G' + (i + 2) + ',"MMDDYYYY"))' // password (using birthdate)
//         ];
//         rows.push(emptyRow);
//     }

//     // Add the @aims.edu.ph to the first cell of the AA column
//     const aaRow = Array(headers.length - 1).fill(''); // Fill with empty values
//     aaRow.push('@aims.edu.ph'); // Add @aims.edu.ph to the last cell
//     rows.push(aaRow); // Add this row to the CSV

//     // Create a CSV string from the rows
//     const csvContent = rows.map(e => e.join(",")).join("\n");

//     // Create a Blob object with the CSV content
//     const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

//     // Create a link element
//     const link = document.createElement("a");
//     link.href = URL.createObjectURL(blob);
//     link.setAttribute("download", "interns_template.csv");

//     // Append the link to the body and trigger a click to download
//     document.body.appendChild(link);
//     link.click();

//     // Clean up and remove the link
//     document.body.removeChild(link);
// });
