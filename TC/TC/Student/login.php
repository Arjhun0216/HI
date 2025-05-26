<?php
session_start(); // Start the session at the beginning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Establishing a connection to the database
        $con = new mysqli("localhost", "root", "1711104@gceb!!", "db_admission");

        // Check for connection errors
        if ($con->connect_error) {
            die("Failed to connect: " . $con->connect_error);
        } else {
            // Prepare SQL statement with a placeholder for username
            $stmt = $con->prepare("SELECT * FROM admin WHERE username = ?");
            // Bind the parameter to the prepared statement
            $stmt->bind_param("s", $username);
            // Execute the prepared statement
            $stmt->execute();
            // Get the result of the executed statement
            $stmt_result = $stmt->get_result();
            
            // Check if there are any rows returned
            if ($stmt_result->num_rows > 0) {
                // Fetch the data as an associative array
                $data = $stmt_result->fetch_assoc();
                $stored_password = $data['password'];
               
                
                // Debugging: Display entered password and retrieved hashed password from the database
               // echo "Stored password: " . $stored_password;
                $entered_password = trim($password);
                $hashed_password = trim($data['password']);
                
                if ($entered_password === $hashed_password) 
                {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username; 
                    echo "<h2>Login Successful</h2>";
                    header("Location: das2-index.php");
                    exit();
                } else {
                    $error_message = "Invalid password";
                }
                
            } else {
                $error_message = "Invalid password";
            }
        }
    } else {
        $error_message = "Invalid password";
    }
   
}
/*$entered_password = trim($password);
                $hashed_password = trim($data['password']);
                
                if (password_verify($entered_password, $stored_password)) {
                    echo "<h2>Login Successful</h2>";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<h1>Invalid password</h1>";
                    header("Location: index_login.php");
                    exit();
                }*/
?>


