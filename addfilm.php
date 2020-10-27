<?php
	require_once 'user.php';

	if(ONLINE){

	require_once 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once 'head.php'; ?>
	<title>Films KZ | Add Film</title>
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
					<form action="to_add_film.php" method="post">
						<div class="form-group">
							<label>NAME: </label>
							<input type="text" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>DESCRIPTION: </label>
							<textarea class="form-control" name="description"></textarea>
						</div>
						<div class="form-group">
							<label>GENRE: </label>
							<select name="genre_id" class="form-control">
								<?php 
									$genres = getAllGenres();
									if($genres!=null){
										foreach($genres as $genre){
								?>
									<option value="<?php echo $genre['id']; ?>">
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
							<input type="text" name="rating" class="form-control">
						</div>
						<div class="form-group">
							<label>YEAR: </label>
							<input type="number" name="year" class="form-control" max="2021" min="1900">
						</div>
						<div class="form-group">
							<button class="btn btn-success float-right">ADD FILM</button>
						</div>
					</form>
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