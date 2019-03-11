<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>GALLERY</h1>
<div class="row">
	<div class="col-md-2">
        <form action="index.php?page=list_gallery" method="post" id="validator" role="form">
            <div class="well">
                <p>
                    Title: <br />
                    <input type="text" class="form-control" size="20" value="<?php echo (isset($_SESSION['populate']['title_search_gallery']) ? $_SESSION['populate']['title_search_gallery'] : '');  ?>" name="title_search_gallery" />
                </p>
                <p>
                    Title: <br />
                    <select class="chosen-select form-control" name="title_gallery">
                        <option value=""></option>
                        <option value="DESC" <?php if(isset($_SESSION['populate']['title_gallery']) && $_SESSION['populate']['title_gallery']=="DESC"){ ?>selected="selected" <?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['title_gallery']) && $_SESSION['populate']['title_gallery']=="ASC"){ ?>selected="selected" <?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Date: <br />
                    <select class="chosen-select form-control" name="date_gallery">
                        <option value=""></option>
                        <option value="DESC" <?php if(isset($_SESSION['populate']['date_gallery']) && $_SESSION['populate']['date_gallery']=="DESC"){ ?>selected="selected" <?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['date_gallery']) && $_SESSION['populate']['date_gallery']=="ASC"){ ?>selected="selected" <?php } ?>>Ascending</option>
                    </select>
                </p>
                <p>
                    Time: <br />
                    <select class="chosen-select form-control" name="time_gallery">
                        <option value=""></option>		
                        <option value="DESC" <?php if(isset($_SESSION['populate']['time_gallery']) && $_SESSION['populate']['time_gallery']=="DESC"){ ?>selected="selected" <?php } ?>>Descending</option>
                        <option value="ASC" <?php if(isset($_SESSION['populate']['time_gallery']) && $_SESSION['populate']['time_gallery']=="ASC"){ ?>selected="selected" <?php } ?>>Ascending</option>
                    </select>
                </p>
                <p><input type="submit" class="btn btn-primary" size="20" value="Search" name="post_order_gallery" /></p>
            </div>
        </form>
	</div>
	<div class="col-md-10">
        <form action="index.php?page=order_gallery" method="post" id="validator" role="form">
            <table class="table-striped list">
                <tr>
                    <td>Title</td>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Shortcut</td>
                    <td>Id module</td>
                </tr>
        <?php		
                while($al_fetch_gallery = $select1->fetch()){	
                    $al_id=decoding($al_fetch_gallery->id);
                    $al_title=decoding($al_fetch_gallery->title);
                    $al_date=decoding($al_fetch_gallery->date);
                    $al_time=decoding($al_fetch_gallery->time);
                    $al_shortcut=decoding($al_fetch_gallery->shortcut);
                    $al_shortcut=str_replace(':',' ',$al_shortcut);
        ?>
                <tr>
                    <td><a href="index.php?page=list_gallery&action=show&id_gallery=<?php echo $al_id ?>"><?php echo $al_title ?></a></td>
                    <td><?php echo $al_date ?></td>
                    <td><?php echo $al_time ?></td>
                    <td><?php echo $al_shortcut ?></td>
                    <td><?php echo $al_id ?></td>
                </tr>
        <?php
                }
        ?>
            </table>
        </form>
	</div>
</div>
<?php echo pagination($al_init_gallery_rows); ?>