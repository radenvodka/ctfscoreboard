<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 13:00:13
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-19 18:43:24
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
if(isset($_POST['name']) && isset($_POST['Password']) && isset($_POST['univeristas']) && isset($_POST['status']) &&  isset($_POST['point']) ){
	$status = $Database->tambahkan_user($_POST['name'],md5($_POST['Password']),$_POST['univeristas'],$_POST['status'],$_POST['point']);
	if($status){
		header("Location: manage-member");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Tambah Member");?>
</head>
<body>
	<div class="wrapper">
	<?= $Modules->slideMenu();?>
	<div class="main-panel">
		<!-- Head Navigator -->
		<nav class="navbar navbar-transparent navbar-absolute">
			<div class="container-fluid">
				<div class="navbar-minimize">
					<button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
						<i class="material-icons visible-on-sidebar-regular">more_vert</i>
						<i class="material-icons visible-on-sidebar-mini">view_list</i>
					</button>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
			</div>
		</nav>
		<!--End Head Navigator -->
		<div class="content">
			<div class="container-fluid">
			<?php
				if($status){
					echo '<div class="alert alert-danger">'.$status.'!</div>';
				}
			?>
				<div class="row">
				<div class="col-md-12">
					<div class="card">
						<form method="post" action="" class="form-horizontal">
							<div class="card-header card-header-text" data-background-color="rose">
								<h4 class="card-title">Tambah Member</h4>
							</div>
							<div class="card-content">
								<div class="row">
									<label class="col-sm-2 label-on-left">Username</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="name" type="text" class="form-control" placeholder="Username" required="">
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Password</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="Password" type="text" class="form-control" placeholder="Password" required="">
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Universitas</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="univeristas" type="text" class="form-control" placeholder="Nama Universitas" required="">
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Status</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<select name="status" class="form-control" required="">
												<option value="1">Aktifkan</option>
												<option value="2">Bekukan</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Point</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="point" type="number" class="form-control" placeholder="Point" required="">
											<span class="material-input"></span></div>
										</div>
									</div>
									<button class="btn btn-success">Submit<div class="ripple-container"></div></button>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

</div>
<?= $Modules->footer();?>
</body>
</html>