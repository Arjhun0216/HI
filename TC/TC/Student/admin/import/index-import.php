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
            background-image:url(data:image/jpeg;base64,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);
           background-repeat:no-repeat;
           background-size:100%;
           
        }
        .btn{
            background-color:blue; 
            padding: 12px 70px;
            margin-left:400px; 
            margin-top:60px;
            font-size: 16px;
            border-radius: 10px;
            border: 2px solid black;
            font-family: "Times New Roman", Times, serif;
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
                        <h1 style="color:black;font-family: Times New Roman, Times, serif;margin-left:275px;">Excel Sheet Import To The DataBase</h1>
                    </div>
                    <div class="card-body">

                        <form action="admin/import/code-import.php" method="POST" enctype="multipart/form-data">

                            <input type="file"  style=""name="import_file" class="con" /><br>
                            <button type="submit" name="save_excel_data" class="btn"  >  IMPORT</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>