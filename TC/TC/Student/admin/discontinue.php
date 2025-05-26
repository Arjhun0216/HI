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

// Retrieve discontinued students
$sql = "SELECT * FROM student WHERE status = 'Discontinue'";
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
    <style>
        .navbar {
            margin-bottom: 20px;
        }
        .navbar a {
           
            text-decoration: none;
            color: #007bff;
            font-size:25px;
            font-family:'time-new-roman';
        }
        
    </style>
</head>
<body>

    <div class="section-title">
        <h3>Discontinued Students</h3>
    </div>

    <div class="navbar">
        <a href="?a=all">All Students</a>
        <a href="?a=discontinue">Discontinued Students</a>
        <a href="?a=transfer">Transferred Students</a>
    </div>

    <?php 
    // Display discontinued students in a table
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
            echo '<td><form method="post" action="?a=demo&regno=' . $row["regno"] . '">
                                <button type="submit" name="submit" class="btn btn-success">
                                <i class="fas fa-eye"></i></button>
                              </form></td>';
        }

        echo '</table>';
    } else {
        echo '<p style="font-size:25px;font-family:times-new-roman;text-align:center;">No transferred students found.</p>';
    }

    // Close the database connection
    
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QnZc57eDJ2UG2KzzW6Sflfd4nLT8HjfHS6hgppI+YBm5QoEpniRZg7Eu9y0TA9mf" crossorigin="anonymous"></script>
</body>
</html>
