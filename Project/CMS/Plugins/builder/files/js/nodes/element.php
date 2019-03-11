<?php
	$width = isset($_POST['width']) ? $_POST['width'] : '';
	$height = isset($_POST['height']) ? $_POST['height'] : '';
	$display = isset($_POST['display']) ? $_POST['display'] : '';
	$padding_top = isset($_POST['padding-top']) ? $_POST['padding-top'] : '';
	$padding_bottom = isset($_POST['padding-bottom']) ? $_POST['padding-bottom'] : '';
	$padding_left = isset($_POST['padding-left']) ? $_POST['padding-left'] : '';
	$padding_right = isset($_POST['padding-right']) ? $_POST['padding-right'] : '';
	$margin_top = isset($_POST['margin-top']) ? $_POST['margin-top'] : '';
	$margin_bottom = isset($_POST['margin-bottom']) ? $_POST['margin-bottom'] : '';
	$margin_left = isset($_POST['margin-left']) ? $_POST['margin-left'] : '';
	$margin_right = isset($_POST['margin-right']) ? $_POST['margin-right'] : '';
	$color = isset($_POST['color']) ? $_POST['color'] : '';
	$text_decoration = isset($_POST['text_decoration']) ? $_POST['text_decoration'] : '';
	$font_size = isset($_POST['font_size']) ? $_POST['font_size'] : '';
	$font_weight = isset($_POST['font_weight']) ? $_POST['font_weight'] : '';
	
	$src = isset($_POST['src']) ? $_POST['src'] : '';
	$href = isset($_POST['href']) ? $_POST['href'] : '';
	$title = isset($_POST['title']) ? $_POST['title'] : '';
	$class = isset($_POST['class']) ? $_POST['class'] : '';
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	
	$content = isset($_POST['editor']) ? $_POST['editor'] : '';
	
	$selected = "selected=\"selected\"";
