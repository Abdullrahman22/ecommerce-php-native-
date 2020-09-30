<?php 
    $pagetitle = "SignUp ";
    $RegisterPage = "_";
    include("includes/template/header.php");

    if( isset( $_SESSION["loginUserID"] ) ){
        header("Location: index.php");
    }


    /*$stmt = $con->prepare("SELECT UserID FROM users WHERE UserID = 331 ORDER BY `UserID` DESC LIMIT 1 ");
    $stmt->execute( array(  ) );
    $row = $stmt->fetch();
    echo $row["UserID"];*/


    if(isset($_POST["signUpBtn"])){
    

        $first_name        =  security( $_POST["first_name"] );
        $last_name         =  security( $_POST["last_name"] );
        $username          =  security( $_POST["username"] ); 
        $gender            =  security( $_POST["gender"] ); 
        $email             =  security( $_POST["email"] ); 
        $password          =  security( $_POST["password"] ); 


        $first_name_status = $last_name_status = $username_status = $email_status = $password_status = $gender_status = 1 ;  // make status not empty;

        //===================== short_name Validation ==============================
        if( empty( $first_name ) ){
            $first_name_error = "First name is required";
            $first_name_status = ""; // make email_status empty
        }else {
            if( strlen($first_name) > 8 || strlen($first_name) < 2 ){
                $first_name_error = " First name must be between 2 and 8 characters";
                $first_name_status = "";   // make email_status  empty
            }else{
                if( empty( $last_name ) ){
                    $last_name_error = "Last name is required";
                    $last_name_status = ""; // make email_status empty
                }else{
                    if( strlen($last_name) > 8 || strlen($last_name) < 2 ){
                        $last_name_error = " Last name must be between 2 and 8 characters";
                        $last_name_status = "";   // make email_status  empty        
                    }
                }
            }
        }

        //===================== Username Validation ==============================
        if( empty( $username ) ){
            $username_error = "Username is required";
            $username_status = ""; // make email_status empty
        }else {
            if(strlen($username) > 16 || strlen($username) < 5 ){
                $username_error = "Username must be between 5 and 16 characters";
                $username_status = "";   // make email_status  empty
            }else{
                $countUser = checkUsernameExist($username);
                if( $countUser != 0){
                    $username_error = "Sorry this username is exist";
                    $username_status = ""; // make email_status  empty     
                }
            }
        }

        //===================== Email Validation ==============================
        if( empty( $email ) ){
            $email_error = "Email is required";
            $email_status = "";
        }else{
            if( !filter_var( $email , FILTER_VALIDATE_EMAIL ) ){
                $email_error = "Invalide Email";
                $email_status = ""; // make email_status  empty
            }else{
                $countEmail = checkEmailExist($email);
                if( $countEmail != 0){
                    $email_error = "Sorry this email is exist";
                    $email_status = ""; // make email_status  empty     
                }
            }
        }

        //===================== Gender Validation ==============================
        $gender =  security( $_POST["gender"] ); 
        if( $gender == "" ){
            $gender_error = "you must choose gender";
            $gender_status = ""; // make email_status  empty     
        }else{
            if( $gender != "0" && $gender != "1"  ){
                $gender_error = "You must choose only gender";
                $gender_status = ""; // make email_status  empty     
            }
        }
        
        //===================== password Validation ==============================
        if( empty( $password ) ){
            $password_error = "Password is required";
            $password_status = "";
        }else{
            if(strlen($password) > 25 || strlen($password) < 5 ){
                $password_error = "Password must be between 5 and 25 characters";
                $username_status = "";  // make password_status  empty
            }else{
                if( preg_match("/[^A-Za-z0-9]/" , $password)){
                    $password_error = "Password must only contain numbers and letters";
                    $password_status = ""; // make password_status  empty
                }
            }
        }

        //===================== Insert user into database ==============================
        if( !empty($first_name_status) && !empty($last_name_status) && !empty($username_status) && !empty($email_status) && !empty($password_status) ){
            
            $hashPassword = md5($password);
            $GroupID = 1 ;  // 1 = users   ;   2 = admins

            $stmt = $con->prepare(" INSERT INTO 
                                            users (  firstName , lastName , Username , Pass , Email , gender , GroupID ) 
                                            VALUES ( :zfirstName , :zlastName , :zUsername , :zPass , :zEmail , :zgender , :zGroupID) ");
            $stmt->execute( array( 
                ":zfirstName"       => $first_name,
                ":zlastName"        => $last_name,
                ":zUsername"        => $username,
                ":zPass"            => $hashPassword,
                ":zEmail"           => $email,
                ":zgender"          => $gender,
                ":zGroupID"         => $GroupID,
            ));

            if($stmt->rowCount() > 0){  // because rowCount() must be 1 at inserting database
                create_session( "creating_account_success" , " <i class='fas fa-check'></i> &nbsp; Your account successfuly created" );
                header("Location: login.php");
            }else{
                create_session( "creating_account_failed" , " <i class='fas fa-times'></i>  &nbsp; Failed to create your account" );
                header("Location: login.php");
            }



        }
    }
    ?>
        <div id="register-page">


            <div class="wrapper"  >
                <div class="inner">
                    <div class="image-holder">
					    <img src="assets/images/backgrounds/headphone.png" alt="">
                    </div>
                    <form  action="<?php echo  $_SERVER["PHP_SELF"]; ?>" method="POST" >
                        <p class="title"> <a href="index.php"> <i class="fas fa-shopping-cart"></i> Snoffle Shop </a> </p>

                        <!------------------------------ First name - Last name------------------------------>
                        <div class="form-group">
                            <input type="text" placeholder="First Name" name ="first_name" class="form_control" value="<?php  echo getInputValue("first_name");  ?>" autocomplete="off"  required />
                            <input type="text" placeholder="Last Name" name ="last_name" class="form_control" value="<?php  echo getInputValue("last_name");  ?>" autocomplete="off"  required />
                        </div>
                        <?php
                            if( isset( $first_name_error ) ){
                                echo '<p class="error_messege">' . $first_name_error . '</p>'; 
                            }
                        ?>
                        <?php
                            if( isset( $last_name_error ) ){
                                echo '<p class="error_messege">' . $last_name_error . '</p>'; 
                            }
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

                        <!------------------------------ email ------------------------------>

                        <div class="form-wrapper">
                            <input type="text" placeholder="Email Address" name ="email" class="form_control" value="<?php  echo getInputValue("email");  ?>" autocomplete="off"  required />
                            <i class="zmdi zmdi-email fas fa-envelope"></i>
                        </div>
                        <?php
                            if( isset( $email_error ) ){
                                echo '<p class="error_messege">' . $email_error . '</p>'; 
                            }
                        ?>

                        <!------------------------------ Gender ------------------------------>

                        <div class="form-wrapper">
                        <select name ="gender"  class="form_control">
                            <option value="" selected  style="display:none" >Gender</option>
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                        </select>
                            <i class="zmdi zmdi-caret-down fas fa-arrow-down" style="font-size: 17px"></i>
                        </div>
                        <?php
                            if( isset( $gender_error ) ){
                                echo '<p class="error_messege">' . $gender_error . '</p>'; 
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
                        <button type="submit" name="signUpBtn" >Register !
                            <i class="zmdi zmdi-arrow-right fas fa-arrow-right"></i>
                        </button>
                        
                        <a href="login.php"> Already have an account ? </a>
                    </form>
                </div>
            </div>



    
        </div>
    <?php include("includes/template/footer.php");





