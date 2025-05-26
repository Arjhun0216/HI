<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: index_login.php"); // Redirect to login if not logged in
    exit();
}
?>
<?php
                            $cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");

                            if(isset($_GET['regno'])) {
                                $regno = $_GET['regno'];
                                $query = "SELECT * FROM STUDENT WHERE regno='$regno'";
                                $query_run = mysqli_query($cn, $query);
                                if(mysqli_num_rows($query_run) > 0) {
                                    $row = mysqli_fetch_assoc($query_run);
                                    ?>
                                    <?php
                                } else {
                                    echo "<h4>No records found</h4>";
                                }
                            }
                            ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 ,shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
<style>
    .bold-label {
    font-weight: bold;
}
</style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="section-title">
                    <h3 id="et">Edit the Regno:
                        <?php print $_GET['regno'].', Name: '.$row["sname"]; ?>'s information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                                    <form action="" method="POST">
                                         <label for="regno" class="bold-label">Regno</label>
                                        <input type="text" name="regno" class="form-control" value="<?php echo $row['regno']; ?>" readonly>
                                         </br>
                                        <label for="college" class="bold-label">1.Name of the institution</label>
                                        <input type="text" name="college" class="form-control" value="<?php echo $row['college']; ?>" readonly>
                                        </br>
                                        <label for="sname" class="bold-label">2.Name of the Student</label>
                                        <input type="text" name="sname" class="form-control" value="<?php echo $row['sname']; ?>" readonly>
                                        </br>
                                        <label for="gname" class="bold-label">3.Father(or)Mother/Guardian</label>
                                        <input type="text" name="gname" class="form-control" value="<?php echo $row['gname']; ?>" readonly>
                                        </br>
                                        <label for="nation,religion" class="bold-label">4.Nationality&Religion</label>
                                        <input type="text" name="nation,religion" class="form-control" value="<?php echo $row['nation']; ?>-<?php echo $row['religion']; ?>" readonly>
                                        </br>
                                        <label for="community,cast" class="bold-label">5.Community&Cast</label>
                                        <input type="text" name="community,cast" class="form-control" value="<?php echo $row['community']; ?>-<?php echo $row['cast']; ?>" readonly>
                                        </br>
                                        <label for="dob" class="bold-label">6.Date of Birth</label>
                                        <input type="text" name="dob" class="form-control" value="<?php echo $row['dob']; ?>" readonly>
                                        </br>
                                        <label for="lastyear" class="bold-label">7.Class in Which the student was studying at the time of leaving Year/Semseter<span style="color: red;">*</span></label>
                                        <input type="text" name="lastyear" class="form-control"  style="border-color: black;" value="<?php echo $row['lastyear']; ?> "required>
                                        </br>
                                        <label for="grad,division" class="bold-label">8.Branch</label>
                                        <input type="text" name="grad,division" class="form-control" value="<?php echo $row['grad']; ?>-<?php echo $row['division']; ?>"readonly>
                                        </br>
                                        <label for="doa" class="bold-label">9.Date of Admission</label>
                                        <input type="text" name="doa" class="form-control" value="<?php echo $row['doa']; ?>"readonly>
                                        </br>
                                        <label for="highclass" class="bold-label">10.Whether qualified for promotion to higher class<span style="color: red;">*</span></label>
                                        <input type="text" name="highclass" class="form-control"  style="border-color: black;" value="<?php echo $row['highclass']; ?>">
                                        </br>
                                        <label for="fees" class="bold-label">11.Whether the student has paid all the fees due to the Institution<span style="color: red;">*</span></label>
                                        <select name="fees" class="form-control" style="border-color: black;">
                                          <option value="Yes" <?php if($row['fees'] == 'Yes') echo 'selected'; ?>>Yes</option>
                                          <option value="No" <?php if($row['fees'] == 'No') echo 'selected'; ?>>No</option>
                                        </select>
                                        </br>
                                        <label for="scholarship" class="bold-label">12.Whether the student was in recieved of any scholarship or any educational concessions<span style="color: red;">*</span></label>
                                        <select name="scholarship" class="form-control" style="border-color: black;">
                                          <option value="Yes" <?php if($row['scholarship'] == 'Yes') echo 'selected'; ?>>Yes</option>
                                          <option value="No" <?php if($row['scholarship'] == 'No') echo 'selected'; ?>>No</option>
                                        </select>
                                        </br>
                                        <label for="medical" class="bold-label">13.Whether the student has undergone medical inspection during in the year First or Repeated to be specified<span style="color: red;">*</span></label>
                                        <select name="medical" class="form-control" style="border-color: black;">
                                          <option value="Yes" <?php if($row['medical'] == 'Yes') echo 'selected'; ?>>Yes</option>
                                          <option value="No" <?php if($row['medical'] == 'No') echo 'selected'; ?>>No</option>
                                        </select>
                                        </br>
                                        <label for="medium" class="bold-label">14.Medium of Instruction</label>
                                        <input type="text" name="medium" class="form-control" value="<?php echo $row['medium']; ?>" readonly>
                                        </br>
                                        <label for="lid" class="bold-label">15.Date on which the student actucally left the instition <span style="color: red;">*</span></label>
                                        <input type="date" name="lid" class="form-control" style="border-color: black;" value="<?php echo $row['lid']; ?>">
                                        </br>
                                        <label for="tcapply" class="bold-label">16.Date on Which the student applied for Transfer Certificate <span style="color: red;">*</span></label>
                                        <input type="date" name="tcapply" class="form-control" style="border-color: black;" value="<?php echo $row['tcapply']; ?>">
                                        </br>
                                        <label for="tcd" class="bold-label">17.Date of Transfer Certificate<span style="color: red;">*</span></label>
                                        <input type="date" name="tcd" class="form-control" style="border-color: black;" value="<?php echo $row['tcd']; ?>">
                                        </br>
                                        <label for="conduct" class="bold-label">18.Conduct and Character of the Student<span style="color: red;">*</span></label>
                                        <input type="text" name="conduct" class="form-control" style="border-color: black;" value="<?php echo $row['conduct']; ?>" >
                                        <label for="leaveyear" class="bold-label">19.Acadmic Year<span style="color: red;">*</span></label>
                                        <input type="text" name="leaveyear" class="form-control" style="border-color: black;" value="<?php echo $row['leaveyear']; ?>" >
                                        <label for="tcyear" class="bold-label">20.TC Year<span style="color: red;">*</span></label>
                                        <input type="text" name="tcyear" class="form-control" style="border-color: black;" value="<?php echo $row['tcyear']; ?>" >
                                        <label for="status" class="bold-label">21.Status</label>
                                        <div>
                                        <?php $status = isset($row['status']) ? $row['status'] : ''; ?>
                                        <input type="radio" id="discontinue" name="status" value="Discontinue" <?php if(isset($row['status']) && $row['status'] == 'Discontinue') echo 'checked'; ?>>
                                        <label for="discontinue">Discontinue</label>
                                        <input type="radio" id="transfer" name="status" value="Transfer" <?php if(isset($row['status']) && $row['status'] == 'Transfer') echo 'checked'; ?>>
                                        <label for="transfer">Transfer</label>
                                        <input type="radio" id="none" name="status" value="None" <?php if(isset($row['status']) && $row['status'] == 'None') echo 'checked'; ?>>
                                        <label for="none">None</label>

                                        </div>
                                        </br>
                                       
                                        
                                        <!-- Other fields to edit -->
                                        
                                        <button type="submit" name="update" class="btn btn-primary">Submit</button>
                                    </form>
                                    
                                <?php
                                /*$cn = mysqli_connect("localhost", "root", "", "db_admission");*/

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
                                    $leaveyear = $_POST['leaveyear'];
                                    $tcyear = $_POST['tcyear'];
                                    $status = $_POST['status'];
                                    

                                    

                                    // Update query
                                    $query = "UPDATE STUDENT SET sname='$sname',lastyear='$lastyear',highclass='$highclass',fees='$fees',scholarship='$scholarship',medical='$medical',lid='$lid',tcapply='$tcapply',tcd='$tcd',conduct='$conduct',leaveyear='$leaveyear',tcyear='$tcyear',status='$status' WHERE  regno='$regno'";
                                    
                                    // Execute the query
                                    $query_run = mysqli_query($cn, $query);
                                    
                                    // Check if the query executed successfully
                                    if($query_run)
                                    {
                                        echo "UPDATED SUCCESSFULLY!";
                                        
                                        exit();
                                    }
                                    else
                                    {
                                        // If there's an error in the query execution, display the error
                                        echo "Error: " . mysqli_error($cn);
                                    }
                                }
                                ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
