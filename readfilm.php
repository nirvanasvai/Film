<?php
	
	require_once 'user.php';
	require_once 'db.php';

	if(isset($_GET['id'])&&is_numeric($_GET['id'])){

		$film = getFilm($_GET['id']);

?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once 'head.php'; ?>
	<link rel="stylesheet" type="text/css" href="fontawesome-free-5.14.0-web/css/all.min.css">
	<title>Films KZ | <?php if($film!=null){ echo $film['name']; } else { echo "Not Found"; } ?></title>
	<style type="text/css">
		iframe{
			max-width: 100%;
		}
		img{
			max-width: 100%;
		}
	</style>
</head>
<body>

	<?php
		require_once 'navbar.php';
	?>

		<div class="container pb-5 mb-5">
			
			<div class="row mt-5">
				
				<div class="col-sm-12">
					
					<?php 

						if($film!=null){

					?>

						<div class="jumbotron">
						  <h2>
						  	<?php
						  		echo $film['name'];
						  	?>
						  </h2>
						  <p class="lead">
						  	<?php
						  		echo $film['description'];
						  	?>
						  </p>
						  <hr class="my-4">
						  <p>Genre : <?php echo $film['genre_name']; ?></p>
						  <p>Year : <?php echo $film['year']; ?></p>
						  <p>Rating : <?php echo $film['rating']; ?></p>
						  <table>
						  	<tr>
						  		<td>
						  			<?php
						  				$likesFromMe = countFilmUserLike($film['id'], $_SESSION['CURRENT_USER']['id']);
						  				$color = "black";
						  				if($likesFromMe>0){
						  					$color = "red";
						  				}
						  			?>
						  			<a href = "javascript:void(0)" id = "likeBtn" style="text-decoration: none; color: <?php echo $color; ?>; font-size: 24px;" onclick="toLike(<?php echo $film['id'];?>)">&#9829;</a>
						  		</td>
						  		<td>
						  			<span style="margin-left: 5px;" id = "likeCount"><?php echo $film['likes']; ?></span>
						  			likes 
						  		</td>
						  	</tr>
						  </table>
						  	<?php
								if(ONLINE){
							?>
								<script type="text/javascript">
									
									function toLike(id){
										
										$.post("ajax_like.php", 
										{
											
											film_id : id

										},function(result){
											arr = JSON.parse(result);
											$("#likeCount").html(arr['likes']);

											if(arr['liked']=="0"){
												$("#likeBtn").css("color", "black");
											}else{
												$("#likeBtn").css("color", "red");
											}
										});

									}

								</script>
							<?php
								}
							?>							
						    <div class="mt-3">
							  <?php
							  	if(ONLINE){
							  ?>
							  <a class="btn btn-success btn-sm" href="editfilm.php?id=<?php echo $film['id']; ?>" role="button">Edit</a>
							  <?php
							  	}
							  ?>
							</div>
						</div>
						<div class="row mt-5" id = "commentDiv">
							<div class="col-sm-6">
								<?php
									if(ONLINE){
								?>
									<form action="to_add_comment.php" method="post">
										<input type="hidden" name="film_id" value="<?php echo $film['id']; ?>">
										<textarea class="form-control" placeholder="Insert comment" name="comment"></textarea>
										<button class="btn btn-success float-right mt-3">ADD COMMENT</button>
									</form>
								<?php
									}else{
								?>
									<h4><a href = "login.php">Authorize</a> to add comment</h4>
								<?php
									}
								?>
							</div>
						</div>
						<div class="row mt-5">
							<div class="col-sm-6">
								<?php
									$comments = getComments($film['id']);
									if($comments!=null){
										foreach($comments AS $comm){
								?>
								<ul class="list-unstyled">
								  <li class="media">
								  	<?php
										$pic = "avatars/default_user.png";
										if($comm['avatar']!=null&&$comm['avatar']!=""){
											if(file_exists($comm['avatar'])){
												$pic = $comm['avatar'];
											}
										}
									?>
								    <img src="<?php echo $pic; ?>" class="mr-3" style="width: 50px;">
								    <div class="media-body">
								      <?php
								      	if($comm['user_id']===$_SESSION['CURRENT_USER']['id']){
								      ?>
								      <button class="btn btn-danger btn-sm float-right" onclick="toDeleteComment(<?php echo $comm['id'];?>)">
								      	<i class="fas fa-trash-alt"></i>
								      </button>
								      <?php
								      	}
								      ?>
								      <h5 class="mt-0 mb-1">
								      	<?php echo $comm['full_name']; ?>
								      </h5>
								      <p style="font-size: 12px;"><?php echo $comm['post_date']; ?></p>
								      <?php echo $comm['comment']; ?>
								    </div>
								  </li>
								</ul>
								<?php
										}
									}
								?>
								<form action="to_deletecomment.php" method="post" id = "delete_comment_form_id">
									<input type="hidden" name="comment_id" id = "comment_id">
									<input type="hidden" name="film_id" value="<?php echo $film['id']; ?>">
								</form>
								<script type="text/javascript">
									
									function toDeleteComment(id) {
										
										ok = confirm("Are you sure to delete comment?");

										if(ok){

											document.getElementById('comment_id').value = id;
											document.getElementById('delete_comment_form_id').submit();

										}

									}

								</script>
							</div>
						</div>

					<?php 

						}else{

					?>
						<h1 class="text-center">Film not found</h1>
					<?php

						}

					?>

				</div>

			</div>

		</div>

	<?php
		require_once 'footer.php';
	?>	

</body>
</html>
<?php
	}else{
		header("Location:index.php");
	}
?>