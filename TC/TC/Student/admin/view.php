<div id="padding">
<div class="section-title">
    <h3>Students list</h3>
</div>
<head>
<style>
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
        }
        
    </style>
</head>
<body>
<div class="nav">
        <a href="?a=all">All Students</a>
        <a href="?a=discontinue">Discontinued Students</a>
        <a href="?a=transfer">Transferred Students</a>
    </div>

</body>

        <?php 

        if(isset($_GET['did']))
        {
        delete();
        print '<h6 class= "successMessage">Student Deleted.</h6>';
        }
               

                $cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");
				$sql = "SELECT * FROM student WHERE status != 'Discontinue'";
				
				$table = mysqli_query($cn, $sql);
				
				
				print '<table>';
				print '<tr><th>ID</th><th>Regno</th><th>Student Name</th><th>Gurdian Name</th><th>Contact</th><th>Address</th><th>Year</th><th>Degree</th><th>Gender</th><th>Blood Group</th><th>Division</th><th>Action</th></tr>';
				
				while($row = mysqli_fetch_assoc($table))
				{
					print '<tr>';
					print '<td>'.htmlentities($row["id"]).'</td>';
					print '<td>'.htmlentities($row["regno"]).'</td>';
					print '<td>'.htmlentities($row["sname"]).'</td>';
					print '<td>'.htmlentities($row["gname"]).'</td>';
					print '<td>'.htmlentities($row["contact"]).'</td>';
					print '<td>'.htmlentities($row["address"]).'</td>';
					print '<td>'.htmlentities($row["class"]).'</td>';
					print '<td>'.htmlentities($row["shift"]).'</td>';
					print '<td>'.htmlentities($row["gender"]).'</td>';
					print '<td>'.htmlentities($row["blgroup"]).'</td>';
					print '<td>'.htmlentities($row["division"]).'</td>';
					print '<td> <a class= "action-e" href= "?a=edit&eid='.$row["id"].'"><i class="fa fa-wrench" title="Update"></i></a>
					<a class= "action-d" href= "?a='.$_GET['a'].'&did='.$row['id'].'"><i class="fa fa-trash" title="Delete"></i></a></td>';
					print '</tr>';
				}
	
				print '</table>';


    function delete()
        {
            global $cn;
            $sql = "delete from student where id = ".$_GET['did'];
            mysqli_query($cn, $sql);
        }
	
    ?>
     
</div>
