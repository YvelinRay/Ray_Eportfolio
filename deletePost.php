<?php
    include "function.php";	
    $idPost = $_GET['id'];
    deletePost($idPost);
    deleteMedia($idPost);		
    
    $db = connectDB();
    $db->startTransaction();;
        try {
            unlink(UPLOAD_PATH .$imgName);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
            echo "Rollback";
        }
    header("Location: index.php");
?>