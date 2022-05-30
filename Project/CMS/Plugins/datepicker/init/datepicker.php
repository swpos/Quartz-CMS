<script type="text/javascript">
	$(document).ready(function () {
		if($('#date').length > 0){
			$('#date').datetimepicker({
				format: 'Y-m-d',
				timepicker:false
			});
			
			$('#time').datetimepicker({
				 format: 'H:i:s',
				 datepicker:false
			});
		}
	});
</script>