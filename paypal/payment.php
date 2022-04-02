<?php
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
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order">
            <h4 class="text-center text-info p-2">PayPal!</h4>
            <form action="" method="post" id="placeOrder">

                <h6 class="text-center lead">Select Payment Mode</h6>
                <div class="form-group">
                    <select name="pmode" class="form-control" id="payment_mode">
                        <option value="" selected disabled>-Select Payment Mode-</option>
                        <option value="mpesa">Mpesa</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
<!--                <div class="form-group">-->
<!--                    <input type="submit" name="submit" value="Pay" id="paybtn" class="btn btn-danger btn-block">-->
<!--                </div>-->
                    <div class="form-group" id="paypalbtn">

                    </div>
            </form>
        </div>
    </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=ARCVXAVnqYszwwUKCCh4-4Td6Nz9o9e8hKyEC1DhiOsJGC4cQjNJhoElfwHNwEmSaNicnEDI_f4038jw&disable-funding=credit,card"></script><!--<script>-->
<script>paypal.Buttons({
        style:{
            color:'blue'
            // shape:'pill'
        },
        createOrder:function (data,actions){

        }

    }).render('#paypalbtn');</script>

</body>

</html>



