<?php
    session_start();
    include('function.php');

    $id_mainchat = $_GET['id_mainchat'];
    $getIdPost = readMainChatPost($id_mainchat);
    if($_SESSION['session_id_user'] == $getIdPost['id_user']){
        $isSucceed = deletePost($id_mainchat);
        if($isSucceed > 0){
            $type = $_GET['type'];
            if($type == 1){
                header('Location: index.php');
            }elseif($type == 2){
                header('Location: profile.php');
            }
        }else{
            echo "<script>
            Error occured
            </script>";
        }
    }else{
        echo "<script>
        alert('You do not have the permission');
        document.location.href = 'likedposts.php';
        </script>";
    }
?>