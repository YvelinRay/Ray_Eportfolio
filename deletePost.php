<?php
    include "function.php";	
    $idPost = $_GET['id'];
    deletePost($idPost);
    deleteMedia($idPost);		

    EDatabase::startTransaction();
        try {
            unlink(UPLOAD_PATH .$imgName);
            EDatabase::commit();
        } catch (Exception $e) {
            EDatabase::rollback();
            echo "Rollback";
        }
    header("Location: index.php");
?>