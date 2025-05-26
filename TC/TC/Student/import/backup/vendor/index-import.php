<?php
// Include PHPExcel library
require_once 'PHPOffice/PHPExcel/Classes/PHPExcel.php';

// Database connection
$mysqli = new mysqli("localhost", "root", "1711104@gceb!!", "db_admission");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$message = ""; // Placeholder for messages

if (isset($_POST['submit'])) {
    $file = $_FILES['excel_file']['tmp_name'];

    if ($file) {
        try {
            // Load Excel File
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheet = $objPHPExcel->getActiveSheet();

            $insertedRows = 0;
            $duplicateEntries = [];

            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                if ($rowIndex == 1) continue; // Skip header row

                $data = [];
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(FALSE);

                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getFormattedValue();
                }

                // Convert date columns
                $dateColumn = date('Y-m-d', strtotime($data[7])); // DOB
                $dateCol = date('Y-m-d', strtotime($data[11])); // DOA

                // Check for duplicate entries
                $checkQuery = "SELECT regno, tcno, umis FROM student WHERE regno = ? OR tcno = ? OR umis = ?";
                $stmt = $mysqli->prepare($checkQuery);
                $stmt->bind_param("sss", $data[0], $data[1], $data[13]);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($existing = $result->fetch_assoc()) {
                        $duplicateEntries[] = trim("RegNo: {$existing['regno']}, TCNo: {$existing['tcno']}, UMIS: {$existing['umis']}", " ,");
                    }
                } else {
                    // Insert Data
                    $query = "INSERT INTO student (regno, tcno, admno, sname, gname, religion, gender, dob, division, grad, cast, doa, class, umis) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $mysqli->prepare($query);
                    $stmt->bind_param("ssssssssssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $dateColumn, $data[8], $data[9], $data[10], $dateCol, $data[12], $data[13]);

                    if ($stmt->execute()) {
                        $insertedRows++;
                    }
                }
            }

            // Display appropriate messages
            if (!empty($duplicateEntries)) {
                $message = '<div class="alert alert-danger"><strong>Duplicate Entries Found:</strong><br>' . implode("<br>", array_filter($duplicateEntries)) . '</div>';
            } elseif ($insertedRows > 0) {
                $message = '<div class="alert alert-success text-center"><strong>Data Successfully Imported</strong></div>';
            }
        } catch (Exception $e) {
            $message = '<div class="alert alert-danger">Error reading file: ' . $e->getMessage() . '</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">No file uploaded.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    
    <!--============================== Required meta tags ===========================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--============================= Fonts =======================================-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,300i,400,700" rel="stylesheet">

    <!--============================= CSS =======================================-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="assets/js/jquery-3.2.1.slim.min.js"></script>

    <title>GCEB TC</title>
    <link rel="shourtcut icon" type="image/png" href="assets/img/favicon.png">



<header class="header-area" >
    <div class="container-fluid"> <!-- Changed to container-fluid for full width -->
        <div class="row">
            <div class="col-md-12"> <!-- Full width column -->
                <div class="logo">
                    <a href="#">
                        <i class="fa"></i>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


    <!--================= Header-area ======================-->
    <div class="header-are header-absoulate">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="logo">
                        <a href="">
                           

                            <span><span id="na"></span></span>
                        </a>
                    </div>
                </div>
    <!--================== Main menu-area ====================-->
                <div class="col-md-7">
                    <div class="main-menu">
                        <?php include('component/menu.php'); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--======================= Slide-area =======================-->
    <div class="welcome-area">
        <div class="owl-carousel slider-content">
            <div class="single-slider-item slider-bg-1">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>








    <title>Upload Excel File</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 450px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .btn-primary {
            background: #2c3e50;
            border: none;
        }
        .btn-primary:hover {
            background: #4ca1af;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Upload Excel File</h2>
    
    <?php echo $message; ?> <!-- Show Messages -->

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" name="excel_file" class="form-control" accept=".xls,.xlsx" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Upload & Save</button>
    </form>
</div>

</body>
</html>
