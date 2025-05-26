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
// Establish database connection
$cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");
if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_GET['did']))
        {
        delete();
        print '<h6 class= "successMessage">Student Deleted.</h6>';
        }
        $sql1 = "UPDATE `student`
        SET `leaveyear` = `acdyear` + 4
        WHERE `leaveyear` IS NULL;";
$table1 = mysqli_query($cn, $sql1);
if (mysqli_query($cn, $sql1)) {
    //echo "Leaveyear updated successfully!";
} else {
   // echo "Error updating leaveyear: " . mysqli_error($cn);
}

// Retrieve all active students
$sql = "SELECT * FROM student";
$table = mysqli_query($cn, $sql);

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>

    <div class="section-title">
        <h3>All Students</h3>
    </div>


    <?php 
    // Display students in a table
    if ($table && mysqli_num_rows($table) > 0) {
        echo '<table class="table">';
        echo '<tr><th>ID</th><th>Regno</th><th>Student Name</th><th>Guardian Name</th><th>Degree</th><th>Gender</th><th>Division</th><th>Action</th></tr>';

        while ($row = mysqli_fetch_assoc($table)) {
            echo '<tr>';
            echo '<td>' . htmlentities($row["id"]) . '</td>';
            echo '<td>' . htmlentities($row["regno"]) . '</td>';
            echo '<td>' . htmlentities($row["sname"]) . '</td>';
            echo '<td>' . htmlentities($row["gname"]) . '</td>';
            echo '<td>' . htmlentities($row["grad"]) . '</td>';
            echo '<td>' . htmlentities($row["gender"]) . '</td>';
            echo '<td>' . htmlentities($row["division"]) . '</td>';
            print '<td> <a class= "action-e" href= "?a=edit&eid='.$row["id"].'"><i class="fa fa-wrench" title="Update"></i></a>
					<a class= "action-d" href= "?a='.$_GET['a'].'&did='.$row['id'].'"><i class="fa fa-trash" title="Delete"></i></a></td>';
					print '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p style="font-size:25px;font-family:times-new-roman;text-align:center;">No transferred students found.</p>';
    }

    // Close the database connection
    function delete()
    {
        global $cn;
        $sql = "delete from student where id = ".$_GET['did'];
        mysqli_query($cn, $sql);
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QnZc57eDJ2UG2KzzW6Sflfd4nLT8HjfHS6hgppI+YBm5QoEpniRZg7Eu9y0TA9mf" crossorigin="anonymous"></script>
</body>
</html>
