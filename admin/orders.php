<?php
    $pagetitle = "Orders Page"; 
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
?>


            <h1 class="text-center" style="padding: 30px 0" >  <i class="fas fa-tasks"></i>   Ordered Products  </h1>
            <div class="container">
                <?php

                    $stmt = $con->prepare(" SELECT
                                    orders.*, users.Username , categories.Category_Name , items.Item_Name FROM orders 
                                    INNER JOIN  users     ON users.UserID = orders.user_ID
                                    INNER JOIN categories ON categories.Category_ID = orders.cat_id
                                    INNER JOIN  items     ON items.Item_ID = orders.item_id
                                    ORDER BY order_ID DESC
                    ");
                    $stmt->execute( array() );
                    $rows = $stmt->fetchAll();

                ?>
                <div class="table-responsive orders-table">

                    <table class="table table-orders table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col"> <i class="fas fa-user"></i> Username</th>
                                <th scope="col"> <i class="far fa-images"></i> Item Img</th>
                                <th scope="col"> <i class="fas fa-cart-plus" ></i> Item Name</th>
                                <th scope="col"> <i class="fas fa-cart-plus" ></i> Category </th>
                                <th scope="col"> <i class="fas fa-dollar-sign"></i> Price</th>
                                <th scope="col"> <i class="fas fa-dollar-sign"></i> Quantity</th>
                                <th scope="col"> <i class="fas fa-dollar-sign"></i> Total Price</th>
                                <th scope="col"> <i class="far fa-clock"></i> Date</th>
                                <th scope="col"> <i class="fas fa-phone"></i> City</th>
                                <th scope="col"> <i class="fas fa-phone"></i> Address</th>
                                <th scope="col"> <i class="fas fa-phone"></i> client num 1</th>
                                <th scope="col"> <i class="fas fa-phone"></i> client num 2</th>
                                <th scope="col"> <i class="fas fa-dollar-sign"></i> Received Money </th>
                                <th scope="col"> <i class="fas fa-truck"></i> Arrival Products</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach( $rows as $row){
                                    $items = getItemById( $row["item_id"] );

                                    ?>
                                        <tr>
                                        
                                            <th scope="row"> <?php echo $row["order_ID"] ; ?>     </th>
                                            <th scope="row"> <?php echo $row["Username"] ; ?>     </th>
                                            <th scope="row"> <img src="../assets/images/product-img/<?php echo $items["Pic"] ; ?>" alt="" class="product-img"/>   </th>
                                            <th scope="row"> <?php echo $row["Item_Name"] ; ?>    </th>
                                            <th scope="row"> <?php echo $row["Category_Name"] ; ?>    </th>
                                            <th scope="row"> <?php echo $row["price"] ; ?>        </th>
                                            <th scope="row"> <?php echo $row["quantity"] ; ?>        </th>
                                            <th scope="row"> <?php echo $row["total_price"] ; ?>        </th>
                                            <th scope="row"> <?php echo $row["date"] ; ?>         </th>
                                            <th scope="row"> <?php echo $row["city"] ; ?>         </th>
                                            <th scope="row"> <?php echo $row["address"] ; ?>         </th>
                                            <th scope="row"> <?php echo $row["client_num_1"] ; ?> </th>
                                            <th scope="row"> <?php echo $row["client_num_2"] ; ?> </th>
                                    
                                            <th scope="row">
                                                <form action="orders.php?do=edit&orderId=<?php echo $row["order_ID"]; ?>" method="POST" >
                                                    <select name="received_money" class="form-control">

                                                        <option value="0" <?php if( $row["received_money"] == "0"){ echo "selected";} ?> > Not Yet </option>
                                                        <option value="1" <?php if( $row["received_money"] == "1"){ echo "selected";} ?> > Received Money </option>
                                                        <option value="2" <?php if( $row["received_money"] == "2"){ echo "selected";} ?> > Not Recevied </option>

                                                    </select>
                                                    <button type="submit" class="btn btn-success btn-block checked-btn" name="edit_received_money" style="margin-top:5px"> <i class="fas fa-check"></i> OK </button>
                                                </form>
                                            </th>
                                    
                                            <th scope="row">
                                                <form action="orders.php?do=edit&orderId=<?php echo $row["order_ID"]; ?>" method="POST" >
                                                    <select name="arrival_products" class="form-control">

                                                        <option value="0" <?php if( $row["arrival_products"] == "0"){ echo "selected";} ?> > Whating To Go </option>
                                                        <option value="1" <?php if( $row["arrival_products"] == "1"){ echo "selected";} ?> > In Way </option>
                                                        <option value="2" <?php if( $row["arrival_products"] == "2"){ echo "selected";} ?> > Product Arrived </option>
                                                        <option value="3" <?php if( $row["arrival_products"] == "3"){ echo "selected";} ?> > Frist Send money </option>

                                                    </select>
                                                    <button type="submit" class="btn btn-success btn-block checked-btn" name="edit_arrival_products" style="margin-top:5px"> <i class="fas fa-check"></i> OK </button>
                                                </form>
                                            </th>
                                    
                                        </tr>
                                    <?php
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
        ================================ edit Page ======================================================*/        

        if ($do == "edit"){ 
            if( isset($_GET["orderId"]) && is_numeric($_GET["orderId"]) ){
                $orderId = intval( $_GET["orderId"] );
            }else{
                $orderId = 0;
            }
            // $orderId = isset($_GET["orderId"]) && is_numeric($_GET["orderId"]) ? intval($_GET["orderId"]) : 0 ;
            $stmt = $con ->prepare("SELECT * FROM  orders WHERE order_ID = ? LIMIT  1 "); // for one result
            $stmt ->execute( array($orderId) );
            $row = $stmt->fetch(); // for comming info and it will get it as array
            $count = $stmt->rowCount();
            if( $count > 0){ 

                if(isset($_POST["edit_received_money"])){
                    
                    $received_money    = $_POST['received_money'];
                    
                    $stmt2 = $con->prepare("UPDATE orders SET received_money = ? WHERE order_ID = ? LIMIT 1");
                    $stmt2->execute(array( $received_money , $orderId ));
                    if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                        echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                                    Received Money is Updated
                                </div>";
                        header("refresh:3; url=orders.php");
                    }else{
                        echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                                    Error
                                </div>";
                        header("refresh:3; url=orders.php");
                    }

                }


                if(isset($_POST["edit_arrival_products"])){
                
                
                    $arrival_products    = $_POST['arrival_products'];
                    
                    $stmt2 = $con->prepare("UPDATE orders SET arrival_products = ? WHERE order_ID = ? LIMIT 1 ");
                    $stmt2->execute(array( $arrival_products , $orderId ));
                    if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                        echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                                    Received Money is Updated
                                </div>";
                        header("refresh:3; url=orders.php");
                    }else{
                        echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                                    Error
                                </div>";
                        header("refresh:3; url=orders.php");
                    }

                }

            }

        }

