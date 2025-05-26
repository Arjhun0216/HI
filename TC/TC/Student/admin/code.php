<?php
$cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");

if(isset($_POST['update']))
{
    $sname = $_POST['sname'];
    $regno = $_POST['regno'];
    $lastyear = $_POST['lastyear'];
    $highclass = $_POST['highclass'];
    $fees = $_POST['fees'];
    $scholarship = $_POST['scholarship'];
    $medical = $_POST['medical'];
    $lid = $_POST['lid'];
    $tcapply = $_POST['tcapply'];
    $tcd = $_POST['tcd'];
    $conduct = $_POST['conduct'];


    

    // Update query
    $query = "UPDATE STUDENT SET sname='$sname',lastyear='$lastyear',highclass='$highclass',fees='$fees',scholarship='$scholarship',medical='$medical',lid='$lid',tcapply='$tcapply',tcd='$tcd',conduct='$conduct' WHERE  regno='$regno'";
    $cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");

    // Execute the query
    $query_run = mysqli_query($cn, $query);
    
    // Check if the query executed successfully
    if($query_run)
    {
        echo "Updated successfully";
        header('location:search.php');
        exit();
    }
    else
    {
        // If there's an error in the query execution, display the error
        echo "Error: " . mysqli_error($cn);
    }
}
?>
