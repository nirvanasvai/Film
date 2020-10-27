<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		require_once 'user.php';

		if(ONLINE){

			if(isset($_POST['film_id'])&&isset($_POST['comment'])){

				require_once 'db.php';

				$film = getFilm($_POST['film_id']);

				if($film!=null){

					$location = "readfilm.php?id=".$film["id"]."#commentDiv";

					addComment($_POST['film_id'], $_SESSION['CURRENT_USER']['id'], $_POST['comment']);

				}

			}

		}

	}

	header("Location:$location");

?>