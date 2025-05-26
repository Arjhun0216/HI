<!--<ul>
    <li><a href="das2-index.php">Dashboard</a></li>
    <li><a href="?a=student_add">Admission</a></li>
    <li><a href="?a=student">Student</a></li>
    <li><a href="?a=search">Search</a></li>
    <li><a href="?a=all">TCList</a></li>
    <li><a href="index-import.php">Import</a></li>
</ul>-->

<!--<div class="main-menu">
    <ul>
    <li><a href="das2-index.php">Dashboard</a></li>
    <li><a href="?a=student">Student</a></li>
    <li><a href="?a=search">Search</a></li>
    <li><a href="?a=all">TCList</a></li>
    <li><a href="index-import.php">Import</a></li>
    </ul>
</div>-->
<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        :root {
            --mainColor: #343a40;
            --color1: #007bff;
            --color2: rgb(0, 255, 255);
            --color3: #202429;
        }

        .sidebar-wrapper {
            max-width: 300px;
            min-width: 300px;
            height: 100vh;
            background-color: var(--mainColor);
            box-shadow: 0 0 8px #000;
            position: fixed;
            top: 0;
            left: -100%;
            transition: 0.5s ease;
            font-family: "Poppins", sans-serif;
        }
        .sidebar-wrapper .sidebar .avatar-wrapper {
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #fff;
            font-size: 1.5rem;
            background: url("./images/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            z-index: 10;
        }
        .sidebar-wrapper .sidebar .avatar-wrapper::after {
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.6);
            z-index: -11;
        }
        .sidebar-wrapper .sidebar nav .menu {
            list-style: none;
        }
        .sidebar-wrapper .sidebar nav .menu li {
            border-bottom: 1px solid #494949;
        }
        .sidebar-wrapper .sidebar nav .menu li a {
            display: block;
            text-decoration: none;
            color: #fff;
            text-transform: capitalize;
            padding: 20px;
            transition: 0.5s ease;
        }
        .sidebar-wrapper .sidebar nav .menu li a:hover {
            background: linear-gradient(45deg, var(--color1), var(--color2));
        }
        .sidebar-wrapper .sidebar nav .menu li a i {
            margin-right: 15px;
        }
        .close {
            cursor: pointer;
            position: absolute;
            top: 2px;
            right: 10px;
        }
        .open {
            cursor: pointer;
            position: absolute;
            top: 2px;
            left: 10px;
            color: #fff;
            font-size: 1.5rem;
        }
        #check {
            display: none;
        }
        #check:checked ~ .sidebar-wrapper {
            left: 0;
        }
    </style>
</head>
<body>

    <!-- Toggle Checkbox -->
    <div class="container">
        <input type="checkbox" id="check">
        <label for="check" class="open"><i class="fas fa-bars"></i></label>

        <!-- Sidebar -->
        <div class="sidebar-wrapper">
            <div class="sidebar">
                <label for="check" class="close"><i class="fas fa-times"></i></label>
                <nav>
                    <ul class="menu">
                        
                        <li><a href="das2-index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="?a=student"><i class="fas fa-graduation-cap"></i> Students</a></li>
                        <li><a href="?a=search"><i class="fas fa-search"></i> Search</a></li>
                        <li><a href="?a=all"><i class="fas fa-list"></i> TCList</a></li>
                        <li><a href="index-import.php"><i class="fas fa-file-import"></i> Import</a></li>
                        <li><a href="#"><i class="fas fa-life-ring"></i> Support</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li> <!-- Ensure to create logout.php for proper session destroy -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QnZc57eDJ2UG2KzzW6Sflfd4nLT8HjfHS6hgppI+YBm5QoEpniRZg7Eu9y0TA9mf" crossorigin="anonymous"></script>
</body>
</html>
