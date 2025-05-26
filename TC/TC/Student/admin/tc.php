<?php
ob_start();
//include pdf_mc_table.php, not fpdf17/fpdf.php
include('pdf_mc_table.php');

//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();
$pdf->SetFont('times','B',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(10,90,90));
$verticalAligns = [Array('M','M','M')];

//set alignment
$pdf->SetAligns(Array('C','L','C'));
// Set font styles for each column (index-based)
$pdf->SetFontStyles(Array('B', 'B', ''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(7);
$regno=$_GET['regno'];
$query="SELECT * FROM STUDENT WHERE regno=:regno";
$count=$dbo->prepare($query);
$count->BindParam(":regno",$regno,PDO::PARAM_INT,20);
if($count->execute()){
    $row=$count->fetch(PDO::FETCH_OBJ);
    $pdf->Image('logo.jpg',0,0);
    $pdf->SetFont('times','B','18');
    $pdf->SetXY(70,8);
    $pdf->Cell(10,20,'GOVERNMENT OF TAMILNADU',0,0,'L',false);
    $pdf->SetFont('times','B','18');
    $pdf->SetXY(50,15);
    $pdf->Cell(10,20,'DEPARTMENT OF TECHNICAL EDUCATION',0,0,'L',false);
    $pdf->SetFont('times','U','16');
    $pdf->SetXY(60,25);
    $pdf->Cell(10,20,'TRANSFER AND CONDUCT CERTIFICATE',0,0,'L',false);
    $pdf->SetFont('times','B','14');
    $pdf->SetXY(90,30);
    $pdf->Cell(10,20,'Admission No:',0,0,'L',false);
    $pdf->SetFont('times','','14');
    $pdf->SetXY(10,40);
    $pdf->Cell(10,20,'Roll No:',0,0,'L',false);
    $pdf->SetFont('times','','14');
    $pdf->SetXY(32,40);
    $pdf->Cell(10,20,$row->regno,0,1,'L',false);
    $pdf->SetFont('times','','14');
    $pdf->SetXY(155,40);
    $pdf->Cell(10,20,'T.C. No:',0,0,'L',false);

    $data2=array(
        array(
			 "1",
            "Name of the Institution",
            $row->college
            
        ),
        array(
            "2",
            "Name of the Student",
            $row->sname

                  
        ),
        array(
            "3",
            "Father (or) Mother/Gurdian",
            $row->gname
        ),
        array(
            "4",
            "Nationality & Religion",
            $row->nation.'-'.$row->religion
        ),
        array(
            "5",
            "Community&Cast",
            $row->community.'-'.$row->cast
        ),
        array(
            "6",
            "Date of Birth",
            $row->dob
        ),
        array(
            "7",
            "Class in which the student was studying at the time of leaving Year/Semester",
			$row->lastyear
        ),
		array(
            "8",
            "Branch",
            $row->grad.'-'.$row->division
        ),
		array(
            "9",
            "Date of Admission",
            $row->doa
        ),
		array(
            "10",
            "Whether qualified for promotion to higher class",
            $row->highclass
        ),
		array(
            "11",
            "Whether the student has paid all the fees due to the Institution",
            $row->fees
        ),
		array(
            "12",
            "Whether the Student was in receiver of any Scholarship or any educational concessions",
            $row->scholarship
        ),
		array(
            "13",
            "Whether the Student has undergone medical inspection during the year Fisrt or Repeat to be specified",
            $row->medical
        ),
		array(
            "14",
            "Medium of Instruction",
            $row->medium
        ),
		array(
            "15",
            "Date on Which the Student actually left the Institution",
            $row->lid
        ),
		array(
            "16",
            "Date on which the student applied for the transfer Certificate",
            $row->tcapply
        ),
		array(
            "17",
            "Date of transfer Certificate",
            $row->tcd
        ),
		array(
            "18",
            "Conduct and Character of the Student",
            $row->conduct
        ),
		array(
            "19",
            "Academic year",
            $row->medium
        ),
		

    );
	$pdf->SetXY(10,55);

	foreach ($data2 as $item) {
        //$pdf->Row($item);
		 // Set font for ID column
		// $pdf->SetFont('times','B',14);

		$pdf->Row($item);
		

       
    }
	$pdf->SetFont('times','','14');
    $pdf->SetXY(160,260);
    $pdf->Cell(10,20,'PRINCIPAL',0,0,'L',false);
	/*$pdf->SetFont('times','','14');
    $pdf->SetXY(150,270);
    $pdf->Cell(10,20,'Government College of Engineering',0,0,'L',false);
	$pdf->SetFont('times','','14');
    $pdf->SetXY(155,275);
    $pdf->Cell(10,20,'BARGUR-635 104',0,0,'L',false);*/

}


ob_end_clean();
//output the pdf
$pdf->Output();

?>





