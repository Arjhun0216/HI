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

// Fetch total number of students
$total_students_query = "SELECT COUNT(*) as total FROM student";
$total_students_result = $conn->query($total_students_query);
$total_students = $total_students_result->fetch_assoc()['total'];

// Fetch number of male students
$male_students_query = "SELECT COUNT(*) as total FROM student WHERE gender = 'Male'";
$male_students_result = $conn->query($male_students_query);
$male_students = $male_students_result->fetch_assoc()['total'];

// Fetch number of female students
$female_students_query = "SELECT COUNT(*) as total FROM student WHERE gender = 'Female'";
$female_students_result = $conn->query($female_students_query);
$female_students = $female_students_result->fetch_assoc()['total'];

// Fetch number of students by caste
$caste_query = "SELECT cast, COUNT(*) as total FROM student GROUP BY cast";
$caste_result = $conn->query($caste_query);
$caste_data = [];
while ($row = $caste_result->fetch_assoc()) {
    $caste_data[$row['cast']] = $row['total'];
}

// Fetch total student details
$total_details_query = "SELECT sname, cast FROM student";
$total_details_result = $conn->query($total_details_query);
$total_students_details = [];
while ($row = $total_details_result->fetch_assoc()) {
    $total_students_details[] = $row;
}

// Fetch male students' details
$male_details_query = "SELECT sname, cast FROM student WHERE gender = 'Male'";
$male_details_result = $conn->query($male_details_query);
$male_students_details = [];
while ($row = $male_details_result->fetch_assoc()) {
    $male_students_details[] = $row;
}

// Fetch female students' details
$female_details_query = "SELECT sname, cast FROM student WHERE gender = 'Female'";
$female_details_result = $conn->query($female_details_query);
$female_students_details = [];
while ($row = $female_details_result->fetch_assoc()) {
    $female_students_details[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>School Dashboard</title>
    <style>
        body{
            background-color:#D3D3D3;
        }
        h1 {
            text-align: center;
            color: #333;
            font-family: 'times-new-roman';
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            font-family: 'times-new-roman';
        }
        .card {
            font-family: 'times-new-roman';
            background-color: #4caf50;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .card-male {
            font-family: 'times-new-roman';
            background-color: yellow;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .card-female {
            font-family: 'times-new-roman';
            background-color: pink;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .card h2, .card-male h2, .card-female h2 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .card p, .card-male p, .card-female p {
            font-size: 2em;
            margin: 0;
            color: #666;
        }
        .caste-list {
            margin-top: 20px;
        }
        .caste-list h2 {
            color: #333;
        }
        .caste-list ul {
            list-style: none;
            padding: 0;
        }
        .caste-list li {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            font-size: 2em;
        }
        .details {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .details h2 {
            margin-top: 0;
        }
        .details ul {
            list-style: none;
            padding: 0;
        }
        .details li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="dashboard">
            <div class="card" onclick="showDetails('total-details')">
                <h2>Total Students</h2>
                <p><?php echo $total_students; ?></p>
            </div>
            <div class="card-male" onclick="showDetails('male-details')">
                <h2>Male Students</h2>
                <p><?php echo $male_students; ?></p>
            </div>
            <div class="card-female" onclick="showDetails('female-details')">
                <h2>Female Students</h2>
                <p><?php echo $female_students; ?></p>
            </div>
        </div>
        <div class="caste-list">
            <h1>Students by Caste</h1>
            <ul>
                <?php 
                $colors = ['#ff9999', '#66b3ff', '#99ff99', '#ffcc99', '#c2c2f0', '#ffb3e6']; // Add more colors if needed
                $color_index = 0;
                foreach ($caste_data as $caste => $count): 
                    $color = $colors[$color_index % count($colors)];
                    $color_index++;
                ?>
                    <li style="background-color: <?php echo $color; ?>;">
                        <?php echo $caste . ': ' . $count; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="total-details" class="details">
            <h2>Total Students Details</h2>
            <ul>
                <?php foreach ($total_students_details as $student): ?>
                    <li><?php echo $student['sname']; ?> (<?php echo $student['cast']; ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="male-details" class="details">
            <h2>Male Students Details</h2>
            <ul>
                <?php foreach ($male_students_details as $student): ?>
                    <li><?php echo $student['sname']; ?> (<?php echo $student['cast']; ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="female-details" class="details">
            <h2>Female Students Details</h2>
            <ul>
                <?php foreach ($female_students_details as $student): ?>
                    <li><?php echo $student['sname']; ?> (<?php echo $student['cast']; ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script>
        function showDetails(id) {
            var details = document.querySelectorAll('.details');
            details.forEach(function(detail) {
                detail.style.display = 'none';
            });
            var selectedDetail = document.getElementById(id);
            selectedDetail.style.display = 'block';
        }
    </script>
</body>
</html>
