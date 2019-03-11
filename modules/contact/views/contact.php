<?php
	if(preg_match('/\{(.*?)\}$/',$al_modules,$al_match2)) {
		if(preg_match('/contacts\{(.*?)\}/',$al_match2[1],$al_match3)) {
			$al_options = explode(':',$al_match3[1]);
			if($al_options[0]=='show_title'){$al_show_title='yes';}else{$al_show_title='no';}
			if($al_options[1]=='show_first_name'){$al_show_first_name='yes';}else{$al_show_first_name='no';}
			if($al_options[2]=='show_last_name'){$al_show_last_name='yes';}else{$al_show_last_name='no';}
			if($al_options[3]=='show_email'){$al_show_email='yes';}else{$al_show_email='no';}
			if($al_options[4]=='show_phone'){$al_show_phone='yes';}else{$al_show_phone='no';}
			if($al_options[5]=='show_postal_code'){$al_show_postal_code='yes';}else{$al_show_postal_code='no';}
			if($al_options[6]=='show_city'){$al_show_city='yes';}else{$al_show_city='no';}
			if($al_options[7]=='show_state'){$al_show_states='yes';}else{$al_show_states='no';}
			if($al_options[8]=='show_country'){$al_show_country='yes';}else{$al_show_country='no';}
			if($al_options[9]=='show_daybirth'){$al_show_daybirth='yes';}else{$al_show_daybirth='no';}
			if($al_options[10]=='show_monthbirth'){$al_show_monthbirth='yes';}else{$al_show_monthbirth='no';}
			if($al_options[11]=='show_yearbirth'){$al_show_yearbirth='yes';}else{$al_show_yearbirth='no';}
			if($al_options[12]=='show_gender'){$al_show_gender='yes';}else{$al_show_gender='no';}
			if($al_options[13]=='show_content'){$al_show_content='yes';}else{$al_show_content='no';}
		}
	}
?>
<?php echo $_SESSION['error_message']; ?>
<?php $_SESSION['error_message'] = ''; ?>
<?php if($al_show_title=='yes'){ ?><h2>Contact</h2><?php } ?>
<div class="form-contact">
    <form action="index.php?action=post_contact" method="post">
    	<div class="row">
        	<input type="hidden" size="30" name="shortcut" value="<?php echo $al_shortcut; ?>" />
			<?php if ($al_show_first_name=='yes'): ?>
				<div class="col-md-6">
                    <p><input type="text" size="30" name="first_name" class="form-control" placeholder="* First Name" /></p>         
                </div>
            <?php endif; ?>
            <?php if ($al_show_last_name=='yes'): ?>
                <div class="col-md-6">
                    <p><input type="text" size="30" name="last_name" class="form-control" placeholder="* Last Name" /></p>
                </div>
            <?php endif; ?>
            <?php if ($al_show_email=='yes'): ?>	
                <div class="col-md-6">
                	<p><input type="text" size="30" name="email" class="form-control" placeholder="* Email" /></p>
                </div>
            <?php endif; ?>
           	<?php if ($al_show_phone=='yes'): ?>
            	<div class="col-md-6">	
                	<p><input type="text" size="30" name="phone" class="form-control" placeholder="* Phone number" /></p>
                </div>
            <?php endif; ?>
            <?php if ($al_show_postal_code=='yes'): ?>
              	<div class="col-md-6">
                	<p><input type="text" size="30" name="postal_code" class="form-control" placeholder="* Postal code" /></p>
                </div>
            <?php endif; ?>
          	<?php if ($al_show_city=='yes'): ?>
            	<div class="col-md-6">
                	<p><input type="text" size="30" name="city" class="form-control" placeholder="* City" /></p>
                </div>
            <?php endif; ?>
            <?php if ($al_show_states=='yes'): ?>
                <div class="col-md-6">
                	<p><input type="text" size="30" name="state" class="form-control" placeholder="* State" /></p>
                </div>
            <?php endif; ?>
           	<?php if ($al_show_country=='yes'):	 ?>
                <div class="col-md-6">
                	<p><input type="text" size="30" name="country" class="form-control" placeholder="* Country" /></p>
                </div>
            <?php endif; ?>
			<?php if ($al_show_daybirth=='yes' || $al_show_monthbirth=='yes' || $al_show_yearbirth=='yes'): ?>
                <div class="col-md-6">
                	<div class="row">  
                		<div class="col-md-12">
                			<p>* Anniversary: </p>
                        </div>
                    </div>
                    <div class="row">
	                    <?php if ($al_show_daybirth=='yes'): ?>
                            <div class="col-md-4">
                                <p>
                                    <select name="daybirth" class="form-control">
                                        <?php foreach (range(1, 31) as $number): ?>
                                            <option value="<?php echo $number ?>"><?php echo $number ?></option>
                                        <?php endforeach; ?>
									</select>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if ($al_show_monthbirth=='yes'): ?>
							<div class="col-md-4">
                                <p>
								   <select name="monthbirth" class="form-control">
                                        <?php foreach (range(1, 12) as $number): ?>
                                            <option value="<?php echo $number ?>" ><?php echo $number ?></option>
                                        <?php endforeach; ?>
								   </select>
                        		</p>
                            </div>
                        <?php endif; ?>
                        <?php if ($al_show_yearbirth == 'yes'): ?>
							<div class="col-md-4">
                                <p>
									<select name="yearbirth" class="form-control">
                                        <?php foreach (range(date('Y'), 1920) as $number): ?>
                                            <option value="<?php echo $number ?>" ><?php echo $number ?></option>
                                        <?php endforeach; ?>
									</select>
                            	</p>
                            </div>
                        <?php endif; ?>
					</div>
                </div>
            <?php endif; ?>
            <?php if ($al_show_gender=='yes'): ?>
				<div class="col-md-6">
                    <p>* Gender: </p>
                    <p>   
                        <select name="gender" class="form-control">
                            <option value="male" >Male</option>
                            <option value="female" >Female</option>
                        </select>
                    </p>
               	</div>
            <?php endif; ?>
		</div>
        <div class="row">
            <?php if ($al_show_content=='yes'): ?>
				<div class="col-md-12">
                	<p><textarea name="content" class="form-control" placeholder="* Description"></textarea></p>
                </div>
            <?php endif; ?>
		</div> 
        <div class="row">
            <div class="col-md-12">
                <p><input type="text" size="30" name="captcha" class="form-control" placeholder="* Captcha: (6 + 10)(-1)" /></p>
            </div>
        </div>    
        <div class="row">
        	<div class="col-md-12">     
           		<input type="hidden" size="30" name="id_module" value="<?php echo $al_id_module ?>" />
        		<p><button type="submit" name="submit" class="btn btn-primary">Send</button></p>
        	</div>
        </div>
    </form>
</div>