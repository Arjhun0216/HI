<!-- ===============================================
	**** A COMPLETE VALIDATE FORM WITH PHP ****
================================================ -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: index_login.php"); // Redirect to login if not logged in
    exit();
}
?>
<!-- ==============  PHP begin  =================-->
<?php
					$sname = "";
					$gname = "";
					$contact = "";
					$admno = "";
					$addept="";
					$adyear="";

					
					$address = "";
					$class = "";
					$shift = "";
					$gender = "";
					$blgroup = "";
					$division = "";
					$religion="";
					$community="";
					$cast="";
					$dob="";
					$doa="";
					$grad="";
					$regno="";
					$tcno = "";
					$tcyear = "";
					
					$esname = "";
					$egname = "";
					$econtact = "";
					
					$eaddress = "";
					$eclass = "";
					$eshift = "";
					$egender = "";
					$eblgroup = "";
					$edivision = "";
					$ereligion="";
					$ecommunity="";
					$ecast="";
					$edob="";
					$edoa="";
					$egrad="";
				    $eregno="";
					$etcno= "";
					$eadmno= "";
					$eaddept="";
					$eadyear="";
					$etcyear="";
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
					$religion=$_POST['religion'];
					
					$cast=$_POST['cast'];
					$dob=$_POST['dob'];
					$doa=$_POST['doa'];
					$grad=$_POST['grad'];
					$regno=$_POST['regno'];
					$tcno=$_POST['tcno'];
					$admno=$_POST['admno'];
					$addept=$_POST['addept'];
					$adyear=$_POST['adyear'];
					$tcyear=$_POST['tcyear'];
					



						
						$er = 0;
						if($tcno == "")
						{
							$er++;
							$etcno = "*Required";
						}
						else{
							$tcno = test_input($tcno);
							if(!preg_match("/^[+0-9]*$/",$tcno)){
							$er++;
							$etcno = "*Only numbers are allowed";
							}
						}
						$check_sql_tcno = "SELECT * FROM student WHERE tcno = '".mysqli_real_escape_string($cn, strip_tags($tcno))."'";
						$check_result_tcno = mysqli_query($cn, $check_sql_tcno);

						if(mysqli_num_rows($check_result_tcno) > 0) {
							$er++;
							$etcno = "T.C.No already exists.";
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
						$check_sql = "SELECT * FROM student WHERE regno = '".mysqli_real_escape_string($cn, strip_tags($regno))."'";
					$check_result = mysqli_query($cn, $check_sql);

					if(mysqli_num_rows($check_result) > 0) {
						$er++;
						$eregno = "Registration number already exists.";
					}
						
						if($sname == "")
						{
							$er++;
							$esname = "*Required";
						}
						else{
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
						else{
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
						else{
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

						 if (empty($gender)) {
						 	$er++;
						    $egender = "*Gender is required";
						  } else {
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

						
						if (empty($division)) {
							$er++;
						   $edivision = "*division is required";
						 } else {
						   $division = test_input($division);
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
						 if (empty($grad)) {
							$er++;
						   $egrad = "*graduation is required";
						 } else {
						   $grad = test_input($grad);
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
						if($admno== "")
						{
							$er++;
							$eadmno = "*Required";
						}
						
						
						if($er == 0)
						{
                            /* $cn = mysqli_connect("localhost", "root", "", "db_admission");*/
							
							$sql = "INSERT INTO student (regno,sname, gname, contact,address, class, shift, gender, blgroup, division,religion,cast,dob,doa,grad,tcno,admno,addept,adyear,tcyear) VALUES (
							'".mysqli_real_escape_string($cn, strip_tags($regno))."',
							'".mysqli_real_escape_string($cn, strip_tags($sname))."',
							'".mysqli_real_escape_string($cn, strip_tags($gname))."', 
							'".mysqli_real_escape_string($cn, strip_tags($contact))."', 
							'".mysqli_real_escape_string($cn, strip_tags($address))."', 
							'".mysqli_real_escape_string($cn, strip_tags($class))."', 
							'".mysqli_real_escape_string($cn, strip_tags($shift))."', 
							'".mysqli_real_escape_string($cn, strip_tags($gender))."', 
							'".mysqli_real_escape_string($cn, strip_tags($blgroup))."', 
							'".mysqli_real_escape_string($cn, strip_tags($division))."', 
							'".mysqli_real_escape_string($cn, strip_tags($religion))."',
							'".mysqli_real_escape_string($cn, strip_tags($cast))."',
							'".mysqli_real_escape_string($cn, strip_tags($dob))."',
							'".mysqli_real_escape_string($cn, strip_tags($doa))."',
							'".mysqli_real_escape_string($cn, strip_tags($grad))."',
							'".mysqli_real_escape_string($cn, strip_tags($tcno))."',
							'".mysqli_real_escape_string($cn, strip_tags($admno))."',
							'".mysqli_real_escape_string($cn, strip_tags($addept))."',
							'".mysqli_real_escape_string($cn, strip_tags($adyear))."',
							'".mysqli_real_escape_string($cn, strip_tags($tcyear))."'

							)";
							
							if(mysqli_query($cn , $sql))
							{
								print '<span class = "successMessage">Data saved into system.</span>';
								$regno="";
								$sname = "";
								$gname = "";
								$contact = "";
								$address = "";
								$class = "";
								$shift = "";
								$gender = "";
								$blgroup = "";
								$division = "";
								$religion = "";
							
								$cast="";
								$dob="";
								$doa="";
								$grad="";
								$tcno="";
								$admno="";
								$tcyear="";
									
							}
							else
							{
								print '<span class= "errorMessage">'.mysqli_error($cn).'</span>';
							}
						}
						else
						{
							print '<span class = "errorMessage">Please fill all the required fields correctly.</span>';
						}
					}
					
					function test_input($data) {
					  $data = trim($data);
					  $data = stripslashes($data);
					  $data = htmlspecialchars($data);
					  return $data;
					}
					
//================================ PHP End =============================	
?>
<script>
    function showAlert(message) {
        alert(message);
    }
</script>

<div class="form-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h3>Admission form</h3>
				</div>

				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">
							<div class="row">
								<div class="col-md-12">
									
									<h5><label for="Regno" style="font-weight:bold;">Regno</label>
									    <span class="error"><?php print $eregno; ?></span></h5>
										<p><input type="text" name="regno" value="<?php print $regno; ?>"></p>

										<h5><label for="tcno" style="font-weight:bold;">T.C.No</label>
									    <span class="error"><?php print $etcno; ?></span></h5>
										<p><input type="text" name="tcno" value="<?php print $tcno; ?>"></p>

										<h5><label for="sname" style="font-weight:bold;" >Student name</label>
										<span class="error"><?php print $esname; ?></span></h5>
										<p><input type="text" name="sname" value="<?php print $sname; ?>"></p>

										<h5><label for="gname" style="font-weight:bold;">Father name or Guardian Name</label><span class="error">
												<?php print $egname; ?></span></h5>
										<p><input type="text" name="gname" value="<?php print $gname; ?>"></p>

										

										<h5><label for="cast" style="font-weight:bold;">Caste</label></h5>
										<p><select name="cast" id="">
												
												<option   value="BC">BC</option>
												<option   value="MBC">MBC</option>
												<option  value="SC">SC</option>
												<option  value="ST">ST</option>

											</select><span class="error">
												<?php print $ecast; ?></span></p>
										<h5><label for="dob" style="font-weight:bold;">Date of Birth </label><span class="error">
										<?php print $edoa; ?></span></h5>
										<p><input type="date" name="dob" value="<?php print $dob; ?>"></p>

										<h5><label for="contact" style="font-weight:bold;">contact</label><span class="error">
												<?php print $econtact; ?></span></h5>
										<p><input type="text" name="contact" value="<?php print $contact; ?>"></p>

										<h5><label for="address" style="font-weight:bold;">address</label><span class="error">
												<?php print $eaddress; ?></span></h5>
										<p><textarea name="address"><?php print $address; ?></textarea></p>

										

										
									
								</div>
								<div class="col-md-12">
									
										<h5><label for="class" style="font-weight:bold;">Year</label><span class="error">
												<?php print $eclass; ?></span></h5>
										<p><input type="text" name="class" value="<?php print $class; ?>"></p>

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


										<h5><label for="gender" style="font-weight:bold;">Gender</label></h5>
										<input type="radio" name="gender" value="Male"><span>Male</span>
										<input type="radio" name="gender" value="Female"><span>Female</span>
										<input type="radio" name="gender" value="Others"><span>Others</span>
										<span class="error">
											<?php print $egender; ?></span>

										

										<h5><label for="division" style="font-weight:bold;">Branch</label></h5>
										<p><select name="division" id="">
												
												<option value="Computer science Engineering ">Computer Science Engineering</option>
												<option value="Electrical and Electronic Engineering">Electrical and Electronic Engineering</option>
												<option value="Electronic and communication Engineering ">Electronic and Communication Engineering</option>
												<option value="Mechanical Engineering">Mechanical Engineering</option>
											</select><span class="error">
												<?php print $edivision; ?></span></p>
										<h5><label for="religion" style="font-weight:bold;">Religion</label></h5>
										<p><select name="religion" id="">
												
												<option   value="Hindu">Hindu</option>
												<option   value="Muslim">Muslim</option>
												<option  value="Christian">Christian</option>
											</select><span class="error">
												<?php print $ereligion; ?></span></p>
										<h5><label for="doa" style="font-weight:bold;">Admission date</label><span class="error">
										     <?php print $edoa; ?></span></h5>
										<p><input type="date" name="doa" value="<?php print $doa; ?>"></p>

										<h5><label for="admno" style="font-weight:bold;">Admission Year</label><span class="error">
										     <?php print $eadmno; ?></span></h5>
										<p><input type="text" name="admno" value="<?php print $admno; ?>"></p>
										<h5><label for="addept" style="font-weight:bold;">Admission Dept</label><span class="error">
										     <?php print $eaddept; ?></span></h5>
										<p><input type="text" name="addept" value="<?php print $addept; ?>"></p>
										<h5><label for="adyear" style="font-weight:bold;">Admission No</label><span class="error">
										     <?php print $eadyear; ?></span></h5>
										<p><input type="text" name="adyear" value="<?php print $adyear; ?>"></p>
										
										<h5><label for="tcyear" style="font-weight:bold;" >Batch</label><span class="error">
										     <?php print $etcyear; ?></span></h5>
										<p><input type="text" name="tcyear" placeholder="2021-2025" value="<?php print $tcyear; ?>"></p>										
										

										<p><input type="submit" name="submit" value="Submit"></p>
									
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
