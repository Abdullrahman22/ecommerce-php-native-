<?php
    $pagetitle = "Users Page"; 
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


            <h1 class="text-center" style="padding: 30px 0" >  <i class="fas fa-user"></i> Users Page  </h1>
            <div class="container">
                <?php

                    $stmt = $con->prepare("SELECT * FROM users WHERE GroupID = 1 ORDER BY UserID DESC");
                    $stmt->execute(array());
                    $rows = $stmt->fetchAll(); ?>
                <div class="table-responsive">
                        
                    <table class="table table-striped users-table">
                        <thead>
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col"> <i class="fas fa-user"></i> Username</th>
                                <th scope="col">@Email</th>
                                <th scope="col"> <i class="fas fa-restroom"></i> Gander</th>
                                <th scope="row"> Delete </th>     
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($rows as $row) {
                                    echo '<tr>';
                                    echo '<th scope="row">'. $row["UserID"] .'</th>';
                                    echo '<th scope="row">'. $row["Username"] .'</th>';
                                    echo '<th scope="row">'. $row["Email"] .'</th>';
                                    if ($row["gender"]  == "0") {
                                        echo '<th scope="row"> Male <i class="fas fa-male" style="font-size:20px" ></i> </th>';
                                    } else {
                                        echo '<th scope="row"> Female <i class="fas fa-female"  style="font-size:20px" ></i> </th>';
                                    }
                                    echo '<th scope="row"> <a href="users.php?do=delete&userid='. $row["UserID"] .'" class="btn btn-block btn-danger checked-btn "> <i class="far fa-trash-alt"></i> Delete</a> </th>';
                                    echo '<tr>';
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>
<?php
        /*============================== manage Page ======================================================
        ===================================================================================================
        ================================ Delete Page ====================================================*/
        }elseif($do == "delete"){
            if( isset($_GET["userid"]) && is_numeric($_GET["userid"]) ){
                $userid = intval( $_GET["userid"] );
            }else{
                $userid = 0;
            }
            // short if condition 
            //$userid = isset($_GET["userid"]) && is_numeric($_GET["userid"]) ? intval($_GET["userid"]) : 0 ;
            $check = checkItem("UserID", "users", $userid) ;
            if( $check > 0){ 
                $stmt = $con->prepare("DELETE FROM 
                                                users 
                                            WHERE 
                                            UserID = ?"); // i can get code from phpMyAdmin when i detele from user
                $stmt->execute(array(  $userid )); // execute the statment 
                $count = $stmt->rowCount();
                if( $count > 0){ 
                    echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                            User is Deleted
                    </div>";
                    header("refresh:2; url=users.php");
                }else{
                    echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                            Error
                    </div>";
                    header("refresh:2; url=users.php");
                }
            }else{
                echo "<div class='text-center alert alert-danger' role='alert' style='margin:100px auto;width:350px'>
                    this id isn't Exist
                </div>";
                header("refresh:2; url=users.php");
            }        
        }
?>

<?php
    include("../includes/template/admin_footer.php");
    }
?>
