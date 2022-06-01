<?php
	if(in_array('ckeditor', $head_plugins) && $editor == 'ckeditor') {
?>
	<script type="text/javascript">
        $(document).ready(function() {
            $("textarea").each(function(index, element) {
                var element_id = $(element).attr('id');
                if($('#' + element_id).length > 0){
                    CKEDITOR.replace(element_id, {
                        skin: 'moono-lisa',
                        allowedContent: true,
						protectedSource:[/<\?[\s\S]*?\?>/g],
						extraPlugins: 'filetools,popup,filebrowser',
						filebrowserBrowseUrl: '/Administrator/index.php?page=Media&action=media_browse',
                        height: 200,
                        toolbar: [
                            { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
                            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                            { name: 'tools', items: [ 'Maximize' ] },
                            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
                            { name: 'others', items: [ '-' ] },
                            '/',
                            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                            { name: 'styles', items: [ 'Styles', 'Format' ] },
                            { name: 'about', items: [ 'About' ] }
                        ]
                    });
                }
            });
        });
    </script>
<?php	
		if($action == 'media_browse' && $page == 'Media'){
?>
			<script>
				// Helper function to get parameters from the query string.
				function getUrlParam( paramName ) {
					var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
					var match = window.location.search.match( reParam );

					return ( match && match.length > 1 ) ? match[1] : null;
				}
				// Simulate user action of selecting a file to be returned to CKEditor.
				function returnFileUrl(fileUrl) {

					var funcNum = getUrlParam( 'CKEditorFuncNum' );
					window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl, function() {
						// Get the reference to a dialog window.
						var dialog = this.getDialog();
						// Check if this is the Image Properties dialog window.
						if ( dialog.getName() == 'image' ) {
							// Get the reference to a text field that stores the "alt" attribute.
							var element = dialog.getContentElement( 'info', 'txtAlt' );
							// Assign the new value.
							if ( element )
								element.setValue( 'alt text' );
						}
						// Return "false" to stop further execution. In such case CKEditor will ignore the second argument ("fileUrl")
						// and the "onSelect" function assigned to the button that called the file manager (if defined).
						// return false;
					} );
					window.close();
				}
			</script>
<?php
		}
	}
?>