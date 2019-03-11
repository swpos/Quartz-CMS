<?php if (!empty($_SESSION['pseudom'])) { ?>
    <p><?php echo LOGIN_WELCOME ?> <?php echo $_SESSION['pseudom']; ?></p>
    <p><a href='index.php?page=Login&action=login_disconnect'><?php echo LOGIN_DISCONNECT ?></a></p>
    <p><a href='index.php'><?php echo LOGIN_ADMINISTRATOR ?></a></p>
<?php } else { ?>
    <form name='form1' id='connexion' method='post' action='index.php?page=Login&action=login_connexion_update'>
        <h1><?php echo LOGIN_CONNECTION ?></h1>
        <p><?php echo LOGIN_USERNAME ?> : <input type='text'  name='username' size='15'/></p> 
        <p><?php echo LOGIN_PASSWORD ?> : <input type='password' name='password' size='15'/></p> 
        <input type='submit' name='Submit' value='<?php echo BUTTON_CONNECTION ?>' />
        <?php if($regis_link == 1){ ?><p><a href="index.php?page=User&action=user_add_user"><?php echo REGISTER ?></a></p><?php } ?>
    </form>
<?php } ?>