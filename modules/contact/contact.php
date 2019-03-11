<?php
	function load_contact ($al_connexion, $al_id_module, $al_shortcut, $al_modules){
		return render(array('al_connexion' => $al_connexion, 'al_modules' => $al_modules), 'contact', 'contact');
	}

	function post_contact ($al_connexion){
		$error='';
		$al_id_module = (isset($_POST['id_module']) ? $_POST['id_module'] : '');
		if(isset($_POST['first_name'])){ $al_first_name = encoding($_POST['first_name']); if($al_first_name==""){$error.="Please enter a value in the field First name.<br />";} }
		if(isset($_POST['last_name'])){ $al_last_name = encoding($_POST['last_name']); if($al_last_name==""){$error.="Please enter a value in the field Last name.<br />";}}
		if(isset($_POST['email'])){ $al_email = encoding($_POST['email']); if($al_email==""){$error.="Please enter a value in the field Email.<br />";}}
		if(isset($_POST['phone'])){ $al_phone = encoding($_POST['phone']); if($al_phone==""){$error.="Please enter a value in the field Phone.<br />";}}
		if(isset($_POST['postal_code'])){ $al_postal_code = encoding($_POST['postal_code']); if($al_postal_code==""){$error.="Please enter a value in the field Postal Code.<br />";}}
		if(isset($_POST['city'])){ $al_city = encoding($_POST['city']); if($al_city==""){$error.="Please enter a value in the field City.<br />";}}
		if(isset($_POST['state'])){ $al_state = encoding($_POST['state']); if($al_state==""){$error.="Please enter a value in the field State.<br />";}}
		if(isset($_POST['country'])){ $al_country = encoding($_POST['country']); if($al_country==""){$error.="Please enter a value in the field Country.<br />";}}
		if(isset($_POST['daybirth'])){ $al_daybirth = encoding($_POST['daybirth']); if($al_daybirth==""){$error.="Please choose a value for the field Day birth.<br />";}}
		if(isset($_POST['monthbirth'])){ $al_monthbirth = encoding($_POST['monthbirth']); if($al_monthbirth==""){$error.="Please choose a value for the field Month birth.<br />";}}
		if(isset($_POST['yearbirth'])){ $al_yearbirth = encoding($_POST['yearbirth']); if($al_yearbirth==""){$error.="Please choose a value for the field Year birth.<br />";}}
		if(isset($_POST['gender'])){ $al_gender = encoding($_POST['gender']); if($al_gender==""){$error.="Please choose a value for the field Gender.<br />";}}
		if(isset($_POST['content'])){ $al_content = encoding($_POST['content']); if($al_content==""){$error.="Please enter text in the field Description.<br />";}}
		if(isset($_POST['captcha'])){ $al_captcha = strtolower(encoding($_POST['captcha'])); if($al_captcha==""){$error.="Please enter a Captcha.";}}
		
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : ''));
		$al_date = date('Y-m-d');
		$al_time = date('H:i:s');
		
		$_SESSION['error_message'] = $error;
		
		if(empty($error) && $al_captcha=="15"){
			$select1=$al_connexion->query("SELECT * FROM cms_contact_config");
			$select1->setFetchMode(PDO::FETCH_OBJ);
			$al_fetch_contact_config = $select1->fetch();
			$al_send_email_admin = $al_fetch_contact_config->send_email_admin;
			$al_send_complete_mail = $al_fetch_contact_config->send_complete_mail;
			$al_send_users = $al_fetch_contact_config->users;
			$al_send_users_array = explode(',' , $al_send_users);
			
			if($al_send_complete_mail=='yes'){
				$al_content_message="
				First name : ".$al_first_name."
				Last name : ".$al_last_name."
				Email : ".$al_email."
				Phone : ".$al_phone."
				Postal code : ".$al_postal_code."
				City : ".$al_city."
				State : ".$al_state."
				Country : ".$al_country."
				Date of birth : ".$al_daybirth."/".$al_monthbirth."/".$al_yearbirth."
				Gender : ".$al_gender."
				
				MESSAGE : ".$al_content;
			}
			else {
				$al_content_message="
				First name : ".$al_first_name."
				Last name : ".$al_last_name."
				
				MESSAGE : ".$al_content;
			}
			
			if($al_send_email_admin == 'yes') {
				$select2=$al_connexion->query("SELECT * FROM ".HASH."_users WHERE id='1'");
				$select2->setFetchMode(PDO::FETCH_OBJ);
				$al_fetch_contact = $select2->fetch();
				$al_email_webmaster = $al_fetch_contact->email;
				
				$subject = 'Contact Form - '.loadvariable($al_connexion);
				$message = 'A message from the contact form on the website. Here is the content : '.$al_content_message;
				$headers = 'From: '.$al_email."\r\n".
					'Reply-To: '.$al_email."\r\n".
					'X-Mailer: PHP/' . phpversion();
				
				mail($al_email_webmaster, $subject, $message, $headers);
			}
			else {		
				$subject = 'Contact Form - '.loadvariable($al_connexion);
				$message = 'A message from the contact form on the website. Here is the content : '.$al_content_message;
				$headers = 'From: '.$al_email."\r\n".
					'Reply-To: '.$al_email."\r\n".
					'X-Mailer: PHP/' . phpversion();
					
				foreach($al_send_users_array as $email){
					mail($email, $subject, $message, $headers);
				}
			}
			 
			$query = $al_connexion->prepare("INSERT INTO cms_contact (id_module, date, time, first_name, last_name, email, phone, postal_code, city, states, country, daybirth, monthbirth, yearbirth, gender, content, shortcut) VALUES (:id_module,:date,:time,:first_name,:last_name,:email,:phone,:postal_code,:city,:states,:country,:daybirth,:monthbirth, :yearbirth,:gender,:content,:shortcut)");
			$query->execute(
				array(
				':id_module'=>$al_id_module,
				':date'=>$al_date,
				':time'=>$al_time,
				':first_name'=>$al_first_name,
				':last_name'=>$al_last_name,
				':email'=>$al_email,
				':phone'=>$al_phone,
				':postal_code'=>$al_postal_code,
				':city'=>$al_city,
				':states'=>$al_state,
				':country'=>$al_country,
				':daybirth'=>$al_daybirth,
				':monthbirth'=>$al_monthbirth,
				':yearbirth'=>$al_yearbirth,
				':gender'=>$al_gender,
				':content'=>$al_content,
				':shortcut'=>$al_shortcut
				)
			);
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
?>