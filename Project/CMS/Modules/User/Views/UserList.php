<div class="users">
	<?php
		$al_options = $params['user'];
		$al_show_title = !empty($al_options['show_title']) ? true : false;
		$al_show_date = !empty($al_options['show_date']) ? true : false;
		$al_show_time = !empty($al_options['show_time']) ? true : false;
		$al_show_username = !empty($al_options['show_username']) ? true : false;
		$al_show_first_name = !empty($al_options['show_first_name']) ? true : false;
		$al_show_last_name = !empty($al_options['show_last_name']) ? true : false;
		$al_show_email = !empty($al_options['show_email']) ? true : false;
		$al_show_picture = !empty($al_options['show_picture']) ? true : false;
		$al_show_gender = !empty($al_options['show_gender']) ? true : false;
		$al_show_city = !empty($al_options['show_city']) ? true : false;
		$al_show_country = !empty($al_options['show_country']) ? true : false;
		$al_show_age = !empty($al_options['show_age']) ? true : false;
		$al_show_about = !empty($al_options['show_about']) ? true : false;
		
		if ($al_show_title):
		?>
			<h2><?php echo $al_fetch_modules->title ?></h2>
		<?php
		endif;
		if ($al_show_date || $al_show_time):
		?>
			<ul>
				<?php if ($al_show_date): ?>
					<li><?php echo $al_fetch_modules->date ?></li>
				<?php endif; ?>
				<?php if ($al_show_time): ?>
					<li><?php echo $al_fetch_modules->time ?></li>
				<?php endif; ?> 
			</ul>
		<?php
		endif;
		?>
	<?php foreach($v->d_a($al_fetch_users) as $user): ?> 
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-warning" style="margin-bottom: 0px; overflow:hidden;">
                    <?php if ($al_show_picture && !empty($user->picture)): ?>
                    <img src="<?php echo $user->picture ?>" width="150" height="auto" style="float: left; margin: 0px 10px 10px 0px;" />
                    <?php endif; ?>
					<?php if ($al_show_username): ?>
                    <h3><?php echo $user->username ?></h3>
                    <?php endif; ?>
                    <p>
                        <?php if ($al_show_first_name): ?>
                        <?php echo $user->first_name ?>
                        <?php endif; ?>
                        <?php if ($al_show_last_name): ?>
                        <?php echo $user->last_name ?>
                        <?php endif; ?>
                        <br />
                        <?php if ($al_show_email): ?>
                        <?php echo EMAIL ?>: <?php echo $user->email ?><br />
                        <?php endif; ?>
                        <?php if ($al_show_gender): ?>
                        <?php echo GENDER ?>: <?php echo $user->gender ?><br />
                        <?php endif; ?>
                        <?php if ($al_show_age): ?>
                        <?php echo AGE ?>: <?php echo $user->age ?><br />
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-warning" style="margin-bottom: 0px;">
                    <p>
                        <?php if ($al_show_city): ?>
                        <?php echo CITY ?>: <?php echo $user->city ?><br />
                        <?php endif; ?>
                        <?php if ($al_show_country): ?>
                        <?php echo COUNTRY ?>: <?php echo $user->country ?><br />
                        <?php endif; ?>
                        <?php if ($al_show_about): ?>
                        <hr />
                        <?php echo $user->about ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
        <hr />
    <?php endforeach; ?>
</div>