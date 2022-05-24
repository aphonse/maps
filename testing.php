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
        <title>Geolight Consult for buying maps</title>
        <meta charset="UTF-8">
        <meta property="og:type" content="website" />
        <meta name="keywords" content="Geolight Consult ,Kenya maps ,geolight , mapping kenya, kenyan wards, " />
        <meta name="author" content="Aphonse Kiprop">
        <meta property="og:image" content="https://geolightconsult.co.ke/pictures/logo.jpeg" />
        <meta property="og:image:secure_url" content="https://geolightconsult.co.ke/pictures/logo.jpeg" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="At Geolight Consult we provide high quality and innovative maps covering the whole country(Kenya). Our goal is to provide our users with information/decisions made by kenyans at ward level that collectively have shaped our country. Our maps are suitable for all people."/>
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
            /* If the screen size is 601px wide or more, set the font-size of <div> to 80px */
            @media screen and (min-width: 601px) {
                div.example {
                    font-size: 130%;

                }
                div.example2 {
                    font-size: 100%;

                }
                a.active {
                    font-size: 110%;

                }
                img.img{
                    width: 45px;
                    height: 45px;

                }

            }
            /* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
            @media screen and (max-width: 600px) {
                div.example {
                    font-size: 90%;

                }
                div.example2 {
                    font-size: 90%;

                }
                a.active {
                    font-size: 90%;

                }
                img.img{
                    width: 30px;
                    height: 30px;

                }

            }

        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>

    <!-- Simulate a smartphone / tablet -->
    <div class="mobile-container">

        <!-- Top Navigation Menu -->
        <div class="topnav">
            <a href="#home" class="active"><img class="img" src="pictures/logo.jpeg" alt="Logo" >&nbsp GEOLIGHT CONSULT</a>
            <div id="myLinks">
                <a href="maps/" class="btn btn-warning">My maps</a>
                <a href="about/" class="btn btn-info">Contact</a>
                <a href="about/" class="btn btn-secondary">About Us</a>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
            <div class="container center">
                <div class="card" id="container">
                    <div class="example" style="text-align: center;">
                        At Geolight Consult we provide high quality and innovative
                        maps of every ward in the whole country(Kenya).
                    </div>
                    <div class="card-body example2">
                        <div class="example">Choose a Ward election map below:</div>
                        <form action="index.php">
                            <div class="form-group">
                                <label for="county" style="font-size: 100%;">County</label>
                                <select style="font-size: 90%;" class="form-control" id="county-dropdown">
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
                                <br>
                                <input type="checkbox" id="check" name="check" onchange="document.getElementById('checkButton').disabled = !this.checked;">
                                <label for="check" style="font-size: 100%;">Add all wards of this County to cart</label><br>
                                <input type = "submit" id = "checkButton" disabled value = "submit"/>
                            </div>
                            <div class="form-group">
                                <label for="constituency" style="font-size: 100%;">Constituency</label>
                                <select class="form-control" style="font-size: 90%;" id="constituency-dropdown">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ward" style="font-size: 100%;">Ward</label>
                                <select style="font-size: 90%;" name="ward" class="form-control" id="ward-dropdown">
                                </select>
                            </div>
                            <div class="text-center">
                                <input type="submit" style="font-size: 90%;" name="cart" id="button-cart"
                                       class="btn btn-secondary btn-lg" value="Add to Cart"
                                />
                                <a href="cart/" style="font-size: 90%;" class="btn btn-info btn-lg"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Cart
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        <div class="container-fluid bg-s-copyright pt-3 text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p><small>@2022 Geolight Consult. All rights reserved</small></p>
                    </div>
                    <!--<div class="col-md-6 text-md-end">-->
                    <!--    <p>-->
                    <!--        <small>-->
                    <!--            <a href="https://wa.me/254705837332" target="_blank" class="m-3"><i class="fab fa-whatsapp"></i></a>-->
                    <!--            <a href="https://www.facebook.com/Sharasolutions" target="_blank" class="m-3"><i class="fab fa-facebook-f"></i></a>-->
                    <!--            <a href="https://twitter.com/SharaSolutions" target="_blank" class="m-3"><i class="fab fa-twitter"></i></a>-->
                    <!--        </small>-->
                    <!--    </p>-->
                    <!--</div>-->
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