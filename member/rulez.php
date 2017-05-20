<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 22:32:03
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-20 01:44:40
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isUser();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Rules");?>
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
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Rules -
                                        <small class="category">Peraturan FIT 2017</small>
                                    </h4>
                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="dashboard-2">
                                                   <?php
														$action		=  mysql_query("SELECT * FROM `posted` WHERE `kategori_id` = 2");
														while ($datas = mysql_fetch_array($action) ) {
														echo $datas['isi'];
													}?>
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
</div>
<?= $Modules->footer();?>
</body>
</html>