?>
<button type="button" class="btn btn-primary btn-lg trigger" data-toggle="modal" data-target="#myModal" style="display:none;"></button>
<div class="modal fade" id="myModal" style="z-index: 9998 !important;">
  <div class="modal-dialog" role="document" style="z-index: 9998 !important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Modify element</h4>
      </div>
      <div class="modal-body">
      	<form action="#">
        	<div id="tabs">
                <ul class="nav nav-tabs">
                    <li><a href="#background">Background Style</a></li>
                    <li><a href="#size">Size Style</a></li>
                    <li><a href="#text">Text Style</a></li>
                    <li><a href="#border">Border Style</a></li>
                    <li><a href="#attr">Attributes</a></li>
                    <li><a href="#contentArea">Content</a></li>
                </ul>
                <div class="style box-element" id="background"><h2>Background Style</h2>
                    <table class="table table-striped">
                   		<?php foreach ($_POST as $key => $value){ ?>
                            <?php if(strpos($key, 'background') !== false){ ?>
                                <tr>
                                    <td>
                                        <?php echo $key; ?>
                                    </td>
                                    <td>
                                    	<?php if(strpos($key, 'image') !== false){ ?>
                                        	<select class="form-control selecting-file" data-property="<?php echo $key; ?>" style="width: auto; display:inline-block;">
                                            </select>
                                            <button type="button" class="btn btn-warning refresh-files">Refresh/Load</button>
                                            <button type="button" class="btn btn-warning upload">Browse</button>
                                        <?php } else { ?>
                                        	<input type="text" class="form-control" data-property="<?php echo $key; ?>" value="<?php if(!empty($value)) { echo $value; } ?>" />
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>
                    <p><button type="button" class="btn btn-secondary reset">Reset style</button></p>
                </div>
                <div class="style box-element" id="size"><h2>Size Style</h2>
                    <table class="table table-striped">
                        <tr>
                            <td>
                                Width
                            </td>
                            <td>
                                <input class="form-control" type="text" name="width" data-property="width"  value="<?php if(!empty($width)) { echo $width; } ?>" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                Height
                            </td>
                            <td>
                                <input class="form-control" type="text" name="height" data-property="height"  value="<?php if(!empty($height)) { echo $height; } ?>" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                Display
                            </td>
                            <td>
                                <select class="form-control" name="display" data-property="display">
                                    <option value=""></option>
                                    <option value="inline" <?php if($display == 'inline') { echo $selected; } ?>>inline</option>
                                    <option value="block" <?php if($display == 'block') { echo $selected; } ?>>block</option>
                                    <option value="flex" <?php if($display == 'flex') { echo $selected; } ?>>flex</option>
                                    <option value="inline-block" <?php if($display == 'inline-block') { echo $selected; } ?>>inline-block</option>
                                    <option value="inline-flex" <?php if($display == 'inline-flex') { echo $selected; } ?>>inline-flex</option>
                                    <option value="inline-table" <?php if($display == 'inline-table') { echo $selected; } ?>>inline-table</option>
                                    <option value="list-item" <?php if($display == 'list-item') { echo $selected; } ?>>list-item</option>
                                    <option value="run-in" <?php if($display == 'run-in') { echo $selected; } ?>>run-in</option>
                                    <option value="table" <?php if($display == 'table') { echo $selected; } ?>>table</option>
                                    <option value="table-caption" <?php if($display == 'table-caption') { echo $selected; } ?>>table-caption</option>
                                    <option value="table-column-group" <?php if($display == 'table-column-group') { echo $selected; } ?>>table-column-group</option>
                                    <option value="table-header-group" <?php if($display == 'table-header-group') { echo $selected; } ?>>table-header-group</option>
                                    <option value="table-footer-group" <?php if($display == 'table-footer-group') { echo $selected; } ?>>table-footer-group</option>
                                    <option value="table-row-group" <?php if($display == 'table-row-group') { echo $selected; } ?>>table-row-group</option>
                                    <option value="table-cell" <?php if($display == 'table-cell') { echo $selected; } ?>>table-cell</option>
                                    <option value="table-column" <?php if($display == 'table-column') { echo $selected; } ?>>table-column</option>
                                    <option value="table-row" <?php if($display == 'table-row') { echo $selected; } ?>>table-row</option>
                                    <option value="none" <?php if($display == 'none') { echo $selected; } ?>>none</option>
                                    <option value="initial" <?php if($display == 'initial') { echo $selected; } ?>>initial</option>
                                    <option value="inherit" <?php if($display == 'inherit') { echo $selected; } ?>>inherit</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Padding-Top
                            </td>
                            <td>
                                <input class="form-control" type="text" data-property="padding-top"  value="<?php if(!empty($padding_top)) { echo $padding_top; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Padding-Right
                            </td>
                            <td>
                                <input class="form-control" type="text" data-property="padding-right"  value="<?php if(!empty($padding_right)) { echo $padding_right; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Padding-Bottom
                            </td>
                            <td>
                                <input class="form-control" type="text" data-property="padding-bottom"  value="<?php if(!empty($padding_bottom)) { echo $padding_bottom; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Padding-Left
                            </td>
                            <td>
                                <input class="form-control" type="text" data-property="padding-left"  value="<?php if(!empty($padding_left)) { echo $padding_left; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Margin-Top
                            </td>
                            <td>
                                <input class="form-control" type="text" data-property="margin-top"  value="<?php if(!empty($margin_top)) { echo $margin_top; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Margin-Right
                            </td>
                            <td>
                                <input class="form-control" type="text" data-property="margin-right"  value="<?php if(!empty($margin_right)) { echo $margin_right; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Margin-Bottom
                            </td>
                            <td>
                                <input class="form-control" type="text" data-property="margin-bottom"  value="<?php if(!empty($margin_bottom)) { echo $margin_bottom; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Margin-Left
                            </td>
                            <td>
                                <input class="form-control" type="text" data-property="margin-left"  value="<?php if(!empty($margin_left)) { echo $margin_left; } ?>" />
                            </td>
                        </tr>
                    </table>
                    <p><button type="button" class="btn btn-secondary reset">Reset style</button></p>
                </div>
                <div class="style box-element" id="text"><h2>Text Style</h2>
                	<table class="table table-striped">
                    	<tr>
                            <td>
                                Font-size
                            </td>
                            <td>
                                <input class="form-control" type="text" name="font_size" data-property="font-size"  value="<?php if(!empty($font_size)) { echo $font_size; } ?>" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                Font-Weight
                            </td>
                            <td>
                                <select class="form-control" name="font_weight" data-property="font-weight">
                                    <option value=""></option>
                                    <option value="normal" <?php if($font_weight == 'normal') { echo $selected; } ?>>normal</option>
                                    <option value="bold" <?php if($font_weight == 'bold') { echo $selected; } ?>>bold</option>
                                    <option value="bolder" <?php if($font_weight == 'bolder') { echo $selected; } ?>>bolder</option>
                                    <option value="lighter" <?php if($font_weight == 'lighter') { echo $selected; } ?>>lighter</option>
                                    <option value="initial" <?php if($font_weight == 'initial') { echo $selected; } ?>>initial</option>
                                    <option value="inherit" <?php if($font_weight == 'inherit') { echo $selected; } ?>>inherit</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Color
                            </td>
                            <td>
                                <input type="text" id="cp2" class="form-control colorpicker" name="color" data-color-format="rgba" data-property="color" value="<?php if(!empty($color)) { echo $color; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Text Decoration
                            </td>
                            <td>
                                <select class="form-control" name="text_decoration" data-property="text-decoration">
                                    <option value=""></option>
                                    <option value="none" <?php if($text_decoration == 'none') { echo $selected; } ?>>none</option>
                                    <option value="underline" <?php if($text_decoration == 'underline') { echo $selected; } ?>>underline</option>
                                    <option value="overline" <?php if($text_decoration == 'overline') { echo $selected; } ?>>overline</option>
                                    <option value="line-through" <?php if($text_decoration == 'line-through') { echo $selected; } ?>>line-through</option>
                                    <option value="initial" <?php if($text_decoration == 'initial') { echo $selected; } ?>>initial</option>
                                    <option value="inherit" <?php if($text_decoration == 'inherit') { echo $selected; } ?>>inherit</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <p><button type="button" class="btn btn-secondary reset">Reset style</button></p>
                </div> 
                <div class="style box-element" id="border"><h2>Border Style</h2>
                	<table class="table table-striped">
                    	<?php foreach ($_POST as $key => $value){ ?>
                            <?php if(
										strpos($key, 'border-top') !== false || 
										strpos($key, 'border-bottom') !== false || 
										strpos($key, 'border-right') !== false || 
										strpos($key, 'border-left') !== false 
								){ ?>
                                <tr>
                                    <td>
                                        <?php echo $key; ?>
                                    </td>
                                    <td>
                                    	<input type="text" class="form-control" data-property="<?php echo $key; ?>" value="<?php if(!empty($value)) { echo $value; } ?>" />
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>
                    <p><button type="button" class="btn btn-secondary reset">Reset style</button></p>
                </div>   
                <div class="attr box-element" id="attr"><h2>Attributes</h2>
                    <table class="table table-striped">
                        <tr>
                            <td>
                                Href
                            </td>
                            <td>
                                <input class="form-control" type="text" name="href" data-attribute="href" value="<?php if(!empty($href)) { echo $href; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Title
                            </td>
                            <td>
                                <input class="form-control" type="text" name="title" data-attribute="title" value="<?php if(!empty($title)) { echo $title; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Class
                            </td>
                            <td>
                                <input class="form-control" type="text" name="class" data-attribute="class" value="<?php if(!empty($class)) { echo $class; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ID
                            </td>
                            <td>
                                <input class="form-control" type="text" name="id" data-attribute="id" value="<?php if(!empty($id)) { echo $id; } ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Src
                            </td>
                            <td>
                                <input class="form-control" type="text" name="src" data-attribute="src" value="<?php if(!empty($src)) { echo $src; } ?>" />
                            </td>
                        </tr>
                    </table>
                    <p><button type="button" class="btn btn-secondary reset">Reset style</button></p>
                </div>
                <div class="content box-element" id="contentArea"><h2>Content</h2>
                    <table class="table table-striped">
                        <tr>
                            <td>
                                <textarea class="form-control editor" id="editor" type="text" name="content" data-attribute="content"><?php if(!empty($content)) { echo htmlspecialchars($content, ENT_QUOTES); } ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary reset" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>