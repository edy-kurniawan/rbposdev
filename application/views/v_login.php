<!DOCTYPE html>
<html>
	<?php
	$this->load->view('template/head');
	$this->load->helper('plusmark_helper');
	?>
	
	<style type="text/css">
	</style>
	<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css')?>">
	<link href="<?php echo base_url('assets/AdminLTE/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />
	<head>
		<style>
		</style>
	</head>
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<b>RB Web App </b>Beta
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Login Team</p><br>
		<form action="<?php echo base_url('login/aksi_login'); ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" name="nama_user" class="form-control" placeholder="username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="pass" class="form-control" placeholder="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
				<?php echo $this->session->flashdata('message');?>
				</div>
				<div class="col-xs-4">
					<button type="submit" class="btn btn-warning btn-block btn-flat">Masuk</button>
				</div>
				<div>
				</div>
			</div>
		</form>
		<hr>
	</div>
</div>
</body>
<script src="<?php echo base_url('assets/AdminLTE/plugins/jQuery/jQuery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/dist/js/de.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
<script src='<?php echo base_url('assets/AdminLTE/plugins/fastclick/fastclick.min.js') ?>'></script>
<script src="<?php echo base_url('assets/AdminLTE/dist/js/app.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/delconfirmation.js')?>"></script>
<script src="<?php echo base_url('assets/allowedfile.js')?>"></script>
</script>
<script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
			}else{
				$('.form-password').attr('type','password');
			}
		});
	});
</script>
<script>
$( ".contacs" ).addClass( "active" );
</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php
$this->load->view('template/sidebar_theme');
?>
<script>
$(document).ready(function(){
setTimeout(function() {
$('.alrt-success').fadeOut('fast');
}, 2000); // <-- time in milliseconds
});
</script>
</html>