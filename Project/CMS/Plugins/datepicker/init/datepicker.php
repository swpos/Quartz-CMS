<script type="text/javascript">
	$(document).ready(function () {
		if($('#date').length > 0){
			$('#date').datetimepicker({
				format: 'YYYY-MM-DD'
			});
			
			$('#time').datetimepicker({
				 format: 'LT'
			});
		}
	});
</script>