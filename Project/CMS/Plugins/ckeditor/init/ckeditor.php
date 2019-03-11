<?php
	if(in_array('ckeditor', $plugins) && $editor == 'ckeditor') {
?>
	<script type="text/javascript">
        $(document).ready(function() {
            $("textarea").each(function(index, element) {
                var element_id = $(element).attr('id');
                if($('#' + element_id).length > 0){
                    CKEDITOR.replace(element_id, {
                        skin: 'moono-lisa'
                        <?php if(in_array('ckfinder', $plugins)){ ?>,
                        extraPlugins: 'uploadimage,image2',
                        // Upload images to a CKFinder connector (note that the response type is set to JSON).
                        uploadUrl: '/Plugins/ckfinder/files/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
        
                        // Configure your file manager integration. This example uses CKFinder 3 for PHP.
                        filebrowserBrowseUrl: '/Plugins/ckfinder/files/ckfinder.html',
                        filebrowserImageBrowseUrl: '/Plugins/ckfinder/files/ckfinder.html?type=Images',
                        filebrowserUploadUrl: '/Plugins/ckfinder/files/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl: '/Plugins/ckfinder/files/core/connector/php/connector.php?command=QuickUpload&type=Images',
        
                        // The following options are not necessary and are used here for presentation purposes only.
                        // They configure the Styles drop-down list and widgets to use classes.
        
                        stylesSet: [
                            { name: 'Narrow image', type: 'widget', widget: 'image', attributes: { 'class': 'image-narrow' } },
                            { name: 'Wide image', type: 'widget', widget: 'image', attributes: { 'class': 'image-wide' } }
                        ],
        
                        // Load the default contents.css file plus customizations for this sample.
                        contentsCss: [ CKEDITOR.basePath + 'contents.css', 'http://sdk.ckeditor.com/samples/assets/css/widgetstyles.css' ],
        
                        // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
                        // resizer (because image size is controlled by widget styles or the image takes maximum
                        // 100% of the editor width).
                        image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right' ],
                        image2_disableResizer: true<?php } ?>,
                        height: 59,
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
	}
?>