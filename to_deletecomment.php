<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		require_once 'user.php';

		if(ONLINE){

			$location = "index.php";

			if(isset($_POST['comment_id'])&&isset($_POST['film_id'])){

				require_once 'db.php';

				deleteComment($_POST['comment_id'], $_SESSION['CURRENT_USER']['id'], $_POST['film_id']);

				$location = "readfilm.php?id=".$_POST['film_id']."#commentDiv";

			}

		}

	}

	header("Location:$location");

?>