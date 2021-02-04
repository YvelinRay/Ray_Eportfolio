<?php
	include 'function.php';
	$error = "";
	$commentaire = "";
	$btnSubmit = filter_input(INPUT_POST, "valider", FILTER_SANITIZE_STRING);
	$uploadDir = "rsc/";
	if ($btnSubmit) {
		//Donne le nombre d'images
		$total = count(array_filter($_FILES['img']['name']));
	
		//Récupère le commentaire et la date
		$commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
	
		if (!isset($error)) {
			$error = "";
		}
	
		$db = connectDB();
	
	
		//Vérifie qu'il y ait au moins un fichier à importer
		if ($total  > 0 || $commentaire != "") {
			$idPost = addPost($commentaire);
			for ($i = 0; $i < $total; $i++) {
	
				$imgName = $_FILES['img']['name'][$i];
				//Vérifie si le fichier dépasse les 3M
				if ($_FILES['img']['size'][$i] <= 9145728) {
					$imgName =  time() . "_" . $_FILES['img']['name'][$i];
	
					$imgTmpName = $_FILES['img']['tmp_name'][$i];
					$imgType = $_FILES['img']['type'][$i];
							
					
					//$error .= $imgType;
					$stringImgType = substr($imgType, 0, strpos($imgType, "/") );
					if($stringImgType == "image" || $stringImgType == "video" || $stringImgType == "audio"){
						//Vérifie l'importation
						if (move_uploaded_file($imgTmpName, $uploadDir . $imgName)) {
						$error = "salit";
							
							addMedia($uploadDir.$imgName, $imgType, $idPost);
							header("Location: index.php");
							exit();
						}
					}	
					else{
						$error .= $imgType . " n'est pas du bon type. ";
					}
				} else {
					$error .=  $imgName . " est trop grand	. (3Mo) \r\n";
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Facebook Theme  Demo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="assets/css/facebook.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
			<div class="box">
					<!-- /sidebar -->
					<!-- main right col -->
				<div class="column col-sm-12 col-xs-12" id="main">
						<!-- top nav -->
						<div class="navbar navbar-blue navbar-static-top">  
							<div class="navbar-header">
							  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">CFPT</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							  </button>
							  <a href="index.php" class="navbar-brand logo">b</a>
							</div>
							<nav class="collapse navbar-collapse" role="navigation">
							<form class="navbar-form navbar-left">
								<div class="input-group input-group-sm" style="max-width:360px;">
								  <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
								  <div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								  </div>
								</div>
							</form>
							<ul class="nav navbar-nav">
							  <li>
								<a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
							  </li>
							  <li>
								<a href="post.php" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
							  </li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
							  <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
								<ul class="dropdown-menu">
								  <li><a href="">Profil</a></li>
								</ul>
							  </li>
							</ul>

							</nav>
						</div>
						<!-- /top nav -->
                        <div class="padding">
							<div class="full col-sm-9">
								<!-- content -->                      
								<div class="row">
								 <!-- main col left --> 
								 <div class="col-sm-5">
									  <div class="well"> 
										   <form action="post.php" method="POST" enctype="multipart/form-data">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4>Ajouter un post <?= $error ?></h4>
												</div>
												<div class="panel-body">
													<a href="#">Commentaire</a>
													<input type="text" class="form-control" value="<?= $commentaire ?>" name="commentaire" placeholder="Ajout de commentaire" />
													<div class="clearfix"></div>
													<hr>
													Choisissez une image !<input type="file" name="img[]" multiple accept="image/*,video/*, audio/*" />
													<hr>
													<input type="submit" value="Post" name="valider" class='"btn btn-primary btn-sm"' />
											
										</form>

									  </div>
								  </div>
							   </div><!--/row-->
							</div><!-- /col-9 -->
						</div><!-- /padding -->
                    </div>
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
			$('[data-toggle=offcanvas]').click(function() {
				$(this).toggleClass('visible-xs text-center');
				$('.row-offcanvas').toggleClass('active');
				$('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
				$('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
				$('#btnShow').toggle();
			});
        });
        </script>
</body></html>		