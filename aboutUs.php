<?php
    $pagetitle = "About Us"; 
    include("includes/template/header.php");
    include("navbar.php");

    
?>






    <div class="header_section">
        <div class="overlay">
            <div class="bg_header">
                <div class="container">
                    <div class="Welcome_box">
                        <h1> Shop With Us </h1>
                        <p> You can shopping here by Visa Card or Vodaphone cash! </p>
                        <a href="categoroes.php" class="btn-custom btn-custom-white"  >   <i class="fas fa-cart-plus"></i> Shop now </a> 
                    </div>
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

                    <div class="col-md-4 col-sm-6">

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
                    <div class="col-md-4 col-sm-6">
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
                    <div class="col-md-4 col-sm-6">

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
                    <div class="col-md-4 col-sm-6">
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
                    <div class="col-md-4 col-sm-6">
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
                    <div class="col-md-4 col-sm-6">
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
                      <p> Up To 50% Off </p>
                <p> Winter Sale  </p>
                <p> Him she'd let them sixth saw light </p>
                <button href="categoroes.php">   <i class="fas fa-cart-plus"></i> Shop now </button>

-->