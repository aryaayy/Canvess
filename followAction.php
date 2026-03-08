<?php
    include('function.php');
    require_once 'config.php';

    use Config\Database;

    // global $conn;
    $db = new Database();
    $db->connect();

	$follower = $_POST['follower'];
	$followed = $_POST['followed'];
    $followExist = followCheck($follower, $followed);
    $user = readUserProfile($followed);
    
    if($followExist == 0){
        if($user['id_postprivacy'] == 0){
            $query = "INSERT INTO t_follow VALUES (NULL, $follower, $followed, 1)";
        }else{
            $query = "INSERT INTO t_follow VALUES (NULL, $follower, $followed, 0)";
        }
    }else{
        $query = "DELETE FROM t_follow WHERE id_follower = $follower AND id_followed = $followed";
    }
    $result = mysqli_query($db->get_conn(), $query);
    $isSucceed = mysqli_affected_rows($db->get_conn());
    if ($isSucceed > 0) {
        echo json_encode(array("statusCode"=>200));
    } 
    else {
        echo json_encode(array("statusCode"=>201));
    }

    $db->close();
?>