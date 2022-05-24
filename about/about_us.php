
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Aphonse Kiprop">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Info</title>
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
            background-size: cover;        }
    </style>

</head>
<body>

<!-- Simulate a smartphone / tablet -->
<div class="mobile-container">

    <!-- Top Navigation Menu -->
    <div class="topnav">
        <a href="../index.php" class="active"><img src="../pictures/logo.jpeg" width="45" height="45" alt="Logo">&nbsp GEOLIGHT CONSULT</a>
        <div id="myLinks">
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <!-- End smartphone / tablet look -->
    <div class="container mt-5" id="container">
        <p style="font-size:1.6vw">
            At Geolight Consult we can fulfil all your Geospatial data related requirements. We have an outstanding amount of high-quality GIS maps covering different parts of the country. Our GIS data covers a wide range of sectors/industries e.g. Thematic maps, Election Maps, Cadastral Maps etc.</P>
        <p style="font-size:1.6vw">
            Our mission is to provide customers with accurate GIS data to assist them make informed decisions.
        </p>
        <br><br><br>
        <p style="font-size:1.6vw">
            Have any queries or complaints please contact us at;<br>
            Email: <b><a href="mailto:1450kenya@gmail.com">1450kenya@gmail.com</a></b>
        </p>

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