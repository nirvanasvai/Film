<?php

	$location = "index.php";
	
	if($_SERVER['REQUEST_METHOD']==='POST'){

		$location = "register.php?error=1";

		if(isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['re_password'])&&isset($_POST['full_name'])){

			if($_POST['password']===$_POST['re_password']){

				require_once 'db.php';

				$checkUser = getUser($_POST['email']);

				if($checkUser==null){

					$id = addUser($_POST['email'], sha1($_POST['password']), $_POST['full_name']);
					addPasswordHistory($id, sha1($_POST['password']));
					$location = "register.php?success";

				}else{

					$location = "register.php?error=2";

				}

			}

		}

	}

	header("Location:$location");

?>