<?php
require 'db.php';
global $conn;
require 'variables.php';
global $map_price,$usd;
if (!isset($_SESSION)){
    session_start();

}
if (isset($_POST['phone']) or isset($_SESSION['mail_message'])){
    if(isset($_POST['phone'])){
        $total_maps = $_SESSION['total_maps'];
        $phone=$_POST['phone'];
        $_SESSION['contact']=$phone;
    }
    if ($_POST['email']!=""){
        $email=$_POST['email'];
        $_SESSION['contact']=$email;
    }
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
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            table.center {
                margin-left: auto;
                margin-right: auto;
            }

            td {
                overflow: hidden;
                text-overflow: ellipsis;
                word-wrap: break-word;
                position: relative;
            }
            @media only screen and (max-width: 480px) {
                /* horizontal scrollbar for tables if mobile screen */
                .tablemobile {
                    position: relative;
                    overflow-x: auto;
                    display: block;
                }
            }
            .center-table {
                margin-left: auto;
                margin-right: auto;
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
            <a href="index.php" class="active"><img src="pictures/logo.jpeg" width="45" height="45" alt="Logo">&nbsp GEOLIGHT CONSULT</a>
            <div id="myLinks">
                <a href="downloads/maps.php" class="btn btn-info">My Orders</a>
                <a href="cart.php" class="btn btn-secondary">Cart</a>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <!-- End smartphone / tablet look -->

        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
            echo $_SESSION['showAlert'];
        } else {
            echo 'none';
        } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php if (isset($_SESSION['mail_message'])) {
                    echo $_SESSION['mail_message'];
                } unset($_SESSION['showAlert']); ?></strong>
        </div>
        &nbsp;
        <div class="mobile-container" id="checkout" >
            <table style="border: 1px solid black" border="1" class="center" id="checkout">
                <thead>
                <h4 class="text-center text-info p-2">Complete your order!</h4>
                </thead>
                <tr>
                    <td colspan="2">
                        <h6 class="lead"><b>Map(s) : </b><?= $total_maps; ?></h6>
                        <h5><b>Total Amount Payable : </b>Kshs. <?= number_format($total) ?></h5>
                    </td>
                </tr>
                <tr>
                    <th>Lipa na Mpesa</th>
                    <th>Pay Via KCB</th>
                </tr>
                <tr>
                    <td>
                        <img src="pictures/mpesa_logo.png" width="120" height="30">
                        &nbsp;
                        <h5>Till Number: <b>9530631</b></h5>
                        <h5>Name: Geolight Consult &nbsp;</h5>
                        &nbsp;&nbsp;
                    </td>
                    <td>
                        <img src="pictures/kcb.jpg" width="120" height="30">
                        &nbsp;
                        <h5>Account Number: <b>1294503146 &nbsp;</b></h5>
                        <h5>Name: Geolight Consult</h5>
                        &nbsp;&nbsp;

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <form action="" method="post" id="placeOrder">
                            <!--<a>Pay Via PayPal</a>-->
                            <div style="width: fit-content" id="paypal-button-container"></div>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <form action="mail.php" method="post" onsubmit="return confirm('NOTICE!!\nThis Email address or Phone number will be used to Send you the maps please confirm before submitting the code' +
                                '\nEmail: <?php echo $email;?>\nWhatsapp Number: <?php echo $phone;?>');" class="container" style="align-content: center">
                            <label for="mpesacheck">MPESA</label>
                            <input type="radio" value="Mpesa" name="check">
                            <label for="kcbcheck"> KCB</label>
                            <input type="radio" value="KCB" name="check">
                            <label for="paypalcheck"> PayPal</label>
                            <input type="radio" value="PayPal" name="check">
                            <br>
                            <p>After you have finished the payment, enter the confirmation code received from MPESA or KCB e.g QD5FGH64F Here.<br> If you paid with PayPal check your email for a transaction code.</p>
                            <input required type="text" onchange="enable()" name="code" placeholder="Confirmation Code">
                            <input type="submit" id="Button" disabled value="Confirm" class="btn btn-info" name="confirmation">
                        </form>
                    </td>
                </tr>
            </table>
            &nbsp;
        </div>

        &nbsp
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
        // $(document).ready(function() {
        //     $('.btn').click(function() {
        //         if (confirm('Are you sure?')) {
        //             var url = $(this).attr('mail.php');
        //             $('#content').load(url);
        //         }else {
        //             var url = $(this).attr('checkout.php');
        //             $('#content').load(url);
        //         }
        //     });
        // });
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
                    $user=$_SESSION['timestamp'];
                    ?>
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                    window.location.replace("https://geolight.000webhostapp.com/maps/mail.php?paypal=<?= $user ?>")
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // var element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            },
            oncancel:function (data){
                window.location.replace("https://geolight.000webhostapp.com/maps/maps/checkout.php?Cancelled")
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
        function enable(){
            document.getElementById("Button").disabled = false;
        }
    </script>
    </body>
    </html>
    <?php
}else{
    header("Location:cart.php");
    exit();}
?>