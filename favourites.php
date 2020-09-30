<?php
    $pagetitle = "Favourites"; 
    include("includes/template/header.php");
    if( !isset(  $_SESSION["loginUserID"] )   ){
        header("Location: login.php");
    }
    include("navbar.php");

?>


    


    <div id="favourite-page">




        <div class="products_section">
            <div class="container">

                <p class="title text-center"> <i class="fas fa-heart"></i> &nbsp; Favourite </p>
                <div class="content-title-underline"></div>            
        
            

                        

                <div class="row ">
                    <?php 
                        $rows = getFavouriteItems();
                        foreach( $rows as $row){

                            $items = getItemById( $row["itemID"] );

                            ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="product-item text-center">
                                    <div class="delete-favourite">
                                        <i class="fas fa-times-circle" itemid="<?php echo  $row["itemID"] ; ?>"></i>
                                    </div>
                                    <div class="item-img">
                                        <img src="assets/images/product-img/<?php echo $items["Pic"] ; ?>" alt="" class='img-fluid' />
                                        <span class="discounte"> 50% <br> OFF </span>
                                    </div>
                                    <p class="item-name">
                                        <a href="view.php?itemid=<?php echo  $items["Item_ID"] ; ?>" >
                                            <?php echo $items["Item_Name"] ; ?>
                                        </a>
                                    </p> 
                                    <div class="item-info">
                                        <span> <i class="fas fa-star"></i> <?php echo $items["stars"] ; ?></span>
                                        <span> <i class="fas fa-heart"></i> <?php echo $items["loves"] ; ?></span>
                                        <span> <i class="fas fa-eye"></i> <?php echo $items["views"] ; ?> </span>
                                    </div>
                                    <p class="last-price text-left">RRP: <span><?php echo $items["fake_price"] ; ?> EGP </span>  </p>
                                    <p class="price text-left"> Price : <?php echo $items["Price"] ; ?> EGP </p>
                                    <div class="item-buttons">
                                        <?php 
                                            if( isset ($_SESSION["loginUserID"])){
                                                echo '  <p class="btn-custom btn-custom-white add_cart" itemid="'. $items['Item_ID']  .'"> <i class="fas fa-cart-plus"></i> Cart</p> ';
                                            }else{
                                                echo '  <a href="login.php" class="btn-custom btn-custom-white " > <i class="fas fa-cart-plus"></i> Cart</a> ';
                                            }
                                        ?>
                                            <a href="view.php?itemid=<?php echo  $items["Item_ID"] ; ?>" class="btn-custom btn-custom-white" > <i class="fas fa-eye"></i> View </a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>



                </div>
                <?php
                    $cartsNum = countFavourites(  $_SESSION["loginUserID"]  );
                    if( $cartsNum == 0 ){
                ?>



                    <div class="no-favourite text-center">
                        You don't have Favourite Items <a href="category.php?catid=1"> Shop Now!</a>
                    </div>


                <?php
                    }
                ?>



            </div>
        </div>

    </div>


    
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="description">
                        <p class="title"> GET IN TOUCH </p>
                        <p> Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879 </p>
                        <div class="social-media">
                            <span> <i class="fab fa-facebook-square"></i> </span>
                            <span> <i class="fab fa-instagram"></i> </span>
                            <span> <i class="fab fa-pinterest-p"></i> </span>
                            <span> <i class="fab fa-snapchat-ghost"></i> </span>
                            <span> <i class="fab fa-youtube"></i> </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="links-box">
                        <div class="row">
                            <div class="col-4">
                                <div class="category-links">
                                    <p class="title" >CATEGORIES</p>
                                    <?php
                                        $cats = get4categories();
                                        foreach($cats as $cat ){
                                            echo '<a href="#">'. $cat['Category_Name'] .'</a>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="links">
                                    <p  class="title" >LINKS</p>
                                    <a href="#"> Carts </a>
                                    <a href="#"> My Orders </a>
                                    <a href="#"> Favourite </a>
                                    <a href="aboutUs.php"> About Us </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="HELP">
                                    <p  class="title" > HELP</p>
                                    <a href="#"> Track Order </a>
                                    <a href="#"> Returns </a>
                                    <a href="#"> Shipping </a>
                                    <a href="#"> FAQs </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="get_notification">
                        <p  class="title" > NEWSLETTER </p>
                        <input type="text" placeholder="eamil@example.com"  />
                        <button href="index.php" class="btn-custom btn-custom-white" style=""> SUBSCRIBE </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="payment-images text-center">
            <span> <img src="assets/images/backgrounds/footer_icons/discover.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/eps.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/express.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/mastercard.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/oxxo.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/p.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/pago.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/paypal.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/postepay.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/sofort.png" alt=""> </span>
            <span> <img src="assets/images/backgrounds/footer_icons/visa.png" alt=""> </span>
        </div>
        <div class="copyright text-center">
            Copyright © 2019 All rights reserved. | This site is made with  by Povami Software
        </div>
    </div>












<?php
    include("includes/template/footer.php");
    
?>






