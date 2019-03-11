<?php echo $top_menu; ?>
<h1><?php echo CHOOSE_PAGE_OF_MENU ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Menu&action=menu_edit_section_update&id_section=<?php echo $al_fetch_section_name1->id; ?>" method="post">
    <div class='row'>
        <div class='col-md-12'>
            <div class="row">
				<div class="col-md-1">
					<h4 style="margin-top:5px;"><?php echo CHOOSE_PAGE_OF_MENU_SECTION ?></h4>
				</div>
				<div class="col-md-11">
					<p><input name='title' type='text' size='30' value='<?php echo $al_fetch_section_name1->section; ?>' /></p>
				</div>
			</div>
			<div class="row">
				<?php foreach ($v->d_a($al_fetch_link_menu) as $al_fetch_link_menu) { ?>
					<div class="col-md-2">
						<div class="panel panel-<?php if($al_fetch_link_menu->id_index == $al_fetch_section_name->id){echo "success";} else{ echo "danger";} ?>">
							<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo $al_fetch_link_menu->name; ?></h2></div>
							<div class="panel-body">
								<?php if ($al_fetch_link_menu->id_index == $al_fetch_section_name->id) { ?>
									<input type='checkbox' name='shortcut[]' value='<?php echo $al_fetch_link_menu->id; ?>' checked='checked' />  
								<?php } else { ?>
									<input type='checkbox' name='shortcut[]' value='<?php echo $al_fetch_link_menu->id; ?>' />  
								<?php } ?>
								<?php echo CHOOSE_PAGE_OF_MENU_ALIAS ?> : 
								<?php echo $al_fetch_link_menu->shortcut; ?>
							</div>
						</div>
					</div>		
				<?php }	?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="submit" name="post" value="<?php echo BUTTON_MODIFY ?>" />
				</div>
			</div>
    	</div>
    </div>
</form>