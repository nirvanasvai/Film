<?php
	require_once 'user.php';
	require_once 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once 'head.php'; ?>
	<title>Films KZ | Movies</title>
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

		<div class="container">
			
			<div class="row mt-5">
				
				<div class="col-sm-12">
					
					<?php 

						$films = getAllFilms();

						if($films!=null){

							foreach ($films as $film) {

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
						  <a class="btn btn-primary btn-sm" href="readfilm.php?id=<?php echo $film['id']; ?>">Read more</a>
						</div>

					<?php 

							}
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