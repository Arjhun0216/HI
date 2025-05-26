<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: index_login.php"); // Redirect to login if not logged in
    exit();
}
?>


<!doctype html>
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>

<html lang="en" >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 ,shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <script>
function toggleTransparency() {
    var yesRadio = document.getElementById('yes');
    var yesLabel = document.querySelector('label[for="yes"]');
    var noRadio = document.getElementById('no');
    var noLabel = document.querySelector('label[for="no"]');

    if (yesRadio.checked) {
        yesLabel.style.opacity = '1'; // Show the "Yes" label
        noLabel.style.opacity = '0.5'; // Make the "No" label transparent
    } else if (noRadio.checked) {
        noLabel.style.opacity = '1'; // Show the "No" label
        yesLabel.style.opacity = '0.5'; // Make the "Yes" label transparent
    }
}

function printPage() {
        var printContent = document.querySelectorAll('.print-area');
        var printWindow = window.open('', '', 'height=400,width=800');
        printWindow.document.write('<html><head><title>Print</title></head><body>');
        printContent.forEach(function (content) {
            printWindow.document.write(content.innerHTML);
        });
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
        }
        
</script>
<style>
     .card {
    padding: 20px;
    margin-top: 50px;
    max-width: 100%; /* Allow full width */
    margin-left: auto;
    margin-right: auto;
    background-color: #f8f9fa; /* Light background for contrast */
    border-radius: 8px; /* Slightly rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.card-title {
    margin-bottom: 20px;
    font-family: "Times New Roman", Times, serif;
    text-align: center;
    font-size: 24px; /* Increase font size for visibility */
    color: #343a40; /* Darker color for better readability */
}

.form-group {
    margin-bottom: 20px;
    text-align: center; /* Center-align text */
    display: flex;
    flex-direction: column;
    align-items: center; /* Center-align items */
}

.form-control {
    position: relative;
    border-radius: 0px;
    padding-left: 10px; /* Reduced padding for better alignment */
    width: 100%;
    max-width: 200px; /* Set max width for input fields */
}

.form-control::placeholder {
    color: #aaa;
    font-size: 16px;
}

        .btn-primary {
            border-radius: 5px;
            background-color: #007bff;
            border-color: #007bff;
            width: 100px;
            display: block;
            margin: 20px auto;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .card-header {
            background-color: #28a745; 
            background-size: cover;
            width: 100%;
            text-align: center;
            padding: 0;
        }

        .nav {
            text-align: center;
            margin-top: 20px;
        }

        .nav a {
            margin: 0 15px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
            text-decoration: none;
        }

        .print-area {
            font-family: "Times New Roman", Times, serif;
            font-size: 20px;
        }

        table {
            font-size: 20px;
        }

        a {
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
            text-decoration: none;
        }
        td {
    vertical-align: middle; /* Aligns cell content to the top */
}

.btn-edit {
    border-radius: 5px;
    background-color: #007bff; /* Your preferred color */
    border-color: #007bff; /* Adjust as needed */
    width: 50px; /* Keep or change as needed */
    display: block; /* Make the button a block element */
    margin: 0; /* Remove margins for tight alignment */
    text-align: center;
}

.btn-edit i {
    margin-right: 5px;
}

.btn-edit:hover {
    background-color: #0056b3; /* Darker shade for hover */
    border-color: #0056b3; /* Adjust as needed */
}


.table {
        width: 100%;
        border-collapse: collapse; /* Ensures borders collapse */
        margin: 20px 0; /* Adds some spacing around the table */
        border: 2px solid black; /* Dark black border for the table */
    }

    /* Style for table headings */
    .table thead th {
        background-color: #007bff; /* Blue background for the header */
        color: white; /* White text color */
        padding: 10px; /* Padding around text */
        font-size: 16px; /* Increase font size */
        text-align: center; /* Center text */
        border: 2px solid black; /* Dark black border for header cells */
    }

    /* Style for table body */
    .table tbody td {
        border: 2px solid black; /* Dark black border for table cells */
        padding: 10px; /* Padding for table cells */
        font-size: 14px; /* Font size for body cells */
    }

    /* Style for table rows on hover */
    .table tbody tr:hover {
        background-color: #f1f1f1; /* Light grey background on row hover */
    }




</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <title>Search</title>
  </head>
  <body>
    
       
            
  <div class="card">
    <div class="card-header">
        <h4 class="card-title">ENTER THE STUDENT REGISTER NUMBER</h4>
    </div>
    <div class="card-body">
    <form action="" method="POST">
    <div class="row">
        <div class="col-md-3 form-group">
            <label for="regno">Register Number</label>
            <input type="text" name="regno" class="form-control" placeholder="Enter Regno">
        </div>
        <div class="col-md-3 form-group">
            <label for="name">Student Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Student Name">
        </div>
        <div class="col-md-3 form-group">
            <label for="department">Department</label>
            <select name="department" class="form-control">
                <option value="">Select Department</option>
                <option value="Computer Science Engineering">CSE</option>
                <option value="Electronic and Communication Engineering">ECE</option>
                <option value="Electrical and Electronic Engineering">EEE</option>
                <option value="Mechanical Engineering">MECH</option>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label for="year"> Year</label>
            <select name="year" class="form-control">
                <option value="">Select Year</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
            </select>
        </div>
        <div class="col-md-12 text-center"> <!-- Center align the button in a new row -->
            <button type="submit" name="search" class="btn btn-primary mt-3">Search</button>
        </div>
    </div>
</form>

        <div class="nav">
            <a href="?a=cse">CSE</a>
            <a href="?a=ece">ECE</a>
            <a href="?a=mech">MECH</a>
            <a href="?a=eee">EEE</a>
        </div>
            <?php
    // Example: Generate checkboxes dynamically from a database query
    if (isset($_POST['dept'])) {
        $division = $_POST['division'];
        // Assume $cn is your database connection object
        
        // Validate and sanitize input (you can improve this further)
        
        $cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");

        // Build and execute the query
        $sql = "SELECT regno FROM STUDENT WHERE division = '$division'";
        $result=mysqli_query($cn,$sql);

        if ($result) {
            // Check if there are rows returned
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Output checkbox for each student
                    echo '<input type="checkbox" name="regno[]" value="' . htmlspecialchars($row['regno']) . '"> Register No. ' . htmlspecialchars($row['regno']) . '<br>';
                }
            } else {
                echo "No students found in this division."; // Output message if no results found
            }
        } else {
            echo "Error executing query: " . $cn->error; // Display database query error
        }

        // Close database connection
        $cn->close();
    }
