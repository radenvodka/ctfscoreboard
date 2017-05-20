<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 21:21:18
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-20 14:24:02
 */
require_once('modules/modules.class.php');
require_once('modules/db.class.php');
$Modules = new Modules;
$Database = new Database;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<title>Welcome to FIT FUN FEST 2017</title>
	<link href="<?= $Modules->asset("bootstrap.min.css",'css');?>" rel="stylesheet" />
	<link href="<?= $Modules->asset("material-dashboard.css",'css');?>" rel="stylesheet" />
	<link href="<?= $Modules->asset("demo.css",'css');?>" rel="stylesheet" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>
<body style="background-color: #3c4858;color: #3C4858;">
	<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=" ../dashboard.html ">FIT FUN FEST 2017</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="/member/login">
                            <i class="material-icons">fingerprint</i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
		<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
                <h2 class="title" style="color:white;">FIT 2017</h2>
                <h5 class="description" style="color:white;">LORE INSUME </h5>
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
									foreach ($Database->info_lastsolved("10") as $key => $data) {
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
	<footer class="footer">
                <div class="container" style="color:white;">
                    <p class="copyright pull-right">
                      FIT   © <script async="" src="//www.google-analytics.com/analytics.js"></script><script>
                            document.write(new Date().getFullYear())
                        </script></p>
                </div>
            </footer>
<?= $Modules->footer();?>
</body>
</html>