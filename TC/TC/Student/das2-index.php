<?php
$servername = "localhost";
$username = "root";
$password = "1711104@gceb!!";
$dbname = "db_admission";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$yearData = array();
$sql = "SELECT class, COUNT(*) as total_students,
            SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as boys,
            SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as girls
        FROM student
        GROUP BY class";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $yearData[] = $row;
    }
}

// Fetch caste data
$casteData = array();
$sql = "SELECT cast, COUNT(*) as total_students,
            SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as boys,
            SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as girls
        FROM student
        GROUP BY cast";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $casteData[] = $row;
    }
}

// Fetch department data
$deptData = array();
$sql_dept = "SELECT division, COUNT(*) as total_students,
                 SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as boys,
                 SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as girls
             FROM student
             GROUP BY division";

$result_dept = $conn->query($sql_dept);

if ($result_dept->num_rows > 0) {
    while ($row = $result_dept->fetch_assoc()) {
        $deptData[] = $row;
    }
}

// Fetch all students data
$allData = array();
$sql_all = "SELECT COUNT(*) as total_students,
                 SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as boys,
                 SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as girls
             FROM student";

$result_all = $conn->query($sql_all);

if ($result_all->num_rows > 0) {
    while ($row = $result_all->fetch_assoc()) {
        $allData[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - College Admission</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #DADADA;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .header-area {
            width: 100%;
            height: 130px;
            background-color: #01427a;
            background-image: url('gceb.png');
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container {
            display: flex;
            width: 100%;
            margin-top: 20px;
            height: calc(100vh - 150px);
        }

        .sidebar {
            width: 200px;
            background-color: #6AB187;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .sidebar h2 {
            margin-top: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            margin-left: 20px;
            overflow-y: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

                .form-container {
            background-color: #f9f9f9;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 20px auto;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            background-color: #01427a;
            color: white;
            font-size: 16px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #012f5a;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
                max-width: 90%;
            }
        }
        .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: #fff;
    padding: 50px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 300px;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #aaa;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.close-btn:hover,
.close-btn:focus {
    color: #000;
}

.popup-top {
    display: none;
    position: fixed;
    top: 0;
    left: 50%; /* Center the popup */
    transform: translateX(-50%); /* Center align */
    width: 50%; /* Adjust width to 50% of the page */
    background-color: #4CAF50; /* Green background */
    color: white;
    text-align: center;
    padding: 15px 10px;
    font-size: 16px;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    border-radius: 5px; /* Rounded corners */
}

.popup-top.error {
    background-color: #f44336; /* Red background for errors */
}

.popup-top .close-top-btn {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: white;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.popup-top .close-top-btn:hover {
    color: #ddd;
}


       
    </style>
    

    <link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,300i,400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

    <script src="assets/js/jquery-3.2.1.slim.min.js"></script>
  
</head>

<body>

    <header class="header-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="logo">
                        <a href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#" id="caste-link">Category</a></li>
                <li><a href="#" id="dept-link">Department</a></li>
                <li><a href="#" id="all-link">All Students</a></li>
            </ul>
        </aside>
      
<div id="replaceResult"></div>

        <main class="content" id="main-content">
            <h1>Welcome to the Dashboard</h1>
            <p>This is the main content area.</p>
        </main>
        <form id="replaceWordForm">
    <h2>Replace Word in Database</h2>
    <div class="form-group">
        <label for="search_word">Word to Replace:</label>
        <input type="text" id="search_word" name="search_word" placeholder="Enter the word to replace" required>
    </div>
    <div class="form-group">
        <label for="replace_word">Replacement Word:</label>
        <input type="text" id="replace_word" name="replace_word" placeholder="Enter the replacement word" required>
    </div>
    <button type="submit">Replace</button>
</form>

<div id="popupTop" class="popup-top">
    <span id="popupMessageTop"></span>
    <button class="close-top-btn">&times;</button>
</div>





    </div>
 

   


    <script>
        var casteData = <?php echo json_encode($casteData, JSON_PRETTY_PRINT); ?>;
        var deptData = <?php echo json_encode($deptData, JSON_PRETTY_PRINT); ?>;
        var allData = <?php echo json_encode($allData, JSON_PRETTY_PRINT); ?>;
        var yearData = <?php echo json_encode($yearData, JSON_PRETTY_PRINT); ?>;

        function generateCasteTable(data) {
            var table = "<table>";
            table += "<tr><th>Caste</th><th>Total Students</th><th>Boys</th><th>Girls</th></tr>";
            data.forEach(function(row) {
                table += "<tr>";
                table += "<td>" + row.cast + "</td>";
                table += "<td>" + row.total_students + "</td>";
                table += "<td>" + row.boys + "</td>";
                table += "<td>" + row.girls + "</td>";
                table += "</tr>";
            });
            table += "</table>";
            return table;
        }

        function generateDeptTable(data) {
            var table = "<table>";
            table += "<tr><th>Department</th><th>Total Students</th><th>Boys</th><th>Girls</th></tr>";
            data.forEach(function(row) {
                table += "<tr>";
                table += "<td>" + row.division + "</td>";
                table += "<td>" + row.total_students + "</td>";
                table += "<td>" + row.boys + "</td>";
                table += "<td>" + row.girls + "</td>";
                table += "</tr>";
            });
            table += "</table>";
            return table;
        }

        function generateYearTable(data) {
            var table = "<table>";
            table += "<tr><th>Class</th><th>Total Students</th><th>Boys</th><th>Girls</th></tr>";
            data.forEach(function(row) {
                table += "<tr>";
                table += "<td>" + row.class + "</td>";
                table += "<td>" + row.total_students + "</td>";
                table += "<td>" + row.boys + "</td>";
                table += "<td>" + row.girls + "</td>";
                table += "</tr>";
            });
            table += "</table>";
            return table;
        }

        function generateAllTable(data) {
            var table = "<table>";
            table += "<tr><th>Total Students</th><th>Boys</th><th>Girls</th></tr>";
            if (data.length > 0) {
                table += "<tr>";
                table += "<td>" + data[0].total_students + "</td>";
                table += "<td>" + data[0].boys + "</td>";
                table += "<td>" + data[0].girls + "</td>";
                table += "</tr>";
            }
            table += "</table>";
            return table;
        }

        document.getElementById('caste-link').addEventListener('click', function (e) {
            e.preventDefault();
            var tableHTML = generateCasteTable(casteData);
            document.getElementById('main-content').innerHTML = "<h2>Caste Data</h2>" + tableHTML;
        });

        document.getElementById('dept-link').addEventListener('click', function (e) {
            e.preventDefault();
            var tableHTML = generateDeptTable(deptData);
            document.getElementById('main-content').innerHTML = "<h2>Department Data</h2>" + tableHTML;
        });

        document.getElementById('all-link').addEventListener('click', function (e) {
            e.preventDefault();
            var tableHTML = generateAllTable(allData);
            document.getElementById('main-content').innerHTML = "<h2>All Students Data</h2>" + tableHTML;
        });

        // Default view
        document.getElementById('main-content').innerHTML = "<h2>Year Data</h2>" + generateYearTable(yearData);
    </script>
    <script>
    function showPopupTop(message, isError = false) {
        var popup = document.getElementById('popupTop');
        var popupMessage = document.getElementById('popupMessageTop');
        var closeBtn = document.querySelector('.close-top-btn');

        // Set message and style
        popupMessage.textContent = message;
        popup.classList.toggle('error', isError);
        popup.style.display = 'block';

        // Hide the popup after 5 seconds automatically
        setTimeout(function () {
            popup.style.display = 'none';
        }, 5000);

        // Close button to hide the popup manually
        closeBtn.onclick = function () {
            popup.style.display = 'none';
        };
    }

    // AJAX submission with notification
    document.getElementById('replaceWordForm').addEventListener('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        fetch('replace_word.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Show success popup
            showPopupTop(data, false);
        })
        .catch(error => {
            // Show error popup
            showPopupTop('Error: ' + error.message, true);
        });
    });
</script>



</body>

</html>
