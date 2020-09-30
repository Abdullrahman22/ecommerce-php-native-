<?php
    $pagetitle = "Items Page"; 
    include("../includes/template/admin_header.php");
    if( !isset( $_SESSION["loginAdmin"] ) ){
        header("Location: ../login.php");
    }else{ 

    
        $do = "";
        if(isset($_GET["do"])){
            $do = $_GET["do"];
        }else{
            $do = "manage";
        }
        /*=================================================================================================
        ===================================================================================================
        ================================ Manage Page ====================================================*/
        if($do == "manage"){ 

            $stmt = $con->prepare(" SELECT
                                items.*, categories.Category_Name FROM items 
                                INNER JOIN categories ON categories.Category_ID = items.Cat_ID ORDER BY Item_ID DESC
            ");
            $stmt->execute();
            $rows = $stmt->fetchAll();

            ?>
                <div class="container">

                    <h1 class="text-center" style="padding: 30px 0" >  <i class="fas fa-cart-plus"></i> Items Page  </h1>   
                    <?php
                        if( isset($_SESSION["add_item_success"])){
                            echo '<div class="add-item-success-messege "> ';
                                echo '<p class="text-center">';
                                    echo $_SESSION["add_item_success"] ;
                                echo '</p>';
                            echo '</div>';
                        }
                        elseif ( isset($_SESSION["add_item_failed"]) ) {
                            echo '<div class="add-item-failed-messege"> ';
                                echo '<p class="text-center">';
                                    echo $_SESSION["add_item_failed"] ;
                                echo '</p>';
                            echo '</div>';
                        }
                        unset( $_SESSION["add_item_success"] );
                        unset( $_SESSION["add_item_failed"] );
                    ?>

                    <?php
                        if( isset($_SESSION["edit_item_success"])){
                            echo '<div class="edit-item-success-messege "> ';
                                echo '<p class="text-center">';
                                    echo $_SESSION["edit_item_success"] ;
                                echo '</p>';
                            echo '</div>';
                        }
                        elseif ( isset($_SESSION["edit_item_failed"]) ) {
                            echo '<div class="edit-item-failed-messege"> ';
                                echo '<p class="text-center">';
                                    echo $_SESSION["edit_item_failed"] ;
                                echo '</p>';
                            echo '</div>';
                        }
                        unset( $_SESSION["edit_item_success"] );
                        unset( $_SESSION["edit_item_failed"] );
                    ?>
                    <a href="items.php?do=add" class="btn  btn-primary" style="margin-bottom:20px"> <i class="fas fa-plus"></i> Add New Item</a>
                    <div class="table-responsive items-table">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#id</th>
                                <th scope="col">item img</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Fake Price</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Stars</th>
                                <th scope="col">Loves</th>
                                <th scope="col">Views</th>
                                <th scope="col">Mount</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach( $rows as $row){
                                        echo '<tr>';
                                        echo '<th scope="row">'. $row["Item_ID"] .'</th>';
                                        echo '<th scope="row"> <img src="../assets/images/product-img/'. $row["Pic"] .'"  alt="" class="product-img" /> </th>';
                                        echo '<th scope="row">'. $row["Item_Name"] .'</th>';
                                        echo '<th scope="row">'. $row["Description"] .'</th>';
                                        echo '<th scope="row">'. $row["fake_price"] .'</th>';
                                        echo '<th scope="row">'. $row["Price"] .'</th>';
                                        echo '<th scope="row"> %' . $row["discount"] .'</th>';
                                        echo '<th scope="row">'. $row["Date"] .'</th>';
                                        echo '<th scope="row">'. $row["Category_Name"] .'</th>';
                                        echo '<th scope="row">'. $row["stars"] .'</th>';
                                        echo '<th scope="row">'. $row["loves"] .'</th>';
                                        echo '<th scope="row">'. $row["views"] .'</th>';
                                        echo '<th scope="row">'. $row["mount"] .'</th>';
                                        echo '<th scope="row"> <a href="items.php?do=edit&itemid='. $row["Item_ID"] .'" class="btn btn-block btn-info" style="color:#fff"> <i class="fas fa-edit"></i>  Edit</a> </th>';
                                        echo '<th scope="row"> <a href="items.php?do=delete&itemid='. $row["Item_ID"] .'" class="btn btn-block btn-danger checked-btn "> <i class="far fa-trash-alt"></i> Delete</a> </th>';
                                        echo '<tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php    
        } 
        /*============================== Manage Page ======================================================
        ===================================================================================================
        ================================ Add Page =======================================================*/
        if ($do == "add"){  
            // Add Page

            if(isset($_POST["addItemsBtn"])){


                $itemName         = security($_POST['itemName']);
                $description      = security($_POST['description']);
                $price            = security($_POST['price']);
                $fake_price       = security($_POST['fake_price']);
                $discount         = security($_POST['discount']);
                $loves            = security($_POST['loves']);
                $stars            = security($_POST['stars']);
                $views            = security($_POST['views']);
                $mount            = security($_POST['mount']);
                $categories       = security($_POST['categories']);

        


                $img_name           = $_FILES["img"]["name"] ;
                $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
                $tmp_name           = $_FILES["img"]["tmp_name"] ;
                $store_files        = "../assets/images/product-img";
                $extentions         = array("jpg" ,"png" , "jpeg" );
                $get_file_extention = explode("." , $img_name);
                $get_extention      = strtolower( end($get_file_extention) ) ;




                $itemName_status = $description_status = $price_status = $fake_price_status =  $discount_status = $loves_status = $stars_status = $views_status = $mount_status = $categories_status = $img_status = 1 ;  // make status not empty;



                //===================== itemName Validation ==============================
                if( empty( $itemName ) ){
                    $itemName_error = "Item Name is required";
                    $itemName_status = ""; // make email_status empty
                }else {
                    if(strlen($itemName) > 16 || strlen($itemName) < 5 ){
                        $itemName_error = "Item Name must be between 5 and 25 characters";
                        $itemName_status = "";   // make email_status  empty
                    }
                }

                //===================== description Validation ==============================
                if( empty( $description ) ){
                    $description_error = "Description is required";
                    $description_status = ""; // make email_status empty
                }else {
                    if(strlen($description) > 250 || strlen($description) < 5 ){
                        $description_error = "Description must be between 5 and 250 characters";
                        $description_status = "";   // make email_status  empty
                    }
                }

                //===================== price Validation ==============================
                if( empty( $price ) ){
                    $price_error = "Price is required";
                    $price_status = ""; // make email_status empty
                }else {
                    if(strlen($price) > 16 || strlen($price) < 2 ){
                        $price_error = "Price must be between 2 and 25 characters";
                        $price_status = "";   // make email_status  empty
                    }else{
                        if( !is_numeric($price) ){
                            $price_error = "Price must be numeric";
                            $price_status = "";   // make email_status  empty    
                        }
                    }
                }

                //===================== fake_price Validation ==============================
                if( empty( $fake_price ) ){
                    $fake_price_error = "Price is required";
                    $fake_price_status = ""; // make email_status empty
                }else {
                    if(strlen($fake_price) > 16 || strlen($fake_price) < 2 ){
                        $fake_price_error = "Price must be between 2 and 25 characters";
                        $fake_price_status = "";   // make email_status  empty
                    }else{
                        if( !is_numeric($fake_price) ){
                            $fake_price_error = "Price must be numeric";
                            $fake_price_status = "";   // make email_status  empty    
                        }
                    }
                }

                //===================== fake_price Validation ==============================
                if( empty( $discount ) ){
                    $discount_error = "discount is required";
                    $discount_status = ""; // make email_status empty
                }else {
                    if(strlen($discount) > 2 ){
                        $discount_error = "discount 2 characters";
                        $discount_status = "";   // make email_status  empty
                    }else{
                        if( !is_numeric($discount) ){
                            $discount_error = "Discount must be numeric";
                            $discount_status = "";   // make email_status  empty    
                        }
                    }
                }

                //===================== loves Validation ==============================
                if( empty( $loves ) ){
                    $loves_error = "Loves is required";
                    $loves_status = ""; // make email_status empty
                }else {
                    if(strlen($loves) > 4 ){
                        $loves_error = "Maximum of loves is 4 characters";
                        $loves_status = "";   
                    }else{
                        if( !is_numeric($loves) ){
                            $loves_error = "loves must be numeric";
                            $loves_status = "";   // make email_status  empty    
                        }
                    }
                }

                //===================== stars Validation ==============================
                if( empty( $stars ) ){
                    $stars_error = "Stars is required";
                    $stars_status = ""; // make email_status empty
                }else {
                    if(strlen($stars) > 3 ){
                        $stars_error = "Maximum of Stars is 3 characters";
                        $stars_status = "";   
                    }
                }

                //===================== views Validation ==============================
                if( empty( $views ) ){
                    $views_error = "Views is required";
                    $views_status = ""; // make email_status empty
                }else {
                    if(strlen($views) > 4 ){
                        $views_error = "Maximum of views is 4 characters";
                        $views_status = "";   
                    }else{
                        if( !is_numeric($views) ){
                            $views_error = "views must be numeric";
                            $views_status = "";   // make email_status  empty    
                        }
                    }
                }
                //===================== mount Validation ==============================
                if( empty( $mount ) ){
                    $mount_error = "Mount is required";
                    $mount_status = ""; // make email_status empty
                }else {
                    if(strlen($mount) > 4 ){
                        $mount_error = "Mount of views is 4 characters";
                        $mount_status = "";   
                    }else{
                        if( !is_numeric($mount) ){
                            $mount_error = "Mount must be numeric";
                            $mount_status = "";   // make email_status  empty    
                        }
                    }
                }

                //===================== categories Validation ==============================
                if( $categories == 0 ){
                    $categories_error = "Categories is required";
                    $categories_status = ""; // make email_status empty
                }

                //===================== Img Validation ==============================
                if( empty( $img_name ) ){
                    $img_error = "Upload photo is required";
                    $img_status = ""; // make img_status  empty
                }else{ 
                    if( !in_array( $get_extention ,  $extentions ) ) { 
                        $img_error = "You must upload only photos";
                        $img_status = ""; // make img_status  empty
                    }else{

                        if (file_exists( $_FILES["img"]["tmp_name"] ) && ( $image_info = getimagesize( $_FILES["img"]["tmp_name"] ) )){
                    
                            $image_info = getimagesize( $_FILES["img"]["tmp_name"] );
                            $image_width = $image_info[0];
                            $image_height = $image_info[1];
        
                            if( $image_width != 530 || $image_height != 591 ){
                                $img_error = "img must be 530 x 591";
                                $img_status = ""; // make img_status  empty
                            }
        
                        } else {
                            $img_error = "img must be 530 x 591";
                            $img_status = ""; // make img_status  empty
                        }

                    }
                }


                //===================== Insert into DB ==============================
                if( !empty($itemName_status) && !empty($description_status) && !empty($price_status)  && !empty($fake_price_status) && !empty($discount_status) &&  !empty($loves_status) && !empty($stars_status) && !empty($views_status) && !empty($mount_status) &&  !empty($categories_status) && !empty($img_status)   ){


                    fix_rotate_jpg_image($tmp_name);
                    move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");

                    $stmt = $con->prepare(" INSERT INTO 
                                                    items ( Item_Name , Description , fake_price , Price , discount ,  Pic , Cat_ID , loves  , stars , views , mount)
                                                    VALUES( :zItem_Name , :zDescription , :zfake_price ,  :zPrice , :zdiscount , :zPic , :zCat_ID , :zloves  , :zstars , :zviews , :zmount  )");
                    $stmt->execute(array(
                    ":zItem_Name"    => $itemName,
                    ":zDescription"  => $description,
                    ":zfake_price"   => $fake_price,
                    ":zPrice"        => $price,
                    ":zdiscount"     => $discount,
                    ":zPic"          => $img_name_rand,
                    ":zCat_ID"       => $categories,
                    ":zloves"        => $loves,
                    ":zstars"        => $stars,
                    ":zviews"        => $views,
                    ":zmount"        => $mount
                    ));
                    if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                        create_session( "add_item_success" , " <i class='fas fa-check'></i> &nbsp; successfuly created New Item " );
                        header("Location: items.php?do=manage");
                    }else{
                        create_session( "add_item_failed" , " <i class='fas fa-times'></i>  &nbsp; Failed to create New Item" );
                        header("Location: items.php?do=manage");
                    }


                }

            }

            ?>
                <h1 class="text-center">Add Items</h1>
                <div class="container">
                    <div class="form-inner">
                        <form class="form-horizontal" style="margin-top:70px" action="?do=add" method="POST" enctype="multipart/form-data">

                            <!--itemName Field-->
                            <div class="form-group">
                                <input type="text"  name="itemName" placeholder="Item Name" class="form-control" value="<?php  echo getValueInput("itemName");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $itemName_error ) ){
                                        echo '<p class="error-messege">' . $itemName_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!--description Field-->
                            <div class="form-group">
                                <input type="text"  name="description" placeholder="Description" class="form-control"  value="<?php  echo getValueInput("description");  ?>"  required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $description_error ) ){
                                        echo '<p class="error-messege">' . $description_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!--price Field-->
                            <div class="form-group">
                                <input type="text"  name="price" placeholder="Price" class="form-control"  value="<?php  echo getValueInput("price");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $price_error ) ){
                                        echo '<p class="error-messege">' . $price_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!-- fake_price Field-->
                            <div class="form-group">
                                <input type="text"  name="fake_price" placeholder="Fake Price" class="form-control"  value="<?php  echo getValueInput("fake_price");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $fake_price_error ) ){
                                        echo '<p class="error-messege">' . $fake_price_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!-- discount Field-->
                            <div class="form-group">
                                <input type="text"  name="discount" placeholder="discount" class="form-control"  value="<?php  echo getValueInput("discount");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $discount_error ) ){
                                        echo '<p class="error-messege">' . $discount_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!--loves Field-->
                            <div class="form-group">
                                <input type="number"  name="loves" placeholder="Fake num of loves" class="form-control"  value="<?php  echo getValueInput("loves");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $loves_error ) ){
                                        echo '<p class="error-messege">' . $loves_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!--stars Field-->
                            <div class="form-group">
                                <input type="text"  name="stars" placeholder="Fake num of review stars " class="form-control"   value="<?php  echo getValueInput("stars");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $stars_error ) ){
                                        echo '<p class="error-messege">' . $stars_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!--views Field-->
                            <div class="form-group">
                                <input type="number"  name="views" placeholder="Fake num of views" class="form-control"  value="<?php  echo getValueInput("views");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $views_error ) ){
                                        echo '<p class="error-messege">' . $views_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!-- mount Field-->
                            <div class="form-group">
                                <input type="number"  name="mount" placeholder="Mount" class="form-control"  value="<?php  echo getValueInput("mount");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $mount_error ) ){
                                        echo '<p class="error-messege">' . $mount_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!--Categories Field-->
                            <div class="form-group">
                                <select name="categories" class="form-control">
                                    <option value="0" selected  style="display:none" >Choose Categories... </option>
                                    <?php
                                        $stmt = $con->prepare("SELECT * FROM categories");
                                        $stmt->execute();
                                        $cats = $stmt->fetchAll();
                                        foreach($cats as $cat){
                                            echo "<option value='"  . $cat["Category_ID"] ."'> " . $cat["Category_Name"] . " </option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php
                                if( isset( $categories_error ) ){
                                    echo '<p class="error-messege">' . $categories_error . '</p>'; 
                                }
                            ?>
                            <!--Upload Image Field-->
                            <div class="upload-input">
                                <label for="file" id="file-label">  <i class="fas fa-cloud-upload-alt"></i> &nbsp; Choose image... &nbsp; <span style="font-size: 13px">530 x 591</span>  </label>
                                <input type="file" class="file form-control" id="file" name="img"   /> 
                                <?php
                                    if( isset( $img_error ) ){
                                        echo '<p class="error-messege">' . $img_error . '</p>'; 
                                    }
                                ?>
                            </div>
                                <br>
                                <br>

                            <input type="submit" name="addItemsBtn" value="Add Items"  class="form-control btn btn-primary"/>
                        </form>
                    </div>
                </div>
            <?php

        }
        /*============================== Add Page =========================================================
        ===================================================================================================
        ================================ Edit Page ====================================================*/ 
        elseif($do == "edit"){
            if( isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ){
                $itemid = intval( $_GET["itemid"] );
            }else{
                $itemid = 0;
            }
            // $itemid = isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ? intval($_GET["itemid"]) : 0 ;
            $stmt = $con ->prepare("SELECT * FROM  items WHERE Item_ID = ? LIMIT  1 "); // for one result
            $stmt ->execute(array($itemid));
            $item = $stmt->fetch(); // for comming info and it will get it as array
            $count = $stmt->rowCount();
            if( $count > 0){ 



                if(isset($_POST["addItemsBtn"])){


                    $itemName         = security( $_POST['itemName']);
                    $description      = security( $_POST['description']);
                    $price            = security( $_POST['price']);
                    $fake_price       = security( $_POST['fake_price']);
                    $discount         = security( $_POST['discount']);
                    $loves            = security( $_POST['loves']);
                    $stars            = security( $_POST['stars']);
                    $views            = security( $_POST['views']);
                    $mount            = security( $_POST['mount']);
                    $categories       = security( $_POST['categories']);
        
        
                    $img_name           =  $_FILES["img"]["name"] ;
                    $img_name_rand      = rand(0 , 1000) . "_" . $img_name;
                    $tmp_name           =  $_FILES["img"]["tmp_name"] ;
                    $store_files        =  "../assets/images/product-img";
                    $extentions         = array("jpg" ,"png" , "jpeg" );
                    $get_file_extention = explode("." , $img_name);
                    $get_extention      = strtolower( end($get_file_extention) ) ;
        
        
        
        
                    $itemName_status = $description_status = $price_status =  $fake_price_status =  $discount_status =  $loves_status = $stars_status = $views_status = $mount_status = $categories_status = $img_status = 1 ;  // make status not empty;
        
        
        
                    //===================== itemName Validation ==============================
                    if( empty( $itemName ) ){
                        $itemName_error = "Item Name is required";
                        $itemName_status = ""; // make email_status empty
                    }else {
                        if(strlen($itemName) > 16 || strlen($itemName) < 5 ){
                            $itemName_error = "Item Name must be between 5 and 25 characters";
                            $itemName_status = "";   // make email_status  empty
                        }
                    }
        
                    //===================== description Validation ==============================
                    if( empty( $description ) ){
                        $description_error = "Item Name is required";
                        $description_status = ""; // make email_status empty
                    }else {
                        if(strlen($description) > 200 || strlen($description) < 5 ){
                            $description_error = "Description must be between 5 and 200 characters";
                            $description_status = "";   // make email_status  empty
                        }
                    }
        
                    //===================== fake_price Validation ==============================
                    if( empty( $fake_price ) ){
                        $fake_price_error = "Price is required";
                        $fake_price_status = ""; // make email_status empty
                    }else {
                        if(strlen($fake_price) > 16 || strlen($fake_price) < 2 ){
                            $fake_price_error = "Price must be between 2 and 25 characters";
                            $fake_price_status = "";   // make email_status  empty
                        }else{
                            if( !is_numeric($fake_price) ){
                                $fake_price_error = "Price must be numeric";
                                $fake_price_status = "";   // make email_status  empty    
                            }
                        }
                    }
        
        
                    //===================== price Validation ==============================
                    if( empty( $price ) ){
                        $price_error = "Price is required";
                        $price_status = ""; // make email_status empty
                    }else {
                        if(strlen($price) > 16 || strlen($price) < 2 ){
                            $price_error = "Price must be between 2 and 25 characters";
                            $price_status = "";   // make email_status  empty
                        }else{
                            if( !is_numeric($price) ){
                                $price_error = "Price must be numeric";
                                $price_status = "";   // make email_status  empty    
                            }
                        }
                    }
        
        
        
                    //===================== discount Validation ==============================
                    if( empty( $discount ) ){
                        $discount_error = "discount is required";
                        $discount_status = ""; // make email_status empty
                    }else {
                        if(strlen($discount) > 2 ){
                            $discount_error = "discount must be 2 characters";
                            $discount_status = "";   // make email_status  empty
                        }else{
                            if( !is_numeric($discount) ){
                                $discount_error = "discount must be numeric";
                                $discount_status = "";   // make email_status  empty    
                            }
                        }
                    }
        
                    //===================== loves Validation ==============================
                    if( empty( $loves ) ){
                        $loves_error = "Loves is required";
                        $loves_status = ""; // make email_status empty
                    }else {
                        if(strlen($loves) > 4 ){
                            $loves_error = "Maximum of loves is 4 characters";
                            $loves_status = "";   
                        }else{
                            if( !is_numeric($loves) ){
                                $loves_error = "discount must be numeric";
                                $loves_status = "";   // make email_status  empty    
                            }
                        }
                    }
        
                    //===================== stars Validation ==============================
                    if( empty( $stars ) ){
                        $stars_error = "Stars is required";
                        $stars_status = ""; // make email_status empty
                    }else {
                        if(strlen($stars) > 3 ){
                            $stars_error = "Maximum of stars is 3 characters";
                            $stars_error = "";   
                        }
                    }
        
                    //===================== views Validation ==============================
                    if( empty( $views ) ){
                        $views_error = "Views is required";
                        $views_status = ""; // make email_status empty
                    }else {
                        if(strlen($views) > 4 ){
                            $views_error = "Maximum of views is 4 characters";
                            $views_status = "";   
                        }else{
                            if( !is_numeric($views) ){
                                $views_error = "views must be numeric";
                                $views_status = "";   // make email_status  empty    
                            }
                        }
                    }
        

                    //===================== mount Validation ==============================
                    if( empty( $mount ) ){
                        $mount_error = "Mount is required";
                        $mount_status = ""; // make email_status empty
                    }else {
                        if(strlen($mount) > 3 ){
                            $mount_error = "Mount of views is 3 characters";
                            $mount_status = "";   
                        }else{
                            if( !is_numeric($mount) ){
                                $mount_error = "mount must be numeric";
                                $mount_status = "";   // make email_status  empty    
                            }
                        }
                    }

                    
                    //===================== categories Validation ==============================
                    if( $categories == 0 ){
                        $categories_error = "Categories is required";
                        $categories_status = ""; // make email_status empty
                    }
        
                    //===================== Img Validation ==============================

                    if( !empty( $img_name ) ){
                        if( !in_array( $get_extention ,  $extentions ) ) { 
                            $img_error = "You must upload only photos";
                            $img_status = ""; // make img_status  empty
                        }else{

                            if (file_exists( $_FILES["img"]["tmp_name"] ) && ( $image_info = getimagesize( $_FILES["img"]["tmp_name"] ) )){
                        
                                $image_info = getimagesize( $_FILES["img"]["tmp_name"] );
                                $image_width = $image_info[0];
                                $image_height = $image_info[1];
            
                                if( $image_width != 530 || $image_height != 591 ){
                                    $img_error = "img must be 530 x 591";
                                    $img_status = ""; // make img_status  empty
                                }
            
                            } else {
                                $img_error = "img must be 530 x 591";
                                $img_status = ""; // make img_status  empty
                            }

                        }
                    }
        

                    //===================== UPDATE into DB ==============================
                    if( !empty($itemName_status) && !empty($description_status) && !empty($price_status) &&  !empty($fake_price_status) && !empty($discount_status) &&  !empty($loves_status) && !empty($stars_status) && !empty($views_status) && !empty($mount_status)  && !empty($categories_status) && !empty($img_status)   ){
        


                        if( empty( $img_name ) ){
                            $img_name_upload = $item["Pic"];
                        }else{

                            fix_rotate_jpg_image($tmp_name);
                            move_uploaded_file( $tmp_name , "$store_files/$img_name_rand");
                            $img_name_upload = $img_name_rand;
                        }

                        $stmt = $con->prepare("UPDATE
                                                    items
                                                SET
                                                    Item_Name = ? , `Description` = ? , fake_price = ? ,  Price = ? , discount = ? , Pic = ? , `Cat_ID` = ? , loves = ?, stars = ? , views = ? , mount = ?
                                                WHERE
                                                    Item_ID = ?");
                        $stmt->execute(array( $itemName, $description, $fake_price , $price, $discount ,  $img_name_upload, $categories, $loves , $stars , $views , $mount , $itemid));

                        if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                            create_session( "edit_item_success" , " <i class='fas fa-check'></i> &nbsp; successfuly Edit Item " );
                            header("Location: items.php?do=manage");
                        }else{
                            create_session( "edit_item_failed" , " <i class='fas fa-times'></i>  &nbsp; Failed to Edit Item" );
                            header("Location: items.php?do=manage");
                        }
        
                    }
        
                }

                ?>
                    <h1 class="text-center"> <i class="fas fa-edit"></i>  Edit Items </h1>
                    <div class="container">
                        <div class="form-inner">
                            <form class="form-horizontal" style="margin-top:70px" action="?do=edit&itemid=<?php echo $itemid ;?>" method="POST" enctype="multipart/form-data">

                                <!--Hidden Field-->
                                <input type="hidden" value="<?php echo $itemid ?>" name="itemid"/>
                                <!--itemName Field-->
                                <div class="form-group">
                                    <input type="text"  name="itemName" placeholder="Item Name" class="form-control" value="<?php  echo $item["Item_Name"];  ?>" required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $itemName_error ) ){
                                            echo '<p class="error-messege">' . $itemName_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!--description Field-->
                                <div class="form-group">
                                    <input type="text"  name="description" placeholder="Description" class="form-control"  value="<?php  echo $item["Description"];  ?>"   required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $description_error ) ){
                                            echo '<p class="error-messege">' . $description_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!--price Field-->
                                <div class="form-group">
                                    <input type="text"  name="price" placeholder="Price" class="form-control"   value="<?php  echo $item["Price"];  ?>"  required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $price_error ) ){
                                            echo '<p class="error-messege">' . $price_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!-- fake_price Field-->
                                <div class="form-group">
                                    <input type="text"  name="fake_price" placeholder="fake Price" class="form-control"   value="<?php  echo $item["fake_price"];  ?>"  required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $fake_price_error ) ){
                                            echo '<p class="error-messege">' . $fake_price_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!-- discount Field-->
                                <div class="form-group">
                                    <input type="text"  name="discount" placeholder="discount" class="form-control"   value="<?php  echo $item["discount"];  ?>"  required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $discount_error ) ){
                                            echo '<p class="error-messege">' . $discount_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!--loves Field-->
                                <div class="form-group">
                                    <input type="number"  name="loves" placeholder="Fake num of loves" class="form-control"   value="<?php  echo $item["loves"];  ?>"  required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $loves_error ) ){
                                            echo '<p class="error-messege">' . $loves_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!--stars Field-->
                                <div class="form-group">
                                    <input type="text"  name="stars" placeholder="Fake num of reviews stars" class="form-control"    value="<?php  echo $item["stars"];  ?>"  required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $stars_error ) ){
                                            echo '<p class="error-messege">' . $stars_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!--views Field-->
                                <div class="form-group">
                                    <input type="number"  name="views" placeholder="Fake num of views" class="form-control"   value="<?php  echo $item["views"];  ?>" required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $views_error ) ){
                                            echo '<p class="error-messege">' . $views_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!-- mount Field-->
                                <div class="form-group">
                                    <input type="number"  name="mount" placeholder="Mount" class="form-control"  value="<?php  echo $item["mount"];  ?>" required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $mount_error ) ){
                                            echo '<p class="error-messege">' . $mount_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!--Categories Field-->
                                <div class="form-group">
                                    <select name="categories" class="form-control">
                                        <option value="0" style="display:none"  >Choose Categories... </option>
                                        <?php
                                            $stmt = $con->prepare("SELECT * FROM categories");
                                            $stmt->execute();
                                            $cats = $stmt->fetchAll();
                                            foreach($cats as $cat){
                                                echo "<option value='"  . $cat["Category_ID"] ."'"  ;
                                                if( $item["Cat_ID"] == $cat["Category_ID"]) echo "selected";
                                                echo " > " . $cat["Category_Name"] . " </option>";         
                                            }
                                        ?>
                                    </select>
                                </div>
                                <?php
                                    if( isset( $categories_error ) ){
                                        echo '<p class="error-messege">' . $categories_error . '</p>'; 
                                    }
                                ?>
                                <!-- DB img -->
                                <div class="form-group">
                                    <img src="../assets/images/product-img/<?php echo $item["Pic"]; ?>" class="img-fluid" alt="" style="border-radius: 10px">
                                </div>
                                <!--Upload Image Field-->
                                <div class="upload-input">
                                    <label for="file" id="file-label">  <i class="fas fa-cloud-upload-alt"></i> &nbsp; Choose another image...  &nbsp; <span style="font-size: 13px">530 x 591</span> </label>
                                    <input type="file" class="file form-control" id="file" name="img"   /> 
                                    <?php
                                        if( isset( $img_error ) ){
                                            echo '<p class="error-messege">' . $img_error . '</p>'; 
                                        }
                                    ?>
                                </div>
                                    <br>
                                    <br>

                                <input type="submit" name="addItemsBtn" value="Add Items"  class="form-control btn btn-primary"/>

                            </form>
                        </div>
                    </div>
                <?php
            }
        }
        /*============================== Update Page ======================================================
        ===================================================================================================
        ================================ Delete Page ====================================================*/        
        elseif($do == "delete"){
            echo "<h1 class='text-center'>  <i class='far fa-trash-alt'></i> Delete Items</h1>";
            if( isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ){
                $itemid = intval( $_GET["itemid"] );
            }else{
                $itemid = 0;
            }
            // short if condition 
            //$itemid = isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ? intval($_GET["itemid"]) : 0 ;
            $check = checkItem("Item_ID", "items", $itemid) ;
            if( $check > 0){ 
                $stmt = $con->prepare("DELETE FROM 
                                                items 
                                            WHERE 
                                                Item_ID = ?"); // i can get code from phpMyAdmin when i detele from user
                $stmt->execute(array(  $itemid )); // execute the statment 
                $count = $stmt->rowCount();
                if( $count > 0){ 
                    echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                            item is Deleted
                    </div>";
                    header("refresh:2; url=items.php");
                }else{
                    echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                            Error
                    </div>";
                    header("refresh:2; url=items.php");
                }
            }else{
                echo "<div class='text-center alert alert-danger' role='alert' style='margin:100px auto;width:350px'>
                    this id isn't Exist
                </div>";
                header("refresh:2; url=items.php");
            }        
        }

    include("../includes/template/admin_footer.php");
    }
?>
