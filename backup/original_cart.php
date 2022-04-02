<?php
session_start();
require 'db.php';
global $conn;
$price_per_map=5000;
if(isset($_SESSION['user']))
{
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Aphonse Kiprop">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Cart</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel="stylesheet" href="styles.css">
        <style>
            #container{
                background-color: #e7d8c3;
                border-radius: 10px;

            }
        </style>
    </head>

    <body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php"><i class=""></i>&nbsp;&nbsp;HOME</a>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-link" style="align-content: center">
                    <form method="post" action="users/logout.php" >
                        <a class="" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                        <input type="submit" name="logout" class="btn btn-danger" value="Logout"/>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

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
    </body>

    </html>

    <?php
}else{
    header("Location:index.php?Cart Error");
}
?>

