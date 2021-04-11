<?php
include 'database.php';
include 'const.php';
function addPost($commentaire)
{
    try {
        $latsInsertId = -1;
        $sql = "INSERT INTO post(commentaire) VALUES(:commentaire);";
        $request = EDatabase::prepare($sql);
        $request->execute(array('commentaire' => $commentaire));
        $latsInsertId = Edatabase::getInstance()->lastInsertId();
        return $latsInsertId;
    } catch (Exception $e) {        
    }
}

function getAllPosts()
{
    $sql = "SELECT * FROM post ORDER BY idPost DESC";
    $request = EDatabase::prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function getAllMedias()
{
    $sql = "SELECT * FROM media ORDER BY idPost DESC ";
    $request = EDatabase::prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}


function addMedia($imgName, $imgType, $idPost){
    try {
        $sql = "INSERT INTO media(typeMedia, nomMedia, idPost) VALUES(:imgType, :imgName, :idPost);";

        $request = EDatabase::prepare($sql);
        $request->execute(array('imgName' => $imgName, 'imgType' => $imgType, 'idPost' => $idPost));
    } catch (Exception $e) {
    }
}

function deletePost($idPost){
    try {
        $sql = "DELETE FROM post WHERE idPost = $idPost";

        $request = EDatabase::prepare($sql);
        $request->execute();
        
    } catch (Exception $e) {
    }
    
}
function deleteMedia($idPost){
    try {
    $sql = "DELETE FROM media WHERE idPost = $idPost";

    $request = EDatabase::prepare($sql);
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
    $sql = "UPDATE post SET commentaire = :commentaires, modificationDate = :dateModifiee WHERE idPost = :idPosts";

    $request = EDatabase::prepare($sql);
    $request->execute(array('commentaires' => $comment, 'dateModifiee' => $date, 'idPosts' => $idPost));
} catch (Exception $e) {
}
}