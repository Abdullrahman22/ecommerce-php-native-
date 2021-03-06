<?php

    include("../../init.php");

    if( isset($_SESSION["loginUserID"])  ){


        $Sender    = $_SESSION["loginUserID"] ;
        $Receiver  = "admin" ;
        $chat_Link = "admin_" . $Sender;
    
        
        if( isset( $_POST["send_message"] ) ){
            $messege = security( $_POST["send_message"] );
            $msg_type = "text";



            $stmt = $con->prepare(" INSERT INTO 
                        messages ( chat_Link ,  message , msg_type , Sender_ID , Receiver_ID )
                        VALUES( :zchat_Link , :zmessage , :zmsg_type , :zSender_ID , :zReceiver_ID ) ");
            $stmt->execute(array(
            ":zchat_Link"    => $chat_Link,
            ":zmessage"      => $messege,
            ":zmsg_type"     => $msg_type,
            ":zSender_ID"    => $Sender,
            ":zReceiver_ID"  => $Receiver,
            ));
            
            if( $stmt ){
                echo json_encode(["status" => "success" ]); 
            }else{
                echo json_encode(["status" => "error" ]); 
            }
        }


    }else{
        header("Location: ../../index.php");
    }
