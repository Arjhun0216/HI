<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: index_login.php"); // Redirect to login if not logged in
    exit();
}
?>
<?php

$cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");

// Retrieve stored register numbers from the database
$query = "SELECT * FROM tclist";
$result = mysqli_query($cn, $query);

$stored_tc_regno = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $stored_tc_regno[] = $row['regno'];
    }
}

// Remove duplicates from the array
$stored_tc_regno = array_unique($stored_tc_regno);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content -->
</head>
<body>
<div class="nav">
        <a href="?a=all">All Students</a>
        <a href="?a=discontinue">Discontinued Students</a>
        <a href="?a=transfer">Transferred Students</a>
    </div>
    

    <div class="container mt-5">
        <h4>Stored TC Regno List</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">T.C No</th>
                    <th scope="col">Regno</th>
                    <th scope="col">Name</th>
                    <th scope="col">Year</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Department</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($stored_tc_regno)) {
                    foreach ($stored_tc_regno as $index => $regno) {
                        echo '<tr>';
                        echo '<th scope="row">' . ($index + 1) . '</th>';
                        echo '<td>' . htmlspecialchars($regno) . '</td>';
                        
                        $details_query = "SELECT * FROM student WHERE regno = '" . mysqli_real_escape_string($cn, $regno) . "'";
                        $details_result = mysqli_query($cn, $details_query);
                        
                        if ($details_result && mysqli_num_rows($details_result) > 0) {
                            $details_row = mysqli_fetch_assoc($details_result);
                            // Display details here; for example:
                            
                            echo '<td>' . htmlspecialchars($details_row['sname']) . '</td>';
                            echo '<td>' . htmlspecialchars($details_row['class']) . '</td>';
                            echo '<td>' . htmlspecialchars($details_row['gender']) . '</td>';
                            echo '<td>' . htmlspecialchars($details_row['division']) . '</td>';
                            echo '</tr>';
                        } else {
                            // If no details found
                            echo '<td>No details found</td>';
                        }
                        
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">No TC stored yet.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
