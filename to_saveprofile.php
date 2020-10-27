<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		require_once 'user.php';

		if(ONLINE){

			if(isset($_POST['full_name'])){

				require_once 'db.php';

				updateUser($_SESSION['CURRENT_USER']['id'], $_POST['full_name']);

				$_SESSION['CURRENT_USER']['full_name'] = $_POST['full_name'];
				$location = "profile.php?success=1";
				
			}

		}

	}

	header("Location:$location");

?>