	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer">
	    <div class="pull-right hidden-xs">
	      <b>Version</b> 2.4.0
	    </div>
	    <strong>Copyright &copy; 2018 Jayson Lynn.Net Inc.</strong>
	</footer>
</div>

<script type="text/javascript">

	$(document).on('submit', 'form[name="sendsms"]', function (e) {
		e.preventDefault();
		e.stopPropagation();
		
		var $ele = $(this);
		$ele.find('[type="submit"]').addClass('disabled');
		$.post('//' + window.location.hostname + '/member_api/send_sms', $(this).serialize(), function (response) {
			if (!response.success) {
				for (var key in response.errors) {
					$ele.find('.signin-text').removeClass('default').addClass('error').html(response.errors[key]);
				}
				$("#pop-up").show().addClass('errors').text("Error, Failed sending Message. Please try again").delay(5000).fadeOut();
			} else {
				// $("#send-sms-modal").modal("hide");
				$("#pop-up").show().addClass('responses').text("Message Sent Successfully").delay(5000).fadeOut();
			}

			$ele.find('[type="submit"]').removeClass('disabled');
		});

	});
	function toggledrop() {
		if ( $('#member-sign').hasClass("open") ) {
			//do something it does have the protected class!
			$('#member-sign').removeClass( "open" );
		} else {
			$('#member-sign').addClass( "open" );
		}
		
	}

</script>

<!-- jQuery 3 -->
<script src="/public_html/assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/public_html/assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="/public_html/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="/public_html/assets/adminlte/bower_components/raphael/raphael.min.js"></script>
<script src="/public_html/assets/adminlte/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="/public_html/assets/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/public_html/assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/public_html/assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/public_html/assets/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/public_html/assets/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="/public_html/assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/public_html/assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/public_html/assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/public_html/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/public_html/assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/public_html/assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/public_html/assets/adminlte/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/public_html/assets/adminlte/dist/js/demo.js"></script>
</body>
</html>
