<?php
require 'db.php';
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
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Aphonse Kiprop">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Checkout</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel="stylesheet" href="styles.css">

        <style>
            #checkout{
                position: fixed;
                top: 30%;
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

                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>
                <li class="nav-item">
                    <form method="post" action="users/logout.php">
                        <input type="submit" name="logout" class="btn btn-danger" value="Logout"/>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
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
    <input  type="hidden" id="price" value="<?php echo $grand_total; ?>">

    <script src="https://www.paypal.com/sdk/js?client-id=ARCVXAVnqYszwwUKCCh4-4Td6Nz9o9e8hKyEC1DhiOsJGC4cQjNJhoElfwHNwEmSaNicnEDI_f4038jw&disable-funding=credit,card"></script>

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
                            value: amount
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
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
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

    </body>

    </html>
    <?php
}else{
    header("Location:users/register.php");
}


?>
