<?php
    $pagetitle = "Comments Page"; 
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

            <h1 class="text-center" style="padding: 30px 0" >  <i class="fas fa-comment-alt"></i>  Comments Page  </h1>
            <div class="container">
                <?php

                    $stmt = $con->prepare(" SELECT
                                        comments.*, items.Item_Name , users.Username FROM comments 
                                        INNER JOIN items ON items.Item_ID = comments.item_ID
                                        INNER JOIN users ON users.UserID = comments.User_ID
                                        ORDER BY comment_ID DESC
                                        ");
                    $stmt->execute( array() );
                    $rows = $stmt->fetchAll();

                ?>
                <div class="table-responsive comments-table ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#id</th>
                            <th scope="col">  <i class="fas fa-comment-alt"></i> Comment</th>
                            <th scope="col"><i class="far fa-clock"></i> Date </th>
                            <th scope="col"> <i class="fas fa-user"></i>  Username</th>
                            <th scope="col"> <i class="fas fa-cart-plus" ></i>  Item Name</th>
                            <th scope="col"> <i class="far fa-trash-alt"></i>  Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach( $rows as $row){
                                    echo '<tr>';
                                    echo '<th scope="row">'. $row["comment_ID"] .'</th>';
                                    echo '<th scope="row">'. $row["comment"] .'</th>';
                                    echo '<th scope="row">'. $row["date"] .'</th>';
                                    echo '<th scope="row">'. $row["Username"] .'</th>';
                                    echo '<th scope="row">'. $row["Item_Name"] .'</th>';
                                    echo '<th scope="row"> 
                                            <a href="comments.php?do=delete&commentid='. $row["comment_ID"] .'" class="btn  btn-danger checked-btn "> <i class="far fa-trash-alt"></i> Delete </a>
                                        </th>';
                                    echo '</tr>';

                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
<?php
        }
        /*============================== manage Page ======================================================
        ===================================================================================================
        ================================ Delete Page ====================================================*/        
        elseif($do == "delete"){
            echo "<h1 class='text-center'>  <i class='far fa-trash-alt'></i> Delete Comments</h1>";
            if( isset($_GET["commentid"]) && is_numeric($_GET["commentid"]) ){
                $commentid = intval( $_GET["commentid"] );
            }else{
                $commentid = 0;
            }
            // short if condition 
            //$commentid = isset($_GET["commentid"]) && is_numeric($_GET["commentid"]) ? intval($_GET["commentid"]) : 0 ;
            $check = checkItem("comment_ID", "comments", $commentid) ;
            if( $check > 0){ 
                $stmt = $con->prepare("DELETE FROM 
                                                comments 
                                            WHERE 
                                            comment_ID = ?"); // i can get code from phpMyAdmin when i detele from user
                $stmt->execute(array(  $commentid )); // execute the statment 
                $count = $stmt->rowCount();
                if( $count > 0){ 
                    echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                            Comment is Deleted
                    </div>";
                    header("refresh:2; url=comments.php");
                }else{
                    echo "<div class='text-center alert alert-primary' role='alert' style='margin:100px auto;width:350px'>
                            Error
                    </div>";
                    header("refresh:2; url=comments.php");
                }
            }else{
                echo "<div class='text-center alert alert-danger' role='alert' style='margin:100px auto;width:350px'>
                    this id isn't Exist
                </div>";
                header("refresh:2; url=comments.php");
            }        
        }



    }
    





    include("../includes/template/admin_footer.php");
    
?>