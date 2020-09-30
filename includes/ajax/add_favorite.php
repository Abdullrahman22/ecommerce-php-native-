<?php

    include("../../init.php");

    if( isset($_SESSION["loginUserID"]) ){


        $sessionUserID   = $_SESSION["loginUserID"] ;



        if( isset( $_POST["itemid"] ) && is_numeric( $_POST["itemid"] )  ){
            
            $itemid = intval( $_POST["itemid"] );

            $stmt = $con->prepare("SELECT * FROM favorite WHERE userID = ? AND itemID = ?  ");
            $stmt->execute( array( $sessionUserID , $itemid  ) );
            $count =  $stmt->rowCount();

            if( $count == 0 ){


                $stmt2 = $con->prepare(" INSERT INTO 
                            favorite ( itemID , userID )
                            VALUES( :zitemID , :zuserID )");
                $stmt2->execute(array(
                    ":zitemID"    => $itemid,
                    ":zuserID"    => $sessionUserID,
                ));


                if( $stmt2 ){
                    echo json_encode(["status" => "successfully" ]); 
                }else{
                    echo json_encode(["status" => "error" ]); 
                }

            }else{
                echo json_encode(["status" => "exsit" ]); 
            }

        }

    }else{
        header("Location: login.php");
    }

