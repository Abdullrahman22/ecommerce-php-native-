<?php 
    $pagetitle = "Login Page ";
    $RegisterPage = "_";
    include("includes/template/header.php");

    if( isset( $_SESSION["loginUserID"] ) ){
        header("Location: index.php");
    }


    if(isset($_POST["loginBtn"])){
    

        $username          =  security( $_POST["username"] ); 
        $password          =  security( $_POST["password"] ); 

        $username_status = $password_status = 1 ;  // make status not empty;


    
        //===================== Username Validation ==============================

        if( empty( $username) ){
            $username_error = "Username is required";
            $username_status = ""; // make email_status empty
        }else{
            if(strlen($username) > 16 || strlen($username) < 5 ){
                $username_error = "Username must be between 5 and 25 characters";
                $username_status = "";   // make email_status  empty
            }
        }
        

    
        //===================== Password Validation ==============================


        if( empty( $password ) ){
            $password_error = "Password is required";
            $password_status = "";
        }else{
            if(strlen($password) > 25 || strlen($password) < 5 ){
                $username_error = "Password must be between 5 and 25 characters";
                $username_status = "";  // make password_status  empty
            }else{
                if( preg_match("/[^A-Za-z0-9]/" , $password)){
                    $password_error = "Password must only contain numbers and letters";
                    $password_status = ""; // make password_status  empty
                }
            }
        }


        //===================== Check if user in DB ==============================
        if( !empty($username_status) && !empty($password_status)  ){

            $hashPassword = md5($password);
            //========== For User ===========

            $stmt_user = $con->prepare("SELECT * FROM users WHERE Username = ? AND Pass = ? AND GroupID = 1 ");//GroupID = 1 for user
            $stmt_user->execute(array( $username , $hashPassword)) ;
            
            if($stmt_user->rowCount() > 0){  // because rowCount() must be 1 when this user has table in db
                $sessionUserID = getUserinfo( "Username", $username , "UserID" );// get UserID by Username
                create_session( "loginUserID" , $sessionUserID );
                header("Location: index.php");
            }else {
                $username_error = "Username or password is incorrect";
                $password_error = "";                
            }

            //========== For Admin ===========

            $stmt_admin = $con->prepare("SELECT * FROM users WHERE Username = ? AND Pass = ? AND GroupID = 2 ");//GroupID = 2 For Admin
            $stmt_admin->execute(array( $username , $hashPassword)) ;
            
            if($stmt_admin->rowCount() > 0){  // because rowCount() must be 1 when this user has table in db
                $sessionUserID = getUserinfo( "Username", $username , "UserID" );// get UserID by Username
                create_session( "loginUserID" , $sessionUserID );
                create_session( "loginAdmin" , $sessionUserID );
                header("Location: admin/index.php");
            }else {
                $username_error = "Username or password is incorrect";
                $password_error = "";                
            }






        }


    }

    

    ?>
        <div id="register-page login-page">

            <div class="wrapper"  >


      

                <div class="inner">
                    <div class="image-holder">
					    <img src="assets/images/backgrounds/headphone.png" alt="">
                    </div>    


                    <form  action="<?php echo  $_SERVER["PHP_SELF"]; ?>" method="POST" >
                        <p class="title"> <a href="index.php"> <i class="fas fa-shopping-cart"></i> Snoffle Shop </a> </p>

                                
                            
                        <?php
                            if( isset($_SESSION["creating_account_success"])){
                                echo '<div class="signup-success-messege "> ';
                                    echo '<p class="text-center">';
                                        echo $_SESSION["creating_account_success"] ;
                                    echo '</p>';
                                echo '</div>';
                            }
                            elseif ( isset($_SESSION["creating_account_failed"]) ) {
                                echo '<div class="signup-failed-messege"> ';
                                    echo '<p class="text-center">';
                                        echo $_SESSION["creating_account_failed"] ;
                                    echo '</p>';
                                echo '</div>';
                            }
                            unset( $_SESSION["creating_account_success"] );
                            unset( $_SESSION["creating_account_failed"] );
                        ?>
                            

                        <!------------------------------ username------------------------------>

                        <div class="form-wrapper">
                            <input type="text" placeholder="Username" name ="username" class="form_control" value="<?php  echo getInputValue("username");  ?>" autocomplete="off"  required />
                            <i class="zmdi zmdi-account fas fa-user"></i>
                        </div>
                        <?php
                            if( isset( $username_error ) ){
                                echo '<p class="error_messege">' . $username_error . '</p>'; 
                            }
                        ?>

                        
                        <!------------------------------ Password ------------------------------>

                        <div class="form-wrapper">
                            <input type="password" placeholder="Password" name ="password" class="form_control" value="<?php  echo getInputValue("password");  ?>" autocomplete="new-password" required/>
                            <i class=" zmdi zmdi-lock fa fa-eye" style="display: none"></i> 
                            <i class=" zmdi zmdi-lock fa fa-eye-slash" ></i> 
                        </div>
                        <?php
                            if( isset( $password_error ) ){
                                echo '<p class="error_messege">' . $password_error . '</p>'; 
                            }
                        ?>


                        <!------------------------------ Button ------------------------------>
                        <button type="submit" name="loginBtn" >Login !
                            <i class="zmdi zmdi-arrow-right fas fa-arrow-right"></i>
                        </button>
                        <a href="signup.php"> Already have an account ? </a>
                    </form>
                </div>
            </div>







        




            
    
    
        </div>
    <?php include("includes/template/footer.php");





