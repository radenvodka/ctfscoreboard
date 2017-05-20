<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 13:00:13
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-20 02:06:06
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
if(isset($_POST['isi']) && isset($_POST['id_kategori'])){
	$status = $Database->tambahkan_info($_POST['isi'],$_POST['id_kategori']);
	if($status){
		header("Location: manage-info");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Tambah Info");?>
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
								<h4 class="card-title">Tambah Info</h4>
							</div>
							<div class="card-content">
								<div class="row">
									<label class="col-sm-2 label-on-left">Isi</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<textarea  class="form-control" name="isi" required=""></textarea>
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Kategori</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
												<select class="form-control" name="id_kategori" required="">
													<option value="">Kategori</option>
													<?php
														$list = $Database->list_kategori();
														foreach ($list as $key => $value) {
															echo '<option value="'.$value['id'].'">'.$value['kategori'].'</option>';
														}
													?>
												</select>
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