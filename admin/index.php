<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 21:21:18
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-20 13:44:09
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
<?= $Modules->header("Dashboard");?>
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
						<div class="card-header">
							<h4 class="card-title">Informations</h4>
						</div>
						<div class="card-content">
							<div class="alert alert-info">
								<span>Selamat datang di Admin Panel Capture the Flag</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="card card-stats">
						<div class="card-header" data-background-color="orange">
							<i class="material-icons">weekend</i>
						</div>
						<div class="card-content">
							<p class="category">Total Player</p>
							<h3 class="card-title"><?= $Database->count_player();?></h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="card card-stats">
						<div class="card-header" data-background-color="rose">
							<i class="material-icons">equalizer</i>
						</div>
						<div class="card-content">
							<p class="category">Total Solved</p>
							<h3 class="card-title"><?= $Database->count_lastsolved();?></h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="card card-stats">
						<div class="card-header" data-background-color="green">
							<i class="material-icons">assignment</i>
						</div>
						<div class="card-content">
							<p class="category">Missions</p>
							<h3 class="card-title"><?= $Database->count_flag();?></h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-icon" data-background-color="green">
							<i class="material-icons">language</i>
						</div>
						<div class="card-content">
							<h4 class="card-title">Top 10 Players</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive table-sales">
										<table class="table">
											<tbody>
												<tr>
													<td>Rank</td>
													<td>Username</td>
													<td class="text-right">
														Point
													</td>
													<td class="text-right">
														Time
													</td>
												</tr>
												<?php
									foreach ($Database->info_topplayer() as $key => $data) {
									echo '<tr>
											<td>'.($key+1).'</td>
											<td>'.$data['tim'].'</td>
											<td class="text-right">'.$data['score'].'</td>
											<td class="text-right">
												<div class="flag">'.$data['time'].'</div>
											</td>
										</tr>';
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
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-icon" data-background-color="rose">
							<i class="material-icons">people</i>
						</div>
						<h4 class="card-title">Latest Solved</h4>
						<div class="card-content">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Tim CTF</th>
											<th class="text-right">Point</th>
											<th class="text-right">Time Submit</th>
										</tr>
									</thead>
									<tbody>
									<?php
									foreach ($Database->info_lastsolved("100") as $key => $data) {
										echo '<tr>
											<td class="text-center">'.($key+1).'</td>
											<td>'.$data['tim'].'</td>
											<td class="text-right">'.$data['score'].'</td>
											<td class="text-right">'.$data['time'].'</td>
										</tr>';
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
<?= $Modules->footer();?>
</body>
</html>