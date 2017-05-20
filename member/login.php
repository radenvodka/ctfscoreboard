<?php
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules 	= new Modules;
$Database 	= new Database;
if(isset($_SESSION['iammember']) != ""){
	header("Location: index.php");
}
if(isset($_POST['username']) && isset($_POST['password'])){
	$status = $Database->memberLogin($_POST['username'],$_POST['password']);
	if($status != "gagal"){
		header("Location: ?");
	}
} 
?>
<!DOCTYPE html>
<html>
<head>
	<?= $Modules->header("Login Member");?>
</head>
<body>
<div class="wrapper wrapper-full-page">
<div class="full-page login-page" filter-color="black" data-image="<?= $Modules->asset("login.jpeg","img");?>">
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
				<form method="post" action="">
					<div class="card card-login card-hidden">
						<div class="card-header text-center" data-background-color="rose">
							<h4 class="card-title">Login</h4>
						</div>
						<?php
							if($status == "gagal"){
								echo '<div class="alert alert-danger">username atau password salah!.</div>';
							}
						?>
						<div class="card-content">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">face</i>
								</span>
								<div class="form-group label-floating">
									<label class="control-label">Username</label>
									<input type="text" name="username" class="form-control">
								</div>
							</div>
							
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>
								<div class="form-group label-floating">
									<label class="control-label">Password</label>
									<input type="password" name="password" class="form-control">
								</div>
							</div>
						</div>
						<div class="footer text-center">
							<button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Let's go</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?= $Modules->footer();?>
</body>
</html>