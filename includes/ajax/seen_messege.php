<?php

    include("../../init.php");

    if( isset($_SESSION["loginUserID"]) ){
        



        if( isset( $_POST["clientID"] ) ){

            $clientID = $_POST["clientID"];
            $chat_Link = "admin_" . $clientID;

            messegeSeen( $chat_Link , $clientID );

  
        }


    }else{
        header("Location: ../../index.php");
    }