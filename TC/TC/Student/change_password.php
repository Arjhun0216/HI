<?php
session_start();

/*if(!isset($_SESSION['c_code']))
{
    header("Location:index_login.php");
}*/

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        
         <link rel="stylesheet" href="style.css">
        <style>
          
        .header-area {
                width: 100%;
                height: 130px; 
                background-color: #01427a !important;
                background-image: url('gceb.png'); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
               
               /* Cover the entire header */
                background-repeat: no-repeat; /* No repeating */
                background-position: center; /* Center the image */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        </style>
    
        <link rel="stylesheet" href="style1.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <title>Change Password</title>


 <!--============================= Fonts =======================================-->
 <link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,300i,400,700" rel="stylesheet">

<!--============================= CSS =======================================-->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="style.css">

<script src="assets/js/jquery-3.2.1.slim.min.js"></script>



<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    /* $(document).ready(function() {
        $("#msg").css("display", "block");
        $("#msg").hide();
        $("#save").click(function() {
          if ($("#pass").val() == "" || $("#pass").val().length < 8) {
            $("#msg").show();
            $("#msg")
              .removeClass("alert alert-success")
              .addClass("alert alert-danger");
            $("#msg")
              .delay(5000)
              .fadeOut();
            $("#msg").text("A valid Password must contain 8 characters");
            return;
          } else {
            if(!confirm("Once You Click 'OK' Password Will be Changed"))
            {
              return;
            }
            //header("Location:update_pass.php");
            $.post("update_pass.php",
              {
                username: $("#username").val(),
                pass: $("#pass").val(),
                old_pass: $("#old_pass").val()
              },
              function(data, status) {
        console.log("Received data:", data); // Debug statement
        console.log("Status:", status); // Debug statement
        
        // Existing code continues...
    }
              /*function(data, status) {
                $("#loader").hide();
                
                if (data === "Success") {
                  
                  $("#msg").show();
                  $("#msg")
                    .removeClass("alert alert-danger")
                    .addClass("alert alert-success");
                  $("#msg").text("Password Changed Successfully");
                  window.location.href="../user/logout.php";
                  $("#msg")
                    .delay(5000)
                    .fadeOut();
                } else {
                  $("#msg").show();
                  $("#msg")
                    .removeClass("alert alert-success")
                    .addClass("alert alert-danger");
                  $("#msg").text(data);
                  $("#msg")
                    .delay(5000)
                    .fadeOut();
                }
              }
            );
          }
        });
      });*/
  $(document).ready(function() {
    $("#save").click(function() {
        $.post("update_pass.php", {
            pass: $("#pass").val(),
            old_pass: $("#old_pass").val(),
            username: $("#username").val()
        })
        .done(function(data) {
            
            
            if (data === "success") {
                alert("Password Changed Successfully");
               
            } else {
             
                alert(data);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown); // Debug statement
            alert("AJAX Error: " + textStatus); // Temporarily using alert for debugging
        });
    });
});

    </script>
  
    </head>
    <body>
    
    <header class="header-area" style="background-color: #f4f4f4;">
    <div class="container-fluid"> <!-- Changed to container-fluid for full width -->
        <div class="row">
            <div class="col-md-8"> <!-- Full width column -->
                <div class="logo">
                    <a href="#">
                        <i class="fa "></i>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

                   
                       

                       
                  



        <!-- <h1>Change Password</h1> -->
        <div  style="text-align: center;width:50%;margin:100px auto;">
      <div
        id="msg"
        class="alert alert-danger"
        style="display: none;"
        role="alert"
      >
        Something went Wrong!!!
      </div>
      <div class="col-md-9">


      <div class="login-form" style="padding-top: inherit;background-color: lightgrey;">
    <h5 style="margin-top:10px;color:blue;text-align:center;">CHANGE PASSWORD</h5>
    <i class="fa fa-unlock-alt" style="font-size:45px;padding-bottom: 10px;margin-top:10px;color:#fdc11c"></i>
    <div class="form-group">
        <input  style="border-radius: 5px;" type="text"  class="form-control" name="username" id="username" placeholder="Username" required>
    </div>
    <div class="form-group">
        <input style="border-radius: 5px;" name="old_pass" id="old_pass" class="form-control" placeholder="Old Password" type="password" required>
    </div>
    <div class="form-group">
        <input style="border-radius: 5px;" name="pass" id="pass" class="form-control" placeholder="New Password" type="password" required>
    </div>
    <button name="login" id="save" class="btn btn-primary btn-block" style="border-radius:15px;color:red;margin-bottom:-50px;background-color: #FDC11C;border-color:#fdc11c;font-weight: 400;font-size: 20px;">Submit</button>
</div>
    </div>

        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        
        <!-- ===== MAIN JS ===== -->
        <script src="assets/js/main.js"></script>
    </body>
</html>