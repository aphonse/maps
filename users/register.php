<?php
session_start();
if(isset($_SESSION['register_message'])){
    echo $_SESSION['register_message'];

}
if(isset($_SESSION['register_error'])){
    echo $_SESSION['register_error'];

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aphonse Kiprop">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register or Login</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.cs/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/navbar.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        html, body {
            /*background-color: #fff;*/
            background-color: #3c6b93;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background: url(../pictures/backgroung_image.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;        }
        #order{
            position: fixed;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            border-top: 1px solid #030325;
            border-bottom: 1px solid #020815;
            background-color: #e7d8c3;
            border-radius: 10px;
        }
    </style>
</head>

<body>
<div class="mobile-container">
    <div class="topnav">
        <a href="../index.php" class="active">GEOLIGHT CONSULT</a>
        <div id="myLinks">
            <a href="../about/about_us.php" class="btn btn-warning">About Us</a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="container">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
            echo $_SESSION['showAlert'];
        } else {
            echo 'none';
        } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
            <a type="button" class="close" data-dismiss="alert">&times;</a>
            <strong><?php if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                } unset($_SESSION['showAlert']); ?></strong>
        </div>
    <div class="container">
        <div class="row justify-content-center">
                <h4 class="text-center text-info p-2">Register to buy maps!</h4>
                <form action="signup_action.php" method="post" id="placeOrder">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passwordrepeat" class="form-control" placeholder="Re-enter Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="register" value="REGISTER" class="btn btn-info btn-block">
                    </div>

                    <div class="form-group">
                        <button name="login" class="btn btn-success btn-block" onclick="document.getElementById('id01').style.display='block'" ;">LOGIN</button>

                        <!--                   <input type="button" name="login" value="LOGIN" class="btn btn-success btn-block">-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>


<script>
    function myFunction() {
        var x = document.getElementById("myLinks");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        /* Full-width input fields */
        input[type=email], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        /* Add a background color when the inputs get focus */
        input[type=email]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        /* Extra styles for the cancel button */
        .cancelbtn .signupbtn {
            float: left;
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        /* Center the image and position the close button */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }

        img.avatar {
            width: 20%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 10px;
        }

        /* Modal Content/Box */
        .modal-content {
            position: relative; /* Stay in place */
            background-color: #fefefe;
            margin: 0% auto 0% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 90%; /* Could be more or less, depending on screen size */
        }

        /* Style the horizontal ruler */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {-webkit-transform: scale(0)}
            to {-webkit-transform: scale(1)}
        }

        @keyframes animatezoom {
            from {transform: scale(0)}
            to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn, .signupbtn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<!--<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>-->
<!--<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign Up</button>-->

<div id="id01" class="modal" >

    <form class="modal-content animate" action="login.php" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="../pictures/user.jpg" alt="Avatar" class="avatar">
        </div>

        <div class="container ">
            <label for="uname"><b>Username</b></label>
            <input type="email" placeholder="Enter Email" name="name" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <label>
                <input type="checkbox"  checked="checked" name="remember"> Remember me
            </label>
            <input type="submit" value="Login" name="login" class="btn btn-primary btn-block">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-danger cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>

        </div>

    </form>
</div>
<script>
    // Get the modal
    var modal = document.getElementById('id01');
    var modal2 = document.getElementById('id02');
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    window.onclick = function(event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }

</script>
</body>
</html>
