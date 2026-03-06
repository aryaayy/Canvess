<?php
    session_start();
    include('function.php');

    $id_followed = $_SESSION['session_id_user'];
    $id_follower = $_GET['id_follower'];
    $valid = checkAccIdFollow($id_follower, $id_followed, 2);
    if($valid){
        $isSucceed = accFollow($id_follower, $id_followed);
        if($isSucceed > 0){
            header('Location: followersList.php');
        }
        else{
            echo "<script>
            Error occured
            </script>";
        }
    }else{
        echo "<script>
        alert('You do not have the permission');
        document.location.href = 'followingList.php';
        </script>";
    }
?>