<?php
	require_once 'user.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once 'head.php'; ?>
	<title>Films KZ | Register</title>
</head>
<body>

	<?php
		require_once 'navbar.php';
	?>

		<div class="container">
			
			<div class="row mt-5">
				<div class="col-sm-6 offset-3">
					<?php
						if(isset($_GET['success'])){
					?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  User added successfully!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
						}
					?>

					<?php
						if(isset($_GET['error'])){
							if($_GET['error']=='1'){
					?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  Error on adding user!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
							}else if($_GET['error']=='2'){
					?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  User with such email exists!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
							}
						}
					?>
					<form action="to_register.php" method="post">
						<div class="form-group">
							<label>
								EMAIL : 
							</label>
							<input type="email" name="email" class="form-control" required>
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
							<label>
								FULL NAME : 
							</label>
							<input type="text" name="full_name" class="form-control" required>
						</div>								
						<div class="form-group">
							<button class="btn btn-success">SIGN UP</button>
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