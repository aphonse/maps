<?php
session_start();
if(!isset($_SESSION['timestamp']))
{
    $_SESSION['timestamp']=time();
}
$time=$_SESSION['timestamp'];
require_once "db.php";
global $conn;
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Aphonse Kiprop">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="At Geolight Consult we provide high quality and innovative maps covering the whole country(Kenya). Our goal is to provide our users with information/decisions made by kenyans at ward level that collectively have shaped our country. Our maps are suitable for all people."/>
        <title>Geolight Consult for buying maps</title>
        <link rel="shortcut icon" href="pictures/logo.jpeg">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/navbar.css">
        <style>
            #container{
                background-color: #dacda2;
                border-radius: 10px;
            }
            html, body {
                /*background-color: #3c6b93;*/
                /*background-color: #fcfcfc;*/
                color: #020815;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background: url(pictures/backgroung_image.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>

    <!-- Simulate a smartphone / tablet -->
    <div class="mobile-container">

        <!-- Top Navigation Menu -->
        <div class="topnav">
            <a href="#home" class="active"><img src="pictures/logo.jpeg" width="45" height="45" alt="Logo">&nbsp GEOLIGHT CONSULT</a>
            <div id="myLinks">
                <a href="maps/" class="btn btn-warning">My maps</a>
                <a href="about/" class="btn btn-info">Contact</a>
                <a href="about/" class="btn btn-secondary">About Us</a>
                <?php
                // if(isset($_SESSION['user'])){
                //     ?>
                <!--//     <a href="users/logout.php" class="btn btn-danger">Logout</a>-->
                <?php
                // }else{
                //     ?>
                <!--//     <a href="users/register.php" class="btn btn-success">Login</a>-->
                <?php
                // }
                ?>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="container mt-5" id="container">
            <div class="row">
                <?php
                //        ?>


                <div class="card" id="container">
                    <div class="card-header">

                        <h4 class=" text-dark m-0">At Geolight Consult we provide high quality and innovative
                            maps covering the whole country(Kenya). Our goal is to provide our users with information/decisions made by kenyans at
                            ward level that collectively have shaped our country. Our maps are suitable for all people.
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php">
                            <div class="form-group">
                                <label for="county">County</label>
                                <select class="form-control" id="county-dropdown">
                                    <option value="">Select County</option>
                                    <?php
                                    $result = mysqli_query($conn,"SELECT * FROM counties");
                                    while($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row["name"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                                <input type="checkbox" id="check" name="check" onchange="document.getElementById('checkButton').disabled = !this.checked;">
                                <label for="check">Add all wards of this County to cart</label><br>
                                <input type = "submit" id = "checkButton" disabled value = "submit"/>
                            </div>
                            <div class="form-group">
                                <label for="constituency">Constituency</label>
                                <select class="form-control" id="constituency-dropdown">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ward">Ward</label>
                                <select name="ward" class="form-control" id="ward-dropdown">
                                </select>
                            </div>
                            <div class="text-center">
                                <input type="submit" name="cart" id="button-cart"
                                       class="btn btn-secondary btn-lg" value="Add to Cart"
                                />
                                <a href="cart.php" class="btn btn-info btn-lg"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Cart
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        var county_id;
        $(document).ready(function() {
            $('#county-dropdown').on('change', function() {
                county_id = this.value;
                $.ajax({
                    url: "constituencies-by-county.php",
                    type: "POST",
                    data: {
                        county_id: county_id
                    },
                    cache: false,
                    success: function(result){
                        $("#constituency-dropdown").html(result);
                        $('#ward-dropdown').html('<option value="">Select Constituency First</option>');
                    }
                });
            });
            $('#checkButton').click(function() {
                alert("You are about to add all wards of selected county to your cart ");
                $.ajax({
                    url: "process.php",
                    type: "POST",
                    data: {
                        checked_id: county_id
                    },
                    cache: false,
                    success: function(result){
                    }
                });
            });

            $('#constituency-dropdown').on('change', function() {
                var constituency_id = this.value;
                $.ajax({
                    url: "wards-by-constituency.php",
                    type: "POST",
                    data: {
                        constituency_id: constituency_id
                    },
                    cache: false,
                    success: function(result){
                        $("#ward-dropdown").html(result);
                    }
                });
            });
            $('#ward-dropdown').on('change', function() {
                var id = this.value;
                $.ajax({
                    url: "process.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(result){
                        $("#button-cart").html(result);
                    }
                });
            });
            $('#button-cart').on('submit', function() {
                $.ajax({
                    url: "process.php",
                    type: "POST",
                    cache: false,
                    success: function(result){
                        // $("#cart").html(result);
                    }
                });
            });

        });

    </script>

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
    <script type = "text/javascript">
        function show(){
            // alert("You have selected the county " + county_id);
        }
    </script>
    </body>
    </html>
<?php

//else{
//     header("Location:users/register.php");
//     exit();
//}
?>