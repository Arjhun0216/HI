<?php
ob_start();
//call main fpdf file
require "config.php";
require('fpdf.php');

//create new class extending fpdf class
class PDF_MC_Table extends FPDF {
    // variable to store widths and aligns of cells, and line height
    var $widths;
    var $aligns;
    var $lineHeight;
    var $fontStyles;

    //Set the array of column widths
    function SetWidths($w){
        $this->widths=$w;
    }

    //Set the array of column alignments
    function SetAligns($a){
        $this->aligns=$a;
    }

    //Set line height
    function SetLineHeight($h){
        $this->lineHeight=$h;
    }

    // Set font styles for each column
    function SetFontStyles($f) {
        $this->fontStyles = $f;
    }

    //Calculate the height of the row
/* function Row($data)
{
    // number of line
    $nb=0;
    
    // loop each data to find out the greatest line number in a row.
    for($i=0;$i<count($data);$i++){
        // NbLines will calculate how many lines needed to display text wrapped in specified width.
        // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    }
    
    // multiply number of lines with line height. This will be the height of the current row
    $h=$this->lineHeight * $nb;


	
    
    // Issue a page break first if needed
    $this->CheckPageBreak($h);
    
    // Draw the cells of the current row
    for($i=0;$i<count($data);$i++)
    {
        // width of the current column
        $w=$this->widths[$i];
        
        // alignment of the current column. if unset, make it left.
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

        // Font style of the current column
        $fontStyle = isset($this->fontStyles[$i]) ? $this->fontStyles[$i] : '';
        $this->SetFont('times', $fontStyle); // Set font style
        
        // Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        
        // Draw the border
        $this->Rect($x,$y,$w,$h);
        
        // Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        
        // Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    // Go to the next line
    $this->Ln($h);

}*/

function Row($data)
{
    // number of lines
    $nb = 0;
    
    // loop through each data to find out the greatest line number in a row.
    for ($i = 0; $i < count($data); $i++) {
        // NbLines will calculate how many lines needed to display text wrapped in specified width.
        // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
        $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
    }
    
    // Calculate the height of the row
    $h = $this->lineHeight * $nb;

    // Issue a page break first if needed
    $this->CheckPageBreak($h);
    
    // Draw the cells of the current row
    for ($i = 0; $i < count($data); $i++) {
        // width of the current column
        $w = $this->widths[$i];
        
        // alignment of the current column. if unset, make it left.
        $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

        // Font style of the current column
        $fontStyle = isset($this->fontStyles[$i]) ? $this->fontStyles[$i] : '';
        $this->SetFont('pala', $fontStyle); // Set font style
        
        // Save the current position
        $x = $this->GetX();
        $y = $this->GetY();
        
        // Draw the border
        $this->Rect($x, $y, $w, $h);

        // Calculate vertical alignment position
        $verticalOffset = ($h - $this->FontSize * $nb) / 2; // Calculate vertical offset
        $this->SetXY($x, $y); // Move Y position
        
        // Add padding at the bottom to prevent touching the bottom border
        $paddingBottom = 0; // Adjust as needed
        $this->MultiCell($w, $this->lineHeight, $data[$i], 0, $a, false, $paddingBottom);
        
        // Put the position to the right of the cell
        $this->SetXY($x + $w, $y);
    }
    // Go to the next line
    $this->Ln($h);
}
























    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //calculate the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
     

     var $defaultBottomMargin = -3; // Change this value as needed

     function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
         parent::__construct($orientation, $unit, $size);
       
  
         // Set bottom margin
         $this->SetMargins(10, 10, 10); // Left, top, right margins
         $this->SetAutoPageBreak(true, $this->defaultBottomMargin);
     }
     
 
}


ob_end_clean();
?>