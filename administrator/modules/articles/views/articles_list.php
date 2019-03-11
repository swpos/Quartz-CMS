<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>ARTICLES</h1>
<div class="row">
    <div class="col-md-2">
        <form action="index.php?page=list_article" method="post" id="validator" role="form">
            <div class="well">
                <p>
                    Keyword: <br />
                    <input type="text" class="form-control" size="20" value="<?php echo (isset($_SESSION['populate']['search_article']) ? $_SESSION['populate']['search_article'] : '') ?>" name="search_article" />
                </p>
                <p>
                    Category: <br />
                    <select class="chosen-select form-control" name="category_article">
                        <option value=""></option>
                        <option value="DESC" <?php if(isset($_SESSION['populate']['category_article']) && $_SESSION['populate']['category_article']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['category_article']) && $_SESSION['populate']['category_article']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Date: <br />
                    <select class="chosen-select form-control" name="date_article">
                        <option value=""></option>
                        <option value="DESC" <?php if(isset($_SESSION['populate']['date_article']) && $_SESSION['populate']['date_article']=="DESC"){ ?>selected="selected" <?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['date_article']) && $_SESSION['populate']['date_article']=="ASC"){ ?>selected="selected" <?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Time: <br />
                    <select class="chosen-select form-control" name="time_article">
                        <option value=""></option>		
                        <option value="DESC" <?php if(isset($_SESSION['populate']['time_article']) && $_SESSION['populate']['time_article']=="DESC"){ ?>selected="selected" <?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['time_article']) && $_SESSION['populate']['time_article']=="ASC"){ ?>selected="selected" <?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Order: <br />
                    <select class="chosen-select form-control" name="order_article">
                        <option value=""></option>		
                        <option value="DESC" <?php if(isset($_SESSION['populate']['order_article']) && $_SESSION['populate']['order_article']=="DESC"){ ?>selected="selected" <?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['order_article']) && $_SESSION['populate']['order_article']=="ASC"){ ?>selected="selected" <?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Published: <br />
                    <select class="chosen-select form-control" name="published_article">
                        <option value=""></option>		
                        <option value="yes" <?php if(isset($_SESSION['populate']['published_article']) && $_SESSION['populate']['published_article']=="yes"){ ?>selected="selected" <?php } ?>>Published</option>
                        <option value="no" <?php if(isset($_SESSION['populate']['published_article']) && $_SESSION['populate']['published_article']=="no"){ ?>selected="selected" <?php } ?>>Unpublished</option>
                    </select>
                </p>
                <p><input type="submit" class="btn btn-primary" size="20" value="Search" name="post_order_article" /></p>
            </div>
        </form>
    </div>
	<div class="col-md-10">
        <form action="index.php?page=order_article" method="post" id="validator" role="form">
            <table class="table-striped list">
                <tr>
                    <td>Title</td>
                    <td>Category</td>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Reorder</td>
                    <td>Shortcut</td>
                    <td>Published</td>
                    <td>Delete</td>
                    <td>Id</td>
                </tr>
        <?php
            while($al_fetch_articles = $select1->fetch()){	
                $al_id=decoding($al_fetch_articles->id);
                $al_title=decoding($al_fetch_articles->title);
                $al_category=decoding($al_fetch_articles->category);
                $al_date=decoding($al_fetch_articles->date);
                $al_time=decoding($al_fetch_articles->time);
                $al_order1=decoding($al_fetch_articles->order1);
                $al_publish=decoding($al_fetch_articles->publish);	
                $al_shortcut_multiple=decoding($al_fetch_articles->shortcut);
                $al_shortcut_multiple = explode(":",$al_shortcut_multiple);
                $al_shortcut=decoding($al_fetch_articles->shortcut);
                        
                if($al_publish==1){
                    $enable='Yes';
                    $publishImage="<span class=\"glyphicon glyphicon-ok-circle\"></span>";
                } else {
                    $enable='No'; 
                    $publishImage="<span class=\"glyphicon glyphicon-ban-circle\"></span>";
                }
        ?>		
                <tr>
                    <td><a href="index.php?page=modif_article&id_article=<?php echo $al_id ?>"><?php echo $al_title ?></a></td>
                    <td><?php echo $al_category ?></td>
                    <td><?php echo $al_date ?></td>
                    <td><?php echo $al_time ?></td>
                    <td><input type="text" class="form-control" style="width: 40px;" name="order[<?php echo $al_id ?>]" value="<?php echo $al_order1 ?>" /></td>
                    <td>
                        <?php
                            for($al_i=0; $al_i<count($al_shortcut_multiple); $al_i++){
                        ?>
                                <label class="label label-warning"><?php echo $al_shortcut_multiple[$al_i] ?></label> 
                        <?php
                            }
                        ?>
                    </td>
                    <td><a href="index.php?page=publish_article&id=<?php echo $al_id ?>&state=<?php echo $enable ?>"><?php echo $publishImage ?></a></td>
                    <td><a href="index.php?page=delete_article&id=<?php echo $al_id ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    <td><?php echo $al_id ?></td>
                </tr>
        <?php
                }
        ?>
            </table>
            <input type="submit" class="btn btn-primary" class="reorder" value="Reorder" />
        </form>
	</div>
</div>
<?php echo pagination($al_init_articles_rows); ?>