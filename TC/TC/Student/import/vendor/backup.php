<?php
require 'PHPOffice/PHPExcel/Classes/PHPExcel.php'; // Ensure the correct path

$host = 'localhost';  
$db = 'db_admission';  
$user = 'root';  
$pass = '';  

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // To display success/error messages

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['upload'])) {
    if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] != 0) {
        $message = '<div class="alert alert-danger">Error: No file uploaded or file is corrupt.</div>';
    } else {
        $file = $_FILES['excel_file']['tmp_name'];
        $fileType = $_FILES['excel_file']['type'];

        // Allowed file types
        $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if (!in_array($fileType, $allowedTypes)) {
            $message = '<div class="alert alert-warning">Invalid file format. Please upload an Excel file (.xls or .xlsx).</div>';
        } else {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $insertedRows = 0; // Count successful insertions
            
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                
                for ($row = 2; $row <= $highestRow; $row++) {  // Skip header row
                    $reg_no = trim($worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $TC_no = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $Ad_no = trim($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $Sname = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $Gname = trim($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $Religion = trim($worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    $gender = trim($worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    $Dob = trim($worksheet->getCellByColumnAndRow(7, $row)->getValue());
                    $Dept = trim($worksheet->getCellByColumnAndRow(8, $row)->getValue());
                    $Degree = trim($worksheet->getCellByColumnAndRow(9, $row)->getValue());
                    $Caste = trim($worksheet->getCellByColumnAndRow(10, $row)->getValue());
                    $Doa = trim($worksheet->getCellByColumnAndRow(11, $row)->getValue());
                    $class = trim($worksheet->getCellByColumnAndRow(12, $row)->getValue());
                    $Umis = trim($worksheet->getCellByColumnAndRow(13, $row)->getValue());

                    if (!empty($reg_no) && !empty($TC_no) && !empty($Sname) && !empty($Gname) && !empty($Religion) && !empty($gender) && !empty($Dob) && !empty($Dept) && !empty($Degree) && !empty($Caste) && !empty($Doa) && !empty($class) && !empty($Umis)) {
                        $stmt = $conn->prepare("INSERT INTO student (regno, tcno, admno, sname, gname, religion, gender, dob, division, grad, cast, doa, class, umis) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        if ($stmt === false) {
                            die("Prepare failed: " . $conn->error);
                        }
                        $stmt->bind_param("ssssssssssssss", $reg_no, $TC_no, $Ad_no, $Sname, $Gname, $Religion, $gender, $Dob, $Dept, $Degree, $Caste, $Doa, $class, $Umis);
                        
                        if ($stmt->execute()) {
                            $insertedRows++;
                        }
                    }
                }
            }

            if ($insertedRows > 0) {
                $message = '<div class="alert alert-success">Data successfully imported! <strong>' . $insertedRows . '</strong> rows inserted.</div>';
            } else {
                $message = '<div class="alert alert-warning">No data was imported. Please check your file.</div>';
            }
        }
    }
    
    // Prevent form resubmission on refresh
    echo "<script>window.location.href=window.location.pathname + '?success=1';</script>";
    exit();
}

if (isset($_GET['success'])) {
    $message = '<div class="alert alert-success">Data successfully imported!</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel File</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Upload Excel File</h2>
    
    <?php echo $message; ?> <!-- Show Success/Error Messages -->

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="excel_file" class="form-label">Choose Excel File:</label>
            <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xls,.xlsx" required>
        </div>
        <button type="submit" name="upload" class="btn btn-primary w-100">Upload & Save to Database</button>
    </form>
</div>

</body>
</html>
