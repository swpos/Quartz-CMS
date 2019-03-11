<?php
	if($_SESSION['editor']=='ckeditor'){
?>
	<script type="text/javascript">
		//<![CDATA[
		CKEDITOR.replace( 'editor',
		{
		skin : 'kama'
		});
		//]]>
	</script>
<?php 
	} 
?>
