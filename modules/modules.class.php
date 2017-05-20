<?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 21:19:04
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-20 12:14:49
 */
class Modules
{
	public function base(){
		if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    	}else{
        	$protocol = 'http';
    	}
		return $protocol . "://" . $_SERVER['HTTP_HOST'];
	}
	public function asset($namefile,$type){
		switch ($type) {
			case 'img':
				return $this->base()."/assets/images/".$namefile;
			break;
			case 'js':
				return $this->base()."/assets/js/".$namefile;
			break;
			case 'css':
				return $this->base()."/assets/css/".$namefile;
			break;
			default:
				# code...
			break;
		}
	}
	public function slideMenu(){
		require_once('slidebar.php');
	}
	public function header($title){
		echo '<title>'.$title.' - FIT 2017</title>';
		require_once('header.php');
	}
	public function footer(){
		require_once('footer.php');
	}
	public function isAdmin(){
		if($_SESSION['iamadmin'] == ""){
			session_destroy();
			header("Location: login.php");
		}
	}
	public function isUser(){
		if($_SESSION['iammember'] == ""){
			session_destroy();
			header("Location: login.php");
		}
	}
}
$Modules = new Modules;