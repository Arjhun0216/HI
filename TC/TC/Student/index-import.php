<?php
// Include PHPExcel library
require_once 'import/vendor/PHPOffice/PHPExcel/Classes/PHPExcel.php';

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
                
                $id = $data[0]; // ID column
                $regno = $data[1]; // Register Number (previously first column)
                $tcno = $data[2]; // TC Number
                $umis = $data[14]; // Adjusted for new ID column
                $joining=$data[15];//Regular or Lateral Entry
                
                // Convert date columns
                $dateColumn = date('Y-m-d', strtotime($data[8])); // DOB
                $dateCol = date('Y-m-d', strtotime($data[12])); // DOA
                $acdyear = date('Y', strtotime($dateCol));

                // Check for duplicate entries
                $checkQuery = "SELECT id, regno, tcno, umis FROM student WHERE id = ? OR regno = ? OR tcno = ? OR umis = ?";
                $stmt = $mysqli->prepare($checkQuery);
                $stmt->bind_param("ssss", $id, $regno, $tcno, $umis);

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($existing = $result->fetch_assoc()) {
                        $duplicateEntry = [];
                
                        if (!empty($existing['regno'])) {
                            $duplicateEntry[] = "RegNo: {$existing['regno']}";
                        }
                        if (!empty($existing['tcno']) && $existing['tcno'] !== '0') {
                            $duplicateEntry[] = "TCNo: {$existing['tcno']}";
                        }
                        if (!empty($existing['umis'])) {
                            $duplicateEntry[] = "UMIS: {$existing['umis']}";
                        }
                
                        if (!empty($duplicateEntry)) {
                            $duplicateEntries[] = implode(", ", $duplicateEntry);
                        }
                    }
                }
                 else {
                    // Insert Data
                    $query = "INSERT INTO student (id, regno, tcno, admno, sname, gname, religion, gender, dob, division, grad, cast, doa, class, umis,acdyear,joining) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("sssssssssssssssss", $id, $regno, $tcno, $data[3], $data[4], $data[5], $data[6], $data[7], $dateColumn, $data[9], $data[10], $data[11], $dateCol, $data[13], $umis,$acdyear,$joining);


                    if ($stmt->execute()) {
                        $insertedRows++;
                    }
                }
            }

            // Display appropriate messages
           if (!empty($duplicateEntries) && count($duplicateEntries) < $insertedRows) {

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
    <title>GCEB TC - Upload Excel File</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">

    <style>
        body {
            background: linear-gradient(to right, #11998e, #38ef7d);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }

        .header-area {
            width: 100%;
            background: #01427a;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .logo img {
            height: 100px;
        }

        .container {
            max-width: 600px;
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-top: 160px;
        }

        .btn-primary, .btn-exit {
            background: #2c3e50;
            border: none;
            color: white; /* Ensures white text color */
            transition: background 0.3s;
        }

        .btn-primary:hover, .btn-exit:hover {
            background: #4ca1af;
        }

        .btn-exit {
            margin-top: 15px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header-area">
        <div class="logo">
            <img src="assets/img/gceb.png" alt="Logo">
        </div>
    </header>

    <!-- Upload Form -->
    <div class="container">
        <h2 class="mb-4">Upload Excel File</h2>

        <?php if (!empty($message)) { echo $message; } ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <input type="file" name="excel_file" class="form-control" accept=".xls,.xlsx" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Upload & Save</button>
        </form>

        <!-- Exit Button -->
        <button class="btn btn-exit w-100" onclick="window.location.href='index.php'">Exit</button>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
