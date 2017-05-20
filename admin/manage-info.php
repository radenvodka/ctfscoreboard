<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 12:20:26
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-19 18:43:09
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Manage Info");?>
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
							<h4 class="card-title">Manage Info</h4>
							<div class="row">
								<div class="col-md-12">
								<a href="tambahinfo" class="btn btn-rose" role="button">Tambah Info</a>
									<div class="table-responsive table-sales">
										<table class="table">
											<tbody>
												<tr>
													<td>ID</td>
													<td>Isi</td>
													<td class="text-right">Ketegori</td>
													<td class="text-right">Actions</td>
												</tr>
												<?php
													$datarray   = $Database->tampilkan_info_list();
													foreach ($datarray as $key => $data) {?>
														<tr>
															<td><?= ($key+1); ?></td>
															<td><?= $data['isi']; ?></td>
															<td class="text-right"><?= $data['kategori']; ?></td>
															<td class="td-actions text-right">
																<a href="delete/<?= $data['id']; ?>/info" class="btn btn-danger" role="button"><i class="material-icons">close</i></a>
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