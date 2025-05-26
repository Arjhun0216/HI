<?php

session_start();

$generated_tc_regno = isset($_SESSION['generated_tc_regno']) ? $_SESSION['generated_tc_regno'] : [];

$cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");

if (isset($_GET['regno'])) {
    $regno = $_GET['regno'];

    // Insert regno into the database
    $insert_query = "INSERT INTO tclist (regno) VALUES ('$regno')";
    if (mysqli_query($cn, $insert_query)) {


        header("Location: tc.php?regno=" . $regno);
        exit;
        /*echo '<script>
              window.open("tc.php?regno=' . $regno . '", "_blank");
              </script>';*/
    } else {
        echo 'Error: ' . mysqli_error($cn);
    }
} else {
    echo 'Regno is not set for generating TC.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content -->
</head>
<body>
    <!-- Your form for search -->
    

    <!-- Your form for generating TC -->
    

    <!-- Generated TC regno list -->
    <div class="container mt-5">
        <h4></h4>
        <table class="table mt-3">
           
            <tbody>
                <?php
                /*if (!empty($generated_tc_regno)) {
                    foreach ($generated_tc_regno as $index => $regno) {
                        echo '<tr>';
                        echo '<th scope="row">' . ($index + 1) . '</th>';
                        echo '<td>' . htmlspecialchars($regno) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">No TC generated yet.</td></tr>';
                }*/
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
