<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		require_once 'user.php';

		if(ONLINE){

			$location = "editfilm.php?error=1";

			if(isset($_POST['id'])){

				require_once 'db.php';

				deleteFilm($_POST['id']);

				$location = "index.php";

			}

		}

	}

	header("Location:$location");

?>