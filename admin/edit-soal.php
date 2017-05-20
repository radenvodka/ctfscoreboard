<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 13:00:13
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-19 18:42:51
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
$edit = $Database->search_soal_by_id($_GET['id']);
if(isset($edit['id']) == null){
	header("Location: /admin/manage-flag");
}
if(isset($_POST['idsoal']) != "" && isset($_POST['name']) != "" && isset($_POST['description']) != "" && isset($_POST['id_player']) && isset($_POST['flag'])  != "" && isset($_POST['point'])  != ""){
	$update = $Database->update_flag($_POST['idsoal'],$_POST['name'],$_POST['flag'],$_POST['description'],$_POST['point'],$_POST['id_player']);
	if($update){
		header("Location: /admin/manage-flag");
	}else{
		$status = "Kesalahan pada pembaruan data";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Tambah Flag");?>
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
				if($status != ""){
					echo '<div class="alert alert-danger">'.$status.'!</div>';
				}
			?>
				<div class="row">
				<div class="col-md-12">
					<div class="card">
						<form method="post" action="" class="form-horizontal">
							<div class="card-header card-header-text" data-background-color="rose">
								<h4 class="card-title">Edit Flag</h4>
							</div>
							<div class="card-content">
								<div class="row">
									<label class="col-sm-2 label-on-left">Nama Soal</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="name" type="text" class="form-control" placeholder="Nama Soal" required="" value="<?=$edit['nama_soal'];?>">
											<input name="idsoal" type="hidden" value="<?=$edit['id'];?>">
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Deskripsi Flag</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="description" type="text" class="form-control" placeholder="Deskripsi Flag" required="" value="<?=$edit['deskripsi'];?>">
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Pemilik Flag</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
												<select class="form-control" name="id_player" required="">
													<?php
														$list = $Database->list_peserta();
														foreach ($list as $key => $value) {
															if($value['id'] === $edit['peserta_id']){
																echo '<option value="'.$value['id'].'" selected>'.$value['username'].'</option>';
															}else{
																echo '<option value="'.$value['id'].'">'.$value['username'].'</option>';
															}
														}
													?>
												</select>
											<span class="material-input"></span></div>
										</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Flag</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="flag" type="text" class="form-control" placeholder="format flag (sensitive value)" required="" value="<?=$edit['flag'];?>">
											<span class="material-input"></span></div>
										</div>
								</div>
								<div class="row">
									<label class="col-sm-2 label-on-left">Point</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input name="point" type="number" class="form-control" placeholder="Point" required="" value="<?=$edit['score'];?>">
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