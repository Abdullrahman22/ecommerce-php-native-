<?php
    $pagetitle = "Home"; 
    include("includes/template/header.php");
    include("navbar.php");

    
?>



    
    <div class="products_section">
        <div class="container">

            <p class="text-center"> Our Products </p>    
            <div class="content-title-underline"></div>            
    
           
            <div class="lasted-items">
                <p> <i class="fas fa-clipboard-list"></i>  NEW </p>
                <div class="content-title-underline-left"></div>            

                <div class="row items-rows owl-carousel owl-theme">
                    <?php 
                        $rows = getlastedItems();
                        foreach( $rows as $row){

                        
                    ?>
                        <div class="col-12">
                            <div class="product-item text-center">
                                <div class="item-img">
                                    <img src="assets/images/product-img/<?php echo $row["Pic"] ; ?>" alt="" class='img-fluid' />
                                    <span class="discounte">  <?php echo $row["discount"] ; ?>% <br> OFF </span>
                                </div>
                                <p class="item-name">
                                    <a href="view.php?itemid=<?php echo  $row["Item_ID"] ; ?>" >
                                        <?php echo $row["Item_Name"] ; ?>
                                    </a>
                                </p>
                                <div class="item-info">
                                    <span> <i class="fas fa-star"></i> <?php echo $row["stars"] ; ?></span>
                                    <span> <i class="fas fa-heart"></i> <?php echo $row["loves"] ; ?></span>
                                    <span> <i class="fas fa-eye"></i> <?php echo $row["views"] ; ?> </span>
                                </div>
                                <p class="last-price text-left">RRP: <span><?php echo $row["fake_price"] ; ?> EGP </span>  </p>
                                <p class="price text-left"> Price : <?php echo $row["Price"] ; ?> EGP </p>
                                <div class="item-buttons">
                                    <?php 
                                        if( isset ($_SESSION["loginUserID"])){
                                            echo '  <p class="btn-custom btn-custom-white add_cart" itemid="'. $row['Item_ID']  .'"> <i class="fas fa-cart-plus"></i> Cart</p> ';
                                        }else{
                                            echo '  <a href="login.php" class="btn-custom btn-custom-white " > <i class="fas fa-cart-plus"></i> Cart</a> ';
                                        }
                                    ?>
                                        <a href="view.php?itemid=<?php echo  $row["Item_ID"] ; ?>" class="btn-custom btn-custom-white" > <i class="fas fa-eye"></i> View </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>



                </div>
            </div>

   
           
            <div class="recommended-seller">
                <p> <i class="far fa-thumbs-up"></i>   RECOMMENDED FOR YOU </p>
                <div class="content-title-underline-left"></div>            
                <div class="row items-rows owl-carousel owl-theme">
                    <?php 
                        $rows = getRandomItems();
                        foreach( $rows as $row){

                        
                    ?>
                        <div class="col-12">
                            <div class="product-item text-center">
                                <div class="item-img">
                                    <img src="assets/images/product-img/<?php echo $row["Pic"] ; ?>" alt="" class='img-fluid' />
                                    <span class="discounte">  <?php echo $row["discount"] ; ?>% <br> OFF </span>
                                </div>
                                <p class="item-name">
                                    <a href="view.php?itemid=<?php echo  $row["Item_ID"] ; ?>" >
                                        <?php echo $row["Item_Name"] ; ?>
                                    </a>
                                </p>
                                <div class="item-info">
                                    <span> <i class="fas fa-star"></i> <?php echo $row["stars"] ; ?></span>
                                    <span> <i class="fas fa-heart"></i> <?php echo $row["loves"] ; ?></span>
                                    <span> <i class="fas fa-eye"></i> <?php echo $row["views"] ; ?> </span>
                                </div>
                                <p class="last-price text-left">RRP: <span><?php echo $row["fake_price"] ; ?> EGP </span>  </p>
                                <p class="price text-left"> Price : <?php echo $row["Price"] ; ?> EGP </p>
                                <div class="item-buttons">
                                    <?php 
                                        if( isset ($_SESSION["loginUserID"])){
                                            echo '  <p class="btn-custom btn-custom-white add_cart" itemid="'. $row['Item_ID']  .'"> <i class="fas fa-cart-plus"></i> Cart</p> ';
                                        }else{
                                            echo '  <a href="login.php" class="btn-custom btn-custom-white " > <i class="fas fa-cart-plus"></i> Cart</a> ';
                                        }
                                    ?>
                                    <a href="view.php?itemid=<?php echo  $row["Item_ID"] ; ?>" class="btn-custom btn-custom-white" > <i class="fas fa-eye"></i> View </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>



                </div>
            </div>


    
           
            <div class="best-seller">
                <p> <i class="fas fa-gem"></i>  BEST SELLER </p>
                <div class="content-title-underline-left"></div>            
                <div class="row items-rows owl-carousel owl-theme">
                    <?php 
                        $rows = getRandomItems();
                        foreach( $rows as $row){

                        
                    ?>
                        <div class="col-12">
                            <div class="product-item text-center">
                                <div class="item-img">
                                    <img src="assets/images/product-img/<?php echo $row["Pic"] ; ?>" alt="" class='img-fluid' />
                                    <span class="discounte">  <?php echo $row["discount"] ; ?>% <br> OFF </span>
                                </div>
                                <p class="item-name">
                                    <a href="view.php?itemid=<?php echo  $row["Item_ID"] ; ?>" >
                                        <?php echo $row["Item_Name"] ; ?>
                                    </a>
                                </p>
                                <div class="item-info">
                                    <span> <i class="fas fa-star"></i> <?php echo $row["stars"] ; ?></span>
                                    <span> <i class="fas fa-heart"></i> <?php echo $row["loves"] ; ?></span>
                                    <span> <i class="fas fa-eye"></i> <?php echo $row["views"] ; ?> </span>
                                </div>
                                <p class="last-price text-left">RRP: <span><?php echo $row["fake_price"] ; ?> EGP </span>  </p>
                                <p class="price text-left"> Price : <?php echo $row["Price"] ; ?> EGP </p>
                                <div class="item-buttons">
                                    <?php 
                                        if( isset ($_SESSION["loginUserID"])){
                                            echo '  <p class="btn-custom btn-custom-white add_cart" itemid="'. $row['Item_ID']  .'"> <i class="fas fa-cart-plus"></i> Cart</p> ';
                                        }else{
                                            echo '  <a href="login.php" class="btn-custom btn-custom-white " > <i class="fas fa-cart-plus"></i> Cart</a> ';
                                        }
                                    ?>
                                    <a href="view.php?itemid=<?php echo  $row["Item_ID"] ; ?>" class="btn-custom btn-custom-white" > <i class="fas fa-eye"></i> View </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>



                </div>
            </div>



        </div>
    </div>




    <section id="stats">

        <div id="stats-cover" class="bg-parallax">

            <div class="content-box">
                <div class="content-title content-title-white wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
                    <h3> We Never Stop Improving </h3>
                    <div class="content-title-underline"></div>
                </div>

                <div class="container">

                    <div class="row text-center wow animated bounceInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                        <div class="col-md-3 col-sm-6">
                            <div class="stats-item">
                                <i class="fa fa-cart-plus fa-5x"></i>
                                <h2><span class="counter"> 1590 </span><span>+</span></h2>
                                <p>Buying</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="stats-item">
                                <i class="fas fa-heart fa-5x"></i> 
                                <h2><span class="counter"> 3500 </span><span>+</span></h2>
                                <p>Awards</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="stats-item">
                                <i class="fas fa-star fa-5x"></i>  
                                <h2><span class="counter"> 1199 </span><span>+</span></h2>
                                <p>Likes</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="stats-item">
                                <i class="fa fa-user fa-5x"></i>
                                <h2><span class="counter"> 2200 </span><span>+</span></h2>
                                <p>accounts</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- End Content Box -->
        </div>
    </section>




    <section class="store_team">
        <div class="container text-center">
            <p> Leadership Team </p>    
            <div class="content-title-underline"></div>            
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-5 "> 
                    <div class="person">

                        <img src="assets/images/backgrounds/person_1.jpg" class="img-fluid" alt="" />
                        <p class="name"> John Rooster </p>
                        <p class="position"> CO-FOUNDER, PRESIDENT </p>
                        <p class="description"> Nisi at consequatur unde molestiae quidem provident voluptatum deleniti quo iste error eos est praesentium distinctio cupiditate tempore suscipit inventore deserunt tenetur.</p>
                        <div class="social-media text-center">
                            <span><a href="#" class=""> <i class="fab fa-twitter-square"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-instagram"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-invision"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-facebook"></i> </a></span>
                        </div>


                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 "> 
                    <div class="person">
                        <img src="assets/images/backgrounds/person_2.jpg" class="img-fluid" alt="" />
                        <p class="name"> Tom Sharp </p>
                        <p class="position"> CO-FOUNDER, COO </p>
                        <p class="description"> Nisi at consequatur unde molestiae quidem provident voluptatum deleniti quo iste error eos est praesentium distinctio cupiditate tempore suscipit inventore deserunt tenetur.</p>
                        <div class="social-media text-center">
                            <span><a href="#" class=""> <i class="fab fa-twitter-square"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-instagram"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-invision"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-facebook"></i> </a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 "> 
                    <div class="person">
                        <img src="assets/images/backgrounds/person_3.jpg" class="img-fluid" alt="" />
                        <p class="name"> Ahmed Albably </p>
                        <p class="position"> YOUTUBER FOR MARKETING</p>
                        <p class="description"> Nisi at consequatur unde molestiae quidem provident voluptatum deleniti quo iste error eos est praesentium distinctio cupiditate tempore suscipit inventore deserunt tenetur.</p>
                        <div class="social-media text-center">
                            <span><a href="#" class=""> <i class="fab fa-twitter-square"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-instagram"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-invision"></i> </a></span>
                            <span><a href="#" class=""> <i class="fab fa-facebook"></i> </a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


   
    <div class="our_offers bg-parallax">
        <div class="overlay">
            <div class="col-md-5">
                <div class="our_offers_inner text-center">
                    <p>Up To 50% Off</p>
                    <p>Winter Sale</p>
                    <p>Take the opportunity and buy</p>
                    <a href="category.php?catid=1" class="btn-custom btn-custom-white"> Shop Now!</a>
                </div>
            </div>
        </div>                      
    </div>


    <!-- Services -->
    <section id="services">

        <div class="content-box">
            <div class="content-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
                <h3> Services </h3>
                <div class="content-title-underline"></div>
            </div>

            <div class="container">

                <div class="row">

                    <div class=" col-md-6 col-sm-12">

                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                            <div class="service-item-icon">
                                <i class="fa fa-paint-brush fa-3x"></i>
                            </div>

                            <div class="service-item-title">
                                <h3> Attractive Designs</h3>
                            </div>

                            <div class="service-item-desc">
                                <p>Get Awesome Designs Online For Ladies and Men</p>
                            </div>

                        </div>

                    </div>
                    <div class=" col-md-6 col-sm-12">
                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                            <div class="service-item-icon">
                                <i class="fas fa-truck fa-3x"></i>
                            </div>

                            <div class="service-item-title">
                                <h3> Delivery Services</h3>
                            </div>

                            <div class="service-item-desc">
                                <p>Find Fast Delivery For Yours Products with In 14 Days</p>
                            </div>

                        </div>


                    </div>
                    <div class=" col-md-6 col-sm-12">

                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                            <div class="service-item-icon">
                                <i class="fas fa-restroom fa-3x"></i>
                            </div>

                            <div class="service-item-title">
                                <h3>Unisex products</h3>
                            </div>

                            <div class="service-item-desc">
                                <p>Find Your Products Whether For Men Or Women </p>
                            </div>

                        </div>

                    </div>
                    <div class=" col-md-6 col-sm-12">
                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                            <div class="service-item-icon">
                                <i class="fas fa-envelope fa-3x"></i>
                            </div>

                            <div class="service-item-title">
                                <h3> company@gmail.com </h3>
                            </div>

                            <div class="service-item-desc">
                                <p>You Can Mail Us To Now Lasted Products</p>
                            </div>

                        </div>
                    </div>
                    <div class=" col-md-6 col-sm-12">
                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                            <div class="service-item-icon">
                                <i class="fas fa-comment-dots fa-3x"></i>
                            </div>

                            <div class="service-item-title">
                                <h3> Live Chat  </h3>
                            </div>

                            <div class="service-item-desc">
                                <p> You Can Contact With Us To Know More Offers</p>
                            </div>

                        </div>


                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                            <div class="service-item-icon">
                                <i class="fas fa-donate fa-3x"></i>
                            </div>

                            <div class="service-item-title">
                                <h3> Custom Offers </h3>
                            </div>

                            <div class="service-item-desc">
                                <p> We Have Discount Offers Up To 50% Percent</p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>


        </div>

    </section>




    <div id="scroll-to-top">
        <i class="fas fa-arrow-circle-up"></i>    
    </div>


    <?php
        

        if( isset( $_SESSION["loginUserID"] ) && !isset( $_SESSION["loginAdmin"] ) ){
        ?>

            <div id="messege-icon">
                    <i class="fas fa-sms"></i>
                </div>

                <div id="messege-box">
                    <div class="top-bar">
                        <i class="fas fa-times"></i>
                        <p> <i class="fas fa-headset"></i> Technical support</p> 
                    </div>
                    <div class="messege-section">

                        <div class="welcome-messeges">

                                <div class="friend-messege">
                                    <div class="friend-messege-content">
                                        <div class="message">
                                            <span class="triangle"></span>
                                                Welcome to snoffle shop ^^
                                        </div>
                                    </div>
                                </div>
                        

                                <div class="friend-messege">
                                    <div class="friend-messege-content">
                                        <div class="message">
                                            <span class="triangle"></span>
                                                How can i help you today ? 
                                        </div>
                                    </div>
                                </div>
                        


                        </div>

                        
                        <div class="messeges-area">

                        </div>

                    </div>
                    <div class="keyboard-section">
                        <form class="content-icon" enctype="multipart/form-data">
                            <label for="file" id="file-label">  <i class="fas fa-paperclip"></i> </label>
                            <input type="file" class="file form-control" id="file" name="file"   /> 
                        </form>
                        <input type="text" class="form-control keyboard-input" id="send-messege" placeholder="Type Your Messege..." autocomplete="off" autofocus   />
                        <i class="fas fa-paper-plane" style="display:none"></i>
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                </div>


        <?php
        }
    ?>
    
    


 

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
<!--



if( isset( $_SESSION["loginUserID"]   ) && !isset( $_SESSION["loginAdmin"] ) ){
















-->