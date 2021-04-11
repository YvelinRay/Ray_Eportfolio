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
        $latsInsertId = EDatabase::getInstance()->lastInsertId();
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
function getAllMediasOfPost($idPost)
{
    $sql = "SELECT nomMedia FROM media WHERE idPost = $idPost";
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

function getMediaName($idMedia){
try{
    $sql = "SELECT nomMedia FROM media WHERE idMedia = $idMedia";
    $request = EDatabase::prepare($sql);
    $request->execute();
    return $request->fetch(PDO::FETCH_ASSOC);

}
catch(Exception $e){
    return false;
}
}

function deleteMedia($idPost, $idMedia = null){
    $mediaName = null;
    if($idMedia != null){
        $mediaName = getMediaName($idMedia);
        $sql = "DELETE FROM media WHERE idPost = $idPost AND idMedia = $idMedia";
    }
    else{
        $sql = "DELETE FROM media WHERE idPost = $idPost";
    }
    try {

    $request = EDatabase::prepare($sql);
    if($request->execute()){
    
    if(count($mediaName) > 1){
       for($i = 0; $i< count($mediaName); $i++)
       {
           if(unlink($mediaName[$i]));
           {
                return true;
           }
           else{
               return false;
           }
       }
    }
    else{
        if(unlink($mediaName)){
            return true;
        }
        else{
            return false;
        }
    }}
    else{
        return false;
    }

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


function InfoImg($files){
    try{
        if ($total  > 0 || $commentaire != "") {

			$idPost = addPost($commentaire);
            $allfilessize = 0;
			for ($i = 0; $i < $total; $i++) {
                $allfilessize += $files['img']['size'][$i];
				$imgName = $files['img']['name'][$i];
				//Vérifie si le fichier dépasse les 3M
				if ($files['img']['size'][$i] <= FILESIZE_MAX && $allfilessize <= ALL_FILESIZE_MAX) {

					$imgName =  time() . "_" . $files['img']['name'][$i];
	
					$imgTmpName = $files['img']['tmp_name'][$i];
					$imgType = $files['img']['type'][$i];
							
					
					//$error .= $imgType;
					$stringImgType = substr($imgType, 0, strpos($imgType, "/") );
					if($stringImgType == "image" || $stringImgType == "video" || $stringImgType == "audio"){
						//Vérifie l'importation
						$error = $imgTmpName;
						if (move_uploaded_file($imgTmpName, $uploadDir . $imgName)) {
							addMedia($uploadDir.$imgName, $imgType, $idPost);
					//		EDatabase::commit();
                            return true;

						}
						else{
							//$error .= $imgType . " n'est pas bon. ";
                            return false;
                        }
					}	
					else{
						//EDatabase::rollBack();
						//$error .= $imgType . " n'est pas du bon type. ";
                        return false;
					
                    }
				} else {
					//EDatabase::rollBack();
					//$error .=  $imgName . " est trop grand \r\n";
                    return false;
				}
			}
		}
    }
    catch(Exception $e){

    }
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