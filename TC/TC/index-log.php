<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Government Engineering College Transfer Certificate WebPage</title>

    <!-- CSS Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction:column;
        }
        .header-area {
            width: 100%;
            height: 130px;
            background-color: #01427a;
            background-image: url('assets/img/gceb.png');
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: flex;
            align-items: center;
            padding: 15px 20px;
        }
        form {
            background-color: #007bff;
            margin:40px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 400px;
            color: white;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #0056b3;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #004494;
        }
        #change-password-btn {
            background-color: #0056b3;
            color: white;
            padding: 12px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        #change-password-btn:hover {
            background-color: #004494;
        }
    </style>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,300i,400,700" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
</head>
<body>

<header class="header-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="logo">
                    <a href="#">
                        <i class="fa"></i>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="d-flex justify-content-center align-items-center" style="flex: 1;">
  <div id="forms-container">
    <form id="login-form" action="login.php" method="post">
        <h2><b>Login</b></h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <!-- PHP error message handling -->
        <?php if (!empty($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <input type="submit" value="Login">
        <button type="button" id="change-password-btn">Change Password</button>
    </form>
  </div>
</div>

<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Get the "Change Password" button
        const changePasswordBtn = document.getElementById('change-password-btn');

        // Add event listener to the "Change Password" button
        changePasswordBtn.addEventListener('click', function() {
            // Redirect to change_password.php
            window.location.href = 'Student-Admission/change_password.php';
        });
    });
</script>

</body>
</html>
