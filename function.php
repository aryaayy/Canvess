<?php
    // include('config.php');
    require_once 'config.php';
    use Config\Database;

    function getIdUserByUsername($username){
        $db = new Database();
        $db->connect();

        $query = "SELECT id_user FROM t_user WHERE username = '$username'";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $id = $result['id_user'];
        
        $db->close();
        return $id;
    }

    function readUserProfile($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_user WHERE id_user = $id";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));

        $db->close();
        return $result;
    }
    
    function readMainChat(){
        $db = new Database();
        $db->connect();
        
        $query = "SELECT t_user.username as username, t_mainchat.* FROM t_mainchat INNER JOIN t_user ON t_mainchat.id_user = t_user.id_user ORDER BY main_datetime DESC";
        $result = mysqli_query($db->get_conn(), $query);
        
        $db->close();
        return $result;
    }
    
    function readMainChatPost($id){
        $db = new Database();
        $db->connect();
        
        $query = "SELECT t_user.username as username, t_mainchat.* FROM t_mainchat INNER JOIN t_user ON t_mainchat.id_user = t_user.id_user WHERE t_mainchat.id_mainchat = $id";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));

        // echo $result['main_message'];
        
        $db->close();
        return $result;
    }
    
    function readMainChatProfile($id){
        $db = new Database();
        $db->connect();
        
        $query = "SELECT t_user.username as username, t_mainchat.* FROM t_mainchat INNER JOIN t_user ON t_mainchat.id_user = t_user.id_user WHERE t_user.id_user = $id ORDER BY main_datetime DESC";
        $result = mysqli_query($db->get_conn(), $query);
        
        $db->close();
        return $result;
    }
    
    function countMainChatProfile($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_mainchat) as countMain FROM t_mainchat WHERE id_user = $id";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countMain'];
        
        $db->close();
        return $result;
    }
    
    function countMainChatProfilePublic($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_mainchat) as countMain FROM t_mainchat WHERE id_user = $id AND isAnonymous = 0";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countMain'];
        
        $db->close();
        return $result;
    }

    function readLikedMainChat($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_likesmain WHERE id_user = $id";
        $result = mysqli_query($db->get_conn(), $query);
        
        $db->close();
        return $result;
    }

    function countLikedMainChat($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_mainchat) as countLiked FROM t_likesmain WHERE id_user = $id";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countLiked'];

        $db->close();
        return $result;
    }
    
    function readReplyChat(){
        $db = new Database();
        $db->connect();
        
        $query = "SELECT t_user.username as username, t_replychat.* FROM t_replychat INNER JOIN t_user ON t_mainchat.id_user = t_user.id_user ORDER BY reply_datetime DESC";
        $result = mysqli_query($db->get_conn(), $query);
        
        $db->close();
        return $result;
    }
    
    function readReplyChatPost($id){
        $db = new Database();
        $db->connect();
        
        $query = "SELECT t_user.username as username, t_replychat.* FROM t_replychat INNER JOIN t_user ON t_replychat.id_user = t_user.id_user WHERE t_replychat.id_main = $id ORDER BY reply_datetime ASC";
        $result = mysqli_query($db->get_conn(), $query);
        
        $db->close();
        return $result;
    }
    
    function readReplyChatProfile($id){
        $db = new Database();
        $db->connect();
        
        $query = "SELECT t_user.username as username, t_replychat.* FROM t_replychat INNER JOIN t_user ON t_replychat.id_user = t_user.id_user WHERE t_user.id_user = $id ORDER BY reply_datetime DESC";
        $result = mysqli_query($db->get_conn(), $query);
        
        $db->close();
        return $result;
    }
    
    function countReplyChatProfile($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_replychat) as countReply FROM t_replychat WHERE id_user = $id";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countReply'];
        
        $db->close();
        return $result;
    }
    
    function countReplyChatProfilePublic($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_replychat) as countReply FROM t_replychat WHERE id_user = $id AND isAnonymous = 0";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countReply'];
        
        $db->close();
        return $result;
    }
    
    function countReplyChatPost($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_replychat) as countReply FROM t_replychat WHERE id_main = $id";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countReply'];
        
        $db->close();
        return $result;
    }

    function countMainChatLikes($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_likesmain) as countLikes FROM t_likesmain WHERE id_mainchat = $id";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countLikes'];
        
        $db->close();
        return $result;
    }

    function createPost(){
        $db = new Database();
        $db->connect();

        $id_user = $_POST['id_user'];
        $main_message = $_POST['main_message'];
        $isAnonymous = $_POST['isAnonymous'];

        $query = "INSERT INTO t_mainchat VALUES(NULL, '$main_message', NULL, '$isAnonymous', $id_user)";
        $result = mysqli_query($db->get_conn(), $query);

        $id_mainchat = 0;
        $isSucceed = mysqli_affected_rows($db->get_conn());
        if($isSucceed > 0){
            $query = "SELECT id_mainchat FROM t_mainchat WHERE id_user = $id_user";
            $result = mysqli_query($db->get_conn(), $query);
            while($temp_id = mysqli_fetch_assoc($result)){
                $id_mainchat = $temp_id['id_mainchat'];
            }
        }

        $db->close();
        return $id_mainchat;
    }
    
    function createReply(){
        $db = new Database();
        $db->connect();

        $id_user = $_POST['id_user'];
        $id_mainchat = $_POST['id_mainchat'];
        $reply_message = $_POST['reply_message'];
        $isAnonymous = $_POST['isAnonymous'];

        $query = "INSERT INTO t_replychat 
                  VALUES(NULL, '$reply_message', NULL, '$isAnonymous', $id_user, $id_mainchat)";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());

        $db->close();
        return $isSucceed;
    }

    function deleteAccount($id){
        $db = new Database();
        $db->connect();

        $query = "DELETE FROM t_user WHERE id_user = $id";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());

        $db->close();
        return $isSucceed;
    }

    function updateUsername($id){
        $db = new Database();
        $db->connect();

        $username = $_POST['username'];

        $query = "UPDATE t_user SET username = '$username' WHERE id_user = $id";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());
        $db->close();
        return $isSucceed;
    }

    function updatePost($id){
        $db = new Database();
        $db->connect();

        $main_message = $_POST['main_message'];
        $isAnonymous = $_POST['isAnonymous'];

        $query = "UPDATE t_mainchat SET main_message = '$main_message', isAnonymous = $isAnonymous WHERE id_mainchat = $id";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());
        $db->close();
        return $isSucceed;
    }

    function deletePost($id){
        $db = new Database();
        $db->connect();

        $query = "DELETE FROM t_mainchat WHERE id_mainchat = $id";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());

        $db->close();
        return $isSucceed;
    }

    function deleteReply($id){
        $db = new Database();
        $db->connect();

        $query = "DELETE FROM t_replychat WHERE id_replychat = $id";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());

        $db->close();
        return $isSucceed;
    }

    function checkLikesMain($id_user, $id_mainchat){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_likesmain WHERE id_user = $id_user AND id_mainchat = $id_mainchat";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));

        if(isset($result)){
            $isSucceed = 1;
        }else{
            $isSucceed = 0;
        }

        $db->close();
        return $isSucceed;
    }

    function adminUser()
	{
        $db = new Database();
        $db->connect();
        $query = "SELECT * from t_user";
        $result = mysqli_query($db->get_conn(), $query);
    
        $db->close();
        return $result;
	}

    function adminReply()
	{
        $db = new Database();
        $db->connect();
        $query = "SELECT t_replychat.*, t_mainchat.*, t_user.username from t_replychat INNER JOIN t_mainchat ON t_mainchat.id_mainchat = t_replychat.id_main INNER JOIN t_user ON t_user.id_user = t_replychat.id_user ORDER BY reply_datetime ASC";
        $result = mysqli_query($db->get_conn(), $query);
    
        $db->close();
        return $result;
	}

    function adminMainChat()
	{
        $db = new Database();
        $db->connect();
        $query = "SELECT t_mainchat.*, t_user.username from t_mainchat INNER JOIN t_user ON t_user.id_user = t_mainchat.id_user ORDER BY main_datetime ASC";
        $result = mysqli_query($db->get_conn(), $query);
    
        $db->close();
        return $result;
	}

    function adminCountUser(){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_user) as countUser FROM t_user";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countUser'];
        
        $db->close();
        return $result;
    }

    function adminCountMain(){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_mainchat) as countMain FROM t_mainchat";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countMain'];
        
        $db->close();
        return $result;
    }

    function adminCountReply(){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_replychat) as countReply FROM t_replychat";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countReply'];
        
        $db->close();
        return $result;
    }
    
    function getBio($id_user) {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT bio FROM t_user WHERE id_user = $id_user";
        $result = mysqli_query($db->get_conn(), $query);
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db->close();
            return $row['bio'];
        } else {
        $db->close();    
        return false;
        }
    }

    function insertBio($id_user, $bio) {
        $db = new Database();
        $db->connect();
        
    
        $query = "SELECT * FROM t_user WHERE id_user = '$id_user'";
        $result = mysqli_query($db->get_conn(), $query);
        
        if(mysqli_num_rows($result) > 0) {
            
            $query = "UPDATE t_user SET bio = '$bio' WHERE id_user = '$id_user'";
        } else {
            
            $query = "INSERT INTO t_user (id_user, bio) VALUES ('$id_user', '$bio')";
        }
        
        $result = mysqli_query($db->get_conn(), $query);
        
        $affected_rows = mysqli_affected_rows($db->get_conn());
        $db->close();
        return $affected_rows;
    }
    
    function updateBio($id_user, $bio_status) {
        $db = new Database();
        $db->connect();
        
        $query = "UPDATE t_user SET bio = '$bio_status' WHERE id_user = '$id_user'";
        $result = mysqli_query($db->get_conn(), $query);
        
        $isSucceed = mysqli_affected_rows($db->get_conn());
        $db->close();
        return $isSucceed;
    }

    function updateGender($id_user, $gender) {
        $db = new Database();
        $db->connect();
        
        $query = "UPDATE t_user SET id_gender = '$gender' WHERE id_user = '$id_user'";
        $result = mysqli_query($db->get_conn(), $query);
        
        $isSucceed = mysqli_affected_rows($db->get_conn());
        $db->close();
        return $isSucceed;
    }

    function updateAccountPrivacy($id_user, $privacy) {
        $db = new Database();
        $db->connect();
        
        $query = "UPDATE t_user SET id_postprivacy = '$privacy' WHERE id_user = '$id_user'";
        $result = mysqli_query($db->get_conn(), $query);
        
        $isSucceed = mysqli_affected_rows($db->get_conn());
        $db->close();
        return $isSucceed;
    }

    function follow($user1, $user2){
        $db = new Database();
        $db->connect();

        $query = "INSERT INTO t_follow VALUES (NULL, $user1, $user2)";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());
        $db->close();
        return $isSucceed;
    }

    function followCheck($follower, $followed){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_follow WHERE id_follower = $follower AND id_followed = $followed";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));

        if(isset($result['id_follow'])){
            $db->close();    
            return 1;
        }else{
            $db->close();    
            return 0;
        }
    }

    function followAccCheck($follower, $followed){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_follow WHERE id_follower = $follower AND id_followed = $followed AND status = 1";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));

        if(isset($result['id_follow'])){
            $db->close();    
            return 1;
        }else{
            $db->close();    
            return 0;
        }
    }

    function readFollow($user1, $user2){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_follow WHERE id_follower = $user1 AND id_followed = $user2";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));

        $db->close();
        return $result;
    }

    function readAllFollowing($follower){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_follow WHERE id_follower = '$follower' AND status = 1";
        $result = mysqli_query($db->get_conn(), $query);

        $db->close();
        return $result;
    }

    function readAllFollowers($followed){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_follow WHERE id_followed = '$followed' AND status = 1";
        $result = mysqli_query($db->get_conn(), $query);

        $db->close();
        return $result;
    }

    function checkIdFollow($user1, $user2, $type){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_follow WHERE id_follower = $user1 AND id_followed = $user2";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));

        if($type == 1){   
            if($user1 == $result['id_follower']){
            $db->close();    
            return 1;
            }
        }else{
            if($user2 == $result['id_followed']){
            $db->close();    
            return 1;
            }
        }
        $db->close();
        return 0;
    }

    function deleteFollow($follower, $following){
        $db = new Database();
        $db->connect();

        $query = "DELETE FROM t_follow WHERE id_follower = $follower AND id_followed = $following";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());

        $db->close();
        return $isSucceed;
    }
    
    function countFollowing($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_follow) as countFollow FROM t_follow WHERE id_follower = $id AND status = 1";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countFollow'];
        
        $db->close();
        return $result;
    }
    
    function countFollowers($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_follow) as countFollow FROM t_follow WHERE id_followed = $id AND status = 1";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countFollow'];
        
        $db->close();
        return $result;
    }
    
    function countFollowersAcc($id){
        $db = new Database();
        $db->connect();

        $query = "SELECT COUNT(id_follow) as countFollow FROM t_follow WHERE id_followed = $id AND status = 0";
        $row = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));
        $result = $row['countFollow'];
        
        $db->close();
        return $result;
    }

    function readFollowersAcc($followed){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_follow WHERE id_followed = $followed AND status = 0";
        $result = mysqli_query($db->get_conn(), $query);

        $db->close();
        return $result;
    }

    function accFollow($follower, $followed){
        $db = new Database();
        $db->connect();

        $query = "UPDATE t_follow SET status = 1 WHERE id_follower = $follower AND id_followed = $followed AND status = 0";
        $result = mysqli_query($db->get_conn(), $query);

        $isSucceed = mysqli_affected_rows($db->get_conn());

        $db->close();
        return $isSucceed;
    }

    function checkAccIdFollow($user1, $user2, $type){
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM t_follow WHERE id_follower = $user1 AND id_followed = $user2";
        $result = mysqli_fetch_assoc(mysqli_query($db->get_conn(), $query));

        if($user2 == $result['id_followed']){
            $db->close();    
            return 1;
        }
        $db->close();
        return 0;
    }
?>