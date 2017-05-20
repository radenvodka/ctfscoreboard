<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 13:00:13
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-19 18:53:33
 */
require_once('../modules/modules.class.php');
require_once('../modules/db.class.php');
$Modules = new Modules;$Modules->isAdmin();
$Database = new Database;
if(isset($_SESSION['username']) == ""){
	header("Location: /admin/login.php");
}
if($_SESSION['iamadmin']){
	switch ($_GET['type']) {
		case 'flag':
			$status = $Database->hapus_flag($_GET['id']);
			header("Location: /admin/manage-flag");
		break;
		case 'user':
			$status = $Database->hapus_user($_GET['id']);
			header("Location: /admin/manage-member");
		break;
		case 'info':
			$status = $Database->hapus_info($_GET['id']);
			header("Location: /admin/manage-info");
		break;
		default:
			# code...
		break;
	}

}