<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		require_once 'db.php';
		require_once 'user.php';

		$likeCnt = 0;
		$liked = 0;

		if(ONLINE){

			if(isset($_POST['film_id'])){

				$filmLikes = countFilmUserLike($_POST['film_id'], $_SESSION['CURRENT_USER']['id']);

				if($filmLikes==0){

					addFilmLikes($_POST['film_id'], $_SESSION['CURRENT_USER']['id']);
					$likeCnt = countLikes($_POST['film_id']);
					saveFilmLikes($_POST['film_id'], $likeCnt);
					$liked = 1;
				
				}else{

					removeFilmLikes($_POST['film_id'], $_SESSION['CURRENT_USER']['id']);
					$likeCnt = countLikes($_POST['film_id']);
					saveFilmLikes($_POST['film_id'], $likeCnt);

				}
				
			}

		}

		echo "{\"liked\": $liked, \"likes\": $likeCnt}";

	}

?>