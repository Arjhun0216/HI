<?php
session_start();
include('dbconfig.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = 0;
        $msg = '';
        foreach($data as $row)
        {
            if($count > 0)
            {
                $id = $row[0];
                $regno = $row[1];
                $tcno = $row[2];
                $adno=$row[3];
                $name=$row[4];
                $fname=$row[5];
                $religion=$row[6];
                $gender=$row[7];
                $dob=$row[8];
                $branch=$row[9];
                $deg=$row[10];
                
                // Check for duplicate entries
                $checkQuery = "SELECT * FROM student WHERE id='$id'";
                $checkResult = mysqli_query($conn, $checkQuery);

                if(mysqli_num_rows($checkResult) == 0)
                {
                    // No duplicate, proceed with insert
                    $studentQuery = "INSERT INTO student(id,regno,tcno,admno,sname,gname,religion,gender,dob,division,grad) VALUES ('$id','$regno','$tcno','$adno','$name','$fname','$religion','$gender','$dob','$branch','$deg')";
                    if(mysqli_query($conn, $studentQuery))
                    {
                        $msg = 'Successfully Imported';
                    }
                    else
                    {
                        $msg = 'Database Error: ' . mysqli_error($conn);
                        break;
                    }
                }
                else
                {
                    // Duplicate found
                    $msg = 'Duplicate entry for ID: ' . $id;
                    break;
                }
            }
            else
            {
                $count = 1;
            }
        }

        if($msg === 'Successfully Imported')
        {
            $_SESSION['message'] = $msg;
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = $msg;
            header('Location: index.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: index-import.php');
        exit(0);
    }
}
?>
