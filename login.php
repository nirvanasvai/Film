<?php
	require_once 'user.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once 'head.php'; ?>
	<title>Films KZ | Login</title>
</head>
<body>

	<?php
		require_once 'navbar.php';
	?>

		<div class="container">
			
			<div class="row mt-5">
				<div class="col-sm-6 offset-3">
					<?php
						if(isset($_GET['error'])&&$_GET['error']=='1'){
					?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  Incorrect email or password!
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php
						}
					?>
					<form action="auth.php" method="post">
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
							<button class="btn btn-success">SIGN IN</button>
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