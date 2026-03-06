<?php
    include('function.php');

    global $conn;

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
    $result = mysqli_query($conn, $query);
    $isSucceed = mysqli_affected_rows($conn);
    if ($isSucceed > 0) {
        echo json_encode(array("statusCode"=>200));
    } 
    else {
        echo json_encode(array("statusCode"=>201));
    }
?>