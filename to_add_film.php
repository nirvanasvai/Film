<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		require_once 'user.php';

		if(ONLINE){

			$location = "addfilm.php?error=1";

			if(isset($_POST['name'])&&isset($_POST['description'])&&isset($_POST['rating'])&&isset($_POST['year'])&&isset($_POST['genre_id'])){

				require_once 'db.php';

				$genre = getGenre($_POST['genre_id']);
				if($genre!=null){

					addFilm($_POST['name'], $_POST['description'], $_POST['genre_id'], $_POST['rating'], $_POST['year']);

					$location = "addfilm.php?success=1";

				}

			}

		}

	}

	header("Location:$location");

?>