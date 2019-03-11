<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>MODULES</h1>
<div class="row">
	<div class="col-md-2">
        <form action="index.php" method="post" id="validator" role="form">
            <div class="well">
                <p>
                    Keyword: <br />
                    <input type="text" class="form-control" size="12" value="<?php echo (isset($_SESSION['populate']['search_module']) ? $_SESSION['populate']['search_module'] : '') ?>" name="search_module" />
                </p>
                <p>
                    Category: <br />
                    <select class="chosen-select form-control" name="category_module">
                        <option value=""></option>
                        <option value="DESC" <?php if(isset($_SESSION['populate']['category_module']) && $_SESSION['populate']['category_module']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['category_module']) && $_SESSION['populate']['category_module']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Type: <br />
                    <select class="chosen-select form-control" name="type_module">
                        <option value=""></option>
                        <option value="type_menu" <?php if(isset($_SESSION['populate']['type_module']) && $_SESSION['populate']['type_module']=="type_menu"){ ?>selected="selected"<?php } ?>>Menu</option>
                        <option value="type_article" <?php if(isset($_SESSION['populate']['type_module']) && $_SESSION['populate']['type_module']=="type_article"){ ?>selected="selected"<?php } ?>>Article</option>
                        <?php
                            $select3=$al_connexion->query("SELECT * FROM ".HASH."_plugins");
                            $select3->setFetchMode(PDO::FETCH_OBJ);
                            while($row = $select3->fetch()){
                                $extension = $row->content;
                                $title = $row->title;
                                $extension_full="type_".$extension;
                        ?>
                            <option value="<?php echo $extension_full ?>" <?php if(isset($_SESSION['populate']['type_module']) && $_SESSION['populate']['type_module'] == $extension_full){ ?>selected="selected"<?php } ?>><?php echo $title ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </p>
                <p>
                    Date: <br />
                    <select class="chosen-select form-control" name="date_module">
                        <option value=""></option>
                        <option value="DESC" <?php if(isset($_SESSION['populate']['date_module']) && $_SESSION['populate']['date_module']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['date_module']) && $_SESSION['populate']['date_module']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Time: <br />
                    <select class="chosen-select form-control" name="time_module">
                        <option value=""></option>		
                        <option value="DESC" <?php if(isset($_SESSION['populate']['time_module']) && $_SESSION['populate']['time_module']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['time_module']) && $_SESSION['populate']['time_module']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Order: <br />
                    <select class="chosen-select form-control" name="order_module">
                        <option value=""></option>		
                        <option value="DESC" <?php if(isset($_SESSION['populate']['order_module']) && $_SESSION['populate']['order_module']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['order_module']) && $_SESSION['populate']['order_module']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Position: <br />
                    <select class="chosen-select form-control" name="position_module">
                        <option value=""></option>		
                        <option value="DESC" <?php if(isset($_SESSION['populate']['position_module']) && $_SESSION['populate']['position_module']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['position_module']) && $_SESSION['populate']['position_module']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Position type: <br />
                    <select class="chosen-select form-control" name="position_type_module">
                        <option value=""></option>
                        <?php 
                            include('../templates/'.loaddefaulttemplate($al_connexion).'/information.php');
                            foreach($al_position as $key => $value){
                        ?>
                            <option value="<?php echo $value ?>" <?php if(isset($_SESSION['populate']['position_type_module']) && $_SESSION['populate']['position_type_module']==$value){ ?>selected="selected"<?php } ?>><?php echo $value ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </p>	
                <p>
                    Published: <br />
                    <select class="chosen-select form-control" name="published_module">
                        <option value=""></option>		
                        <option value="yes" <?php if(isset($_SESSION['populate']['published_module']) && $_SESSION['populate']['published_module']=="yes"){ ?>selected="selected"<?php } ?>>Published</option>
                        <option value="no" <?php if(isset($_SESSION['populate']['published_module']) && $_SESSION['populate']['published_module']=="no"){ ?>selected="selected"<?php } ?>>Unpublished</option>
                    </select>
                <p>
                <p><input type="submit" class="btn btn-primary" size="20" value="Search" name="post_order_module" /><p>
            </div>
        </form>
	</div>
    <div class="col-md-10">
        <form action="index.php?page=order_module" method="post" id="validator" role="form">
            <table class="table-striped list">
                <tr>
                    <td>Category/Title</td>
                    <td>Type</td>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Order</td>
                    <td>Position</td>
                    <td>Shortcut</td>
                    <td>Published</td>
                    <td>Delete</td>
                    <td>Id</td>
                </tr>
        <?php
                while($al_fetch_modules = $select1->fetch()){
                    $al_id=decoding($al_fetch_modules->id);
                    $al_category=decoding($al_fetch_modules->category);
                    $al_modules=decoding($al_fetch_modules->modules);
                    $al_position=decoding($al_fetch_modules->position);
                    $al_date=decoding($al_fetch_modules->date);
                    $al_time=decoding($al_fetch_modules->time);
                    $al_order1=decoding($al_fetch_modules->order1);
                    $al_title=decoding($al_fetch_modules->title);
                    $al_published=decoding($al_fetch_modules->published);
                    if($al_published=='1'){
                        $al_published='Yes';
                        $publishImage="<span class=\"glyphicon glyphicon-ok-circle\"></span>";
                    } else {
                        $al_published='No'; 
                        $publishImage="<span class=\"glyphicon glyphicon-ban-circle\"></span>";
                    }
                    $al_shortcut_multiple=decoding($al_fetch_modules->shortcut);
                    $al_shortcut_multiple = explode(":",$al_shortcut_multiple);
                    preg_match('/\{type_(.*?)\{/', $al_modules, $al_match);
                    $al_type=$al_match[1];
                    $al_shortcut=$al_match[1];
                    if(($al_position!='') && ($al_title != "hidden") && ($al_id != 1)){
        ?>
                <tr>
                    <td><a href="index.php?page=<?php echo $al_shortcut ?>&id=<?php echo $al_id ?>"><?php echo $al_category ?></a></td>
                    <td><?php echo $al_type ?></td>
                    <td><?php echo $al_date ?></td>
                    <td><?php echo $al_time ?></td>
                    <td><input type="text" class="form-control" style="width: 40px;" value="<?php echo $al_order1 ?>" name="order[<?php echo $al_id ?>]" /></td>
                    <td><?php echo $al_position ?></td>
                    <td>
						<?php
                            for($al_i=0; $al_i<count($al_shortcut_multiple); $al_i++){
                        ?>
                                <label class="label label-warning"><?php echo $al_shortcut_multiple[$al_i] ?></label> 
                        <?php
                            }
                        ?>
                    </td>
                    <td><a href="index.php?page=publish_module&id=<?php echo $al_id ?>&state=<?php echo $al_published ?>"><?php echo $publishImage ?></a></td>
                    <td><a href="index.php?page=delete_module&action=delete&id=<?php echo $al_id ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    <td><?php echo $al_id ?></td>
                </tr>
        <?php
                    }
                }
        ?>
            </table>
            <input type="submit" class="btn btn-primary" class="reorder" value="Reorder" />
        </form>
	</div>
</div>        
<?php echo pagination($al_init_modules_rows); ?>