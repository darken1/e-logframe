<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>DRC Central Database System</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/jquery-ui/jquery-ui.min.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/themes.css">
    	<!-- Tagsinput -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/tagsinput/jquery.tagsinput.css">
    <!-- dataTables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/datatable/TableTools.css">
    <!-- Datepicker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/datepicker/datepicker.css">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/multiselect/multi-select.css">
    <!-- Filetree -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/dynatree/ui.dynatree.css">
    <!-- timepicker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/timepicker/bootstrap-timepicker.min.css">

	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>js/plugins/multiselect/jquery.multi-select.js"></script>
	<!-- Nice Scroll -->
	<script src="<?php echo base_url(); ?>js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo base_url(); ?>js/plugins/jquery-ui/jquery-ui.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="<?php echo base_url(); ?>js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="<?php echo base_url(); ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="<?php echo base_url(); ?>js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo base_url(); ?>js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Flot -->
	<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.bar.order.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- imagesLoaded -->
	<script src="<?php echo base_url(); ?>js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="<?php echo base_url(); ?>js/plugins/pageguide/jquery.pageguide.js"></script>
	<!-- FullCalendar -->
	<script src="<?php echo base_url(); ?>js/plugins/fullcalendar/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- Chosen -->
	<script src="<?php echo base_url(); ?>js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="<?php echo base_url(); ?>js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo base_url(); ?>js/plugins/icheck/jquery.icheck.min.js"></script>

	<!-- Theme framework -->
	<script src="<?php echo base_url(); ?>js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo base_url(); ?>js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="<?php echo base_url(); ?>js/demonstration.min.js"></script>
    
    <!-- Validation -->
	<script src="<?php echo base_url(); ?>js/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/validation/additional-methods.min.js"></script>
	<!-- TagsInput -->
	<script src="<?php echo base_url(); ?>js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Custom file upload -->
	<script src="<?php echo base_url(); ?>js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<!-- Filetree -->
	<script src="<?php echo base_url(); ?>js/plugins/dynatree/jquery.dynatree.js"></script>
    <!-- Timepicker -->
	<script src="<?php echo base_url(); ?>js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    
    <!-- New DataTables -->
	<script src="<?php echo base_url(); ?>js/plugins/momentjs/jquery.moment.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/momentjs/moment-range.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/datatables/extensions/dataTables.tableTools.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/datatables/extensions/dataTables.colReorder.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/datatables/extensions/dataTables.colVis.min.js"></script>
	<script src="<?php echo base_url(); ?>js/plugins/datatables/extensions/dataTables.scroller.min.js"></script>
    <!-- Wizard -->
	<script src="<?php echo base_url(); ?>js/plugins/wizard/jquery.form.wizard.min.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/mockjax/jquery.mockjax.js"></script>
    
    <!--<script src="<?php echo base_url(); ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>-->
    
      <script src="<?php echo base_url(); ?>inputmask/js/jquery.inputmask.js"></script>
      
      <script type="text/javascript" src="<?php echo base_url(); ?>js/script.js"></script> 
    
    <script>
	$(document).ready(function(){
    $(":input").inputmask();
});
	</script>
    
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ckeditor/ckeditor.js"></script>
	<!--[if lte IE 9]>
		<script src="<?php echo base_url(); ?>js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
		<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>img/apple-touch-icon-precomposed.png" />
</head>
<?php date_default_timezone_set('Africa/Nairobi');?>