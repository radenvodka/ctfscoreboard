<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 22:32:03
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-20 14:04:32
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isUser();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
if(isset($_POST['flag'])){
	$idNya = $Database->search_user_by_id($_SESSION['username'] );
	if(isset($idNya)){
		$status = $Database->sflag($_POST['flag'],$idNya);
	}else{
		session_destroy();
		header("Location: login.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?= $Modules->header("Prize");?>
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
            	echo '<div class="alert alert-'.$status['css'].'">
                       <span>'.$status['msg'].'</span>
                </div>';
            }?>
				<div class="card">
                    <form method="post" action="" class="form-horizontal">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Submit Flag</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <label class="col-sm-2 label-on-left">Format Flag</label>
                                <div class="col-sm-10">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"></label>
                                        <input type="text" class="form-control" name="flag">
                                        <span class="help-block">Tolong untuk di perhatikan data flag yang akan di submit.</span>
                                    <span class="material-input"></span></div>
                                </div>
                            </div>
                            <div class="row">
                               <div class="form-footer text-right">
                                <button type="submit" class="btn btn-rose btn-fill">Submit Flag<div class="ripple-container"></div></button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>					<div class="card">
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
<?= $Modules->footer();?>
</body>
</html>