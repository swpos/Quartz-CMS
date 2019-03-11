<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>ADD MENU MODULE</h1>
<form action="index.php?page=addmodule&action=post_menu" method="post" id="validator" role="form">
    <div class="row">
        <div class="col-md-6">
            <table class="table-striped">
                <tr>
                	<td width="20%">Title</td>
                    <td><input name="title" type="text" class="form-control" size="30" value="<?php echo isset($_SESSION['populate']['title']) ? $_SESSION['populate']['title'] : ''; ?>" /></td>
                </tr>
                <tr>
                    <td width="20%">Type of module</td>
                    <td>Menu</td>
                </tr>
                <tr>
                    <td width="20%">Position</td>
                    <td>
                        <?php echo add_position($al_connexion); ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Section name</td>
                    <td><input name="section" type="text" class="form-control" size="30" value="<?php if(isset($_SESSION['populate']['section'])){ echo $_SESSION['populate']['section']; } ?>" /></td>
                </tr>
                <tr>
                    <td width="20%">Pages affected</td>
                    <td>
                        <?php echo add_shortcut($al_connexion); ?>
                    </td>
                </tr>
			</table>
		</div>
		<div class="col-md-6">
            <table class="table-striped">
                <tr>
                    <td width="20%">Category</td><td></td>
                </tr>
                <tr>
                    <td width="20%">Show Title</td>
                    <td>
                        <select class="chosen-select form-control" name="show_title_category">
                            <option value="show_title">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">	
            <input type="submit" class="btn btn-primary" name="post" value="Add" />
        </div>
    </div>
</form>