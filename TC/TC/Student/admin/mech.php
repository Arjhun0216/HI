<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: index_login.php"); // Redirect to login if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Form</title>
    <style>
       
 #tcForm input[type="checkbox"] {
            transform: scale(1.5); /* Increase the size of the checkboxes */
            font-family: 'times-new-roman';
            font-size:25px;
        }
        
        #tcForm {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: 'times-new-roman'; /* Set font style for the form */
            font-size:20px;
        }
    </style>
</head>
<body>
<form id="tcForm" method="post" action="process.php">
<input type="checkbox" id="selectAllCheckbox" onclick="toggleSelectAll(this)"> Select All<br>

                            <?php
                            $cn = mysqli_connect("localhost", "root", "1711104@gceb!!", "db_admission");

                            $sql = "SELECT regno FROM STUDENT WHERE division ='Mechanical Engineering'and status!='Discontinue' and status!= 'Transfer'and class ='Final'";
                            $result = $cn->query($sql);
                        
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo '<input type="checkbox" class="regnoCheckbox" name="regno[]" value="' . $row['regno'] . '"> ' . $row['regno'] . '<br>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                <button type="submit" name="dept" class="btn btn-primary">Download</button>
            </form>
            <script>
function toggleSelectAll(selectAllCheckbox) {
    var checkboxes = document.getElementsByClassName('regnoCheckbox');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = selectAllCheckbox.checked;
    }
}
</script>
</body>
</html>