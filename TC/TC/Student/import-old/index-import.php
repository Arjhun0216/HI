
<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="style.css">

    <title>Excel sheet import to database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card{
            weight: 800px;
            height:500px;
            
        }
       
        .card-header{
            background-color: #28a745; 
            background-size: cover;
           background-size:100%;
           
        }
        .btn{
            background-color:#90EE90;
            padding: 12px 70px;
            margin-left:400px; 
            margin-top:60px;
            font-size: 16px;
            border-radius: 10px;
            border: 2px solid black;
            font-family: "Times New Roman", Times, serif;
            font-weight:bold;
        }
        .con{
            font-size:25px;
            border-radius: 5px;
            border: 2px solid black;
            height:40px; 
            margin-left:250px;
            width: 700px;
            margin-top:50px;
            font-family: "Times New Roman", Times, serif;
        }
        .card-body{
            background-color:; 
            
        }
        body{
            background-image:url(data:image/jpeg;base64,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);
            background-repeat:no-repeat;
            background-size: cover;
           
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['message'])) {
                echo '<script type="text/javascript">';
                echo 'alert("' . $_SESSION['message'] . '");';
                echo '</script>';
                unset($_SESSION['message']);
            }
            ?>



                <div class="card">
                    <div class="card-header">
                        <h1 style="color:black;font-family: Times New Roman, Times;">Excel Sheet Import To The DataBase</h1>
                    </div>
                    <div class="card-body">

                        <form action="code-import.php" method="POST" enctype="multipart/form-data">

                            <input type="file"  style=""name="import_file" class="con" /><br>
                            <button type="submit" name="save_excel_data"  class="btn"  >  IMPORT</button>
                        </form>
                        <a href="index.php" class="btn" style=" margin-left: 400px; margin-top: 20px;">EXIT</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>