<?php

   if( isset( $_SESSION["loginUserID"] ) ){
        $username =  getUserinfo("UserID" , $_SESSION["loginUserID"] , "Username") ;

        $countFavourite = countFavourite(  $_SESSION["loginUserID"] );
        if( $countFavourite == "" ){
            $countFavourite = "0";
        }if( $countFavourite >=10 ){
            $countFavourite = "+9";
        }

        $countAddCart   = countAddCart(  $_SESSION["loginUserID"] );
        if( $countAddCart == "" ){
            $countAddCart = "0" ;
        }
        if( $countAddCart >= 10 ){
            $countAddCart = "+9";
        }


    }

?>

    <nav class="navbar navbar-expand-lg sticky-top transparent-bg ">
        <div class="container">

            <a class="navbar-brand" href="index.php"> <i class="fas fa-shopping-cart" ></i> Snoffle Shop </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">  <i class="fas fa-bars"></i> </span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="category.php?catid=1">  <i class="fas fa-list-ul"></i>  Categories </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php if( isset( $_SESSION["loginUserID"] )){ echo  'href="favourites.php"'  ;  }else{  echo  'href="login.php"'  ;  } ?>   >  <i class="fas fa-heart"></i>  Favourites </a>
                        <div class="red_circle favorites">  <?php if( isset( $_SESSION["loginUserID"] )){ echo $countFavourite ;}else{ echo "0";} ?>  </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php if( isset( $_SESSION["loginUserID"] )){ echo  'href="carts.php"'  ;  }else{  echo  'href="login.php"'  ;  } ?>   > <i class="fas fa-shopping-cart"></i> Cart</a>
                        <div class="red_circle cart"> <?php if( isset( $_SESSION["loginUserID"] )){ echo  $countAddCart  ;  }else{ echo "0";} ?>  </div>
                    </li>

                    <?php 
                        if( isset( $_SESSION["loginUserID"]) && !isset( $_SESSION["loginAdmin"])  ){
                            echo '<li class="nav-item">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user"></i> ' . $username . '
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="myOrders.php">  <i class="fas fa-tasks"></i> My Orders  </a>
                                    <a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i>  Sign Out  </a>
                                </div>
                            </li>  ';
                        }elseif( isset( $_SESSION["loginUserID"]) && isset( $_SESSION["loginAdmin"])  ){
                            echo '<li class="nav-item">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user"></i> ' . $username . '
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="admin/index.php"> <i class="fas fa-tachometer-alt"></i> Dashboard  </a>
                                    <a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i>  Sign Out  </a>
                                </div>
                            </li>  ';
                        }else{ 
                            echo '<li class="nav-item">
                                    <a class="nav-link"  href="login.php"> <i class="fas fa-sign-out-alt"></i>  Login  </a>
                                </li>  ';
                        }
                    ?>
                </ul>
            </div>
            
        </div>
    </nav>



    <div class="overlay-white-alert loading">
        <div class="lds-dual-ring"></div>
    </div>

    <div class="overlay-white-alert maximum-alert">
        <div class="maximum-alert-inner">
            <p class="text-center"> <i class="fas fa-info-circle"></i> </p>
            <p> Maximum 5 Products in your cart </p>
        </div>
    </div>
    
    <div class=" overlay-white-alert exist-alert cart">
        <div class="exist-alert-inner">
            <p class="text-center"> <i class="fas fa-info-circle"></i> </p>
            <p>This product is already exist in <span> <i class="fas fa-shopping-cart" ></i> cart </span> </p>
        </div>
    </div>
    <div class=" overlay-white-alert exist-alert favourite">
        <div class="exist-alert-inner">
            <p class="text-center"> <i class="fas fa-info-circle"></i> </p>
            <p>This product is already exist in <span> <i class="fas fa-heart" ></i>  favourite </span> </p>
        </div>
    </div>