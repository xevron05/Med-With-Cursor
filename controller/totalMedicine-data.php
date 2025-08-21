<?php
require "../php-config/Connection.php";

$records = $conn->query("SELECT * FROM medicines INNER JOIN med_cursor.medicinebatch m on medicines.SN = m.MED_ID");

$nr_of_rows = $records->num_rows;

// Setting the number of rows to display in a page.
$rows_per_page = 10;

// calculating the nr of pages.
$pages = ceil($nr_of_rows / $rows_per_page);

// Setting the start from, value.
$start = 0;
$i = 1;

// If the user clicks on the pagination buttons.
if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
    $i = $start+1;
}

// For Total Medicine details
$medicineFetchSqlTotalMedicine = "SELECT * FROM medicines INNER JOIN med_cursor.medicinebatch m on medicines.SN = m.MED_ID LIMIT $start, $rows_per_page";
$done = $conn->query($medicineFetchSqlTotalMedicine);



// For count row of total medicine
$totalRowCount = "SELECT * from medicines";
if ($result = mysqli_query($conn, $totalRowCount)) {
    // Return the number of rows in result set
    $rowcounting = mysqli_num_rows( $result );
}

    $conn->close();
