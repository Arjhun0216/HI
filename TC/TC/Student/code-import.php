<?php
session_start();
include('dbconfig.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = 0;
        $msg = '';
        $hasError = false;

        foreach ($data as $row) {
            if ($count > 0) { // Skip the header row
                if (empty(array_filter($row))) {
                    // Skip empty row
                    continue;
                }

                $id = $row[0];
                $regno = trim($row[1]);
                $tcno = $row[2];
                $adno = $row[3];
                $name = $row[4];
                $fname = $row[5];
                $religion = $row[6];
                $gender = $row[7];

                if (is_numeric($row[8])) {
                    $dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->format('Y-m-d');
                } else {
                    $dob = date('Y-m-d', strtotime($row[8]));
                }

                $branch = $row[9];
                $deg = $row[10];
                $cast = $row[11];
                if (is_numeric($row[12])) {
                    $doa = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])->format('Y-m-d');
                } else {
                    $doa = date('Y-m-d', strtotime($row[12]));
                }

                $acdyear = date('Y', strtotime($doa));
                $class = $row[13];
                $umis = $row[14];

                // Check for duplicate entries in the database
                $duplicateIdCheck = mysqli_query($conn, "SELECT * FROM student WHERE id='$id'");
                $duplicateRegNoCheck = mysqli_query($conn, "SELECT * FROM student WHERE regno='$regno'");
                $duplicateTcNoCheck = mysqli_query($conn, "SELECT * FROM student WHERE tcno='$tcno'");

                if (mysqli_num_rows($duplicateIdCheck) > 0) {
                    $msg = 'Duplicate entry for id: ' . $id . ' at row ' . ($count + 1);
                    $hasError = true;
                    break;
                } elseif (mysqli_num_rows($duplicateRegNoCheck) > 0) {
                    $msg = 'Duplicate entry for regno: ' . $regno . ' at row ' . ($count + 1);
                    $hasError = true;
                    break;
                } elseif (mysqli_num_rows($duplicateTcNoCheck) > 0) {
                    $msg = 'Duplicate entry for tcno: ' . $tcno . ' at row ' . ($count + 1);
                    $hasError = true;
                    break;
                } else {
                    // No duplicates, proceed with insert
                    $studentQuery = "INSERT INTO student(id, regno, tcno, admno, sname, gname, religion, gender, dob, division, grad, cast, doa, acdyear, class, umis) 
                                     VALUES ('$id','$regno','$tcno','$adno','$name','$fname','$religion','$gender','$dob','$branch','$deg','$cast','$doa','$acdyear','$class','$umis')";

                    if (!mysqli_query($conn, $studentQuery)) {
                        $msg = 'Database Error: ' . mysqli_error($conn);
                        $hasError = true;
                        break;
                    }
                }
            }
            $count++;
        }

        // Redirect with message
        if ($hasError) {
            echo "<script>alert('$msg'); window.location.href='index-import.php';</script>";
            exit(0);
        } else {
            $_SESSION['message'] = 'Successfully Imported';
            header('Location: index-import.php');
            exit(0);
        }
    } else {
        echo "<script>alert('Invalid File'); window.location.href='index-import.php';</script>";
        exit(0);
    }
}
?>