<?php
session_start();
require "../db.php";
global $conn;
if(isset($_SESSION['timestamp']))
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Aphonse Kiprop">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>My Orders</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/navbar.css">
        <style>
            #container{
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
                background: url(../pictures/backgroung_image.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;            }
        </style>

    </head>
    <body>

    <!-- Simulate a smartphone / tablet -->
    <div class="mobile-container">

        <!-- Top Navigation Menu -->
        <div class="topnav">
            <a href="../index.php" class="active"><img src="../pictures/logo.jpeg" width="45" height="45" alt="Logo">&nbsp GEOLIGHT CONSULT</a>
            <div id="myLinks">
                <a href="../cart.php" class="btn btn-info">My Cart</a>
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
                        <strong><?php if (isset($_SESSION['mail_message'])) {
                                echo $_SESSION['mail_message'];
                            } unset($_SESSION['showAlert']); ?></strong>
                    </div>
                    &nbsp;
                    <h2 class="text-center text-dark m-0">Maps on Order</h2><br>
                    <form method="post" action="search_order.php">
                        <input type="text" size="40" placeholder="Enter Email or Phone to see your orders" required name="search_order">
                        <input type="submit" name="search_submit">
                    </form>
                    <div class="table-responsive mt-2" id="container">
                        <table class="table table-bordered table-striped text-left">
                            <thead>
                            <tr>
                                <th></th>
                                <th style="text-align:center">CONSTITUENCY</th>
                                <th style="text-align:center">WARD</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($_SESSION['contact'])){
                                $user=$_SESSION['contact'];
                            }else{
                                $user=$_SESSION['timestamp'];
                            }
                            $stmt = $conn->prepare("SELECT * FROM cart where user ='$user' and status='1'");
                            $stmt->execute() or die(mysqli_error($conn));
                            $result = $stmt->get_result();
                            $count=1;
                            while ($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $count ?>.</td>
                                    <td><?= $row['constituency'] ?></td>
                                    <td><?= $row['ward'] ?></td>
                                    <?php
                                    $map_name=$row['map_name'];
                                    $county=$row['county'];
                                    //Fetch map in DB

                                    $filename=$county."/".$map_name;
                                    //                                    $filename=$map_name;
                                    $count=$count+1;
                                    $link="http://localhost/maps/".$filename;
                                    //                                    $link = "<a href='maps.php?link=$filename'> $filename </a><br />";
                                    //- the missing closing brace
                                    ?>
                                    <td>

                                        <!--                                        <form method="get" action="maps.php">-->
                                        <!--                                            <a href="../downloads/maps.php?file=<?php echo $filename;?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download-alt"></span>-->
                                        <!--                                                Download</a>-->
                                        <!--                                            <button type="submit" name="download">Download</button>-->
                                        <!--                                        </form>-->
                                    </td>
                                </tr>

                            <?php
                            endwhile;
                            if(!empty($_GET['file'])) {
                                $filename=basename($_GET['file']);
                                $filepath='maps/'.$county."/".$filename;
                                if (file_exists($filepath)) {
//                                    header("Cache-Control: public");
//                                    header('Content-Description: File Transfer');
//                                    header("Content-Disposition: attachment; filename=$filename");
//                                    header("Content-Type: application/pdf");
//                                    header("Content-Transfer-Encoding: binary");

//                                    readfile($filepath);
                                    exit;
                                }
                                else{
                                    // echo "Error254 hgy";
                                }
                            }
                            ?>

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

        </div>

    </div>
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
    header("Location:../index.php");
    exit();}
?>