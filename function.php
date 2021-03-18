<?php
include 'database.php';
include 'const.php';
function addPost($commentaire)
{
    try {
        $id = -1;
        $db = connectDB();
        $db->beginTransaction();
        $sql = "INSERT INTO post(commentaire) VALUES(:commentaire);";

        $request = $db->prepare($sql);
        $request->execute(array('commentaire' => $commentaire));
        $id = $db->lastInsertId();
        $db->commit();
        return $id;
    } catch (Exception $e) {
        $db->rollBack();
    }
}

function getAllPosts()
{

    $db = connectDB();
    $sql = "SELECT * FROM post ORDER BY idPost DESC";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function getAllMedias()
{
    $db = connectDB();

    $sql = "SELECT * FROM media ORDER BY idPost DESC ";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function connectDB()
{
    static $bdd = null;

    if ($bdd === null) {
        $bdd = new PDO("mysql:host=" .DB_HOST. ";dbname=" . DB_NAME .";charset=utf8", DB_USER, DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $bdd;
}

function addMedia($imgName, $imgType, $idPost){
    try {
        $db = connectDB();
        $db->beginTransaction();
        $sql = "INSERT INTO media(typeMedia, nomMedia, idPost) VALUES(:imgType, :imgName, :idPost);";

        $request = $db->prepare($sql);
        $request->execute(array('imgName' => $imgName, 'imgType' => $imgType, 'idPost' => $idPost));
        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
    }
}

function deletePost($idPost){
    try {
        deleteMedia($idPost);
        $db = connectDB();
        $db->beginTransaction();
        $sql = "DELETE FROM post WHERE idPost = $idPost";

        $request = $db->prepare($sql);
        $request->execute();
        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
    }
    
}
function DeleteMedia($idPost){
    try {
    $db = connectDB();
    $db->beginTransaction(); 
    $sql = "DELETE FROM media WHERE idPost = $idPost";

    $request = $db->prepare($sql);
    if($request->execute()){
        if(unlink( UPLOAD_PATH .$imgName)){
            $db->commit();
        }
    }
} catch (Exception $e) {
    $db->rollBack();
}
}