<?php

    include("../../init.php");


    if( isset($_SESSION["loginAdmin"])  ){

        //$Sender    = "admin" ;
        //$Receiver  = $_SESSION["clientID"] ;
        //$chat_Link = "admin_" . $Receiver;
        $admin    = "admin" ;
        
        if( isset( $_GET["messege"] ) ){



            $statment = $con->prepare(" SELECT DISTINCT `chat_Link` FROM `messages` WHERE `Sender_ID` = ? OR `Receiver_ID` = ? GROUP By `msg_id` DESC LIMIT 9999");
            $statment->execute( array( $admin , $admin ) );
            $rows = $statment->fetchAll();


            foreach ($rows  as $row) {

                $clientId = str_replace( $admin ,"", $row["chat_Link"] );
                $clientId = str_replace( "_" ,"", $clientId);
                
                

                $stmt = $con->prepare("SELECT * FROM `users` WHERE UserID = ? LIMIT 1 ");
                $stmt->execute( array( $clientId ) );
                $client = $stmt->fetch();

                if( $admin > $clientId ){
                    $chating_Link = $admin . "_" . $clientId;
                }else{
                    $chating_Link = $clientId . "_" . $admin;
                }



                $stmt2 = $con->prepare("SELECT * FROM `messages` WHERE `Sender_ID` = ? AND `Receiver_ID` = ? AND `seen` = 0  ");
                $stmt2->execute( array( $clientId , $admin ) );
                $count = $stmt2->rowCount();

                
                ?>
                    <div class="clients-messge-box <?php if( $count > 0 ){ echo "custom-alert" ;} ?>" onclick="location.href='chat.php?clientID=<?php echo $client['UserID'] ;?>'" clientID = "<?php echo $client['UserID'] ;?>" >
                            
                        <?php
                            $count_unseen_messege   = count_unseen_messege( $clientId , $admin  );
                            if( $count_unseen_messege == "" ){
                                $count_unseen_messege = "0" ;
                            }
                            if( $count_unseen_messege >= 10 ){
                                $count_unseen_messege = "+9";
                            }
                            if( $count > 0 ){
                                echo '<span class="not_seen_num">' . $count_unseen_messege . "</span>";
                            }
                            
                        ?>
                        <div class="client-img">
                            <?php
                                if( $client["gender"] == "0"){
                                    $userPhoto = "../assets/images/backgrounds/dafulte-img-male.jpg";
                                }else{
                                    $userPhoto = "../assets/images/backgrounds/dafulte-img-female.jpg";
                                }
                            ?>
                            <img src="<?php echo $userPhoto; ?>" alt="">
                        </div>
                        <div class="messege-info">
                            <div class="client-name">
                                <?php  echo ucfirst( $client["Username"] ); ?>
                            </div>
                            <div class="client-messge">
                                <?php

                                    $chat_Link = "admin_" . $client['UserID'];
                                    if( getLastMsgSender($chat_Link) == "admin" ){
                                        $sender = "You : ";
                                    }else{
                                        $sender = " ";
                                    }

                                    if( getLastMsgType($chat_Link) == "text" ){

                                        echo $sender . getLastMsg($chat_Link) ;

                                    }elseif( getLastMsgType($chat_Link) == "jpg" || getLastMsgType($chat_Link) == "png" || getLastMsgType($chat_Link) == "jpeg"  ){
                                        
                                        echo $sender .  '<i class="far fa-images"></i> ' . getLastMsg($chat_Link) ;

                                    }elseif( getLastMsgType($chat_Link) == "like" ){
                                        
                                        echo   '<div class="like" > ' . $sender . getLastMsg($chat_Link) .'  </div>'  ;

                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                <?php
            }







            
        }


    }else{
        header("Location: ../../index.php");
    }
?>

