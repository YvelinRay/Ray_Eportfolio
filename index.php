<?php
/*
Auteur : Yvelin A. Ray
Date : 04.02.2021
Version 1.0.5
	
*/

//require_once 'function.php';
include "function.php";	
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>CFPT-BOOK</title>
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
	
					  
					</div>
					<!-- /sidebar -->
				  
					<!-- main right col -->
					<div class="column col-sm-12 col-xs-12" id="main">
						
						<!-- top nav -->
						<div class="navbar navbar-blue navbar-static-top">  
							<div class="navbar-header">
							  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle</span>
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
                              <a href="post.php"><i class="glyphicon glyphicon-plus"></i> Post</a>
							  </li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
							  <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
								<ul class="dropdown-menu">
								  <li><a href="">profil</a></li>
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
								 
									   <div class="panel panel-default">
										<div class="panel-thumbnail"><img src="assets/img/bg_4.jpg" class="img-responsive"></div>
										<div class="panel-body">
										  <p class="lead">Bienvenue</p>
										</div>
									  </div>
									
								  </div>
							   
								  <div class="col-sm-5">	
									<?php
									$posts = getAllPosts();
									$media = getAllMedias();
									$total = count($posts);
									$totalMedias = count($media);


									for ($i = 0; $i < $total; $i++) {


										echo '<tr><td><div class="panel-body">
									<div class="clearfix"></div>';
										echo '<div class="panel-body">
									<div class="clearfix"></div>
									<hr>

									<p><b>';
										echo $posts[$i]["commentaire"];
										echo "</td><td><a href='deletePost.php?id=" . $posts[$i]["idPost"] . "'> <button class='btn btn-primary btn-sm'>Delete</button></a> 
										<a href='updatePost.php?id=" . $posts[$i]["idPost"] . "'> <button class='btn btn-primary btn-sm'>Update</button></a>";
										echo '</b></p></td></tr>';
										echo '<div class="panel-thumbnail">';
										for ($j = 0; $j < $totalMedias; $j++) {
											if ($posts[$i]["idPost"] == $media[$j]["idPost"]) {
												
											
												$typeFinal = explode("/", $media[$j]["typeMedia"]);

												echo "<tr><td>";
												
												if ($typeFinal[0] == "video") {
													echo '<div class="input-group">
														<div class="input-group-btn">'
														. '<video src="' . $media[$j]["nomMedia"] . '" controls loop autoplay width="350"></video>'  .
														'</div></td>';
												}
												if ($typeFinal[0] == "image") {
													echo '<div class="input-group">
														<div class="input-group-btn">'
														. '<img src="'. $media[$j]["nomMedia"] . '" width="350">'  .
														'</div></td>';
												}
												if ($typeFinal[0] == "audio") {
													echo '<div class="input-group">
														<div class="input-group-btn">'
														. '<audio src="'. $media[$j]["nomMedia"] . '" controls width="350"></audio>'  .
														'</div></td>';
												}

												echo "</tr>";
											}
											echo '</div>';
										}

										echo '</div>

								</div>';
									}

									?>
								</table>
							</div>
</div>
</div>
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
			$('[data-toggle=offcanvas]').click(function() {
				$(this).toggleClass('visible-xs text-center');
				$(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
				$('.row-offcanvas').toggleClass('active');
				$('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
				$('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
				$('#btnShow').toggle();
			});
        });
        </script>
</body></html>