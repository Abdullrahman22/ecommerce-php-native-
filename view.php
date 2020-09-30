<?php
    $pagetitle = "View Item"; 
    include("includes/template/header.php");
    include("navbar.php");

    

    if( isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ){
        $itemid = intval( $_GET["itemid"] );
    }else{
        $itemid = 0;
        header("Location: index.php");
    }
    if( checkItemExist($itemid) == 0 ){
        header("Location: index.php");
    }
    $row = getItemById($itemid);




    if(isset($_POST["btnAddComment"])){
  

        $userid         = $_POST['userid'];
        $itemid         = $_POST['itemid'];
        $comment        = security( trim( $_POST['comment']) );

        $comment_status = 1 ;  // make status not empty;


        //===================== userid Validation ==============================
        if( $userid != $_SESSION["loginUserID"]  ){
            header("Location: index.php");
        }

        
        //===================== itemid Validation ==============================
        if( $itemid != $_GET["itemid"]  ){
            header("Location: index.php");
        }

        
        //===================== comment Validation ==============================
        if( $comment == "" ){
            $comment_error =  "comment is empty";
            $comment_status = "";

        }else{
            if(strlen($comment) > 240 || strlen($comment) < 5 ){
                $comment_error =   "comment must be between 5 and 25 characters";
                $comment_status = "";
            }
        }



        //===================== Insert user into database ==============================
        if( !empty($comment_status) ){


            $stmt3 = $con->prepare(" INSERT INTO 
                                comments ( comment , User_ID , item_ID )
                                VALUES( :zcomment , :zUser_ID , :zitem_ID )");
            $stmt3->execute(array(
                ":zcomment"   => $comment,
                ":zUser_ID"   => $userid,
                ":zitem_ID"   => $itemid,
            ));
            if($stmt3->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                header("Location: view.php?itemid=$itemid");
            }else{
                header("Location: view.php?itemid=$itemid" );
            }



        }


    }



?>





    <div id="view-page">


    










        <div class="product">

            <div class="container">
                <div class="row">
                    
                    <div class="col-md-4"> 
                        <img src="assets/images/product-img/<?php echo $row["Pic"];?>" alt="" class="img-fluid product-img"/>
                    </div>
                    <div class="col-md-8"> 
                        <p class="Item_Name"> <?php echo $row["Item_Name"];?> </p>
                        <p class="Price">
                            Price : <span class="recent-price"> <?php echo $row["Price"];?> EGP </span> 
                            <span class="last-price" > <?php echo $row["fake_price"];?> EGP </span> 
                            <span class="discounte">  <?php echo $row["discount"] ; ?>% <br> OFF </span>
                        </p>
                        <p class="Category_Name"> Category : <a href="#"> <?php echo $row["Category_Name"];?> </a> </p>
                        <p class="mount" > Mount : <?php echo $row["mount"];?> </p>
                        <hr>
                        <p class="Description" > <span style="color:#000"> Description : </span> <?php echo $row["Description"];?> </p>
                        <hr>
                        <br>
                        <div class="item-buttons">
                            <?php 
                                if( isset ($_SESSION["loginUserID"])){
                                    echo '  <p class="btn-custom btn-custom-white add_cart" itemid="'. $row['Item_ID']  .'"> <i class="fas fa-cart-plus"></i> Add To Cart</p>';
                                    echo '  <p class="btn-custom btn-custom-white add_favorite" itemid="'. $row['Item_ID']  .'"> <i class="fas fa-heart"></i> Add To Favourtie</p>';
                                }else{
                                    echo '  <a href="login.php" class="btn-custom btn-custom-white " > Add To Cart </a> ';
                                }
                            ?>
                            &nbsp; &nbsp;  <span class="loves-section"> <i class="fas fa-heart"></i> <span> <?php echo $row["loves"];?> </span> </span>
                        </div>
                         
                        <div class="social_share"> Share To :  
                            <span> <a href="#"> <i class="fab fa-facebook-square"></i> </a> </span>
                            <span> <a href="#"> <i class="fab fa-twitter-square"></i> </a> </span>
                            <span> <a href="#"> <i class="fab fa-instagram"></i> </a> </span>
                            <span> <a href="#"> <i class="fab fa-invision"></i> </a> </span>

                        </div>
                        <div class="payment-images">
                            <span> <img src="assets/images/backgrounds/mcafee_secure.png" alt=""/></span>
                            <span> <img src="assets/images/backgrounds/paypal.png" alt=""/></span>
                            <span> <img src="assets/images/backgrounds/money_back.png" alt=""/></span>

                        </div>
                        <div class="secure_info">
                            <span> <i class="fas fa-dollar-sign"></i> Tax Info </span>
                            <span> <i class="fas fa-shield-alt"></i> Price Protection </span>
                            <span> <i class="fas fa-info-circle"></i>  Price Disclaimer </span>
                            <span> <i class="fas fa-pen"></i> Report Item </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>



        <div class="comment">

            <div class="container">

                <div class="row"> 
                    <div class="col-md-10 offset-md-1">
                        <span class="title"> CUSTOMER REVIEWS </span>
                        <hr>
                        <div class="stras"> <span> <?php echo $row["stars"];  ?> </span> Out OF 5 &nbsp; <i class="fas fa-star"></i> </div>
                        
                        <div class="form-box">
                            <?php
                                if( isset(  $_SESSION["loginUserID"] )   ){
                                    ?>
                                        <div class="put-comment">

                                            <form action="?itemid=<?php echo $row["Item_ID"]; ?>" method="POST" >
                                                <h4> Post a comment </h4>
                                                <textarea class="form-control "  name="comment" require >

                                                </textarea>
                                                <input type="hidden" name="userid" value="<?php echo $_SESSION["loginUserID"]  ; ?>" /> 
                                                <input type="hidden" name="itemid" value="<?php echo $_GET["itemid"] ; ?>" /> 
                                                <input type="submit" name="btnAddComment" class="btn-custom btn-custom-white" value="Submit Now" />
                                            </form>

                                        </div>
                                    <?php
                                }
                            ?>
                        </div> 

                        <?php

                        $comments = getCommentByItemId( $itemid );
                        $count = commentExist( $itemid );
                        if( $count > 0){
                            foreach( $comments as $comment){

                            
                        ?>
                        <div class=""> 
                                <div class="comment-box">
                                    <div class="user-box">
                                        <?php


                                            $stmt2 = $con->prepare("SELECT gender FROM users WHERE UserID = ? LIMIT 1");
                                            $stmt2->execute( array( $comment["User_ID"] ) );
                                            $row = $stmt2->fetch();
                                            if( $row["gender"] == 0){
                                                $photo = "dafulte-img-male.jpg";
                                            }else{
                                                $photo = "dafulte-img-female.jpg";
                                            }
                                        ?>
                                        <div class="user-img"> <img src="assets/images/backgrounds/<?php echo  $photo; ?>" class="" alt="" /> </div>
                                        <div class="user-info">
                                            <div class="username">  <?php echo $comment["Username"] ?> </div>
                                            <div class="comment-date"> <?php echo $comment["date"] ?> </div>
                                        </div>
                                    </div>
                                    <div class="user-comment">
                                        <p> <?php echo $comment["comment"] ?> </p>
                                    </div>

                                </div>  

                            <?php
                            }                          
                        }else{
                            ?>
                                <div class="comment-box no-comment">  <i class="fas fa-info-circle"></i> No Reviews For This Item... <?php if( !isset( $_SESSION["loginUserID"] ) ){ echo "<a href='login.php'>Login to review</a> " ;} ?> </div>
                            <?php
                        }
                        ?>








                    </div>
                </div>

            </div>

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



