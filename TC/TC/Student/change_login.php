<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<form id="login-form" action="change.php" method="post">
        <h2>Password Change</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="oldPassword">oldPassword:</label>
        <input type="Password" id="oldPassword" name="oldPassword" required>
        <label for="newPassword">newPassword:</label>
        <input type="Password" id="newPassword" name="newPassword" required>
        <label for="confirmPassword">confirmPassword:</label>
        <input type="Password" id="confirmPassword" name="confirmPassword" required>
        <input type="submit" value="changepassword">
    
    </form>
   
     
</body>
</html>
