<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		$location = "login.php?error=1";

		if(isset($_POST['email'])&&isset($_POST['password'])){

			require_once 'db.php';

			$checkUser = getUser($_POST['email']);

			if($checkUser!=null){

				if($checkUser['password']===sha1($_POST['password'])){

					session_start();
					$_SESSION['CURRENT_USER'] = $checkUser;
					$location = "index.php";

				}

			}

		}

	}

	header("Location:$location");

?>