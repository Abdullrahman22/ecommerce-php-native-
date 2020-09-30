<?php
    $pagetitle = "Chat Page"; 
    include("../includes/template/admin_header.php");
    if( !isset( $_SESSION["loginAdmin"] ) ){
        header("Location: ../login.php");
    }else{ 

        
        $stmt = $con->prepare("SELECT * FROM users WHERE GroupID = 1 ");
        $stmt->execute();
        $clients = $stmt->fetchAll();
?>



    <div id="admin-chat">

        <h1 class="text-center" style="padding: 30px 0" > <i class="fas fa-comment"></i> Chat Page  </h1>


        <div class="chat-box">

            <div class="overlay"></div>
            <div class="left-section">

                <div class="top-bar">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="clients-messages">
                    




                </div>
            </div>

            <div class="right-section">

                <div class="top-bar">
                    <i class="fas fa-bars"></i>
                </div>

                <?php

                if( isset($_GET["clientID"]) && is_numeric($_GET["clientID"]) ){
                    $clientID = intval( $_GET["clientID"] ); 
                    create_session( "clientID" , $clientID );
                ?>
                    <div class="keyboard-section">

                        <div class="keyboard-section-inner"  > <!-- enctype must to upload files -->

                            <input type="text" class="form-control keyboard-input"  clientID="<?php echo $clientID; ?>" id="send-messege" placeholder="Type Your Messege..." autocomplete="off" autofocus   />

                            <form class="content-icon" enctype="multipart/form-data">
                                <label for="file" id="file-label">  <i class="fas fa-paperclip"></i> </label>
                                <input type="file" class="file form-control" id="file" name="file"   /> 
                            </form>


                            <i class="fas fa-paper-plane" style="display:none"></i>
                            <i class="fas fa-thumbs-up"></i>

                        </div>

                    </div>
                    <div class="messege-section">
                        <div class="messeges-container">

                        </div>
                    </div>
                <?php
                }else{
                    ?>
                        <div class="chat-info">
                            <div class="chat-info-inner">
                                <img src="../assets/images/backgrounds/messege_sent.png" alt="">
                                <p>Connect now with your clients and be close to them !</p>
                            </div>
                        </div>
                    <?php
                }
                ?>


            </div>

        </div>



    </div>
        



<?php
    include("../includes/template/admin_footer.php");
    }
?>
<!--




-->