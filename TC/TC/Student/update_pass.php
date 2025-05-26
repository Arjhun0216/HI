<?php
session_start();


// Create database connection
$con = new mysqli("localhost", "root", "1711104@gceb!!", "db_admission");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the form data is received
if(isset($_POST['pass']) && isset($_POST['old_pass']) && isset($_POST['username'])) {
    
    // Sanitize input data
    $new_password = mysqli_real_escape_string($con, $_POST['pass']);
    $old_password = mysqli_real_escape_string($con, $_POST['old_pass']);
    $username = mysqli_real_escape_string($con, $_POST['username']);

    // Check if the old password matches the stored password
    $sql = "SELECT password FROM admin WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

         
        
       
        $entered_password = trim($old_password);
        $stored_password = trim($row['password']);
        
       

        if ($entered_password === $stored_password) {
            // Hash the new password
            //$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_sql = "UPDATE admin SET password = '$new_password' WHERE username = '$username'";
            if(mysqli_query($con, $update_sql)) {
                echo "Password Successfully Changed";
            } else {
                echo "Error updating password";
            }
        } else {
            echo "Old password is incorrect";
        }
        
       /* $entered_password = trim($old_password);

        if (password_verify($entered_password, $stored_password)) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_sql = "UPDATE admin SET password = '$hashed_password' WHERE username = '$username'";
            if(mysqli_query($con, $update_sql)) {
                echo "Password Successfully Changed";
            } else {
                echo "Error updating password";
            }
        } else {
            echo "Old password is incorrect";
        }*/
    } else {
        echo "User not found";
    }
}
?>
