<?php
session_start();
require 'db.php';
global $conn;
$price_per_map=5000;
if(isset($_SESSION['user']))
{
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
                background-color: #e7d8c3;
                border-radius: 10px;
            }
            html, body {
                background-color: #3c6b93;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background: url(pictures/backgroung_image.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
    <body>

    <!-- Simulate a smartphone / tablet -->
    <div class="mobile-container">

        <!-- Top Navigation Menu -->
        <div class="topnav">
            <a href="index.php" class="active">GEOLIGHT CONSULT</a>
            <div id="myLinks">
                <a href="downloads/maps.php" class="btn btn-secondary">My Maps</a>
                <a href="users/logout.php" class="btn btn-danger">Logout</a>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <!-- End smartphone / tablet look -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                        echo $_SESSION['showAlert'];
                    } else {
                        echo 'none';
                    } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                            } unset($_SESSION['showAlert']); ?></strong>
                    </div>
                    &nbsp;
                    <h2 class="text-center text-danger m-0">Maps in your cart!</h2><br>
                    <div class="table-responsive mt-2" id="container">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th></th>
                                <th style="text-align:left">CONSTITUENCY</th>
                                <th style="text-align:left">WARD</th>
                                <th>
                                    <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $user=$_SESSION['user'];
                            $stmt = $conn->prepare("SELECT * FROM cart where user ='$user' and status='0'");
                            $stmt->execute() or die(mysqli_error($conn));
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            $total_maps=0;
                            $count=1;
                            while ($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                    <td style="text-align:left"><?= $row['constituency'] ?></td>
                                    <td style="text-align:left"><?= $row['ward'] ?></td>
                                    <td>
                                        <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $grand_total += $price_per_map;
                                $total_maps+=1;
                                $count+=1;
                                ?>
                            <?php
                            endwhile;
                            $_SESSION['total_maps']=$total_maps;
                            ?>


                            </tbody>
                        </table>

                    </div>
                    &nbsp;

                </div>
                &nbsp;
                <div class="center">
                    <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Buy More
                        Maps</a>
                    &nbsp;
                    <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ; ?>">
                        <i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                </div>
            </div>

        </div>

    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Load total no.of items added in the cart and display in the navbar
            load_cart_item_number();

            function load_cart_item_number() {
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#cart-item").html(response);
                    }
                });
            }
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