<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 13:00:13
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-19 18:43:15
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: login.php");
}
?>
<div class="sidebar" data-active-color="rose" data-background-color="black">
<div class="logo"><a href="index.php" class="simple-text">Capture the Flag</a></div>
<div class="sidebar-wrapper">
	<!-- Side Navigator -->
	<div class="user">
		<div class="info">
			<a data-toggle="collapse" href="#collapseExample" class="collapsed"><?= $_SESSION['username'];?><b class="caret"></b></a>
			<div class="collapse" id="collapseExample">
				<ul class="nav">							
					<li><a href="/admin/logout">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
    <!--End Side Navigator -->
    <!--Navigator -->
	<ul class="nav">
		<li class="">
			<a href="/admin/index.php">
				<i class="material-icons">dashboard</i>
				<p>Home</p>
			</a>
		</li>
		<li class="">
			<a href="/admin/manage-member">
				<i class="material-icons">people</i>
				<p>Manage Member</p>
			</a>
		</li>
		<li class="">
			<a href="/admin/manage-flag">
				<i class="material-icons">assignment</i>
				<p>Manage Flag</p>
			</a>
		</li>
		<li class="">
			<a href="/admin/manage-info">
				<i class="material-icons">settings</i>
				<p>Update Information</p>
			</a>
		</li>
	</ul>
	<!--End Navigator -->
</div>
</div>