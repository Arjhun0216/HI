<?php
ob_start();
$cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");
if (isset($_get['regno'])) {
    $regno = $_get['regno'];
    // Fetch the data for the specified regno
    $query = "SELECT * FROM STUDENT WHERE regno='$regno'";
    $query_run = mysqli_query($cn, $query);
    
    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_array($query_run);
        // Include the file responsible for PDF generation
        include('process.php');
    } else {
        echo "No records found for the specified registration number.";
    }
    exit; // Stop further execution to prevent additional output
}
?>