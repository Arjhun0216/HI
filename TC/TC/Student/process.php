<?php
ob_start();
// Include pdf_mc_table.php, not fpdf17/fpdf.php
include('pdf_mc_table.php');
include('pala.php');

// Make new object
$pdf = new PDF_MC_Table();
$pdf->AddFont('pala', '', 'pala.php');
$pdf->AddFont('palatino-linotype-bold', '', 'palatino-linotype-bold.php');
$pdf->SetFont('times', '', 16);

// Add page, set font
$pdf->AddPage();

$leftPadding = 20; // Adjust as needed
$pdf->Cell($leftPadding);
// Set width for each column (6 columns)
$pdf->SetWidths(Array(10, 85, 90));

// Set alignment
$pdf->SetAligns(Array('C', 'L', 'L'));
// Set font styles for each column (index-based)
$pdf->SetFontStyles(Array('', '', ''));

$pdf->Image('bimage.jpg', 15, 50, 180, 200);

// Set line height. This is the height of each line, not rows.
$pdf->SetLineHeight(6.4);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['regno'])) {
    $selectedRegnos = $_POST['regno']; // Get selected register numbers

    // Database connection setup
    $servername = "localhost";
    $username = "root";
    $password = "1711104@gceb!!";
    $dbname = "db_admission";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $currentYear = date("Y");
$currentMonth = date("m");

// Determine the `lyear` value based on the current month
if ($currentMonth >= 7) {
    $lyear = $currentYear + 1;
} else {
    $lyear = $currentYear - 1;
}

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($selectedRegnos as $regno) {

        $sql = "UPDATE STUDENT SET tcyear='$currentYear', lyear='$lyear' WHERE regno='$regno'";
        mysqli_query($conn, $sql);



        // Fetch student details based on regno
        $sql = "SELECT * FROM STUDENT WHERE regno = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $regno);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $pdf->Image('logo.jpg', -6, -5);
            $pdf->Image('gceblogo.jpg', 167, 5);
            $pdf->SetFont('times', 'B', '16');
            $pdf->SetXY(62, 3);
            $pdf->Cell(10, 15, 'GOVERNMENT OF TAMILNADU', 0, 0, 'L', false);
            $pdf->SetFont('times', 'B', '16');
            $pdf->SetXY(45, 10);
            $pdf->Cell(10, 15, 'DEPARTMENT OF TECHNICAL EDUCATION', 0, 0, 'L', false);
            $pdf->SetFont('times', 'U', '14');
            $pdf->SetXY(75, 20);
            $pdf->Cell(10, 15, 'TRANSFER CERTIFICATE', 0, 0, 'L', false);
            $pdf->SetFont('times', 'B', '12');
            $pdf->SetXY(65, 25);
            $pdf->Cell(10, 15, 'Roll No:', 0, 0, 'L', false);
            $pdf->SetFont('times', 'B', '12');
            $pdf->SetXY(81, 25);
            $pdf->Cell(10, 15, $row['admno'] . $row['addept'] . $row['adyear'], 0, 0, 'L', false);
            $pdf->SetFont('times','B','12');
            $pdf->SetXY(105,25);
            $pdf->Cell(10,15,' / ',0,0,'L',false);
            $pdf->SetFont('times','B','12');
            $pdf->SetXY(108,20);
            $pdf->Cell(10,25,'UMIS No:',0,0,'L',false);
            $pdf->SetFont('times','B','12');
            $pdf->SetXY(127,25);
            $pdf->Cell(10,15,$row['umis'],0,0,'L',false);
            $pdf->SetFont('pala', '', '12');
            $pdf->SetXY(18, 35);
            $pdf->Cell(10, 15, 'Reg No:', 0, 0, 'L', false);
            $pdf->SetFont('pala', '', '12');
            $pdf->SetXY(34, 35);
            $pdf->Cell(10, 15, $row['regno'], 0, 1, 'L', false);
            $pdf->SetFont('pala', '', '12');
            $pdf->SetXY(145,35);
            $pdf->Cell(10,15,'T.C. No:',0,0,'L',false);
            $pdf->SetXY(170,270);
            $pdf->Cell(10,20,'PRINCIPAL');
            if ($currentMonth >= 7) {
                $pdf->SetFont('pala', '', 12);
                $pdf->SetXY(161, 33);
                $pdf->Cell(10, 20, $row['tcno'] . '/' . $row['tcyear'] . '-' . $row['lyear'], 0, 1, 'L', false);
            } else {
                $pdf->SetFont('pala', '', 12);
                $pdf->SetXY(166, 33);
                $pdf->Cell(10, 20, $row['tcno'] . '/' . $row['lyear'] . '-' . $row['tcyear'], 0, 1, 'L', false);
            }
            
            $data2 = array(
                array("1", "Name of the Institution","Government College of Engineering Bargur, Krishnagiri - 635 104"),
                array("2", "Name of the Student", $row['sname']),
                array("3", "Father (or) Mother/Guardian Name", $row['gname']),
                array("4", "Nationality & Religion", $row['nation'] . ' - ' . $row['religion']),
                array("5", "Community & Caste", $row['community']),
                array("6", "Gender", $row['gender']),
                array("7", "Date of Birth", formattedDate($row['dob'])),
                array("8", "Class in which the student was studying at the time of leaving Year/Semester","Fourth Year (VIII Semester)"),
                array("9", "Branch", $row['grad'] . '-' . $row['division']),
                array("10", "Date of Admission", formattedDate($row['doa'])),
                array("11", "Whether qualified for promotion to higher class", $row['highclass']),
                array("12", "Whether the student has paid all the fees due to the Institution","Yes"),
                array("13", "Whether the student was in receiver of any scholarship or any educational concessions"),
                array("14", "Whether the student has undergone medical inspection during the year     [First or Repeat to be specified]","Yes"),
                array("15", "Medium of Instruction", $row['medium']),
                array("16", "Date on which the student actually left the Institution", "09.04.2025"),
                array("17", "Date on which the student applied for the transfer certificate"),
                array("18", "Date of transfer certificate"),
                array("19", "Academic year",$row['acdyear'].'-2025'),
                array("20", "Conduct and Character of the student")
            );
          
            $pdf->SetXY(10, 55);
            $leftMargin = 15; // Adjust as needed
            $pdf->SetLeftMargin($leftMargin);

            $pdf->SetXY(10, 47); // Initial Y position for table data
            $pdf->SetLeftMargin(15); // Set left margin as needed
            
            foreach ($data2 as $items) {
        // Calculate starting Y position
        $startY = $pdf->GetY();
    
        // Column 1 (ID)
        $pdf->SetFont('pala', '', 12);
        $pdf->Cell(10, 6.5, $items[0], 0, 0, 'C');// Fixed height for ID column (no wrapping needed)
        
        $pdf->SetXY(19, $startY);
        $pdf->SetFont('pala', '', 12);
        $pdf->Cell(7, 6.5,".", 0, 0, 'C');
        
        // Column 2 (Label) with text wrapping
        $pdf->SetFont('palatino-linotype-bold', '', 12);
        $pdf->MultiCell(80, 6.5, $items[1], 0, 'L'); // Wrap text in Label column
      
        // Calculate new Y position after Column 2's MultiCell
        $column2EndY = $pdf->GetY();

        $pdf->SetXY(107, $startY);
        $pdf->SetFont('pala', '', 12);
        $pdf->Cell(5, 6.5,":", 0, 0, 'C');
        // Set Y position back to start for Column 3 (Value) alignment
        $pdf->SetXY(115, $startY);
    
        // Column 3 (Value) with text wrapping
        $pdf->SetFont('pala', '', 12);
        $pdf->MultiCell(90, 6.5, $items[2], 0, 'L'); // Wrap text in Value column
    
        // Calculate new Y position after Column 3's MultiCell
        $column3EndY = $pdf->GetY();
    
        // Determine the max Y position from Column 2 and Column 3 to set row height
        $rowEndY = max($column2EndY, $column3EndY);
    
        // Set Y position to the next row based on the tallest cell in the row
        $pdf->SetY($rowEndY);
    }
            

           /* $pdf->SetFont('pala', '', '14');
            $pdf->SetXY(155, 265);
            $pdf->Cell(10, 20, 'Principal', 0, 0, 'L', false);
            $pdf->SetFont('pala', '', '14');
            $pdf->SetXY(130, 270);
            $pdf->Cell(10, 20, 'Government College of Engineering', 0, 0, 'L', false);
            $pdf->SetFont('pala', '', '14');
            $pdf->SetXY(150, 275);
            $pdf->Cell(10, 20, 'BARGUR-635 104', 0, 0, 'L', false);*/

            // Add page for the next student if there are more
            if ($regno !== end($selectedRegnos)) {
                $pdf->AddPage();
            }
        } else {
            echo "No student found for Register No. $regno<br>";
        }
    }

    ob_end_clean();

    // Combine PDFs and set output headers
    $filename = "TC_" . implode("_", $selectedRegnos) . ".pdf";
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');

    $pdf->Output('D', $filename);
} else {
    echo 'Error: Invalid request';
}

