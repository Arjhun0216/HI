<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout</title>
    <!--<link rel="stylesheet" href="styles.css">-->
    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
}

.sidebar {
    width: 250px;
    background-color: #f4f4f4;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
}

.sidebar h2 {
    margin-top: 0;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #333;
}

.content {
    flex: 1;
    padding: 20px;
}

.content h1 {
    margin-top: 0;
}

    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="?a=student_add">Profile</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </aside>
        <main class="content">
            <h1>Welcome to the Dashboard</h1>
            <p>This is the main content area.</p>
            <!-- Add your PHP content here -->
        </main>
    </div>
</body>
</html>
