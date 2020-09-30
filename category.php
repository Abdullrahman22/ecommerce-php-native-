<?php
    $pagetitle = "Categories"; 
    include("includes/template/header.php");
    include("navbar.php");

    


    

    if( isset($_GET["catid"]) && is_numeric($_GET["catid"]) ){
        $catid = intval( $_GET["catid"] );
    }else{
        $catid = 0;
        header("Location: index.php");
    }
    if( checkCategoryExist($catid) == 0 ){
        header("Location: index.php");
    }
    $cat = getCategory($catid);





?>

    <div id="category-page">

        <?php
            $stmt = $con->prepare("SELECT * FROM `categories` ORDER BY `Category_ID`  ");
            $stmt->execute( array(  ) );
            $rows = $stmt->fetchAll();
        ?>
        <div class="fixed-nav">
            <div class="fixed-nav-inner text-center ">
                <div class="nav-info"> CHOOSE CATEGORIES</div>
                <?php
                    foreach( $rows as $row ){
                    ?>
                        <a href="?catid=<?php echo  $row["Category_ID"] ;?>" alt=""    <?php if( $catid == $row["Category_ID"]  ) {echo ' style="background-color: #1793e546" ';}?>  > <?php  echo $row["Category_Name"]; ?></a> 
                    <?php
                    }
                ?>
            </div>
        </div>

        <div id="nav_mob">
            <div class="container">
            <div class="nav_mob">
                <div class="tilte">CHOOSE CATEGORIES &nbsp; <i class="fas fa-arrow-down"></i> </div>
                <hr>
            </div>
            <div class="custom-dropdown hidden">
                <?php
                    foreach( $rows as $row ){
                    ?>
                        <a href="?catid=<?php echo  $row["Category_ID"] ;?>"  alt=""    <?php if( $catid == $row["Category_ID"]  ) {echo ' style="background-color: #1793e546" ';}?>    > <?php  echo $row["Category_Name"]; ?> </a> 
                    <?php
                    }
                ?>
            </div>
        </div>

        
        </div>

        <div class="category-section">
            <div class="products_section">
                <div class="container">
                    <p class="text-center"> <?php  echo $cat["Category_Name"] ; ?> </p>    
                    <div class="content-title-underline"></div> 
                    <div class="row">
           
                        <?php

                            $tables = getitemsBycatid($catid);
                            foreach( $tables as $table){
                        ?>     
                                
                                <div class=" col-lg-4 col-md-6 col-sm-6">
                                    <div class="product-item text-center">

                                        <div class="item-img">
                                            <img src="assets/images/product-img/<?php echo $table["Pic"] ; ?>" alt="" class='img-fluid' />
                                            <span class="discounte">  <?php echo $table["discount"] ; ?>% <br> OFF </span>
                                        </div>
                                        <p class="item-name">
                                            <a href="view.php?itemid=<?php echo  $table["Item_ID"] ; ?>" >
                                                <?php echo $table["Item_Name"] ; ?>
                                            </a>
                                        </p>                  
                                        <div class="item-info">
                                            <span> <i class="fas fa-star"></i> <?php echo $table["stars"] ; ?></span>
                                            <span> <i class="fas fa-heart"></i> <?php echo $table["loves"] ; ?></span>
                                            <span> <i class="fas fa-eye"></i> <?php echo $table["views"] ; ?> </span>
                                        </div>
                                        <p class="last-price text-left">RRP: <span><?php echo $table["fake_price"] ; ?> EGP </span>  </p>
                                        <p class="price text-left"> Price : <?php echo $table["Price"] ; ?> EGP </p>
                                        <div class="item-buttons">
                                        <?php 
                                                if( isset ($_SESSION["loginUserID"])){
                                                    echo '  <p class="btn-custom btn-custom-white add_cart" itemid="'. $table['Item_ID']  .'"> <i class="fas fa-cart-plus"></i> Cart</p> ';
                                                }else{
                                                    echo '  <a href="login.php" class="btn-custom btn-custom-white " > <i class="fas fa-cart-plus"></i> Cart</a> ';
                                                }
                                            ?>
                                                <a href="view.php?itemid=<?php echo  $table["Item_ID"] ; ?>" class="btn-custom btn-custom-white" > <i class="fas fa-eye"></i> View </a>
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




        <div id="scroll-to-top">
            <i class="fas fa-arrow-circle-up"></i>    
        </div>









    </div>

    




<?php
    include("includes/template/footer.php");
    
?>
<!--





                           <div class="product-item text-center">

                                    <div class="item-img">
                                        <img src="assets/images/product-img/<?php echo $table["Pic"] ; ?>" alt="" class='img-fluid' />
                                        <span class="discounte"> 50% <br> OFF </span>
                                    </div>
                                    <p class="item-name"><?php echo $table["Item_Name"] ; ?></p>
                                    <div class="item-info">
                                        <span> <i class="fas fa-star"></i> <?php echo $table["stars"] ; ?></span>
                                        <span> <i class="fas fa-heart"></i> <?php echo $table["loves"] ; ?></span>
                                        <span> <i class="fas fa-eye"></i> <?php echo $table["views"] ; ?> </span>
                                    </div>
                                    <p class="last-price text-left">RRP: <span><?php echo $table["fake_price"] ; ?> EGP </span>  </p>
                                    <p class="price text-left"> Price : <?php echo $table["Price"] ; ?> EGP </p>
                                    <div class="item-buttons">
                                    <?php 
                                            if( isset ($_SESSION["loginUserID"])){
                                                echo '  <p class="btn-custom btn-custom-white add_cart" itemid="'. $table['Item_ID']  .'"> <i class="fas fa-cart-plus"></i> Cart</p> ';
                                            }else{
                                                echo '  <a href="login.php" class="btn-custom btn-custom-white " > <i class="fas fa-cart-plus"></i> Cart</a> ';
                                            }
                                        ?>
                                            <a href="view.php?itemid=<?php echo  $table["Item_ID"] ; ?>" class="btn-custom btn-custom-white" > <i class="fas fa-eye"></i> View </a>
                                    </div>
                                </div>





-->