?>




                       </div>

                   
                </div>
            </div>
          
        
            <?php
    // Database connection
    $cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");

    if(isset($_POST['search'])) {
        $regno = $_POST['regno'];
        $name = $_POST['name'];
        $department = $_POST['department'];
        $year = $_POST['year'];

        // Start building the query based on the user input
        $query = "SELECT * FROM STUDENT WHERE 1=1";

        // If registration number is provided, ignore other fields and search by regno only
        if (!empty($regno)) {
            $query = "SELECT * FROM STUDENT WHERE regno = '$regno'";
        } else {
            // Filter by student name
            if (!empty($name)) {
                $query .= " AND sname LIKE '%$name%'";
            }

            // Filter by department if selected
            if (!empty($department)) {
                $query .= " AND division = '$department'";
            }

            // Filter by year if selected
            if (!empty($year)) {
                $query .= " AND acdyear = '$year'";
            }
        }

        $query_run = mysqli_query($cn, $query);
    ?>
                 
                              
                                <?php
                                
                                ?>
                        </div>
                </div>
                
                <div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Regno</th>
                    <th>Department</th>
                    <th colspan="3" style="text-align: center;">Actions</th>  <!-- Added column for actions -->
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_array($query_run)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['sname']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['acdyear']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['regno']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['division']) . '</td>';

                        echo '<td><form method="post" action="?a=demo&regno=' . $row["regno"] . '">
                                <button type="submit" name="submit" class="btn btn-success">
                                <i class="fas fa-eye"></i></button>
                              </form></td>';
                        
                        echo '<td><form method="post" action="?a=demo1&regno=' . $row["regno"] . '">
                                <button type="submit" name="submit" class="btn btn-danger">
                                <i class="fas fa-download"></i></button>
                              </form></td>';
                        echo '<td><form method="post" action="?a=edit1&regno=' . $row["regno"] . '">
                                <button type="submit" name="submit" class="btn btn-edit">
                                <i class="fas fa-edit"></i></button>
                                </form></td>';
                                
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No records found</td></tr>'; // Changed colspan to 5
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

                
                <?php
                 }
                ?>
                
                    
            
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    -->
  </body>
</html>
