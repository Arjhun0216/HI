<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
        $username = $_POST['username'];
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

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
            if ($stmt->execute()) {
                // Get the result of the executed statement
                $stmt_result = $stmt->get_result();

                // Check if there are any rows returned
                if ($stmt_result->num_rows > 0) {
                    // Fetch the data as an associative array
                    $data = $stmt_result->fetch_assoc();
                    $entered_password = trim($oldPassword);
                    $hashed_password = trim($data['password']);
                    
                   
                    // Verify the old password
                    if ($entered_password === $hashed_password){
                        if ($newPassword === $confirmPassword) {
                            // Hash the new password
                            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                            // Update the password in the database
                            $update_stmt = $con->prepare("UPDATE admin SET password = ? WHERE username = ?");
                            $update_stmt->bind_param("ss", $hashedPassword, $username);

                            if ($update_stmt->execute()) {
                                echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
                            } else {
                                echo json_encode(['success' => false, 'message' => 'Failed to update password']);
                            }
                        } else {
                            echo json_encode(['success' => false, 'message' => 'New Password and Confirm Password do not match']);
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Incorrect old password']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Invalid username']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Error executing SQL statement: ' . $stmt->error]);
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Please enter all required fields']);
    }
}
?>
