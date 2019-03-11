<?php echo $top_menu; ?>
<?php echo $error; ?>
<h1><?php echo MENU_LIST ?></h1>
<div class='row'>
    <div class='col-md-12'>
		<div class="row">
			<?php
				if ($al_fetch_modules) {
				foreach ($v->d_a($al_fetch_modules) as $al_fetch_module) {
					$al_fetch_section_names = $system_shortcut->get_section($al_fetch_module->id); ?>
						<?php foreach ($v->d_a($al_fetch_section_names) as $al_fetch_section_name) { ?>
							<div class="col-md-6">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h2 class="panel-title" align="center">
											<a href='index.php?page=Menu&action=menu_edit_section&id=<?php echo $al_fetch_module->id ?>&id_section=<?php echo $al_fetch_section_name->id ?>&id_module=<?php echo $al_fetch_module->id ?>'><?php echo $al_fetch_section_name->section ?></a>
										</h2>
									</div>
									<div class="panel-body">
										<table class="table-info list table-striped">
											<thead>
												<tr>
													<th><?php echo MENU_LIST_TITLE ?></th>
													<th><?php echo MENU_LIST_ALIAS ?></th>
													<th><?php echo MENU_LIST_DELETE ?></th>
													<th><?php echo MENU_LIST_PUBLISH ?></th>
												</tr>
											</thead>
									
											<tfoot>
												<tr>
													<th><?php echo MENU_LIST_TITLE ?></th>
													<th><?php echo MENU_LIST_ALIAS ?></th>
													<th><?php echo MENU_LIST_DELETE ?></th>
													<th><?php echo MENU_LIST_PUBLISH ?></th>
												</tr>
											</tfoot>
											<tbody>
												<?php
												$al_fetch_link_menus = $system_shortcut->get_links($al_fetch_section_name->id);
												foreach ($v->d_a($al_fetch_link_menus) as $al_fetch_link_menu) {
												?>
													<tr>
														<td>
															<span class="label label-<?php if($al_fetch_link_menu->published == 1){echo "success";} else{ echo "danger";} ?>"><a href="index.php?page=Menu&action=menu_listed_menu_link&id=<?php echo $al_fetch_module->id ?>&id_link=<?php echo $al_fetch_link_menu->id ?>" style="color:#FFFFFF;"><?php echo $al_fetch_link_menu->name ?></a></span>
														</td>
														<td>
															<?php echo $al_fetch_link_menu->shortcut ?>
														</td>
														<td>
															<a title="Delete" href="index.php?page=Menu&action=menu_delete_link&id_link=<?php echo $al_fetch_link_menu->id ?>"><span class="icon glyphicon glyphicon-remove"></span></a>
														</td>
														<td>
															<a title="Published/Unpublished" href='index.php?page=Menu&action=menu_unpublish_link&id_link=<?php echo $al_fetch_link_menu->id ?>&state=<?php echo $al_fetch_link_menu->published ?>'>
																<?php if ($al_fetch_link_menu->published == 1) { ?>
																	<span class='icon glyphicon glyphicon-ok-circle'></span>
																<?php } else { ?>
																	<span class='icon glyphicon glyphicon-ban-circle'></span>
																<?php } ?>
															</a>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>	
						<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>
    </div>
</div>