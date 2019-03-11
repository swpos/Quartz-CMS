<script type="text/javascript">
	$(document).ready(function () {
		if($('table.list').length > 0){
			$('table.list').each(function (index, element) {
				// Setup - add a text input to each footer cell
				$(element).find('tfoot th').each(function (index2, element2) {
					var title = $(element).find('thead th').eq(index2).text();
					$(this).html('<div class="form-group has-feedback"><input type="text" placeholder="' + title + '" /><i class="glyphicon glyphicon-search form-control-feedback"></i></div>');
				});
				
				$(element).find('thead th').each(function () {
					$(this).html($(this).html() + ' <span class="glyphicon glyphicon-sort"></span>');
				});
			
				$.extend($.fn.dataTable.defaults, {
					"searching": true,
					"ordering": true,
					"paging": false,
					"info": false,
				});
			
				// DataTable
				var table = $(element).DataTable({
					"aaSorting": []
				});
			
				// Apply the search
				table.columns().eq(0).each(function (colIdx) {
					$('input', table.column(colIdx).footer()).on('keyup change', function () {
						table
								.column(colIdx)
								.search(this.value)
								.draw();
					});
				});
			});
		}
	});
</script>