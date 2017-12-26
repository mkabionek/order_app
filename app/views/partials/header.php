<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,200,300,400" rel="stylesheet">
    <link rel="stylesheet" href="/app/assets/css/style.css">
    <link rel="shortcut icon" type="image/png" href="/app/assets/favicon.ico"/>
<!--    <script src="../app/assets/js/jquery-3.2.1.js"></script>-->
    <title>Order App</title>
</head>

<body>
<header class="nav">
    <div class="container">
        <?php
            if(isset($_SESSION['username'])){
    //
                switch ($_SESSION['user_type']){
                    case '0':
                        include_once 'adminNav.php';
                        break;

                    case '1':
                        include_once 'clientNav.php';
                        break;
                    case '2':
                        include_once 'designerNav.php';
                        break;
                }

            } else{
                include_once 'nav.php';
            }

        ?>
    </div>

</header>
