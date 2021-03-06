<?php

    include ("../init.php");

    

?>
<!DOCTYPE hmtl>
<html>
    <head>
        <title>
            <?php
                if(!isset($pagetitle)){
                    echo "Defulte Page";
                }else{
                    echo $pagetitle;
                }
            ?>
        </title>
        <!-- Meta -->
        <meta charset="utf-8">
        <!-- IE Compatibility Meta -->
        <meta http-equiv="X-UA-Compatibale" content="IE-=edge">
        <!-- Mobile meta-->
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-------------------------------------- start favicon  -----------------------------> 
        <link rel="apple-touch-icon" sizes="57x57" href="../assets/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../assets/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../assets/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../assets/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../assets/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../assets/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../assets/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../assets/images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../assets/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../assets/images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../assets/images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff"> 
        <!-------------------------------------- End favicon  ------------------------------->  
        <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=El+Messiri&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/animated.css">
        <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
        <?php
            if ( isset($RegisterPage) ){
                echo '<link rel="stylesheet" href="../assets/css/register.css">';
            }else{
                echo '<link rel="stylesheet" href="../assets/css/custom.css">';
            }
        ?>

    </head>
    <body>

        <?php
            if( !isset( $_SESSION["loginUserID"] ) ){
                ?>
                    <script>
                        var sessionlogin = 0
                    </script>
                <?php
            }
            if( isset( $_SESSION["loginUserID"] ) ){
                ?>
                    <script>
                        var sessionlogin = 1
                    </script>
                <?php
            }
            if(   isset( $_SESSION["loginUserID"] ) && isset( $_SESSION["loginAdmin"] )  ){
                ?>
                    <script>
                        var sessionlogin = 2
                    </script>
                <?php
            }
        ?>

        <nav class="navbar navbar-expand-lg sticky-top transparent-bg admin">
            <div class="container">

                <a class="navbar-brand" href="index.php">Home Page</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">  <i class="fas fa-bars"></i> </span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="index.php">   <i class="fas fa-user"></i>  Users </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">  <i class="fas fa-list-ul"></i>  Categories </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="items.php">   <i class="fas fa-cart-plus"></i>  Items </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="comments.php">  <i class="fas fa-comment-alt"></i> Comments </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">  <i class="fas fa-tasks"></i> Orders </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="chat.php"> <i class="fab fa-facebook-messenger"></i>  Chat </a>
                        </li>


                    </ul>
                </div>
                
            </div>
        </nav>

        <div id="admin-page">

    
            <div class="admin-nav">


                <div class="nav-item text-center">
                    <a href="../index.php">  <i class="fas fa-home"></i>  </a> 
                    <div class="absolute">
                        Home Page
                    </div>
                </div>
                <div class="nav-item text-center">
                    <a href="index.php">  <i class="fas fa-user"></i>  </a> 
                    <div class="absolute">
                        Users
                    </div>
                </div>
                <div class="nav-item text-center">
                    <a href="categories.php">  <i class="fas fa-list-ul"></i>  </a> 
                    <div class="absolute">
                        Categories
                    </div>
                </div>
                <div class="nav-item text-center">
                    <a href="items.php">  <i class="fas fa-cart-plus"></i>  </a> 
                    <div class="absolute">
                        Items
                    </div>
                </div>
                

                <div class="nav-item text-center">
                    <a href="comments.php">   <i class="fas fa-comment-alt"></i> </a> 
                    <div class="absolute">
                        Comments
                        <div class="triangle-left"></div>
                    </div>
                </div>
                

                <div class="nav-item text-center">
                    <a href="orders.php">    <i class="fas fa-tasks"></i>  </a> 
                    <div class="absolute">
                        Orders
                        <div class="triangle-left"></div>
                    </div>
                </div>
                

                <div class="nav-item text-center">
                    <a href="chat.php"> <i class="fab fa-facebook-messenger"></i> </a> 
                    <div class="absolute">
                        Chat
                        <div class="triangle-left"></div>
                    </div>
                </div>
                

            </div>


