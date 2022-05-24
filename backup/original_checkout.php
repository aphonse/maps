<?php
require 'db.php';
global $conn;
require 'variables.php';
global $map_price,$usd;
if (!isset($_SESSION)){
    session_start();

}
if (isset($_SESSION['user'])){
    $total_maps = $_SESSION['total_maps'];
    $total =$map_price*$total_maps;
    $conversion=$total/$usd;//Convert to USD
    $grand_total=number_format((float)$conversion, 2, '.', '');
    $items = [];
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Aphonse Kiprop">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Checkout</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/navbar.css">
        <style>
            #checkout{
                position: relative;
                border-top: 1px solid #030325;
                border-bottom: 1px solid #020815;
                background-color: #e7d8c3;
                border-radius: 10px;
            }
            html, body {
                /*background-color: #fff;*/
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
                <a href="cart.php" class="btn btn-secondary">Cart</a>
                <a href="users/logout.php" class="btn btn-danger">Logout</a>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <!-- End smartphone / tablet look -->
        <div class="container" id="checkout">
            <div class="row justify-content-center">
                <div id="order">
                    <h4 class="text-center text-danger p-2">Complete your order!</h4>
                    <div>
                        <h6 class="lead"><b>Map(s) : </b><?= $total_maps; ?></h6>
                        <h5><b>Total Amount Payable : </b>Kshs. <?= number_format($total) ?></h5>
                    </div>
                    &nbsp;
                    <form action="" method="post" id="placeOrder">
                        <div id="paypal-button-container"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <input  type="hidden" id="price" value="<?php echo $grand_total; ?>">

    <script src="https://www.paypal.com/sdk/js?client-id=ARS0YCc478nAryksiAgqmTq6ZJbnk028d6y4junr4OZnuyloBOLNcmkI4V4loyps-GJdduCzyr1vTdW5&disable-funding=credit,card"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
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
    <!-- Set up a container element for the button -->
    <script>
        var amount= document.getElementById("price").value;
        console.log(amount);
        paypal.Buttons({
            style:{
                color:'blue',
                shape:'pill'
            },

            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            // value: amount
                            value: '0.1'
                        }
                    }]
                });
            },

            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    <?php
                    //                    $_SESSION['paypal']="Thank you for your payment!";
                    $user=$_SESSION['user'];
                    ?>
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                    window.location.replace("http://localhost/maps/downloads/maps.php?paypal=<?= $user ?>")
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // var element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            },
            oncancel:function (data){
                window.location.replace("http://localhost/maps/checkout.php")
            }
        }).render('#paypal-button-container');

    </script>

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