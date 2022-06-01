<?php
	if($action == 'media_select' && $page == 'Media'){
?>
	<script>
		function getUrlParam( paramName ) {
			var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
			var match = window.location.search.match( reParam );

			return ( match && match.length > 1 ) ? match[1] : null;
		}

		function returnFileUrl(fileUrl) {
			window.opener.returnData(fileUrl, getUrlParam('field_id'));
			window.close();
		}
	</script>
<?php
	}
?>