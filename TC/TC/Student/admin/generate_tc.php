<?php

session_start();

$generated_tc_regno = isset($_SESSION['generated_tc_regno']) ? $_SESSION['generated_tc_regno'] : [];

if (isset($_POST['search'])) {
    $cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");
    if (isset($_GET['regno'])) {
        $regno = $_GET['regno'];
        $query = "SELECT * FROM STUDENT WHERE regno='$regno'";
        $query_run = mysqli_query($cn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_array($query_run)) {
                // Here you can display the student details as per your previous code
            }
        } else {
            echo 'No records found';
        }
    } else {
        echo 'Regno is not set';
    }
}

if (isset($_POST['generated'])) {
    
        $regno=$_GET['regno'];
        $_SESSION['generated_tc_regno'][] = $regno;
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content -->
</head>
<body>
    <!-- Your table display code for student details -->

    <!-- Generated TC regno list -->
    <div class="container mt-5">
        <h4>Generated TC Regno List</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Regno</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($generated_tc_regno)) {
                    foreach ($generated_tc_regno as $index => $regno) {
                        echo '<tr>';
                        echo '<th scope="row">' . ($index + 1) . '</th>';
                        echo '<td>' . htmlspecialchars($regno) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">No TC generated yet.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
