<?php

    include("../../init.php");

    if( isset($_SESSION["loginUserID"]) ){


        $sessionUserID   = $_SESSION["loginUserID"] ;



        if( isset( $_POST["itemid"] ) && is_numeric( $_POST["itemid"] )  ){
            
            $itemid = intval( $_POST["itemid"] );

            $check = checkItem("Item_ID", "items", $itemid) ;
            if( $check > 0){ 
                $stmt = $con->prepare("DELETE FROM 
                                                add_cart 
                                            WHERE 
                                                itemID = ? AND userID = ? "); // i can get code from phpMyAdmin when i detele from user
                $stmt->execute(array(  $itemid , $sessionUserID )); // execute the statment 
                $count = $stmt->rowCount();
                if( $count > 0){ 
                    echo json_encode(["status" => "successfully" ]);  
                }else{
                    echo json_encode(["status" => "error" ]); 
                }
            }else{
                header("Location: index.php");
            }  

        }

    }else{
        header("Location: login.php");
    }

