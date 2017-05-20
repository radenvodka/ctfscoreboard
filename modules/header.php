<?php
require_once('../modules/modules.class.php');
$Modules = new Modules;
?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<!-- Bootstrap core CSS     -->
<link href="<?= $Modules->asset("bootstrap.min.css",'css');?>" rel="stylesheet" />
<!--  Material Dashboard CSS    -->
<link href="<?= $Modules->asset("material-dashboard.css",'css');?>" rel="stylesheet" />
<!--  CSS for Demo Purpose, don't include it in your project     -->
<link href="<?= $Modules->asset("demo.css",'css');?>" rel="stylesheet" />
<!--     Fonts and icons     -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />