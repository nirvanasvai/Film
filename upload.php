<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		require_once 'user.php';

		if(ONLINE){

			$location = "profile.php?ava_error";

			if(isset($_FILES['avatar'])){

				if($_FILES['avatar']['size']<=2097152){

					if($_FILES['avatar']['type']==='image/jpeg' || $_FILES['avatar']['type']==='image/png'){

						require_once 'db.php';

						$target = "avatars/".sha1($_SESSION['CURRENT_USER']['id']."_pic_ava").".jpg";

						move_uploaded_file($_FILES['avatar']['tmp_name'], $target);
						updateAva($_SESSION['CURRENT_USER']['id'], $target);
						$_SESSION['CURRENT_USER']['avatar'] = $target;
						$location = "profile.php?ava_success";

					}

				}

			}

		}

	}

	header("Location:$location");

?>