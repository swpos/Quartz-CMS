<?php
	$al_title=decoding($al_fetch_articles->title);
	$al_id=decoding($al_fetch_articles->id);
	$al_username=decoding($al_fetch_articles->username);
	$al_date=decoding($al_fetch_articles->date);
	$al_time=decoding($al_fetch_articles->time);
	$al_category=decoding($al_fetch_articles->category);
	$al_content=decoding_ck($al_fetch_articles->content);
	$al_publish=decoding($al_fetch_articles->publish);
	$al_shortcut=decoding($al_fetch_articles->shortcut);
	$al_modules=decoding($al_fetch_articles->modules);
	$al_shortcut_multiple2=explode(':', decoding($al_fetch_articles->shortcut));
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>

<h1>MODIFY AN ARTICLE</h1>
<form action="index.php?page=modif_article&action=modif&id_article=<?php echo $al_id; ?>" method="post" id="validator" role="form">
	<div class="row">
 	   	<div class="col-md-6">
            <input name="id_module" type="hidden" size="30" value="<?php echo $al_id_module; ?>" />
            <table class="table-striped">
                <tr>
                    <td width="20%">Title</td>
                    <td><input name="title" type="text" class="form-control" size="30" value="<?php echo $al_title; ?>" /></td>
                </tr>
                <tr>
                    <td width="20%">Username</td>
                    <td><?php echo $al_username; ?></td>
                </tr>
                <tr>
                    <td width="20%">Date created</td>
                    <td><?php echo $al_date; ?></td>
                </tr>
                <tr>
                    <td width="20%">Hour created</td>
                    <td><?php echo $al_time; ?></td>
                </tr>
                <tr>
                    <td width="20%">Category</td>
                    <td>
                		<select class="chosen-select form-control" name="category">
							<option value="0">NONE</option>
							<?php
                                $select2=$al_connexion->query("SELECT * FROM ".HASH."_category");
                                $select2->setFetchMode(PDO::FETCH_OBJ);
                            
                                while($al_fetch_category = $select2->fetch()){
                                    $al_category_listing=$al_fetch_category->category;
                                    if($al_category==$al_category_listing){ 
                            ?>
                                        <option value="<?php echo $al_category_listing; ?>" selected="selected"><?php echo $al_category_listing; ?></option>
                            <?php 
                                    } else { 
                            ?>
                                        <option value="<?php echo $al_category_listing; ?>"><?php echo $al_category_listing; ?></option>
                            <?php 
                                    } 
                                } 
                            ?>
						</select>
            		</td>
            	</tr>
                <tr>
                    <td width="20%">Publish</td>
                    <td>
                        <select class="chosen-select form-control" name="publish">
                            <option value="1" <?php if($al_publish=='1'){ ?> selected="selected"<?php } ?>>published</option>
                            <option value="0" <?php if($al_publish=='0'){ ?> selected="selected"<?php } ?>>unpublished</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td width="20%">Pages affected</td>
                    <td>
                    	<?php echo modify_shortcut($al_connexion, $al_shortcut_multiple2); ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table-striped">
            <?php
                if(preg_match('/\{(.*?)\}$/', $al_modules, $al_match2)) {
            ?> 
                <tr>
                    <td width="20%">Article</td>
                    <td></td>
                </tr>
            <?php
                    if(preg_match('/article\{(.*?)\}/',$al_match2[1],$al_match3)) {	
                        $al_options2 = explode(':',$al_match3[1]);
            ?>
                <tr>
                    <td width="20%">Show title</td>
                    <td>
                        <select class="chosen-select form-control" name="show_title">
                            <option value="show_title" <?php if($al_options2[0] == 'show_title'){ ?> selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[0] == '0'){ ?> selected="selected"<?php } ?>>Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show description</td>
                    <td>
                        <select class="chosen-select form-control" name="show_description">
                            <option value="show_description" <?php if($al_options2[1] == 'show_description'){  ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[1] == '0'){  ?>selected="selected" <?php } ?>>Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show username</td>
                    <td>
                        <select class="chosen-select form-control" name="show_username">
                            <option value="show_username" <?php if($al_options2[2] == 'show_username'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[2] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show time</td>
                    <td>
                        <select class="chosen-select form-control" name="show_time">
                            <option value="show_time" <?php if($al_options2[3] == 'show_time'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[3] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show Date</td>
                    <td>
                        <select class="chosen-select form-control" name="show_date">
                            <option value="show_date" <?php if($al_options2[4] == 'show_date'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[4] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
                    </td>
                </tr>
            <?php 
                    }	
                }
            ?>
            </table>
            <textarea cols="80" id="editor" name="value" rows="10"><?php echo $al_content; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" value="Modify" />
        </div>
    </div>
</form>