<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-18 22:51:41
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-05-01 03:28:12
 */
session_start();
date_default_timezone_set('Asia/Jakarta');
class Database
{
	var $host 	= "localhost";
	var $uname 	= "root";
	var $pass 	= "";
	var $db 	= "dbctf";

	public function __construct(){
			$koneksi = mysql_connect($this->host, $this->uname, $this->pass);
			mysql_select_db($this->db);
			if($koneksi){
				//echo "Koneksi database mysql dan php berhasil.";
			}else{
				//echo "Koneksi database mysql dan php GAGAL !";
			}
	}
	#######################################
	public function filter($data) {
    	$data = htmlspecialchars(trim(htmlentities(strip_tags($data))));
    	if (get_magic_quotes_gpc())
        	$data = stripslashes($data);
    		$data = mysql_real_escape_string($data);
    	return $data;
	}
	public function ctfDate(){
		return  date("Y-m-d h:i:s");
	}
	########### SEARCH ####################
	public function search_peserta_by_id($id){
		$search = mysql_query("SELECT * FROM `peserta` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search['username'];
	}
	public function search_peserta_by_ids($id){
		$search = mysql_query("SELECT * FROM `peserta` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search;
	}
	public function search_soal_by_id($id){
		$search = mysql_query("SELECT * FROM `flag` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search;
	}
	public function search_posted_by_id($id){
		$search = mysql_query("SELECT * FROM `kategori` WHERE `id` = '$id'");
		$search = mysql_fetch_array($search);
		return $search['nama_kategori'];
	}
	public function count_player(){
		 $count = mysql_query("SELECT * FROM `peserta`");
		 $count = mysql_num_rows($count);
		 return $count;
	}
	public function count_flag(){
		 $count = mysql_query("SELECT * FROM `flag`");
		 $count = mysql_num_rows($count);
		 return $count;
	}
	public function count_lastsolved(){
		 $count = mysql_query("SELECT * FROM `last_solved`");
		 $count = mysql_num_rows($count);
		 return $count;
	}
	########### show data ####################
	public function list_peserta(){
		$action		=  mysql_query("SELECT * FROM `peserta`");
		while ($row = mysql_fetch_array($action)) {
			$array[] = array('id' => $row['id'],'username' => $row['username']);
		}
		return $array;
	}
	public function list_kategori(){
		$action		=  mysql_query("SELECT * FROM `kategori`");
		while ($row = mysql_fetch_array($action)) {
			$array[] = array('id' => $row['id'],'kategori' => $row['nama_kategori']);
		}
		return $array;
	}
	public function tampilkan_flag_list(){
		$action = mysql_query("SELECT * FROM `flag`");
		while ($row = mysql_fetch_array($action)) {
			$flag[] = array(
				'id' 		=> $row['id'],
				'nama_soal' => $row['nama_soal'],
				'deskripsi'	=> $row['deskripsi'],
				'peserta'   => $this->search_peserta_by_id($row['peserta_id']),
				'score' 	=> $row['score'],
			);
		}
		return $flag;
	}
	public function tampilkan_member_list(){
		$action = mysql_query("SELECT * FROM `peserta`");
		while ($row = mysql_fetch_array($action)) {
			$member[] = array(
				'id' 			=> $row['id'],
				'username'  	=> $row['username'],
				'universitas'   => $row['universitas'],
				'score' 		=> $row['score'],
				'status' 		=> $row['status'],
			);
		}
		return $member;
	}
	public function tampilkan_info_list(){
		$action = mysql_query("SELECT * FROM `posted`");
		while ($row = mysql_fetch_array($action)) {
			$posted[] = array(
				'id' 			=> $row['id'],
				'isi' 			=> $row['isi'],
				'kategori'		=> $this->search_posted_by_id($row['kategori_id']),
			);
		}
		return $posted;
	}
	########### DELETE ####################
	public function hapus_flag($id){
		$action = mysql_query("DELETE FROM `flag` WHERE `flag`.`id` = '$id'");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	public function hapus_user($id){
		$action = mysql_query("DELETE FROM `peserta` WHERE `peserta`.`id` = '$id'");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	public function hapus_info($id){
		$action = mysql_query("DELETE FROM `posted` WHERE `posted`.`id` = '$id'");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	########### UPDATE / ADD ####################
	public function statusMember($key){
		switch ($key) {
			case '1':
				$action = mysql_query("UPDATE `peserta` SET `status`=1");
			break;
			case '2':
				$action = mysql_query("UPDATE `peserta` SET `status`=2");
			break;
			
			default:
				# code...
			break;
		}
	}
	public function tambahkan_flag($nama_soal,$flag,$desc,$score,$score2,$pid){
		$idsearch = $this->search_peserta_by_id($pid);
		if($idsearch == ""){
			return "Peserta tidak ditemukan.";
		}else{
			$action = mysql_query("INSERT INTO `flag`(`id`, `nama_soal`, `flag`, `deskripsi`, `score`, `score_perserta`, `peserta_id`) VALUES (0,'$nama_soal','$flag','$desc','$score','$score2','$pid')");
			if($action){
				return "sukses";
			}else{
				return "Kesalahan di database";
			}
		}
	}
	public function update_flag($id,$soal,$flag,$desc,$score,$pid){
		$sql  = 'UPDATE `flag` SET `nama_soal` = \''.$soal.'\', `flag` = \''.$flag.'\', `deskripsi` = \''.$desc.'\', `score` = \''.$score.'\', `peserta_id` = \''.$pid.'\' WHERE `flag`.`id` = '.$id.'';
		$sql  = mysql_query($sql); 
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	public function tambahkan_user($username,$password,$universitas,$status,$score){
		$action = mysql_query("INSERT INTO `peserta`(`id`, `username`, `password`, `universitas`, `score`, `time`, `status`) VALUES (0,'$username','$password','$universitas','$score','','$status')");
		if($action){
			return true;
		}else{
			return false;
		}
	}
	public function update_user($id,$username,$password = false,$universitas,$status,$score){
		if($password == false){
			$sql  = 'UPDATE `peserta` SET `username` = \''.$username.'\', `universitas` = \''.$universitas.'\', `score` = \''.$score.'\', `status` = \''.$status.'\' WHERE `peserta`.`id` = '.$id.'';
			$sql  = mysql_query($sql);
			if($sql){
				return true;
			}else{
				return false;
			}
		}else{
			$sql  = 'UPDATE `peserta` SET `username` = \''.$username.'\', `password` = \''.md5($password).'\', `universitas` = \''.$universitas.'\', `score` = \''.$score.'\', `status` = \''.$status.'\' WHERE `peserta`.`id` = '.$id.'';
			$sql  = mysql_query($sql);
			if($sql){
				return true;
			}else{
				return false;
			}
		}
	}
	public function tambahkan_info($isi,$kategori){
		$sql = mysql_query("INSERT INTO `posted`(`id`, `isi`, `kategori_id`) VALUES (0,'$isi','$kategori')");
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	################## TABLE ###################
	public function info_lastsolved($count){
		$mysql = mysql_query("SELECT * FROM `last_solved` ORDER BY `last_solved`.`time` DESC LIMIT $count");
		while ($data = mysql_fetch_array($mysql)) {
			$peserta_id = $data['peserta_id'];
			$flag_id    = $data['flag_id'];
			$scoresc 	= mysql_query("SELECT * FROM `flag` WHERE `id` = '$flag_id'");
			$scorescs 	= mysql_fetch_array($scoresc);
			$datas[] 	= array(
				'tim'	=> $this->search_peserta_by_id($data['peserta_id']),
				'time' 	=> $data['time'], 
				'score' => $scorescs['score'], 
			);
		}
		return $datas;
	}
	public function info_topplayer(){
		$mysql = mysql_query("SELECT * FROM `peserta` ORDER BY `peserta`.`score` DESC, `peserta`.`time` ASC LIMIT 10");
		while ($data = mysql_fetch_array($mysql)) {
			$datas[] = array(
				'tim'    => $data['username'], 
				'score'  => $data['score'], 
				'time'   => $data['time'], 
			);
		}
		return $datas;
	}
	################## FLAG  ####################
	public function last_solved_by_id($id){
		$mysql = mysql_query("SELECT * FROM `last_solved` WHERE `peserta_id` = '$id'");
		$mysql = mysql_num_rows($mysql);
		return $mysql;
	}
	public function search_user_by_id($id){
		$sql = mysql_query("SELECT * FROM `peserta` WHERE `username` = '$id'");
		$sql = mysql_fetch_array($sql);
		return $sql[id];
	}
	public function checklastsalvoed($pid,$fid){
		$sql 	= mysql_query("SELECT * FROM `last_solved` WHERE `peserta_id` = '$pid' AND `flag_id` = '$fid'");
		$jumlah = mysql_num_rows($sql);
		if ( $jumlah == 0 ) {
			return false;
		}else{
			return true;
		}
	}
	public function sflag($flag,$id){
		$this->kickPlayer();
		$flag = $this->filter($flag);
		$sql = mysql_query("SELECT * FROM `flag` WHERE `flag` = '$flag' AND `peserta_id` != '$id'");
		$arr = mysql_fetch_array($sql);
		if($arr['nama_soal']){
			$flag = $this->checklastsalvoed($id,$arr[id]);
			if($flag){
				$notif = array(
					'msg' => 'Tidak dapat memasukan flag yang sama!',
					'css' => 'info',
					'cdo' => false, 
				);
			}else{
				$flid 		= $arr['id'];
				$time 		= $this->ctfDate();
				$srcscore 	= $this->search_peserta_by_ids($id);
				$scores 	= ($srcscore['score']+$arr['score']);
				$sql = mysql_query("INSERT INTO `last_solved`(`id`, `peserta_id`, `flag_id`, `time`) VALUES (0,'$id','$flid','$time')");
				if($sql){
					$updt = mysql_query("UPDATE `peserta` SET `score`='$scores',`time`='$time' WHERE `peserta`.`id` = '$id'");
					if($updt){
						$notif = array(
							'msg' => 'Selamat anda mendapatkan flag <b>tim lain</b> dengan point '.$arr['score'].' !',
							'css' => 'success',
							'cdo' => true, 
						);
					}else{
						$notif = array(
							'msg' => 'kesalahan saat memperbarui data!',
							'css' => 'danger',
							'cdo' => true, 
						);
					}
				}else{
					$notif = array(
						'msg' => 'kesalahan saat memperbarui data!',
						'css' => 'danger',
						'cdo' => true, 
					);
				}
			}
		}else{
				$sql = mysql_query("SELECT * FROM `flag` WHERE `flag` = '$flag' AND `peserta_id` = '$id'");
				$arr = mysql_fetch_array($sql);
				if($arr['nama_soal']){
				$flag = $this->checklastsalvoed($id,$arr[id]);
				if($flag){
					$notif = array(
						'msg' => 'Tidak dapat memasukan flag yang sama!',
						'css' => 'info',
						'cdo' => false, 
					);
				}else{
					$flid 		= $arr['id'];
					$time 		= $this->ctfDate();
					$srcscore 	= $this->search_peserta_by_ids($id);
					$scores 	= ($srcscore['score']+$arr['score_perserta']);
					$sql = mysql_query("INSERT INTO `last_solved`(`id`, `peserta_id`, `flag_id`, `time`) VALUES (0,'$id','$flid','$time')");
					if($sql){
						$updt = mysql_query("UPDATE `peserta` SET `score`='$scores',`time`='$time' WHERE `peserta`.`id` = '$id'");
						if($updt){
							$notif = array(
								'msg' => 'Selamat anda mendapatkan flag <b>anda sendiri</b> dengan point '.$arr['score_perserta'].' !',
								'css' => 'success',
								'cdo' => true, 
							);
						}else{
							$notif = array(
								'msg' => 'kesalahan saat memperbarui data!',
								'css' => 'danger',
								'cdo' => true, 
							);
						}
					}else{
						$notif = array(
							'msg' => 'kesalahan saat memperbarui data!',
							'css' => 'danger',
							'cdo' => true, 
						);
					}
				}
			}else{
				$notif = array(
					'msg' => 'flag tidak di temukan atau format flag salah!',
					'css' => 'danger',
					'cdo' => false, 
				);
			}

			/*$notif = array(
				'msg' => 'flag tidak di temukan atau format flag salah!',
				'css' => 'danger',
				'cdo' => false, 
			);*/

		}
		return $notif;
	}
	########### LOGIN ##########################
	public function adminLogin($username,$password){
		$username	= $this->filter($username);
		$password   = $this->filter($password);

		$cekuser 	= mysql_query("SELECT * FROM `admin` WHERE username = '$username'");
		$jumlah 	= mysql_num_rows($cekuser);
		$hasil 		= mysql_fetch_array($cekuser);
		if ( $jumlah == 0 ) {
				return 'gagal';
		}else{
			if ( md5($password) <> $hasil['password'] ) {
				return 'gagal';
			}else{
				$_SESSION['username'] = $username;
				$_SESSION['iamadmin'] = $username;
			}
		}
	}
	public function memberLogin($username,$password){
		$username	= $this->filter($username);
		$password   = $this->filter($password);
		
		$cekuser 	= mysql_query("SELECT * FROM `peserta` WHERE username = '$username'");
		$jumlah 	= mysql_num_rows($cekuser);
		$hasil 		= mysql_fetch_array($cekuser);
		if ( $jumlah == 0 ) {
				return 'gagal';
		}else{
			if ( md5($password) <> $hasil['password'] ) {
				return 'gagal';
			}else{
				$_SESSION['username']  = $username;
				$_SESSION['iammember'] = $username;
			}
		}
	}
	public function kickPlayer(){
		for ($i=0; $i <3; $i++) { 
			if($_SESSION['iammember']){
				$id 	= $this->search_user_by_id($_SESSION['username']);
				$status = $this->search_peserta_by_ids($id); 
				if($status['status'] != 1){
					session_destroy();
					header("Location: login.php");
					exit;
				}
			}
		}
	}
}
$Database = new Database();
$Database->kickPlayer();