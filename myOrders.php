<?php
    $pagetitle = "My Orders"; 
    include("includes/template/header.php");
    if( !isset(  $_SESSION["loginUserID"] )   ){
        header("Location: login.php");
    }
    include("navbar.php");
?>

    <div id="myOrders-page">
        <h3 class="text-center">  <i class="fas fa-tasks"></i> My Orders </h3>
        <div class="content-title-underline"></div>            


        <div class="container">

            <p class="text-right"> Want Some to order new Items ? <a href="category.php">Continue Shopping</a> </p>
            <br>
            <?php
                $cartsNum = countOrders(  $_SESSION["loginUserID"]  );
                if( $cartsNum > 0 ){
                    
            ?>
            <p> - you have <?php echo $cartsNum ;?> items in your Orders</p>
            <br>
            <br>

        </div>
        <?php
        $stmt = $con->prepare(" SELECT
                        orders.* , items.Item_Name FROM orders 
                        INNER JOIN  items ON items.Item_ID = orders.item_id
                        WHERE user_ID = ? 
                        ORDER BY order_ID DESC ");
        $stmt->execute( array( $_SESSION["loginUserID"] ) );
        $rows = $stmt->fetchAll();
        ?>
        <div class="table-container">
            <div class="table-responsive ">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> <i class="far fa-images"></i> Item Img</th>
                            <th scope="col"> <i class="fas fa-cart-plus" ></i> Item Name</th>
                            <th scope="col"> <i class="fas fa-dollar-sign"></i> Price</th>
                            <th scope="col"> <i class="fas fa-layer-group"></i> Mount </th>
                            <th scope="col"> <i class="fas fa-dollar-sign"></i> Received Money </th>
                            <th scope="col"> <i class="fas fa-truck"></i> Delivery Products</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach( $rows as $row){

                                $items = getItemById( $row["item_id"] );

                                ?>

                                    <tr>
                                        <th scope="row"> <img src="assets/images/product-img/<?php echo $items["Pic"] ; ?>" alt="" class="product-img"/>  </th>
                                        <th scope="row">   <?php echo $items["Item_Name"] ; ?>    </th>
                                        <th scope="row"> 
                                            &nbsp; <span class="old-price" > EGP : <?php echo $items["fake_price"] ; ?> </span>
                                            <br>
                                            &nbsp; <span class="new-price"> EGP : <?php echo $items["Price"] ; ?> </span> 
                                        </th>
                                        <th scope="row"> <?php echo $row["quantity"] ; ?> </th>
                                        <th scope="row">
                                            <?php if( $row["received_money"] == "0"){ echo " <img src='assets/images/backgrounds/Spinner.gif' alt=''/> Checking";} ?>
                                            <?php if( $row["received_money"] == "1"){ echo " <i class='fas fa-check'></i>  Recieved";} ?>
                                            <?php if( $row["received_money"] == "2"){ echo " <i class='fas fa-times-circle'></i> Not recieved money try again";} ?>
                                        </th>
                                
                                        <th scope="row">
                                            <?php if( $row["arrival_products"] == "0"){ echo "<img src='assets/images/backgrounds/Spinner.gif' alt=''/> Checking";} ?>
                                            <?php if( $row["arrival_products"] == "1"){ echo " <i class='fas fa-truck'></i> In Way";} ?>
                                            <?php if( $row["arrival_products"] == "2"){  echo " <i class='fas fa-check'></i>  Delivered";} ?>
                                            <?php if( $row["arrival_products"] == "3"){  echo " <i class='fas fa-times-circle'></i> Frist Send money"; } ?>
                                        </th>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
 
        <?php }else{
        ?>
        <div class="no-carts text-center">
        You don't have items Carts <a href="category.php?catid=1"> Shop Now!</a>
        </div>


        <?php }?>











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