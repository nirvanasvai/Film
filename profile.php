<?php
	require_once 'user.php';

	if(ONLINE){

	require_once 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once 'head.php'; ?>
	<title>Films KZ | Movies</title>
	<style type="text/css">
		iframe{
			max-width: 100%;
		}
		img{
			max-width: 100%;
		}
	</style>
</head>
<body>

	<?php
		require_once 'navbar.php';
	?>
		<div class="container">
			<div>
					
			</div>
		</div>
		<div class="container">
			<div class="row mt-5">
				<div class="col-sm-5">
					<?php
						$pic = "avatars/default_user.png";
						if($_SESSION['CURRENT_USER']['avatar']!=null&&$_SESSION['CURRENT_USER']['avatar']!=""){
							if(file_exists($_SESSION['CURRENT_USER']['avatar'])){
								$pic = $_SESSION['CURRENT_USER']['avatar'];
							}
						}
					?>
					<img src="<?php echo $pic; ?>" class="img-thumbnail">
					<form action="upload.php" method="post" enctype="multipart/form-data">
						<div class="custom-file mt-4">
						  <input type="file" class="custom-file-input" name="avatar">
						  <label class="custom-file-label">Choose Avatar</label>
						</div>
						<button class="btn btn-primary float-right mt-2">UPLOAD</button>
					</form>
				</div>
				<div class="col-sm-6 offset-1">
					<?php
						if(isset($_GET['success'])){
							if($_GET['success']=='1'){
					?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  User updated successfully!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
							}else if($_GET['success']=='2'){
					?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  Password updated successfully!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
							}
						}
					?>

					<?php
						if(isset($_GET['error'])){
							if($_GET['error']=='1'){
					?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  Couldn't update user!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
							}else if($_GET['error']=='2'){
					?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  Passwords are not same!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
							}else if($_GET['error']=='3'){
					?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  Old password is not correct!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
							}else if($_GET['error']=='4'){
					?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  You have already used this password!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>			
					<?php
							}
						}
					?>
					<form action="to_saveprofile.php" method="post">
						<div class="form-group">
							<label>
								FULL NAME : 
							</label>
							<input type="text" name="full_name" class="form-control" required value="<?php echo $_SESSION['CURRENT_USER']['full_name'];?>">
						</div>
						<div class="form-group">
							<button class="btn btn-success">UPDATE PROFILE</button>
						</div>
					</form>
					<form action="to_savepassword.php" method="post" class="mt-5">
						<div class="form-group">
							<label>
								OLD PASSWORD : 
							</label>
							<input type="password" name="old_password" class="form-control" required>
						</div>
						<div class="form-group">
							<label>
								PASSWORD : 
							</label>
							<input type="password" name="password" class="form-control" required>
						</div>
						<div class="form-group">
							<label>
								REPEAT PASSWORD : 
							</label>
							<input type="password" name="re_password" class="form-control" required>
						</div>							
						<div class="form-group">
							<button class="btn btn-success">UPDATE PASSWORD</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	<?php
		require_once 'footer.php';
	?>	

</body>
</html>

<?php
	
	}else{

		header("Location:index.php");

	}

?>