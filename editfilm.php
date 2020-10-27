<?php
	require_once 'user.php';

	if(ONLINE){

	require_once 'db.php';

	if(isset($_GET['id'])&&is_numeric($_GET['id'])){

		$film = getFilm($_GET['id']);

?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once 'head.php'; ?>
	<link rel="stylesheet" type="text/css" href="fontawesome-free-5.14.0-web/css/all.min.css">
	<title>Films KZ | Edit <?php if($film!=null){ echo $film['name']; } else { echo "Not Found"; } ?></title>
	 <script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
  	 <script>
  	 	tinymce.init({
  	 		selector:'textarea',
			plugins: 'media'
  	 	});
  	 </script>
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
					<form action="to_save_film.php" method="post">
						<input type="hidden" name="id" value="<?php echo $film['id']; ?>">
						<div class="form-group">
							<label>NAME: </label>
							<input type="text" name="name" class="form-control" required value="<?php echo $film['name']; ?>">
						</div>
						<div class="form-group">
							<label>DESCRIPTION: </label>
							<textarea class="form-control" name="description"><?php echo $film['description']; ?></textarea>
						</div>
						<div class="form-group">
							<label>GENRE: </label>
							<select name="genre_id" class="form-control">
								<?php 
									$genres = getAllGenres();
									if($genres!=null){
										foreach($genres as $genre){
								?>
									<option value="<?php echo $genre['id']; ?>" <?php if($genre['id']==$film['genre_id']){ echo "selected"; }?> >
										<?php echo $genre['name']; ?>
									</option>
								<?php
										}
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>RATING: </label>
							<input type="text" name="rating" class="form-control" value="<?php echo $film['rating']; ?>">
						</div>
						<div class="form-group">
							<label>YEAR: </label>
							<input type="number" name="year" class="form-control" max="2021" min="1900" value="<?php echo $film['year']; ?>">
						</div>
						<div class="form-group">
							<button class="btn btn-success btn-sm float-left mr-2"><i class="fas fa-save"></i> SAVE FILM</button>
						</div>
					</form>
					<form action="deletefilm.php" method="post">
						<input type="hidden" name="id" value="<?php echo $film['id']; ?>">
						<button class="btn btn-danger btn-sm float-left"><i class="fas fa-trash-alt"></i> DELETE FILM</button>
					</form>
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
	
	}else{

		header("Location:index.php");

	}

?>