?>
<?php
    include("../includes/template/admin_footer.php");
    }
?>


<!--




 


        if ($do == "edit"){ 
            if( isset($_GET["orderId"]) && is_numeric($_GET["orderId"]) ){
                $orderId = intval( $_GET["orderId"] );
            }else{
                $orderId = 0;
            }
            // $orderId = isset($_GET["orderId"]) && is_numeric($_GET["orderId"]) ? intval($_GET["orderId"]) : 0 ;
            $stmt = $con ->prepare("SELECT * FROM  orders WHERE order_ID = ? LIMIT  1 "); // for one result
            $stmt ->execute(array($orderId));
            $row = $stmt->fetch(); // for comming info and it will get it as array
            $count = $stmt->rowCount();
            if( $count > 0){ 

                if(isset($_POST["edit_received_money"])){

                    $received_money    = $_POST['received_money'];
                    
                    $stmt2 = $con->prepare("UPDATE orders SET received_money = ? WHERE Item_ID = ? LIMIT 1");
                    $stmt2->execute(array( $received_money , $orderId ));
                    if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                        echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                                    Received Money is Updated
                                </div>";
                        header("refresh:3; url=orders.php");
                    }else{
                        echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                                    Error
                                </div>";
                        header("refresh:3; url=orders.php");
                    }
                
                }


                if(isset($_POST["edit_arrival_products"])){

                    $received_money    = $_POST['arrival_products'];
                    
                    $stmt2 = $con->prepare("UPDATE orders SET arrival_products = ? WHERE Item_ID = ? LIMIT 1 ");
                    $stmt2->execute(array( $received_money , $orderId ));
                    if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                        echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                                    Received Money is Updated
                                </div>";
                        header("refresh:3; url=orders.php");
                    }else{
                        echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                                    Error
                                </div>";
                        header("refresh:3; url=orders.php");
                    }
                
                }






            }

        }




-->