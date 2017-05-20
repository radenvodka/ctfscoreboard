<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 12:20:26
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-19 19:01:06
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
if(isset($_GET['users']) != null){
	switch ($_GET['users']) {
		case 'allactive':
			$Database->statusMember(1);
			header("Location: manage-member");
		break;
		case 'allnonactive':
			$Database->statusMember(2);
			header("Location: manage-member");
		break;
		default:
			# code...
		break;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Manage Member");?>
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
				<div class="row">
					<div class="col-md-12">
											<div class="card">
						<div class="card-header card-header-icon" data-background-color="green">
							<i class="material-icons">assignment</i>
						</div>
						<div class="card-content">
							<h4 class="card-title">Manage Member</h4>
							<div class="row">
								<div class="col-md-12">
								<a href="tambahuser" class="btn btn-rose" role="button">Tambah Member</a>
								<a href="?users=allactive" class="btn btn-rose" role="button">Aktifkan Semua User</a>
								<a href="?users=allnonactive" class="btn btn-rose" role="button">Bekukan Semua User</a>
									<div class="table-responsive table-sales">
										<table class="table">
											<tbody>
												<tr>
													<td>ID Member</td>
													<td>Username</td>
													<td>Universitas</td>
													<td>Status</td>
													<td class="text-right">Point</td>
													<td class="text-right">Actions</td>
												</tr>
												<?php
													$datarray   = $Database->tampilkan_member_list();
													foreach ($datarray as $key => $data) {?>
														<tr>
															<td><?= ($key+1); ?></td>
															<td><?= $data['username']; ?></td>
															<td><?= $data['universitas']; ?></td>
															<td><?= ($data['status'] == "1" ? "Aktif":"Dibekukan") ?></td>
															<td class="text-right"><?= $data['score']; ?></td>
															<td class="td-actions text-right">
																<a href="edit/<?= $data['id']; ?>/user" class="btn btn-info" role="button"><i class="material-icons">edit</i></a>
																<a href="delete/<?= $data['id']; ?>/user" class="btn btn-danger" role="button"><i class="material-icons">close</i></a>
															</td>
														</tr>
													<?php
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
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