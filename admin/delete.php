<?php
    include("../function.php");


    $id = $_GET['id_reply'];
    if ($id > 0) {
        $isDeleteSucceed = deleteReply($id);  
        if ($isDeleteSucceed > 0) {
        echo "
        <script>
        alert('Delete Success !');
        </script>
        ";
        if($_GET['type'] == 2){
            $id_mainchat = $_GET['id_mainchat'];
            header("Location: post.php?id_mainchat=$id_mainchat");
        }else{
            header("Location: admin.php");
        }
        } else {
        echo "
        <script>
        alert('Delete Failed !');
        document.location.href = 'admin.php';
        </script>
        ";
    }
    }

    $id = $_GET['id_user'];
    if ($id > 0) {
        $isDeleteSucceed = deleteAccount($id);  
        if ($isDeleteSucceed > 0) {
        echo "
        <script>
        alert('Delete Success !');
        document.location.href = 'admin.php';
        </script>
        ";
        } else {
        echo "
        <script>
        alert('Delete Failed !');
        document.location.href = 'admin.php';
        </script>
        ";
    }
    }

    $id = $_GET['id_main'];
    if ($id > 0) {
        $isDeleteSucceed = deletePost($id);  
        if ($isDeleteSucceed > 0) {
            echo "
            <script>
            alert('Delete Success !');
            </script>
            ";
            if($_GET['type'] == 2){
                header("Location: indexAdmin.php");
            }else{
                header("Location: admin.php");
            }
        } else {
        echo "
        <script>
        alert('Delete Failed !');
        document.location.href = 'admin.php';
        </script>
        ";
    }
    }
?>