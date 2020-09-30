<?php

    function getInputValue($name){
        if (isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

    function getQuantityValue($name){
        if (isset($_POST[$name])){
            echo $_POST[$name];
        }else{
            echo "1";
        }
    }

    function security( $data ){
        $data = strip_tags($data); // to remove tags from inputs
        return ltrim( $data, " " ); // to remove spaces after string
    }

    function create_session( $session_name , $session_value ){
        $_SESSION["$session_name"] = "$session_value" ;
    }
    

    function getValueInput($name){
        if (isset($_POST[$name])){
            echo $_POST[$name];
        }
    }


    function checkEmailExist( $email ){
        global $con;
        $stmt = $con->prepare("SELECT Email FROM users WHERE Email = ? ");
        $stmt->execute( array( $email ) );
        $count =  $stmt->rowCount();
        return $count; 
    }
    function checkUsernameExist( $username ){
        global $con;
        $stmt = $con->prepare("SELECT Username FROM users WHERE Username = ? ");
        $stmt->execute( array( $username ) );
        $count = $stmt->rowCount();
        return $count; 
    }
    function checkCategoryExist( $catid ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM categories WHERE Category_ID = ? ");
        $stmt->execute( array( $catid ) );
        $count =  $stmt->rowCount();
        return $count; 
    }
    
    function checkItemExist( $itemid ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ? ");
        $stmt->execute( array( $itemid ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    function checkUserExist( $userid ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? ");
        $stmt->execute( array( $userid ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    function checkItemNameExist( $Item_Name ){
        global $con;
        $stmt = $con->prepare("SELECT Item_Name FROM items WHERE Item_Name = ? ");
        $stmt->execute( array( $Item_Name ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    function checkItem($select, $from, $value){
        global $con;
        $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
        $statment ->execute(array($value));
        $count =  $statment->rowCount();
        return $count;
    }

    function getUserinfo( $table , $session , $valueGet ){ // depende on UserID
        global $con;
        $stmt = $con->prepare("SELECT * FROM users WHERE $table = ? LIMIT 1");
        $stmt->execute( array( $session ) );
        $row = $stmt->fetch();
        return $row["$valueGet"];
    }

    function getlastedItems(){ // depende on UserID
        global $con;

        $stmt = $con->prepare("SELECT * FROM `items` ORDER BY Item_ID DESC LIMIT 20");
        $stmt->execute( array(  ) );
        $rows = $stmt->fetchAll();
        return $rows ;

    }

    function get4categories(){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `categories` ORDER BY Category_ID  LIMIT 4");
        $stmt->execute( array(  ) );
        $rows = $stmt->fetchAll();
        return $rows ;
    }

    function getFavouriteItems(){ // depende on UserID
        global $con;

        $stmt = $con->prepare("SELECT * FROM `favorite` ORDER BY favorite_ID DESC ");
        $stmt->execute( array(  ) );
        $rows = $stmt->fetchAll();
        return $rows ;

    }

    function count_unseen_messege( $clientId , $admin  ){ // depende on UserID
        global $con;
        $stmt = $con->prepare("SELECT COUNT( message ) FROM messages WHERE `Sender_ID` = ? AND `Receiver_ID` = ? AND `seen` = 0  ");
        $stmt->execute( array( $clientId , $admin ) );   // do the statment
        return $stmt->fetchColumn(); 

    }
    
    function messegeSeen($chat_Link , $clientId ){
        global $con;
        $stmt = $con->prepare(" UPDATE messages SET seen = 1 WHERE chat_Link = ? AND Sender_ID = ? ");
        $stmt->execute(array( $chat_Link , $clientId ));
        return $stmt;
    }

    function getRandomItems(){ // depende on UserID
        global $con;

        $stmt = $con->prepare("SELECT * FROM `items` ORDER BY RAND() DESC LIMIT 20");
        $stmt->execute( array(  ) );
        $rows = $stmt->fetchAll();
        return $rows ;

    }




    function countCarts( $sessionID ){ // depende on UserID

        global $con;
        $stmt = $con->prepare("SELECT COUNT( addCartID ) FROM add_cart WHERE userID = ?");
        $stmt->execute( array( $sessionID ) );   // do the statment
        return $stmt->fetchColumn(); 

    }


    function countOrders( $sessionID ){ // depende on UserID

        global $con;
        $stmt = $con->prepare("SELECT COUNT( order_ID ) FROM orders WHERE user_ID = ?");
        $stmt->execute( array( $sessionID ) );   // do the statment
        return $stmt->fetchColumn(); 

    }


    function countFavourites( $sessionID ){ // depende on UserID

        global $con;
        $stmt = $con->prepare("SELECT COUNT( favorite_ID ) FROM favorite WHERE userID = ?");
        $stmt->execute( array( $sessionID ) );   // do the statment
        return $stmt->fetchColumn(); 

    }

    function countAddCart( $sessionID ){ // depende on UserID

        global $con;
        $stmt = $con->prepare("SELECT COUNT( addCartID ) FROM add_cart WHERE userID = ?  ");
        $stmt->execute( array( $sessionID ) );   // do the statment
        return $stmt->fetchColumn(); 

    }
    function countFavourite( $sessionID ){ // depende on UserID

        global $con;
        $stmt = $con->prepare("SELECT COUNT( favorite_ID ) FROM favorite WHERE userID = ?  ");
        $stmt->execute( array( $sessionID ) );   // do the statment
        return $stmt->fetchColumn(); 

    }

    function getItemById($itemid){ // depende on itemid
        global $con;
        $stmt = $con->prepare(" SELECT
                                    items.*, categories.Category_Name FROM items 
                                INNER JOIN categories ON categories.Category_ID = items.Cat_ID
                                WHERE Item_ID = ? LIMIT 1
        ");
        $stmt->execute( array( $itemid ) );
        $row = $stmt->fetch();
        return $row ;
    }

    function getCategory($catid){ // depende on itemid
        global $con;
        $stmt = $con->prepare(" SELECT * FROM `categories` WHERE Category_ID = ? LIMIT 1 ");
        $stmt->execute( array( $catid ) );
        $row = $stmt->fetch();
        return $row ;
    }


    function getitemsBycatid($catid){ // depende on itemid
        global $con;
        $stmt = $con->prepare(" SELECT * FROM `items` WHERE Cat_ID = ? ");
        $stmt->execute( array( $catid ) );
        $rows = $stmt->fetchAll();
        return $rows ;
    }


    function getCommentByItemId( $itemid ){ // depende on itemid
        global $con;
        $stmt = $con->prepare(" SELECT
                                    comments.*, users.Username FROM comments 
                                INNER JOIN users ON users.UserID = comments.User_ID
                                WHERE item_ID = ? 
        ");
        $stmt->execute( array( $itemid ) );
        $rows = $stmt->fetchAll();
        return $rows ;
    }


    function commentExist( $itemid ){ // depende on itemid
        global $con;
        $stmt = $con->prepare("SELECT * FROM comments WHERE item_ID = ?");
        $stmt->execute( array( $itemid ) );
        $count = $stmt->rowCount();
        return $count ;
    }










    function time_ago( $db_msg_time ){

        $db_time      = strtotime( $db_msg_time );
        date_default_timezone_set('Africa/Cairo');

        $current_time = time();

        $seconds = $current_time - $db_time ;

        $minutes = floor($seconds / 60); // 60
        $hours   = floor($seconds / 3600); // 60 *60
        $days    = floor($seconds / 86400); // 60 *60 * 24
        $weeks   = floor($seconds / 604800); // 60 *60 * 24 * 7
        $months  = floor($seconds / 2592000); // 60 *60 * 24 * 30
        $years   = floor($seconds / 31536000); // 60 *60 * 24 * 30 *12


        if( $seconds <= 60 ){
            return "Just Now";
        }
        elseif( $minutes <= 60 ){

            if( $minutes == 1 ){
                return "1 minute ago";
            }else{
                return $minutes . " minutes ago";
            }

        }
        elseif( $hours <= 24 ){

            if( $hours == 1 ){
                return "1 hour ago";
            }else{
                return $hours . " hours ago";
            }

        }
        elseif( $days <= 7 ){

            if( $days == 1 ){
                return "1 day ago";
            }else{
                return $days . " days ago";

            }

        }
        elseif( $weeks <= 4.3 ){

            if( $weeks == 1 ){
                return "1 week ago";
            }else{
                return $weeks . " weeks ago";

            }

        }
        elseif( $months <= 12 ){

            if( $months == 1 ){
                return "1 month ago";
            }else{
                return $months . " months ago";

            }

        }
        else{
            if( $years == 1 ){
                return "1 year ago";
            }else{
                return $years . " years ago";

            }
        }


  

    }




          
    function getLastMsgSender ( $chat_Link ){ // depende on UserID
        global $con;
        $stmt = $con->prepare("SELECT Sender_ID FROM messages WHERE chat_Link = ? ORDER BY `msg_id` DESC LIMIT 1 ");
        $stmt->execute( array( $chat_Link ) );
        $row = $stmt->fetch();
        return $row["Sender_ID"];
    }


    function getLastMsgType ( $chat_Link ){ // depende on UserID
        global $con;
        $stmt = $con->prepare("SELECT msg_type FROM messages WHERE chat_Link = ? ORDER BY `msg_id` DESC LIMIT 1 ");
        $stmt->execute( array( $chat_Link ) );
        $row = $stmt->fetch();
        return $row["msg_type"];
    }

     function getLastMsg ( $chat_Link ){ // depende on UserID
        global $con;
        $stmt = $con->prepare("SELECT message FROM messages WHERE chat_Link = ? ORDER BY `msg_id` DESC LIMIT 1 ");
        $stmt->execute( array( $chat_Link ) );
        $row = $stmt->fetch();
        return $row["message"];
    }



    function fix_rotate_jpg_image( $tmp_name ){
        
        $exif = exif_read_data( $tmp_name );
        if (!empty($exif['Orientation'])) {
            $imageResource = imagecreatefromjpeg($tmp_name); // provided that the image is jpeg. Use relevant function otherwise
            switch ($exif['Orientation']) {
                case 3:
                $image = imagerotate($imageResource, 180, 0);
                break;
                case 6:
                $image = imagerotate($imageResource, -90, 0);
                break;
                case 8:
                $image = imagerotate($imageResource, 90, 0);
                break;
                default:
                $image = $imageResource;
            } 
        }
        imagejpeg($image, $tmp_name, 90);

    }
  
?>
