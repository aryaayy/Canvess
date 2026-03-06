<?php
    include('config.php');

    function getIdUserByUsername($username){
        global $conn;

        $query = "SELECT id_user FROM t_user WHERE username = '$username'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $id = $result['id_user'];
        
        return $id;
    }

    function readUserProfile($id){
        global $conn;

        $query = "SELECT * FROM t_user WHERE id_user = $id";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        return $result;
    }
    
    function readMainChat(){
        global $conn;
        
        $query = "SELECT t_user.username as username, t_mainchat.* FROM t_mainchat INNER JOIN t_user ON t_mainchat.id_user = t_user.id_user ORDER BY main_datetime DESC";
        $result = mysqli_query($conn, $query);
        
        return $result;
    }
    
    function readMainChatPost($id){
        global $conn;
        
        $query = "SELECT t_user.username as username, t_mainchat.* FROM t_mainchat INNER JOIN t_user ON t_mainchat.id_user = t_user.id_user WHERE t_mainchat.id_mainchat = $id";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        // echo $result['main_message'];
        
        return $result;
    }
    
    function readMainChatProfile($id){
        global $conn;
        
        $query = "SELECT t_user.username as username, t_mainchat.* FROM t_mainchat INNER JOIN t_user ON t_mainchat.id_user = t_user.id_user WHERE t_user.id_user = $id ORDER BY main_datetime DESC";
        $result = mysqli_query($conn, $query);
        
        return $result;
    }
    
    function countMainChatProfile($id){
        global $conn;

        $query = "SELECT COUNT(id_mainchat) as countMain FROM t_mainchat WHERE id_user = $id";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countMain'];
        
        return $result;
    }
    
    function countMainChatProfilePublic($id){
        global $conn;

        $query = "SELECT COUNT(id_mainchat) as countMain FROM t_mainchat WHERE id_user = $id AND isAnonymous = 0";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countMain'];
        
        return $result;
    }

    function readLikedMainChat($id){
        global $conn;

        $query = "SELECT * FROM t_likesmain WHERE id_user = $id";
        $result = mysqli_query($conn, $query);
        
        return $result;
    }

    function countLikedMainChat($id){
        global $conn;

        $query = "SELECT COUNT(id_mainchat) as countLiked FROM t_likesmain WHERE id_user = $id";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countLiked'];

        return $result;
    }
    
    function readReplyChat(){
        global $conn;
        
        $query = "SELECT t_user.username as username, t_replychat.* FROM t_replychat INNER JOIN t_user ON t_mainchat.id_user = t_user.id_user ORDER BY reply_datetime DESC";
        $result = mysqli_query($conn, $query);
        
        return $result;
    }
    
    function readReplyChatPost($id){
        global $conn;
        
        $query = "SELECT t_user.username as username, t_replychat.* FROM t_replychat INNER JOIN t_user ON t_replychat.id_user = t_user.id_user WHERE t_replychat.id_main = $id ORDER BY reply_datetime ASC";
        $result = mysqli_query($conn, $query);
        
        return $result;
    }
    
    function readReplyChatProfile($id){
        global $conn;
        
        $query = "SELECT t_user.username as username, t_replychat.* FROM t_replychat INNER JOIN t_user ON t_replychat.id_user = t_user.id_user WHERE t_user.id_user = $id ORDER BY reply_datetime DESC";
        $result = mysqli_query($conn, $query);
        
        return $result;
    }
    
    function countReplyChatProfile($id){
        global $conn;

        $query = "SELECT COUNT(id_replychat) as countReply FROM t_replychat WHERE id_user = $id";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countReply'];
        
        return $result;
    }
    
    function countReplyChatProfilePublic($id){
        global $conn;

        $query = "SELECT COUNT(id_replychat) as countReply FROM t_replychat WHERE id_user = $id AND isAnonymous = 0";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countReply'];
        
        return $result;
    }
    
    function countReplyChatPost($id){
        global $conn;

        $query = "SELECT COUNT(id_replychat) as countReply FROM t_replychat WHERE id_main = $id";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countReply'];
        
        return $result;
    }

    function countMainChatLikes($id){
        global $conn;

        $query = "SELECT COUNT(id_likesmain) as countLikes FROM t_likesmain WHERE id_mainchat = $id";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countLikes'];
        
        return $result;
    }

    function createPost(){
        global $conn;

        $id_user = $_POST['id_user'];
        $main_message = $_POST['main_message'];
        $isAnonymous = $_POST['isAnonymous'];

        $query = "INSERT INTO t_mainchat VALUES(NULL, '$main_message', NULL, '$isAnonymous', $id_user)";
        $result = mysqli_query($conn, $query);

        $id_mainchat = 0;
        $isSucceed = mysqli_affected_rows($conn);
        if($isSucceed > 0){
            $query = "SELECT id_mainchat FROM t_mainchat WHERE id_user = $id_user";
            $result = mysqli_query($conn, $query);
            while($temp_id = mysqli_fetch_assoc($result)){
                $id_mainchat = $temp_id['id_mainchat'];
            }
        }

        return $id_mainchat;
    }
    
    function createReply(){
        global $conn;

        $id_user = $_POST['id_user'];
        $id_mainchat = $_POST['id_mainchat'];
        $reply_message = $_POST['reply_message'];
        $isAnonymous = $_POST['isAnonymous'];

        $query = "INSERT INTO t_replychat 
                  VALUES(NULL, '$reply_message', NULL, '$isAnonymous', $id_user, $id_mainchat)";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);

        return $isSucceed;
    }

    function deleteAccount($id){
        global $conn;

        $query = "DELETE FROM t_user WHERE id_user = $id";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);

        return $isSucceed;
    }

    function updateUsername($id){
        global $conn;

        $username = $_POST['username'];

        $query = "UPDATE t_user SET username = '$username' WHERE id_user = $id";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);
        return $isSucceed;
    }

    function updatePost($id){
        global $conn;

        $main_message = $_POST['main_message'];
        $isAnonymous = $_POST['isAnonymous'];

        $query = "UPDATE t_mainchat SET main_message = '$main_message', isAnonymous = $isAnonymous WHERE id_mainchat = $id";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);
        return $isSucceed;
    }

    function deletePost($id){
        global $conn;

        $query = "DELETE FROM t_mainchat WHERE id_mainchat = $id";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);

        return $isSucceed;
    }

    function deleteReply($id){
        global $conn;

        $query = "DELETE FROM t_replychat WHERE id_replychat = $id";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);

        return $isSucceed;
    }

    function checkLikesMain($id_user, $id_mainchat){
        global $conn;

        $query = "SELECT * FROM t_likesmain WHERE id_user = $id_user AND id_mainchat = $id_mainchat";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        if(isset($result)){
            $isSucceed = 1;
        }else{
            $isSucceed = 0;
        }

        return $isSucceed;
    }

    function adminUser()
	{
        global $conn;
        $query = "SELECT * from t_user";
        $result = mysqli_query($conn, $query);
    
        return $result;
	}

    function adminReply()
	{
        global $conn;
        $query = "SELECT t_replychat.*, t_mainchat.*, t_user.username from t_replychat INNER JOIN t_mainchat ON t_mainchat.id_mainchat = t_replychat.id_main INNER JOIN t_user ON t_user.id_user = t_replychat.id_user ORDER BY reply_datetime ASC";
        $result = mysqli_query($conn, $query);
    
        return $result;
	}

    function adminMainChat()
	{
        global $conn;
        $query = "SELECT t_mainchat.*, t_user.username from t_mainchat INNER JOIN t_user ON t_user.id_user = t_mainchat.id_user ORDER BY main_datetime ASC";
        $result = mysqli_query($conn, $query);
    
        return $result;
	}

    function adminCountUser(){
        global $conn;

        $query = "SELECT COUNT(id_user) as countUser FROM t_user";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countUser'];
        
        return $result;
    }

    function adminCountMain(){
        global $conn;

        $query = "SELECT COUNT(id_mainchat) as countMain FROM t_mainchat";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countMain'];
        
        return $result;
    }

    function adminCountReply(){
        global $conn;

        $query = "SELECT COUNT(id_replychat) as countReply FROM t_replychat";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countReply'];
        
        return $result;
    }
    
    function getBio($id_user) {
        global $conn;
        
        $query = "SELECT bio FROM t_user WHERE id_user = $id_user";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['bio'];
        } else {
            return false;
        }
    }

    function insertBio($id_user, $bio) {
        global $conn;
        
    
        $query = "SELECT * FROM t_user WHERE id_user = '$id_user'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0) {
            
            $query = "UPDATE t_user SET bio = '$bio' WHERE id_user = '$id_user'";
        } else {
            
            $query = "INSERT INTO t_user (id_user, bio) VALUES ('$id_user', '$bio')";
        }
        
        $result = mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
    }
    
    function updateBio($id_user, $bio_status) {
        global $conn;
        
        $query = "UPDATE t_user SET bio = '$bio_status' WHERE id_user = '$id_user'";
        $result = mysqli_query($conn, $query);
        
        $isSucceed = mysqli_affected_rows($conn);
        return $isSucceed;
    }

    function updateGender($id_user, $gender) {
        global $conn;
        
        $query = "UPDATE t_user SET id_gender = '$gender' WHERE id_user = '$id_user'";
        $result = mysqli_query($conn, $query);
        
        $isSucceed = mysqli_affected_rows($conn);
        return $isSucceed;
    }

    function updateAccountPrivacy($id_user, $privacy) {
        global $conn;
        
        $query = "UPDATE t_user SET id_postprivacy = '$privacy' WHERE id_user = '$id_user'";
        $result = mysqli_query($conn, $query);
        
        $isSucceed = mysqli_affected_rows($conn);
        return $isSucceed;
    }

    function follow($user1, $user2){
        global $conn;

        $query = "INSERT INTO t_follow VALUES (NULL, $user1, $user2)";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);
        return $isSucceed;
    }

    function followCheck($follower, $followed){
        global $conn;

        $query = "SELECT * FROM t_follow WHERE id_follower = $follower AND id_followed = $followed";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        if(isset($result['id_follow'])){
            return 1;
        }else{
            return 0;
        }
    }

    function followAccCheck($follower, $followed){
        global $conn;

        $query = "SELECT * FROM t_follow WHERE id_follower = $follower AND id_followed = $followed AND status = 1";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        if(isset($result['id_follow'])){
            return 1;
        }else{
            return 0;
        }
    }

    function readFollow($user1, $user2){
        global $conn;

        $query = "SELECT * FROM t_follow WHERE id_follower = $user1 AND id_followed = $user2";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        return $result;
    }

    function readAllFollowing($follower){
        global $conn;

        $query = "SELECT * FROM t_follow WHERE id_follower = '$follower' AND status = 1";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    function readAllFollowers($followed){
        global $conn;

        $query = "SELECT * FROM t_follow WHERE id_followed = '$followed' AND status = 1";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    function checkIdFollow($user1, $user2, $type){
        global $conn;

        $query = "SELECT * FROM t_follow WHERE id_follower = $user1 AND id_followed = $user2";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        if($type == 1){   
            if($user1 == $result['id_follower']){
                return 1;
            }
        }else{
            if($user2 == $result['id_followed']){
                return 1;
            }
        }
        return 0;
    }

    function deleteFollow($follower, $following){
        global $conn;

        $query = "DELETE FROM t_follow WHERE id_follower = $follower AND id_followed = $following";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);

        return $isSucceed;
    }
    
    function countFollowing($id){
        global $conn;

        $query = "SELECT COUNT(id_follow) as countFollow FROM t_follow WHERE id_follower = $id AND status = 1";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countFollow'];
        
        return $result;
    }
    
    function countFollowers($id){
        global $conn;

        $query = "SELECT COUNT(id_follow) as countFollow FROM t_follow WHERE id_followed = $id AND status = 1";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countFollow'];
        
        return $result;
    }
    
    function countFollowersAcc($id){
        global $conn;

        $query = "SELECT COUNT(id_follow) as countFollow FROM t_follow WHERE id_followed = $id AND status = 0";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $result = $row['countFollow'];
        
        return $result;
    }

    function readFollowersAcc($followed){
        global $conn;

        $query = "SELECT * FROM t_follow WHERE id_followed = $followed AND status = 0";
        $result = mysqli_query($conn, $query);

        return $result;
    }

    function accFollow($follower, $followed){
        global $conn;

        $query = "UPDATE t_follow SET status = 1 WHERE id_follower = $follower AND id_followed = $followed AND status = 0";
        $result = mysqli_query($conn, $query);

        $isSucceed = mysqli_affected_rows($conn);

        return $isSucceed;
    }

    function checkAccIdFollow($user1, $user2, $type){
        global $conn;

        $query = "SELECT * FROM t_follow WHERE id_follower = $user1 AND id_followed = $user2";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

        if($user2 == $result['id_followed']){
            return 1;
        }
        return 0;
    }
?>