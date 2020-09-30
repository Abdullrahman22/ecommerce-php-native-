<?php
    $pagetitle = "Carts"; 
    include("includes/template/header.php");
    if( !isset(  $_SESSION["loginUserID"] )   ){
        header("Location: login.php");
    }
    include("navbar.php");



    if( isset( $_POST["CartBtn"] ) ){

       

        
        $city           = security ($_POST['city'] );
        $address        = security ($_POST['address'] );
        $received_name  = security ($_POST['received_name'] );
        $num_1          = security ($_POST['num_1'] );
        $num_2          = security ($_POST['num_2'] );

        $city_status = $address_status = $received_name_status = $num_1_status = $num_2_status = $send_money_status =  1;
        //===================== city Validation ==============================
        if( $city == "0"){
            $city_error = "choose City is required";
            $city_status = ""; // make email_status empty
        }

        //===================== address Validation ==============================
        if( empty( $address ) ){
            $address_error = "Address is required";
            $address_status = ""; // make email_status empty
        }else {
            if(strlen($address) > 200 || strlen($address) < 15 ){
                $address_error = "Address must be between 15 and 200 characters";
                $address_status = "";   // make email_status  empty
            }
        }

        //===================== received_name Validation ==============================
        if( empty( $received_name ) ){
            $received_name_error = "Received name is required";
            $received_name_status = ""; // make email_status empty
        }else {
            if(strlen($received_name) > 25 || strlen($received_name) < 5 ){
                $received_name_error = "Received name must be between 5 and 25 characters";
                $received_name_status = "";   // make email_status  empty
            }
        }



        //===================== num_1 Validation ==============================
        if( empty( $num_1 ) ){
            $num_1_error = "Number name is required";
            $num_1_status = ""; // make email_status empty
        }else {
            if(strlen($num_1) > 18 || strlen($num_1) < 11 ){
                $num_1_error = "Number must be between 11 and 18 characters";
                $num_1_status = "";   // make email_status  empty
            }
        }
            
        //===================== num_2 Validation ==============================
        if( empty( $num_2 ) ){
            $num_2_error = "Number name is required";
            $num_2_status = ""; // make email_status empty
        }else {
            if(strlen($num_2) > 18 || strlen($num_2) < 11 ){
                $num_2_error = "Number must be between 11 and 18 characters";
                $num_2_status = "";   // make email_status  empty
            }
        }
        //===================== CheckBox validation Validation ==============================

        if ( !isset( $_POST['send_money']) ) {
            $send_money_error = "You must check that you have sent item money to 01210811347 ";
            $send_money_status = "";   // make email_status  empty
        }else{
            if( $_POST['send_money'] != "1" ){
                $send_money_error = "You must check that you have sent item money to 01210811347 ";
                $send_money_status = "";   // make email_status  empty
    
            }
        }

        //===================== insert into db ==============================
        if(  !empty($city_status) && !empty($address_status) && !empty($received_name_status) && !empty($num_1_status) && !empty($num_2_status)  && !empty($send_money_status)   ){

        

            //=====================================================================================
            //===================== if isset item 1 ===============================================
            //=====================================================================================

            if( isset( $_POST['Item_ID'][0] ) || isset( $_POST['Quantity'][0] )  ){

                $Item_ID  =  security( $_POST['Item_ID'][0] );
                $Quantity = security( $_POST['Quantity'][0] );
                $row = getItemById($Item_ID);
                $cat = $row["Cat_ID"];
                $price = $row["Price"];
                $totalQuantity = $price * $Quantity;


                //===================== Quantity Validation ==============================
                if( $Quantity == "0" ){
                    header("Location: index.php");
                }else{
                    if( $Quantity > 30  ){
                        header("Location: index.php");
                    }
                }
                //===================== Item_ID Validation ==============================
                if( $Item_ID == "0" ){
                    header("Location: index.php");
                }else{
                    if( checkItemExist( $Item_ID ) == 0 ){
                        header("Location: index.php");
                    }
                }
                //=====================insert item 1 Item_ID Validation ==============================

        
                $stmt = $con->prepare(" INSERT INTO 
                                orders ( user_ID , item_id , cat_id	, price , total_price , quantity , city , address ,  client_num_1  , client_num_2 , receiver_name  ) 
                                VALUES ( :zuser_ID ,  :zitem_id , :zcat_id , :zprice ,  :ztotal_price , :zquantity , :zcity , :zaddress ,  :zclient_num_1  , :zclient_num_2 , :zreceiver_name  ) ");
                $stmt->execute( array( 
                    ":zuser_ID"       => $_SESSION["loginUserID"],
                    ":zitem_id"       => $Item_ID,
                    ":zcat_id"        => $cat,
                    ":zprice"         => $price,
                    ":ztotal_price"   => $totalQuantity,
                    ":zquantity"      => $Quantity,
                    ":zcity"          => $city,
                    ":zaddress"       => $address,
                    ":zclient_num_1"  => $num_1,
                    ":zclient_num_2"  => $num_2,
                    ":zreceiver_name" => $received_name
                ));



                if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                    $check = checkItem("itemID", "add_cart", $Item_ID) ;
                    if( $check > 0){ 
                        $stmt2 = $con->prepare("DELETE FROM 
                                                        add_cart 
                                                    WHERE 
                                                        itemID = ?"); // i can get code from phpMyAdmin when i detele from user
                        $stmt2->execute(array(  $Item_ID )); // execute the statment 
                        $count = $stmt2->rowCount();
                        if( $count > 0){ 
                            header("Location: myorders.php");
                        }else{
                            header("Location: index.php");
                        }
                    }else{
                        header("Location: index.php");
                    } 
                }else{
                    header("Location: index.php");
                }
                

            }



            //=====================================================================================
            //===================== if isset item 2 ===============================================
            //=====================================================================================


            if( isset( $_POST['Item_ID'][1] ) || isset( $_POST['Quantity'][1] )  ){

                $Item_ID  =  security( $_POST['Item_ID'][1] );
                $Quantity = security( $_POST['Quantity'][1] );
                $row = getItemById($Item_ID);
                $cat = $row["Cat_ID"];
                $price = $row["Price"];
                $totalQuantity = $price * $Quantity;


                //===================== Quantity Validation ==============================
                if( $Quantity == "0" ){
                    header("Location: index.php");
                }else{
                    if( $Quantity > 30  ){
                        header("Location: index.php");
                    }
                }
                //===================== Item_ID Validation ==============================
                if( $Item_ID == "0" ){
                    header("Location: index.php");
                }else{
                    if( checkItemExist( $Item_ID ) == 0 ){
                        header("Location: index.php");
                    }
                }
                //=====================insert item 1 Item_ID Validation ==============================
                $stmt = $con->prepare(" INSERT INTO 
                                orders ( user_ID , item_id , cat_id	, price , total_price , quantity , city , address ,  client_num_1  , client_num_2 , receiver_name  ) 
                                VALUES ( :zuser_ID ,  :zitem_id , :zcat_id , :zprice ,  :ztotal_price , :zquantity , :zcity , :zaddress ,  :zclient_num_1  , :zclient_num_2 , :zreceiver_name  ) ");
                $stmt->execute( array( 
                    ":zuser_ID"       => $_SESSION["loginUserID"],
                    ":zitem_id"       => $Item_ID,
                    ":zcat_id"        => $cat,
                    ":zprice"         => $price,
                    ":ztotal_price"   => $totalQuantity,
                    ":zquantity"      => $Quantity,
                    ":zcity"          => $city,
                    ":zaddress"       => $address,
                    ":zclient_num_1"  => $num_1,
                    ":zclient_num_2"  => $num_2,
                    ":zreceiver_name" => $received_name
                ));




                if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                    $check = checkItem("itemID", "add_cart", $Item_ID) ;
                    if( $check > 0){ 
                        $stmt2 = $con->prepare("DELETE FROM 
                                                        add_cart 
                                                    WHERE 
                                                        itemID = ?"); // i can get code from phpMyAdmin when i detele from user
                        $stmt2->execute(array(  $Item_ID )); // execute the statment 
                        $count = $stmt2->rowCount();
                        if( $count > 0){ 
                            header("Location: myorders.php");
                        }else{
                            header("Location: index.php");
                        }
                    }else{
                        header("Location: index.php");
                    } 
                }else{
                    header("Location: index.php");
                }
                
            }


            //=====================================================================================
            //===================== if isset item 3 ===============================================
            //=====================================================================================


            if( isset( $_POST['Item_ID'][2] ) || isset( $_POST['Quantity'][2] )  ){

                $Item_ID  =  security( $_POST['Item_ID'][2] );
                $Quantity = security( $_POST['Quantity'][2] );
                $row = getItemById($Item_ID);
                $cat = $row["Cat_ID"];
                $price = $row["Price"];
                $totalQuantity = $price * $Quantity;


                //===================== Quantity Validation ==============================
                if( $Quantity == "0" ){
                    header("Location: index.php");
                }else{
                    if( $Quantity > 30  ){
                        header("Location: index.php");
                    }
                }
                //===================== Item_ID Validation ==============================
                if( $Item_ID == "0" ){
                    header("Location: index.php");
                }else{
                    if( checkItemExist( $Item_ID ) == 0 ){
                        header("Location: index.php");
                    }
                }
                //=====================insert item 1 Item_ID Validation ==============================
                $stmt = $con->prepare(" INSERT INTO 
                                orders ( user_ID , item_id , cat_id	, price , total_price , quantity , city , address ,  client_num_1  , client_num_2 , receiver_name  ) 
                                VALUES ( :zuser_ID ,  :zitem_id , :zcat_id , :zprice ,  :ztotal_price , :zquantity , :zcity , :zaddress ,  :zclient_num_1  , :zclient_num_2 , :zreceiver_name  ) ");
                $stmt->execute( array( 
                    ":zuser_ID"       => $_SESSION["loginUserID"],
                    ":zitem_id"       => $Item_ID,
                    ":zcat_id"        => $cat,
                    ":zprice"         => $price,
                    ":ztotal_price"   => $totalQuantity,
                    ":zquantity"      => $Quantity,
                    ":zcity"          => $city,
                    ":zaddress"       => $address,
                    ":zclient_num_1"  => $num_1,
                    ":zclient_num_2"  => $num_2,
                    ":zreceiver_name" => $received_name
                ));



                if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                    $check = checkItem("itemID", "add_cart", $Item_ID) ;
                    if( $check > 0){ 
                        $stmt2 = $con->prepare("DELETE FROM 
                                                        add_cart 
                                                    WHERE 
                                                        itemID = ?"); // i can get code from phpMyAdmin when i detele from user
                        $stmt2->execute(array(  $Item_ID )); // execute the statment 
                        $count = $stmt2->rowCount();
                        if( $count > 0){ 
                            header("Location: myorders.php");
                        }else{
                            header("Location: index.php");
                        }
                    }else{
                        header("Location: index.php");
                    } 
                }else{
                    header("Location: index.php");
                }
                
            }



            //=====================================================================================
            //===================== if isset item 4 ===============================================
            //=====================================================================================


            if( isset( $_POST['Item_ID'][3] ) || isset( $_POST['Quantity'][3] )  ){

                $Item_ID  =  security( $_POST['Item_ID'][3] );
                $Quantity = security( $_POST['Quantity'][3] );
                $row = getItemById($Item_ID);
                $cat = $row["Cat_ID"];
                $price = $row["Price"];
                $totalQuantity = $price * $Quantity;


                //===================== Quantity Validation ==============================
                if( $Quantity == "0" ){
                    header("Location: index.php");
                }else{
                    if( $Quantity > 30  ){
                        header("Location: index.php");
                    }
                }
                //===================== Item_ID Validation ==============================
                if( $Item_ID == "0" ){
                    header("Location: index.php");
                }else{
                    if( checkItemExist( $Item_ID ) == 0 ){
                        header("Location: index.php");
                    }
                }
                //=====================insert item 1 Item_ID Validation ==============================
                $stmt = $con->prepare(" INSERT INTO 
                                orders ( user_ID , item_id , cat_id	, price , total_price , quantity , city , address ,  client_num_1  , client_num_2 , receiver_name  ) 
                                VALUES ( :zuser_ID ,  :zitem_id , :zcat_id , :zprice ,  :ztotal_price , :zquantity , :zcity , :zaddress ,  :zclient_num_1  , :zclient_num_2 , :zreceiver_name  ) ");
                $stmt->execute( array( 
                    ":zuser_ID"       => $_SESSION["loginUserID"],
                    ":zitem_id"       => $Item_ID,
                    ":zcat_id"        => $cat,
                    ":zprice"         => $price,
                    ":ztotal_price"   => $totalQuantity,
                    ":zquantity"      => $Quantity,
                    ":zcity"          => $city,
                    ":zaddress"       => $address,
                    ":zclient_num_1"  => $num_1,
                    ":zclient_num_2"  => $num_2,
                    ":zreceiver_name" => $received_name
                ));



                if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                    $check = checkItem("itemID", "add_cart", $Item_ID) ;
                    if( $check > 0){ 
                        $stmt2 = $con->prepare("DELETE FROM 
                                                        add_cart 
                                                    WHERE 
                                                        itemID = ?"); // i can get code from phpMyAdmin when i detele from user
                        $stmt2->execute(array(  $Item_ID )); // execute the statment 
                        $count = $stmt2->rowCount();
                        if( $count > 0){ 
                            header("Location: myorders.php");
                        }else{
                            header("Location: index.php");
                        }
                    }else{
                        header("Location: index.php");
                    } 
                }else{
                    header("Location: index.php");
                }
                
            }






            //=====================================================================================
            //===================== if isset item 5 ===============================================
            //=====================================================================================


            if( isset( $_POST['Item_ID'][4] ) || isset( $_POST['Quantity'][4] )  ){

                $Item_ID  =  security( $_POST['Item_ID'][4] );
                $Quantity = security( $_POST['Quantity'][4] );
                $row = getItemById($Item_ID);
                $cat = $row["Cat_ID"];
                $price = $row["Price"];
                $totalQuantity = $price * $Quantity;


                //===================== Quantity Validation ==============================
                if( $Quantity == "0" ){
                    header("Location: index.php");
                }else{
                    if( $Quantity > 30  ){
                        header("Location: index.php");
                    }
                }
                //===================== Item_ID Validation ==============================
                if( $Item_ID == "0" ){
                    header("Location: index.php");
                }else{
                    if( checkItemExist( $Item_ID ) == 0 ){
                        header("Location: index.php");
                    }
                }
                //=====================insert item 1 Item_ID Validation ==============================
                $stmt = $con->prepare(" INSERT INTO 
                                orders ( user_ID , item_id , cat_id	, price , total_price , quantity , city , address ,  client_num_1  , client_num_2 , receiver_name  ) 
                                VALUES ( :zuser_ID ,  :zitem_id , :zcat_id , :zprice ,  :ztotal_price , :zquantity , :zcity , :zaddress ,  :zclient_num_1  , :zclient_num_2 , :zreceiver_name  ) ");
                $stmt->execute( array( 
                    ":zuser_ID"       => $_SESSION["loginUserID"],
                    ":zitem_id"       => $Item_ID,
                    ":zcat_id"        => $cat,
                    ":zprice"         => $price,
                    ":ztotal_price"   => $totalQuantity,
                    ":zquantity"      => $Quantity,
                    ":zcity"          => $city,
                    ":zaddress"       => $address,
                    ":zclient_num_1"  => $num_1,
                    ":zclient_num_2"  => $num_2,
                    ":zreceiver_name" => $received_name
                ));


                if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                    $check = checkItem("itemID", "add_cart", $Item_ID) ;
                    if( $check > 0){ 
                        $stmt2 = $con->prepare("DELETE FROM 
                                                        add_cart 
                                                    WHERE 
                                                        itemID = ?"); // i can get code from phpMyAdmin when i detele from user
                        $stmt2->execute(array(  $Item_ID )); // execute the statment 
                        $count = $stmt2->rowCount();
                        if( $count > 0){ 
                            header("Location: myorders.php");
                        }else{
                            header("Location: index.php");
                        }
                    }else{
                        header("Location: index.php");
                    } 
                }else{
                    header("Location: index.php");
                }


            }

        }




    }






?>

    <div id="carts-page">
        <form action="<?php  echo $_SERVER["PHP_SELF"] ?>" method="POST" >



            <div class="carts-section">
                <div class="container">

                    <p> Here's What You're Getting</p>
                    <br>
                    <p class="text-right"> Want Some to order new Items ? <a href="category.php">Continue Shopping</a> </p>
                    <br>
                    <?php
                        $cartsNum = countCarts(  $_SESSION["loginUserID"]  );
                        if( $cartsNum > 0 ){
                            
                    ?>
                    <p> - you have <?php echo $cartsNum ;?> items in your Carts</p>
                    <br>
                    <br>

                </div>
                <?php
                $stmt = $con->prepare(" SELECT
                            add_cart.*, items.Item_Name FROM add_cart 
                            INNER JOIN  items ON items.Item_ID = add_cart.itemID
                            WHERE userID = ? 
                            ORDER BY addCartID DESC
                ");
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
                                    <th scope="col"> Mount </th>
                                    <th scope="col"> <i class="fas fa-dollar-sign"></i> Total Price </th>
                                    <th scope="col"> <i class="fas fa-times"></i>  Cancel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach( $rows as $row){

                                        $items = getItemById( $row["itemID"] );

                                        ?>

                                            <tr>
                                                <th scope="row"> <img src="assets/images/product-img/<?php echo $items["Pic"] ; ?>" alt="" class="product-img"/>    </th>
                                                <th scope="row"> &nbsp;   <?php echo $items["Item_Name"] ; ?>    </th>
                                                <input type="hidden" name="Item_ID[]" value=" <?php echo $items["Item_ID"];?> " />
                                                <th scope="row" class="price">$ <span> <?php echo $items["Price"];  ?>  </span> </th>
                                                <th scope="row"> 
                                                    <input type="number" name="Quantity[]" min="1" max="30" class="form-control Quantity-box" value="<?php  echo getQuantityValue("Quantity[]");  ?>" > 
                                                </th>
                                                <th scope="row" class="total_price" >  &nbsp;  $ <span> <?php echo $items["Price"]; ?>  </span>  </th>
                                                <th scope="row">  &nbsp; &nbsp;   <i class="fas fa-window-close" itemid="<?php echo $row['itemID'] ;?>" ></i>   </th>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="cart-buttons">
                    <div class="container">
                        <a href="index.php" class="btn-custom btn-custom-white">  <i class="fas fa-arrow-left"></i> &nbsp; Go Back</a>
                        <a class="btn-custom btn-custom-white buy_now" > Buy Now &nbsp; <i class="fas fa-arrow-right"></i> </a>
                    </div>
                </div> 
                <?php }else{
                ?>
                <div class="no-carts text-center">
                You don't have items Carts <a href="category.php?catid=1"> Shop Now!</a>
                </div>


                <?php }?>
            </div>



            <div class="buyer-section">




                <div class="steps">
                    <div> <i class="fas fa-info-circle"></i>   </div> 
                    <div> &nbsp;  </div> 
                    <div> &nbsp;  </div> 
                </div>



                <h2 class="text-center" style="padding:30px 0px"> Buyer details <i class="fas fa-shopping-cart"></i> </h2>
                <p> Product Shipping To Country : Egypt <img src="assets/images/backgrounds/egypt.png" alt="" /> </p>
                <div class="form">

                    <div class="form-group"  >
                        <label for="received_name"> <i class="fas fa-city"></i> Select City : </label>
                        <select class="form-control" name="city">
                            <option value="0"  selected style="display:none"> Choose City ...</option>
                            <option value="Cairo" > Cairo</option>
                            <option value="Alexandria" > Alexandria</option>
                            <option value="Giza" > Giza</option>
                            <option value="Shubra el-Khema" > Shubra el-Khema</option>
                            <option value="Port Said" > Port Said</option>
                            <option value="Suez" > Suez</option>
                            <option value="El Mahalla el Kubra" > El Mahalla el Kubra</option>
                            <option value="El Mansoura" > El Mansoura</option>
                            <option value="Tanta" > Tanta</option>
                            <option value="Asyut" > Asyut</option>
                            <option value="Fayoum" > Fayoum</option>
                            <option value="Zagazig" > Zagazig</option>
                            <option value="Ismailia" > Ismailia</option>
                            <option value="Khusus" > Khusus</option>
                            <option value="Aswan" > Aswan</option>
                            <option value="Damanhur" > Damanhur</option>
                            <option value="El-Minya" > El-Minya</option>
                            <option value="Damietta" > Damietta</option>
                            <option value="Luxor" > Luxor</option>
                            <option value="Qena" > Qena</option>
                            <option value="Beni Suef" > Beni Suef</option>
                            <option value="Sohag" > Sohag</option>
                            <option value="Sharqia" > Sharqia</option>
                            <option value="Qalyubia" > Qalyubia</option>
                            <option value="New Valley" > New Valley</option>
                            <option value="Monufia" > Monufia</option>
                            <option value="Shibin el-Kom" > Shibin el-Kom</option>
                            <option value="Hurghada" > Hurghada</option>
                            <option value="Banha" > Banha</option>
                            <option value="Kafr al-Sheikh" > Kafr al-Sheikh</option>
                            <option value="Mallawi" > Mallawi</option>
                            <option value="El Arish" > El Arish</option>
                            <option value="10th of Ramadan City" > 10th of Ramadan City</option>
                            <option value="Marsa Matruh" > Marsa Matruh</option>

                        </select>
                        <?php
                            if( isset( $city_error ) ){
                                echo '<p class="error-messege">' . $city_error . '</p>'; 
                            }
                        ?>
                    </div>

                    <div class="form-group"  >
                        <label for="address"> <i class="fas fa-address-card"></i> Your Address  : </label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address.."  value="<?php  echo getInputValue("address");  ?>"  autocomplete="none"  />
                        <?php
                            if( isset( $address_error ) ){
                                echo '<p class="error-messege">' . $address_error . '</p>'; 
                            }
                        ?>
                    </div>

                    <div class="form-group"  >
                        <label for="received_name"> <i class="fas fa-user-check"></i> Received Name : </label>
                        <input type="text" class="form-control" name="received_name" id="received_name" placeholder="Enter Name.."  value="<?php  echo getInputValue("received_name");  ?>"   autocomplete="none"  />
                        <?php
                            if( isset( $received_name_error ) ){
                                echo '<p class="error-messege">' . $received_name_error . '</p>'; 
                            }
                        ?>
                    </div>

                    <div class="form-group"  >
                        <label for="num_1"> <i class="fas fa-phone-volume"></i> Send Money From : </label>
                        <input type="number" class="form-control" name="num_1" id="num_1" placeholder="Enter Number.."  value="<?php  echo getInputValue("num_1");  ?>"  autocomplete="none"  />
                        <?php
                            if( isset( $num_1_error ) ){
                                echo '<p class="error-messege">' . $num_1_error . '</p>'; 
                            }
                        ?>
                    </div>

                    <div class="form-group" style="padding: 5px 0px">
                        <label for="num_2"> <i class="fas fa-phone-volume"></i> Follow your shipment on a number : </label>
                        <input type="number" class="form-control" name="num_2" id="num_2" placeholder="Enter Number.."   value="<?php  echo getInputValue("num_2");  ?>"    autocomplete="none" />
                        <?php
                            if( isset( $num_2_error ) ){
                                echo '<p class="error-messege">' . $num_2_error . '</p>'; 
                            }
                        ?>
                    </div>

                    <div class="send_money">

                        <input type="checkbox" id="send_money" name="send_money" value="1">
                        <label for="send_money">Be sure to send the purchased money to a number 01210811347 at Vodafone Cash <img src="assets/images/backgrounds/Vodafone-2-icon (1).png" alt="" /></label>
                        <?php
                            if( isset( $send_money_error ) ){
                                echo '<p class="error-messege">' . $send_money_error . '</p>'; 
                            }
                        ?>
                        <?php
                            if( isset( $login_error ) ){
                                header("Location: signup.php "); 
                            }
                        ?>
                    </div>
                    <div class="buyer-info-buttons">

                        <a class="btn-custom btn-custom-white cart_page">  <i class="fas fa-arrow-left"></i> &nbsp; Go Back</a>
                        <button type="submit" name="CartBtn" class="btn-custom btn-custom-white payment_page" > Payment page &nbsp; <i class="fas fa-arrow-right"></i> </button>

                    </div>

                </div>


            </div>
        </form>
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
