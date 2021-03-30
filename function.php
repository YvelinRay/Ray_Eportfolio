<?php
include 'database.php';
include 'const.php';
function addPost($commentaire)
{
    try {
        $id = -1;
        $db = connectDB();
        $sql = "INSERT INTO post(commentaire) VALUES(:commentaire);";

        $request = $db->prepare($sql);
        $request->execute(array('commentaire' => $commentaire));
        $id = $db->lastInsertId();
        return $id;
    } catch (Exception $e) {
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
        $sql = "INSERT INTO media(typeMedia, nomMedia, idPost) VALUES(:imgType, :imgName, :idPost);";

        $request = $db->prepare($sql);
        $request->execute(array('imgName' => $imgName, 'imgType' => $imgType, 'idPost' => $idPost));
    } catch (Exception $e) {
    }
}

function deletePost($idPost){
    try {
        $db = connectDB();
        $sql = "DELETE FROM post WHERE idPost = $idPost";

        $request = $db->prepare($sql);
        $request->execute();
        
    } catch (Exception $e) {
    }
    
}
function deleteMedia($idPost){
    try {
    $db = connectDB();
    $sql = "DELETE FROM media WHERE idPost = $idPost";

    $request = $db->prepare($sql);
    $request->execute();
} catch (Exception $e) {
}
}

function convertImage($source, $dst, $width, $height, $quality, $type){

	$imageSize = getimagesize($source);

	if($type == 'png'){

		$imageRessource = imagecreatefrompng($source);
	}else{
		$imageRessource = imagecreatefromjpeg($source);
	}

	$imageFinal = imagecreatetruecolor($width,$height);

	$final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);

	imagejpeg($imageFinal, $dst, $quality);
}

function UpdateComment(string $comment, int $idPost)
{
  $date = date("Y-m-d H:i:s");

  try {
    $db = connectDB();
    $sql = "UPDATE post SET commentaire = :commentaires, modificationDate = :dateModifiee WHERE idPost = :idPosts";

    $request = $db->prepare($sql);
    $request->execute(array('commentaires' => $comment, 'dateModifiee' => $date, 'idPosts' => $idPost));
} catch (Exception $e) {
}
}