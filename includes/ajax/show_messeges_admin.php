<?php

    include("../../init.php");


    if( isset($_SESSION["loginAdmin"])  ){

        $Sender    = "admin" ;
        $Receiver  = $_SESSION["clientID"] ;
        $chat_Link = "admin_" . $Receiver;

        
        if( isset( $_GET["messege"] ) ){





            $stmt2= $con->prepare("SELECT count(chat_Link) FROM messages  WHERE chat_Link = ? ");
            $stmt2->execute( array( $chat_Link ) );
            $staffrow = $stmt2->fetch(PDO::FETCH_NUM);
            $last_row_msg = $staffrow[0];
            $last_15_row_msg = $last_row_msg - 15;
            if( $last_15_row_msg < 0 ){
                $last_15_row_msg = 0;
            }


            $stmt = $con->prepare("SELECT 
                                        *
                                    FROM 
                                        messages
                                    WHERE chat_Link = ? ORDER BY msg_time  LIMIT  $last_15_row_msg , $last_row_msg 
                            ");
            $stmt->execute( array( $chat_Link ) );
            $rows = $stmt->fetchAll();
            foreach( $rows as $row){

                





                if ( $row["Sender_ID"] == "admin" ){
                    if( $row["msg_type"] == "text" ){
                        echo    '<div class="my-message">

                                    <div class="my-message-inner">
                                        <div class="my-message-content">
                                            <div class="date">
                                                <div> '.  time_ago( $row["msg_time"])  .'  </div>
                                            </div>
                                            <div class="message">
                                                <span class="triangle"></span>
                                                '. $row["message"] .' 
                                            </div>
                                        </div>
                                    </div>
                                
                                </div> ';
                    }elseif( $row["msg_type"] == "jpg" || $row["msg_type"] == "png"  || $row["msg_type"] == "png" ){
                        echo    '<div class="my-message my_photo">

                                    <div class="my-message-inner">
                                        <div class="my-message-content">
                                            <div class="date">
                                                <div>  '.   time_ago( $row["msg_time"])  .'  </div>
                                            </div>
                                            <div class="message">
                                                <img src="../assets/images/files-sent/'. $row["message"] .'" alt=""/>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div> ';
                    }elseif(  $row["msg_type"] == "like" ){

                        echo    '<div class="my-message my_like">

                                    <div class="my-message-inner">
                                        <div class="my-message-content">
                                            <div class="date"> 
                                                <div>  '. time_ago( $row["msg_time"])  .'  </div>
                                            </div>
                                            <div class="message">
                                                <i class="fas fa-thumbs-up"></i>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div> ';
                    }
                }elseif( $row["Sender_ID"] == $_SESSION["clientID"]  ){


                    if( $row["msg_type"] == "text" ){
                        echo    '<div class="friend-messege">
                                    <div class="friend-messege-content">
                                        <div class="friend-info">
                                            <span class="date ">
                                                <div> '. time_ago( $row["msg_time"])  .'   </div>
                                            </span>
                                        </div>
                                        <div class="message">
                                            <span class="triangle"></span>
                                            '. $row["message"] .' 
                                        </div>
                                    </div>
                                </div>';
                    }elseif( $row["msg_type"] == "jpg" || $row["msg_type"] == "png"  || $row["msg_type"] == "png" ){
                        echo    '<div class="friend-messege friend_photo">
                                    <div class="friend-messege-content">
                                        <div class="friend-info">
                                            <span class="date">
                                                <div> '. time_ago( $row["msg_time"])  .'     </div>
                                            </span>
                                        </div>
                                        <div class="message">
                                            <img src="../assets/images/files-sent/'. $row["message"] .'" alt=""/>
                                        </div>
                                    </div>
                                </div>';
                    }elseif(  $row["msg_type"] == "like" ){

                        echo    '<div class="friend-messege friend_like">
                                    <div class="friend-messege-content">
                                        <div class="friend-info">
                                            <span class="date">
                                                <div> '. time_ago( $row["msg_time"])  .'    </div>
                                            </span>
                                        </div>
                                        <div class="message">
                                            <i class="fas fa-thumbs-up"></i>
                                        </div>
                                    </div>
                                </div>';
                    }











                }








            }
            
        }


    }else{
        header("Location: ../../index.php");
    }
?>

