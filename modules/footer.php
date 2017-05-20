<?php
require_once('../modules/modules.class.php');
$Modules = new Modules;
?>
<!--   Core JS Files   -->
<script src="<?= $Modules->asset("jquery-3.1.1.min.js","js")?>" type="text/javascript"></script>
<script src="<?= $Modules->asset("jquery-ui.min.js","js")?>" type="text/javascript"></script>
<script src="<?= $Modules->asset("bootstrap.min.js","js")?>" type="text/javascript"></script>
<script src="<?= $Modules->asset("material.min.js","js")?>" type="text/javascript"></script>
<script src="<?= $Modules->asset("perfect-scrollbar.jquery.min.js","js")?>" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="<?= $Modules->asset("jquery.validate.min.js","js"); ?>"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="<?= $Modules->asset("moment.min.js","js"); ?>"></script>
<!--  Charts Plugin -->
<script src="<?= $Modules->asset("chartist.min.js","js"); ?>"></script>
<!--  Plugin for the Wizard -->
<script src="<?= $Modules->asset("jquery.bootstrap-wizard.js","js"); ?>"></script>
<!--  Notifications Plugin    -->
<script src="<?= $Modules->asset("bootstrap-notify.js","js"); ?>"></script>
<!--   Sharrre Library    -->
<script src="<?= $Modules->asset("jquery.sharrre.js","js"); ?>"></script>
<!-- DateTimePicker Plugin -->
<script src="<?= $Modules->asset("bootstrap-datetimepicker.js","js"); ?>"></script>
<!-- Vector Map plugin -->
<script src="<?= $Modules->asset("jquery-jvectormap.js","js")?>"></script>
<!-- Sliders Plugin -->
<script src="<?= $Modules->asset("nouislider.min.js","js")?>"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Select Plugin -->
<script src="<?= $Modules->asset("jquery.select-bootstrap.js","js")?>"></script>
<!--  DataTables.net Plugin    -->
<script src="<?= $Modules->asset("jquery.datatables.js","js")?>"></script>
<!-- Sweet Alert 2 plugin -->
<script src="<?= $Modules->asset("sweetalert2.js","js")?>"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?= $Modules->asset("jasny-bootstrap.min.js","js")?>"></script>
<!--  Full Calendar Plugin    -->
<script src="<?= $Modules->asset("fullcalendar.min.js","js")?>"></script>
<!-- TagsInput Plugin -->
<script src="<?= $Modules->asset("jquery.tagsinput.js","js")?>"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?= $Modules->asset("material-dashboard.js","js")?>"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?= $Modules->asset("demo.js","js")?>"></script>
<script type="text/javascript">
	$().ready(function() {
		demo.checkFullPageBackgroundImage();

		setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
	});
</script>