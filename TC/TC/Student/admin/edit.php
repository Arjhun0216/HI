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
    $sname = "";
    $gname = "";
    $contact = "";
    $grad="";
    $address = "";
    $class = "";
    $shift = "";
    $gender = "";
    $blgroup = "";
    $division = "";
    $cast="";
    $religion="";
    $regno="";
    $dob="";
	$doa="";
					
    $esname = "";
    $egname = "";
    $econtact = "";
    $egrad="";
    $eaddress = "";
    $eclass = "";
    $eshift = "";
    $egender = "";
    $eblgroup = "";
    $edivision = "";
    $ereligion="";
    $ecast="";
    $eregno="";
    $edob="";
	$edoa="";

    $cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");


    $sql = "select * from student where id = ".$_GET['eid'];
    $table = mysqli_query($cn, $sql);
    $row = mysqli_fetch_assoc($table);
					
	if(isset($_POST['submit']))
	{
	$sname = $_POST['sname'];
	$gname = $_POST['gname'] ;
	$contact = $_POST['contact'];
	
	$address = $_POST['address'];
	$class = $_POST['class'];
	$shift = $_POST['shift'];
						
	if(isset($_POST['gender']))
	$gender = $_POST['gender'];
						
	$blgroup = $_POST['blgroup'];
	$division = $_POST['division'];
	$grad=$_POST['grad'];
    $religion=$_POST['religion'];		
	$cast=$_POST['cast'];
    $dob=$_POST['dob'];
	$doa=$_POST['doa'];	
    $regno=$_POST['regno'];			
    $er = 0;

    
						
    if($sname == "")
    {
        $er++;
        $esname = "*Required";
    }
    else
    {
        $sname = test_input($sname);
        if(!preg_match("/^[a-zA-Z ]*$/",$sname)){
            $er++;
            $esname = "*Only letters and white space allowed";
        }
    }

    if($gname == "")
    {
        $er++;
        $egname = "*Required";
    }
    else
    {
		$gname = test_input($gname);
		if(!preg_match("/^[a-zA-Z ]*$/",$gname)){
		$er++;
		$egname = "*Only letters and white space allowed";
        }
    }

    if($contact == "")
    {
        $er++;
        $econtact = "*Required";
    }
    else
    {
        $contact = test_input($contact);
        if(!preg_match("/^[+0-9]*$/",$contact)){
            $er++;
            $econtact = "*Only numbers are allowed";
        }
							
    }

       

        if($address == "")
        {
            $er++;
            $eaddress = "*Required";
        }

        if($class == "")
        {
            $er++;
            $eclass = "*Required";
        }

        if($shift == 0)
        {
            $er++;
            $eshift = "*Please select shift";
        }

        if (empty($gender))
        {
            $er++;
            $egender = "*Gender is required";
        } 
        else {
            $gender = test_input($gender);
        }

        if($blgroup == "")
        {
            $er++;
            $eblgroup = "*Required";
        }
        elseif(strlen($blgroup) > 3)
        {
            $er++;
            $eblgroup = "*Not more than 3 character";
        }
        
        else
        {
            $blgroup = test_input($blgroup);
            if(!preg_match("/^[a-zA-Z+-]*$/",$blgroup))
            {
                $er++;
                $eblgroup = "*Blood group not valid";
            }

        }

        if($division == 0)
        {
            $er++;
            $edivision = "*Please select Division";
        }
        if (empty($grad)) {
            $er++;
           $egrad = "*graduation is required";
         } else {
           $grad = test_input($grad);
         }
         if (empty($religion)) {
            $er++;
           $ereligion = "*religion is required";
         } else {
           $religion = test_input($religion);
         }
        
        if (empty($cast)) {
            $er++;
           $ecast = "*cast is required";
         } else {
           $cast = test_input($cast);
         }
        
         if($regno == "")
         {
             $er++;
             $eregno = "*Required";
         }
         else{
             $regno = test_input($regno);
             if(!preg_match("/^[+0-9]*$/",$regno)){
             $er++;
             $eregno = "*Only numbers are allowed";
             }
         }
         if($dob == "")
         {
             $er++;
             $edob = "*Required";
         }
         
         if($doa== "")
         {
             $er++;
             $edoa = "*Required";
         }
        if($er == 0)
        {
            $sql = "update student set sname = '".strip_tags($sname)."', 
            gname = '".strip_tags($gname)."',
            regno = '".strip_tags($regno)."',
            dob = '".strip_tags($dob)."',
            doa = '".strip_tags($doa)."',
            contact = '".strip_tags($contact)."',
            address = '".strip_tags($address)."',
            class = '".strip_tags($class)."',
            shift = '".strip_tags($shift)."' ,
            grad = '".strip_tags($grad)."' ,
            religion = '".strip_tags($religion)."' ,
            cast = '".strip_tags($cast)."' ,
            gender = '".strip_tags($gender)."',
            division = '".strip_tags($division)."' where id = ".$_GET['eid'];
            
            if(mysqli_query($cn, $sql))
            {
                print '<span class = "successMessage">Data update successfully</span>';
                $row['sname'] = "";
                $row['gname'] = "";
                $row['contact'] = "";
                $row['address'] = "";
                $row['class'] = "";
                $row['shift'] = "";
                $row['grad'] = "";
                $row['religion'] = "";
                $row['cast'] = "";
                $row['gender'] = "";
                $row['blgroup'] = "";
                $row['division'] = "";
                $row['regno'] = "";
                $row['dob'] = "";
                $row['doa'] = "";
            }
            else
            {
                print '<span>'.mysqli_error($cn).'</span>';
            }
        }
    }
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<div class="form-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 id="et">Edit the ID:
                        <?php print $_GET['eid'].', Name: '.$row["sname"]; ?>'s information</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <h5><label for="Regno" style="font-weight:bold;">Regno</label>
									    <span class="error"><?php print $eregno; ?></span></h5>
										<p><input type="text" name="regno" value="<?php print  $row['regno']; ?>"></p>
                                        <h5><label for="sname">Student name</label>
                                            <span class="error">
                                                <?php print $esname; ?></span></h5>
                                        <p><input type="text" name="sname" value="<?php print $row['sname']; ?>"></p>

                                        <h5><label for="gname">Gurdian name</label><span class="error">
                                                <?php print $egname; ?></span></h5>
                                        <p><input type="text" name="gname" value="<?php print $row['gname']; ?>"></p>

                                        <h5><label for="contact">contact</label><span class="error">
                                                <?php print $econtact; ?></span></h5>
                                        <p><input type="text" name="contact" value="<?php print $row['contact']; ?>"></p>

                                        <h5><label for="address">Address</label><span class="error">
                                                <?php print $eaddress; ?></span></h5>
                                        <p><textarea name="address"><?php print $row['address']; ?></textarea></p>
                                        <h5><label for="religion" style="font-weight:bold;">Religion</label></h5>
										<p><select name="religion" id="">
												
												<option   value="Hindu">Hindu</option>
												<option   value="Muslim">Muslim</option>
												<option  value="Christian">Christian</option>
											</select><span class="error">
												<?php print $ereligion; ?></span></p>
                                                <h5><label for="cast" style="font-weight:bold;">Caste</label></h5>
										<p><select name="cast" id="">
												
												<option   value="BC">BC</option>
												<option   value="MBC">MBC</option>
												<option  value="SC">SC</option>
												<option  value="ST">ST</option>

											</select><span class="error">
												<?php print $ecast; ?></span></p>
                                                <h5><label for="dob" style="font-weight:bold;">Date of Birth </label><span class="error">
										<?php print $edob; ?></span></h5>
										<p><input type="date" name="dob" value="<?php print $dob; ?>"></p>
                                    
                                </div>
                                <div class="col-md-12">
                                    
                                        <h5><label for="class">class</label><span class="error">
                                                <?php print $eclass; ?></span></h5>
                                        <p><input type="text" name="class" value="<?php print $row['class']; ?>"></p>

                                        <h5><label for="shift" style="font-weight:bold;">Degree</label></h5>
										<p><select name="shift" id="">
												
												<option value="Full-Time" >Full-Time</option>
												<option value="Part-Time ">Part-Time</option>
											</select><span class="error">
												<?php print $eshift; ?></span></p>

                                                <h5><label for="shift" style="font-weight:bold;">Degree</label></h5>
										<p><select name="grad" id="">

												<option value="B.E">UG</option>
												<option value="M.E ">PG</option>
											</select><span class="error">
												<?php print $egrad; ?></span></p>


                                        <h5><label for="gender">Gender</label></h5>
                                        <input type="radio" name="gender" value="male"><span>Male</span>
                                        <input type="radio" name="gender" value="female"><span>Female</span>
                                        <input type="radio" name="gender" value="others"><span>Others</span>
                                        <span class="error">
                                            <?php print $egender; ?></span>

                                        <h5><label for="blgroup">blood group</label><span class="error">
                                                <?php print $eblgroup; ?></span></h5>

                                        <p><input type="text" name="blgroup" value="<?php print $row['blgroup']; ?>"></p>

                                        <h5><label for="division" style="font-weight:bold;">Branch</label></h5>
										<p><select name="division" id="">
												
												<option value="Computer science Engineering ">Computer Science Engineering</option>
												<option value="Electrical and Electronic Engineering">Electrical and Electronic Engineering</option>
												<option value="Electronic and communication Engineering ">Electronic and Communication Engineering</option>
												<option value="Mechanical Engineering">Mechanical Engineering</option>
											</select><span class="error">
												<?php print $edivision; ?></span></p>
                                        <h5><label for="doa" style="font-weight:bold;">Admission date</label><span class="error">
										     <?php print $edoa; ?></span></h5>
										<p><input type="date" name="doa" value="<?php print$row['doa']; ?>"></p>        

                                        <p><input type="submit" name="submit" value="Save Change"></p>
                                  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