function formattedDate($date) {
    if (!$date) {
        return 'N/A'; // Return a default value or handle appropriately
    }

    $dateObj = DateTime::createFromFormat('Y-m-d', $date);
    if (!$dateObj) {
        return 'Invalid Date'; // Handle invalid date formats
    }

    $day = $dateObj->format('d');
    $month = $dateObj->format('m');
    $year = $dateObj->format('Y');
    
    $monthNames = [
        '01' => 'January', '02' => 'February', '03' => 'March',
        '04' => 'April', '05' => 'May', '06' => 'June',
        '07' => 'July', '08' => 'August', '09' => 'September',
        '10' => 'October', '11' => 'November', '12' => 'December'
    ];
    
    $dayNames = [
        '01' => 'First', '02' => 'Second', '03' => 'Third', '04' => 'Fourth', '05' => 'Fifth',
        '06' => 'Sixth', '07' => 'Seventh', '08' => 'Eighth', '09' => 'Ninth', '10' => 'Tenth',
        '11' => 'Eleventh', '12' => 'Twelfth', '13' => 'Thirteenth', '14' => 'Fourteenth',
        '15' => 'Fifteenth', '16' => 'Sixteenth', '17' => 'Seventeenth', '18' => 'Eighteenth',
        '19' => 'Nineteenth', '20' => 'Twentieth', '21' => 'Twenty-first', '22' => 'Twenty-second',
        '23' => 'Twenty-third', '24' => 'Twenty-fourth', '25' => 'Twenty-fifth', '26' => 'Twenty-sixth',
        '27' => 'Twenty-seventh', '28' => 'Twenty-eighth', '29' => 'Twenty-ninth', '30' => 'Thirtieth',
        '31' => 'Thirty-first'
    ];
    $yearInWords = numberToWords($year);

    $formattedDate = $day . '.' . $month . '.' . $year.PHP_EOL.' (' . $dayNames[$day] . ' ' . $monthNames[$month] . ' ' . $yearInWords . ')';
    return $formattedDate;
}

