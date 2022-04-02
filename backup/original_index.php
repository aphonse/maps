<?php
session_start();
require_once "db.php";
if(isset($_SESSION['user']))
{
    $conn = mysqli_connect("localhost", "root", "adm10722", "counties");
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Aphonse Kiprop">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Maps Home</title>
        <!-- Fonts -->
        <!--        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">-->
        <!-- Styles -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel="stylesheet" href="styles.css">
        <style>
            #county{
                background-color: #e7d8c3;
                border-radius: 10px;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
    <nav class="navbar bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand"><i class=""></i>&nbsp;&nbsp;GEOLIGHT CONSULT</a>
        <div style="text-align: left;">
            <!--        &nbsp;-->
            <form method="post" action="users/logout.php">
                <a href="about/about_us.php" class="btn btn-secondary">About Us</a>
                <input type="submit" name="logout" class="btn btn-danger"  value="Logout"/>
            </form>
        </div>


    </nav>
    <div class="container mt-5" id="county">
        <div class="row">
            <a class=" text-dark m-0"><?php
                //                echo "Welcome ".$_SESSION['user'];
                ?></a>

            <?php
            //        ?>
            <div class="card" id="county">
                <div class="card-header">

                    <h4 class=" text-dark m-0">At Geolight Consult we provide high quality and innovative
                        maps covering the whole country(Kenya). Our goal is to provide our users with information/decisions made by kenyans at
                        ward level that collectively have shaped our country. Our maps are suitable for all people in kenya
                    </h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="country">County</label>
                            <select class="form-control" id="country-dropdown">
                                <option value="">Select County</option>
                                <?php
                                //                            $result = mysqli_query($conn,"SELECT * FROM countries");
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
                            <label for="state">Constituency</label>
                            <select class="form-control" id="state-dropdown">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">Ward</label>
                            <select name="ward" class="form-control" id="city-dropdown">
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="cart" id="button-cart"
                                   class="btn btn-secondary btn-lg" value="Add to Cart"
                            />
                            <a href="cart.php" class="btn btn-info btn-lg"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Cart
                            </a>
                            <input type="button" name="my_maps"
                                   class="btn btn-success btn-lg" value="Go to My maps"
                                   onClick="document.location.href='downloads/maps.php'"
                            />
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    </div>


    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var county_id = this.value;
                $.ajax({
                    url: "states-by-country.php",
                    type: "POST",
                    data: {
                        county_id: county_id
                    },
                    cache: false,
                    success: function(result){
                        $("#state-dropdown").html(result);
                        $('#city-dropdown').html('<option value="">Select Constituency First</option>');
                    }
                });
            });
            $('#state-dropdown').on('change', function() {
                var constituency_id = this.value;
                $.ajax({
                    url: "cities-by-state.php",
                    type: "POST",
                    data: {
                        constituency_id: constituency_id
                    },
                    cache: false,
                    success: function(result){
                        $("#city-dropdown").html(result);
                    }
                });
            });
            $('#city-dropdown').on('change', function() {
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
        //For Add to cart


    </script>

    </body>
    </html>

    <?php
}else{
    header("Location:users/register.php?Login or Register");
    exit();}
?>

