<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 13:00:13
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-19 18:42:55
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
$edit = $Database->search_peserta_by_ids($_GET[id]);;
if(isset($edit['id']) == null){
	header("Location: /admin/manage-member");
}
if(isset($_POST['name']) && isset($_POST['univeristas']) && isset($_POST['status']) && isset($_POST['point'])  ){
	if($_POST['Password'] != null){
		$status = $Database->update_user($_POST['id'],$_POST['name'],$_POST['Password'],$_POST['univeristas'],$_POST['status'],$_POST['point']);
		if($status){
			header("Location: /admin/manage-member");
		}else{
			$status = "Pembaruan data gagal";
		}
	}else{
		$status = $Database->update_user($_POST['id'],$_POST['name'],false,$_POST['univeristas'],$_POST['status'],$_POST['point']);
		if($status){
			header("Location: /admin/manage-member");
		}else{
			$status = "Pembaruan data gagal";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Edit Member");?>
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
								<h4 class="card-title">Edit Member</h4>
							</div>
							<div class="card-content">
								<div class="row">
									<label class="col-sm-2 label-on-left">Username</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="name" type="text" class="form-control" placeholder="Username" required="" value="<?= $edit['username']?>">
											<input name="id" type="hidden" value="<?= $edit['id']?>">
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Password</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="Password" type="text" class="form-control" placeholder="Password (Optional)">
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Universitas</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="univeristas" type="text" class="form-control" placeholder="Nama Universitas" required="" value="<?= $edit['universitas']?>">
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
												<?php
												$numoption = array('1' => 'Aktif','2' => 'Bekukan');
												foreach ($numoption as $key => $value) {
													if($edit['status'] == $key){
														echo '<option value="'.$key.'" selected>'.$value.'</option>';
													}else{
														echo '<option value="'.$key.'">'.$value.'</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Point</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="point" type="number" class="form-control" placeholder="Point" required="" value="<?= $edit['score']?>">
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