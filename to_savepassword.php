<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		require_once 'user.php';

		if(ONLINE){

			print_r($_POST);

			if(isset($_POST['old_password']) && isset($_POST['password']) && isset($_POST['re_password'])){

				$location = "profile.php?error=2";

				if($_POST['password']===$_POST['re_password']){

					require_once 'db.php';

					$currentUser = getUser($_SESSION['CURRENT_USER']['email']);

					$location = "profile.php?error=3";

					if($currentUser['password']===sha1($_POST['old_password'])){

						$checkHist = getPasswordHistory($_SESSION['CURRENT_USER']['id'], sha1($_POST['password']));

						if($checkHist!=null&&$checkHist['id']!=null){

							$location = "profile.php?error=4";

						}else{

							updatePassword($_SESSION['CURRENT_USER']['id'], sha1($_POST['password']));
							addPasswordHistory($_SESSION['CURRENT_USER']['id'], sha1($_POST['password']));

							$_SESSION['CURRENT_USER']['password'] = sha1($_POST['password']);
							$location = "profile.php?success=2";
						
						}

					}

				}
				
			}

		}

	}

	header("Location:$location");

?>