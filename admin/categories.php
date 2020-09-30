<?php
    $pagetitle = "Categories Page"; 
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
        if ($do == "manage") {
            ?>

            <h1 class="text-center" style="padding: 30px 0" > <i class="fas fa-list-ul"></i> Categories Page  </h1>
            <div class="container">
                <?php
                    if( isset($_SESSION["add_category_success"])){
                        echo '<div class="add-item-success-messege "> ';
                            echo '<p class="text-center">';
                                echo $_SESSION["add_category_success"] ;
                            echo '</p>';
                        echo '</div>';
                    }
                    elseif ( isset($_SESSION["add_category_failed"]) ) {
                        echo '<div class="add-item-failed-messege"> ';
                            echo '<p class="text-center">';
                                echo $_SESSION["add_category_failed"] ;
                            echo '</p>';
                        echo '</div>';
                    }
                    unset( $_SESSION["add_category_success"] );
                    unset( $_SESSION["add_category_failed"] );
                ?>
                <?php
                    if( isset($_SESSION["edit_Category_success"])){
                        echo '<div class="add-item-success-messege "> ';
                            echo '<p class="text-center">';
                                echo $_SESSION["edit_Category_success"] ;
                            echo '</p>';
                        echo '</div>';
                    }
                    elseif ( isset($_SESSION["edit_Category_failed"]) ) {
                        echo '<div class="add-item-failed-messege"> ';
                            echo '<p class="text-center">';
                                echo $_SESSION["edit_Category_failed"] ;
                            echo '</p>';
                        echo '</div>';
                    }
                    unset( $_SESSION["edit_Category_success"] );
                    unset( $_SESSION["edit_Category_failed"] );
                ?>
                <a href="categories.php?do=add" class="btn  btn-primary" style="margin-bottom:20px"> <i class="fas fa-plus"></i> Add New Category</a>
                <?php

                    $stmt = $con->prepare("SELECT * FROM `categories` ORDER BY Category_ID DESC  ");
                    $stmt->execute(array());
                    $rows = $stmt->fetchAll(); ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col"> <i class="fas fa-list-ul"></i>  Category Name</th>
                            <th scope="col"> <i class="far fa-file-alt"></i> Description </th>
                            <th scope="col"> <i class="fas fa-edit"></i> Edit </th>
                            <th scope="col"> <i class="far fa-trash-alt"></i> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($rows as $row) {
                                echo '<tr>';
                                    echo '<th scope="row">'. $row["Category_ID"] .'</th>';
                                    echo '<th scope="row">'. $row["Category_Name"] .'</th>';
                                    echo '<th scope="row">'. $row["Description"] .'</th>';
                                    echo '<th scope="row"> <a href="categories.php?do=edit&catid='. $row["Category_ID"] .'" class="btn  btn-info" style="color:#fff"> <i class="fas fa-edit"></i>  Edit</a> </th>';
                                    echo '<th scope="row"> <a href="categories.php?do=delete&catid='. $row["Category_ID"] .'" class="btn  btn-danger checked-btn "> <i class="far fa-trash-alt"></i> Delete</a> </th>';
                                echo '<tr>';
                            } ?>
                    </tbody>
                </table>
            </div>
<?php
        /*=============================== manage Page ==================================================
        ================================================================================================
        ================================ add Page ====================================================*/
        }elseif ($do == "add") {


            if(isset($_POST["addCategoryBtn"])){


                $CategoryName    = $_POST['CategoryName'];
                $description     = $_POST['description'];

                $CategoryName_status =  1 ;  // make status not empty;

                //===================== CategoryName Validation ==============================
                if( empty( $CategoryName ) ){
                    $CategoryName_error = "Category Name is required";
                    $CategoryName_status = ""; // make email_status empty
                }else {
                    if(strlen($CategoryName) > 16 || strlen($CategoryName) < 4 ){
                        $CategoryName_error = "Category Name must be between 4 and 25 characters";
                        $CategoryName_error = "";   // make email_status  empty
                    }
                }

                //===================== Insert into DB ==============================
                if( !empty($CategoryName_status) ){


                    $stmt = $con->prepare(" INSERT INTO 
                                                    categories ( Category_Name , Description )
                                                    VALUES( :zCategoryName , :zDescription )");
                    $stmt->execute(array(
                        ":zCategoryName"    => $CategoryName,
                        ":zDescription"  => $description,
                    ));
                    if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                        create_session( "add_category_success" , " <i class='fas fa-check'></i> &nbsp; Successfuly add new category " );
                        header("Location: categories.php?do=manage");
                    }else{
                        create_session( "add_category_failed" , " <i class='fas fa-times'></i>  &nbsp; Failed add new category" );
                        header("Location: categories.php?do=manage");
                    }


                }

            }
?>

                <h1 class="text-center">Add Category</h1>
                <div class="container">
                    <div class="form-inner">
                        <form class="form-horizontal" style="margin-top:70px" action="?do=add" method="POST">

                            <!-- CategoryName Field-->
                            <div class="form-group">
                                <input type="text"  name="CategoryName" placeholder="Category Name" class="form-control" value="<?php  echo getValueInput("CategoryName");  ?>" required="required" autocomplete="off"/>
                                <?php
                                    if( isset( $CategoryName_error ) ){
                                        echo '<p class="error-messege">' . $CategoryName_error . '</p>'; 
                                    }
                                ?>
                            </div>

                            <!--description Field-->
                            <div class="form-group">
                                <input type="text"  name="description" placeholder="Description" class="form-control"  value="<?php  echo getValueInput("description");  ?>"   autocomplete="off"/>
                                <?php
                                    if( isset( $description_error ) ){
                                        echo '<p class="error-messege">' . $description_error . '</p>'; 
                                    }
                                ?>
                            </div>
                            <br>
                            <input type="submit" name="addCategoryBtn" value="Add Category"  class="form-control btn btn-primary"/>
                        </form>
                    </div>
                </div>

<?php
        /*=============================== add Page ==================================================
        ================================================================================================
        ================================ edit Page ====================================================*/
        }elseif ($do == "edit") {



            if( isset($_GET["catid"]) && is_numeric($_GET["catid"]) ){
                $catid = intval( $_GET["catid"] );
            }else{
                $catid = 0;
            }
            // $catid = isset($_GET["catid"]) && is_numeric($_GET["catid"]) ? intval($_GET["catid"]) : 0 ;
            $stmt = $con->prepare("SELECT * FROM  categories WHERE Category_ID = ? LIMIT  1 "); // for one result
            $stmt ->execute(array($catid));
            $cat = $stmt->fetch(); // for comming info and it will get it as array
            $count = $stmt->rowCount();
            if( $count > 0){ 



                if(isset($_POST["editCategoryBtn"])){



                    $CategoryName    = $_POST['CategoryName'];
                    $description     = $_POST['description'];
    
                    $CategoryName_status =  1 ;  // make status not empty;
    
                    //===================== CategoryName Validation ==============================
                    if( empty( $CategoryName ) ){
                        $CategoryName_error = "Category Name is required";
                        $CategoryName_status = ""; // make email_status empty
                    }else {
                        if(strlen($CategoryName) > 16 || strlen($CategoryName) < 4 ){
                            $CategoryName_error = "Category Name must be between 4 and 25 characters";
                            $CategoryName_status = "";   // make email_status  empty
                        }
                    }
    
                    //===================== Insert into DB ==============================
                    if( !empty($CategoryName_status) ){
    
    


                        $stmt = $con->prepare("UPDATE
                                                    categories
                                                SET
                                                    Category_Name = ? , `Description` = ? 
                                                WHERE
                                                    Category_ID = ?");
                        $stmt->execute(array( $CategoryName, $description , $catid ));

                        if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                            create_session( "edit_Category_success" , " <i class='fas fa-check'></i> &nbsp; successfuly Edit Category " );
                            header("Location: categories.php?do=manage");
                        }else{
                            create_session( "edit_Category_failed" , " <i class='fas fa-times'></i>  &nbsp; Failed to Edit Category" );
                            header("Location: categories.php?do=manage");
                        }
        
                    }
        
                }

                ?>
                    <h1 class="text-center"> <i class="fas fa-edit"></i>  Edit Category </h1>
                    <div class="container">
                        <div class="form-inner">
                            <form class="form-horizontal" style="margin-top:70px" action="?do=edit&catid=<?php echo $catid ;?>" method="POST" >

                                <!--Hidden Field-->
                                <input type="hidden" value="<?php echo $catid ?>" name="catid"/>

                                <!--CategoryName Field-->
                                <div class="form-group">
                                    <input type="text"  name="CategoryName" placeholder="Category Name" class="form-control" value="<?php  echo $cat["Category_Name"];  ?>" required="required" autocomplete="off"/>
                                    <?php
                                        if( isset( $CategoryName_error ) ){
                                            echo '<p class="error-messege">' . $CategoryName_error . '</p>'; 
                                        }
                                    ?>
                                </div>

                                <!--description Field-->
                                <div class="form-group">
                                    <input type="text"  name="description" placeholder="Description" class="form-control"  value="<?php  echo $cat["Description"];  ?>"   autocomplete="off"/>
                                    <?php
                                        if( isset( $description_error ) ){
                                            echo '<p class="error-messege">' . $description_error . '</p>'; 
                                        }
                                    ?>
                                </div>


                                <input type="submit" name="editCategoryBtn" value="Save Changes"  class="form-control btn btn-primary"/>

                            </form>
                        </div>
                    </div>
                <?php
            }

        /*=============================== edit Page ====================================================
        ================================================================================================
        ================================ delete Page ====================================================*/
        }elseif ($do == "delete") {


            echo "<h1 class='text-center'>  <i class='far fa-trash-alt'></i> Delete Categories</h1>";
            if( isset($_GET["catid"]) && is_numeric($_GET["catid"]) ){
                $catid = intval( $_GET["catid"] );
            }else{
                $catid = 0;
            }
            // short if condition 
            //$catid = isset($_GET["catid"]) && is_numeric($_GET["catid"]) ? intval($_GET["catid"]) : 0 ;
            $check = checkItem("Category_ID", "categories", $catid) ;
            if( $check > 0){ 
                $stmt = $con->prepare("DELETE FROM 
                                                categories 
                                            WHERE 
                                            Category_ID = ?"); // i can get code from phpMyAdmin when i detele from user
                $stmt->execute(array(  $catid )); // execute the statment 
                $count = $stmt->rowCount();
                if( $count > 0){ 
                    echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                        category is Deleted
                    </div>";
                    header("refresh:2; url=categories.php");
                }else{
                    echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                            Error
                    </div>";
                    header("refresh:2; url=categories.php");
                }
            }else{
                echo "<div class='text-center alert alert-danger' role='alert' style='margin:100px auto;width:350px'>
                    this id isn't Exist
                </div>";
                header("refresh:2; url=categories.php");
            }





        
        
        }
?>


<?php
    include("../includes/template/admin_footer.php");
    }
?>