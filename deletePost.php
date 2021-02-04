<?php
    include "function.php";	
    $idPost = $_GET['id'];
    deletePost($idPost);
    header("Location: index.php");
?>