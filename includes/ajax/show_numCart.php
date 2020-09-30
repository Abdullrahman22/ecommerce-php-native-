<?php

    include("../../init.php");

    if( isset($_SESSION["loginUserID"]) ){


        $sessionUserID   = $_SESSION["loginUserID"] ;



        if( isset( $_GET["show_numCart"] ) ){
            

            $stmt = $con->prepare("SELECT COUNT( addCartID ) FROM add_cart WHERE userID = ?  ");
            $stmt->execute( array( $sessionUserID ) );   // do the statment
            echo $stmt->fetchColumn(); 

        }

    }else{
        header("Location: login.php");
    }

