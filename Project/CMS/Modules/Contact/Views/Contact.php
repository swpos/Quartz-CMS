<?php
$al_options = $params['contacts'];
$al_show_title = !empty($al_options['show_title']) ? true : false;
$al_show_first_name = !empty($al_options['show_first_name']) ? true : false;
$al_show_last_name = !empty($al_options['show_last_name']) ? true : false;
$al_show_email = !empty($al_options['show_email']) ? true : false;
$al_show_phone = !empty($al_options['show_phone']) ? true : false;
$al_show_postal_code = !empty($al_options['show_postal_code']) ? true : false;
$al_show_city = !empty($al_options['show_city']) ? true : false;
$al_show_states = !empty($al_options['show_state']) ? true : false;
$al_show_country = !empty($al_options['show_country']) ? true : false;
$al_show_daybirth = !empty($al_options['show_daybirth']) ? true : false;
$al_show_monthbirth = !empty($al_options['show_monthbirth']) ? true : false;
$al_show_yearbirth = !empty($al_options['show_yearbirth']) ? true : false;
$al_show_gender = !empty($al_options['show_gender']) ? true : false;
$al_show_content = !empty($al_options['show_content']) ? true : false;

if ($al_show_title): ?>	
    <h2>Contact</h2>
<?php endif; ?>
<div class='form-contact'>
    <form action="/Contact/post_contact" method="post">
    	<div class="row">
        	<input type="hidden" size="30" name="contact[shortcut]" value="<?php echo $page; ?>" />
			<?php if ($al_show_first_name): ?>
                <div class="col-md-6">
                    <p><input type="text" size="30" name="contact[first_name]" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_FIRST_NAME ?>" required="required" /></p>         
                </div>
            <?php endif; ?>
            <?php if ($al_show_last_name): ?>	
                <div class="col-md-6">
                    <p><input type="text" size="30" name="contact[last_name]" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_LAST_NAME ?>" required="required" /></p>
                </div>
            <?php endif; ?>
            <?php if ($al_show_email): ?>
                <div class="col-md-6">
                	<p><input type="text" size="30" name="contact[email]" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_EMAIL ?>" required="required" /></p>
                </div>
            <?php endif; ?>
           	<?php if ($al_show_phone): ?>
            	<div class="col-md-6">	
                	<p><input type="text" size="30" name="contact[phone]" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_PHONE ?>" required="required" /></p>
                </div>
            <?php endif; ?>
            <?php if ($al_show_postal_code): ?>	
              	<div class="col-md-6">
                	<p><input type="text" size="30" name="contact[postal_code]" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_POSTAL_CODE ?>" required="required" /></p>
                </div>
            <?php endif; ?>
          	<?php if ($al_show_city): ?>
            	<div class="col-md-6">
                	<p><input type="text" size="30" name="contact[city]" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_CITY ?>" required="required" /></p>
                </div>
            <?php endif; ?>    
            <?php if ($al_show_states): ?>
                <div class="col-md-6">
                	<p><input type="text" size="30" name="contact[states]" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_STATE ?>" required="required" /></p>
                </div>
            <?php endif; ?>
           	<?php if ($al_show_country): ?>	
                <div class="col-md-6">
                	<p><input type="text" size="30" name="contact[country]" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_COUNTRY ?>" required="required" /></p>
                </div>
            <?php endif; ?>
			<?php if ($al_show_daybirth || $al_show_monthbirth || $al_show_yearbirth): ?>
                <div class="col-md-6">
                	<div class="row">  
                		<div class="col-md-12">
                			<p>* <?php echo CONTACT_MODULE_FORM_BIRTHDAY ?>: </p>
                        </div>
                    </div>
                    <div class="row">  
	                    <?php if ($al_show_daybirth): ?>
                            <div class="col-md-4">
                                <p>
                                    <select name="contact[daybirth]" class="form-control" required="required">
                                        <?php foreach (range(1, 31) as $number): ?>
                                            <option value="<?php echo $number ?>"><?php echo $number ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if ($al_show_monthbirth): ?>
                            <div class="col-md-4">
                                <p>
								   <select name="contact[monthbirth]" class="form-control" required="required">
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
									<select name="contact[yearbirth]" class="form-control" required="required">
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
            <?php if ($al_show_gender): ?>
                <div class="col-md-6">
                    <p>* <?php echo CONTACT_MODULE_FORM_GENDER ?>: </p>
                    <p>   
                        <select name="contact[gender]" class="form-control" required="required">
                            <option value="male" ><?php echo CONTACT_MODULE_FORM_GENDER_MALE ?></option>
                            <option value="female" ><?php echo CONTACT_MODULE_FORM_GENDER_FEMALE ?></option>
                        </select>
                    </p>
               	</div>
            <?php endif; ?>
		</div>
        <div class="row">   
            <?php if ($al_show_content): ?>
            	<div class="col-md-12">
                	<p><textarea name="contact[content]" class="form-control" id="contact<?php echo $category ?>" placeholder="* <?php echo CONTACT_MODULE_FORM_DESCRIPTION ?>" required="required"></textarea></p>
                </div>
            <?php endif; ?>
		</div> 
        <div class="row">
            <div class="col-md-12">
                <p><input type="text" size="30" name="captcha" class="form-control" placeholder="* <?php echo CONTACT_MODULE_FORM_ANTI_BOT ?>" required="required" /></p>
            </div>
        </div>    
        <div class="row">
        	<div class="col-md-12">     
           		<input type="hidden" size="30" name="contact[id_module]" value="<?php echo $category ?>" />
        		<p><button type="submit" name="submit" class="btn btn-default"><?php echo BUTTON_SEND ?></button></p>
        	</div>
         </div>
    </form>
</div>

