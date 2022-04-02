<?php
session_start();
if(isset($_SESSION['user']))
{
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
        <title>Maps Home</title>
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
            <a href="#home" class="active">GEOLIGHT CONSULT</a>
            <div id="myLinks">
                    <a href="downloads/maps.php" class="btn btn-success">My maps</a>
                    <a href="about/about_us.php" class="btn btn-info">Contact</a>
                    <a href="about/about_us.php" class="btn btn-secondary">About Us</a>
                    <a href="users/logout.php" class="btn btn-danger">Logout</a>
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
                            ward level that collectively have shaped our country. Our maps are suitable for all people in kenya
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
        $(document).ready(function() {
            $('#county-dropdown').on('change', function() {
                var county_id = this.value;
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
    </body>
    </html>
    <?php
}else{
    header("Location:users/register.php?Login or Register");
    exit();}
?>