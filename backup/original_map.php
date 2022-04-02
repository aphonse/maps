<?php
session_start();
require "../db.php";
global $conn;
if(isset($_SESSION['user']))
{
    if (isset($_GET['paypal'])) {
        $_SESSION['paypal'] = "Thank you for your payment!";
        $user = $_SESSION['user'];
        $sql = "UPDATE cart SET status='1' WHERE user='$user'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Aphonse Kiprop">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>My Maps</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            html, body {
                /*background-color: #fff;*/
                background-color: #3c6b93;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                /*background-image: url('pictures/user.jpg');*/
            }
            #container{
                background-color: #e7d8c3;
                border-radius: 10px;

            }
        </style>

    </head>

    <body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="../index.php"><i class=""></i>&nbsp;&nbsp;HOME</a>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="../index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Buy More
                        Maps</a>
                </li>
                &nbsp;
                <li class="nav-item">
                    <form method="post" action="../users/logout.php">
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
                <h2 class="text-center text-dark m-0">Available Maps for download</h2><br>
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
                        $user=$_SESSION['user'];
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
                                $filename="downloads/maps/".$county."/".$map_name;
                                $count=$count+1;
                                ?>
                                <td>
                                    <a href="http://localhost/maps/<?php echo $filename?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download-alt"></span>
                                        Download</a>
                                </td>
                            </tr>

                        <?php
                        endwhile;

                        ?>

                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>

    </body>

    </html>

    <?php
}else{
    header("Location:../users/register.php");
}
?>



