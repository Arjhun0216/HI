<?php
session_start();
$error_message = ""; // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Establishing a connection to the database
        $con = new mysqli("localhost", "root", "1711104@gceb!!", "db_admission");

        // Check for connection errors
        if ($con->connect_error) {
            die("Failed to connect: " . $con->connect_error);
        } else {
            // Prepare SQL statement with a placeholder for username
            $stmt = $con->prepare("SELECT * FROM admin WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt_result = $stmt->get_result();

            if ($stmt_result->num_rows > 0) {
                $data = $stmt_result->fetch_assoc();
                $stored_password = trim($data['password']);

                if ($password === $stored_password) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("Location: Student/das2-index.php");
                    exit();
                } else {
                    $error_message = "Incorrect password.";
                }
            } else {
                $error_message = "Invalid username or password.";
            }
            $stmt->close();
        }
        $con->close();
    } else {
        $error_message = "Please fill in both fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Government Engineering College Transfer Certificate WebPage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header-area {
            width: 100%;
            height: 130px;
            background-color: #01427a;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed; /* Fixed header at the top */
            top: 0;
            left: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Ensure the header stays above other content */
        }
        .logo img {
            height: 100px; /* Adjust the logo height as needed */
        }
        main {
            margin-top: 150px; /* Add space below the header to avoid overlapping */
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 150px);
        }
        form {
            background-color: #007bff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: white;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .error-message {
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
            font-size: 0.9em;
        }
        input[type="submit"], #change-password-btn {
            background-color: #0056b3;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover, #change-password-btn:hover {
            background-color: #004080;
        }
        .password-container {
            position: relative;
        }
        #toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header with Logo -->
    <header class="header-area">
        <div class="logo">
            <img src="gceb.png" alt="Government Engineering College Logo"> <!-- Update the src attribute to the correct path -->
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <form id="login-form" action="" method="post">
            <h2 style="color: white; text-align: center;"><b>Login</b></h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span id="toggle-password"><i class="fas fa-eye"></i></span>
            </div>
            <!-- Display error message below the password field -->
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <input type="submit" value="Login">
            <button type="button" id="change-password-btn">Change Password</button>
        </form>
    </main>

    <script>
        const passwordField = document.getElementById('password');
        const togglePassword = document.getElementById('toggle-password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        document.getElementById('change-password-btn').addEventListener('click', function () {
            window.location.href = 'Student/change_password.php';
        });
    </script>
</body>
</html>


