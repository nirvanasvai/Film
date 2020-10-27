<?php
	
	session_start();

	if(isset($_SESSION['CURRENT_USER'])){

		define("ONLINE", true);

	}else{

		define("ONLINE", false);

	}

?>