function numberToWords($number) {
    $words = [
        1999 => 'Nineteen Ninety Nine',2000 => 'Two Thousand',2001 => 'Two Thousand One',2002 => 'Two Thousand Two',2003 => 'Two Thousand Three',
        2004 => 'Two Thousand Four', 2005 => 'Two Thousand Five', 2006 => 'Two Thousand Six', 2007 => 'Two Thousand Seven',
        2008 => 'Two Thousand Eight',2009 => 'Two thousand Nine',2010 => 'Two Thousand Ten',2011 => 'Two Thousand Eleven',
        2012 => ' Two Thousand Twelve',2013 => 'Two Thousand Thirteen',2014 => ' Two Thousand fourteen',2015 => 'Two Thousand Fifteen',
        2016 => 'Two Thousand Sixteen ',2017 => 'Two Thousand Seventeen',2018 => 'Two Thousand Eighteen',2019 => 'Two Thousand Nineteen',2020 => 'Two Thousand Twenty',
        2021 => 'Two Thousand Twenty One',2022 => 'Two Thousand Twenty Two',2023 => 'Two Thousand Twenty Three ',2024 => 'Two Thousand Twenty Four',2025 => 'Two Thousand Twenty Five',
        2026 => 'Two Thousand Twenty Six',2027 => 'Two Thousand Twenty seven',2028 => 'Two Thousand Twenty Eight',2029 => 'Two Thousand Twenty Nine',2030 => 'Two Thousand Twenty Thirty',
        2031 => 'Two Thousand ThirtyOne',2032 => 'Two Thousand ThirtyTwo',2033 => 'Two Thousand ThirtyThree',2034 => 'Two Thousand ThirtyFour',2035 => 'Two Thousand ThirtyFive',
        2036 => 'Two Thousand ThirtySix',2037 => 'Two Thousand ThirtySeven',2038 => 'Two Thousand ThirtyEight',2039 => 'Two Thousand ThirtyNine',2040 => ' forty',
        2041 => 'Two Thousand FortyOne',2042 => 'Two Thousand FortyTwo',2043 => 'Two Thousand FortyThree',2044 => 'Two Thousand FortyFour',2045 => 'Two Thousand FortyFive',
        2046 => 'Two Thousand FortySix',2047 => 'Two Thousand FortySeven',2048 => 'Two Thousand FortyEight',2049 => 'Two Thousand FortyNine',2050 => 'Two Thousand Fifty',

    
    ];
    if ($number < 2100) {
        return $words[$number];
    }

   
    return $number;
}
?>
