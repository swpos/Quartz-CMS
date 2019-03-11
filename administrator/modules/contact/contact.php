<?php
	function contact_addmodule($al_connexion) {	
		return render(array('al_connexion' => $al_connexion), 'contact', 'add_module');
	}
	
	function post_contact_addmodule ($al_connexion) {
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		
		$al_show_title= encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_show_first_name= encoding((isset($_POST['show_first_name']) ? $_POST['show_first_name'] : ''));
		$al_show_last_name= encoding((isset($_POST['show_last_name']) ? $_POST['show_last_name'] : ''));
		$al_show_email = encoding((isset($_POST['show_email']) ? $_POST['show_email'] : ''));
		$al_show_phone= encoding((isset($_POST['show_phone']) ? $_POST['show_phone'] : ''));
		$al_show_postal_code= encoding((isset($_POST['show_postal_code']) ? $_POST['show_postal_code'] : ''));
		$al_show_city= encoding((isset($_POST['show_city']) ? $_POST['show_city'] : ''));
		$al_show_state= encoding((isset($_POST['show_state']) ? $_POST['show_state'] : ''));
		$al_show_country= encoding((isset($_POST['show_country']) ? $_POST['show_country'] : ''));
		$al_show_daybirth= encoding((isset($_POST['show_daybirth']) ? $_POST['show_daybirth'] : ''));
		$al_show_monthbirth= encoding((isset($_POST['show_monthbirth']) ? $_POST['show_monthbirth'] : ''));
		$al_show_yearbirth= encoding((isset($_POST['show_yearbirth']) ? $_POST['show_yearbirth'] : ''));
		$al_show_gender= encoding((isset($_POST['show_gender']) ? $_POST['show_gender'] : ''));
		$al_show_content= encoding((isset($_POST['show_content']) ? $_POST['show_content'] : ''));
		
		$al_prepare_module_content="{type_contact{contacts{".
		$al_show_title.":".
		$al_show_first_name.":".
		$al_show_last_name.":".
		$al_show_email.":".
		$al_show_phone.":".
		$al_show_postal_code.":".
		$al_show_city.":".
		$al_show_state.":".
		$al_show_country.":".
		$al_show_daybirth.":".
		$al_show_monthbirth.":".
		$al_show_yearbirth.":".
		$al_show_gender.":".
		$al_show_content.":}}}";
		
		$al_error = array(
			"Position:input:fill:30" => $al_position,
			"Shortcut:input:fill:30" => $al_shortcut,
			"Title:input:fill:30" => $al_title,
		);
		error_message(true, $al_error);
		
		if (empty($_SESSION['error_message'])){
			$select1=$al_connexion->prepare("SELECT category FROM ".HASH."_modules WHERE title = :al_title");
			$select1->bindParam(':al_title', $al_title);
			$select1->execute();
			$al_fetch_modules = $select1->rowCount();
			if(($al_fetch_modules < 0) || ($al_fetch_modules == 0)){
				$al_date=date('Y-m-d');
				$al_time=date('H:i:s');
				
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_modules (title, category, modules, order1, date, time, shortcut, position, published) VALUES (:title,:category,:modules,:order1,:date,:time,:shortcut,:position,:published)");
				$query->execute(
					array(
					':title'=>$al_title,
					':category'=>format_link($al_title),
					':modules'=>$al_prepare_module_content,
					':order1'=>'1',
					':date'=>$al_date,
					':time'=>$al_time,
					':shortcut'=>$al_shortcut,
					':position'=>$al_position,
					':published'=>'0'
					)
				);
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}

	function contact ($al_connexion) {
		$al_id_module=(isset($_GET['id']) ? $_GET['id'] : '');
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id_module");
		$select1->bindParam(':al_id_module', $al_id_module);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_modules = $select1->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_modules' => $al_fetch_modules, 'al_id_module' => $al_id_module), 'contact', 'edit_module');
	}

	function post_contact ($al_connexion) {
		$al_id = (isset($_GET['id']) ? $_GET['id'] : '');
		$al_content_display = '';
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		$al_category = encoding((isset($_POST['category']) ? $_POST['category'] : ''));
		$al_show_title= encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_show_first_name= encoding((isset($_POST['show_first_name']) ? $_POST['show_first_name'] : ''));
		$al_show_last_name= encoding((isset($_POST['show_last_name']) ? $_POST['show_last_name'] : ''));
		$al_show_email = encoding((isset($_POST['show_email']) ? $_POST['show_email'] : ''));
		$al_show_phone= encoding((isset($_POST['show_phone']) ? $_POST['show_phone'] : ''));
		$al_show_postal_code= encoding((isset($_POST['show_postal_code']) ? $_POST['show_postal_code'] : ''));
		$al_show_city= encoding((isset($_POST['show_city']) ? $_POST['show_city'] : ''));
		$al_show_state= encoding((isset($_POST['show_state']) ? $_POST['show_state'] : ''));
		$al_show_country= encoding((isset($_POST['show_country']) ? $_POST['show_country'] : ''));
		$al_show_daybirth= encoding((isset($_POST['show_daybirth']) ? $_POST['show_daybirth'] : ''));
		$al_show_monthbirth= encoding((isset($_POST['show_monthbirth']) ? $_POST['show_monthbirth'] : ''));
		$al_show_yearbirth= encoding((isset($_POST['show_yearbirth']) ? $_POST['show_yearbirth'] : ''));
		$al_show_gender= encoding((isset($_POST['show_gender']) ? $_POST['show_gender'] : ''));
		$al_show_content= encoding((isset($_POST['show_content']) ? $_POST['show_content'] : ''));
		$al_prepare_module_content="{type_contact{contacts{".
		$al_show_title.":".
		$al_show_first_name.":".
		$al_show_last_name.":".
		$al_show_email.":".
		$al_show_phone.":".
		$al_show_postal_code.":".
		$al_show_city.":".
		$al_show_state.":".
		$al_show_country.":".
		$al_show_daybirth.":".
		$al_show_monthbirth.":".
		$al_show_yearbirth.":".
		$al_show_gender.":".
		$al_show_content.":}}}";
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Position:input:fill:30" => $al_position,
			"Shortcut:input:fill:30" => $al_shortcut
		);
		error_message(true, $al_error);

		if (empty($_SESSION['error_message'])){
			$update_contact = $al_connexion->prepare("UPDATE ".HASH."_category SET category=? WHERE category=?");
			$update_contact->execute(array(format_link($al_title),$al_category));
			$update_contact = $al_connexion->prepare("UPDATE ".HASH."_modules SET modules=?, shortcut=?, category=?, title=?, position=? WHERE id=?");
			$update_contact->execute(
				array(
					$al_prepare_module_content,
					$al_shortcut,
					format_link($al_title),
					$al_title,
					$al_position,
					$al_id
				)
			);
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}

	function post_admin_list_contact ($al_connexion) {
		$al_send_email_admin= encoding((isset($_POST['send_email_admin']) ? $_POST['send_email_admin'] : ''));
		$al_send_complete_email= encoding((isset($_POST['send_complete_email']) ? $_POST['send_complete_email'] : ''));
		$al_email_user= encoding((isset($_POST['email_user']) ? $_POST['email_user'] : ''));
		
		if($al_send_email_admin){
			$update_contact = $al_connexion->prepare("UPDATE cms_contact_config SET send_email_admin=? WHERE id=?");
			$update_contact->execute(array($al_send_email_admin,'1'));
		}
		if($al_send_complete_email){
			$update_contact = $al_connexion->prepare("UPDATE cms_contact_config SET send_complete_mail=? WHERE id=?");
			$update_contact->execute(array($al_send_complete_email,'1'));
		}
		$update_contact = $al_connexion->prepare("UPDATE cms_contact_config SET users=? WHERE id=?");
		$update_contact->execute(array(trim($al_email_user),'1'));
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}

	function list_contact ($al_connexion) {
		$select1=$al_connexion->query("SELECT * FROM cms_contact_config");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_contact_config = $select1->fetch();
		
		$al_email_search=encoding((isset($_POST['email_search_contact']) ? $_POST['email_search_contact'] : ''));
		$al_gender=encoding((isset($_POST['gender_contact']) ? $_POST['gender_contact'] : ''));
		$al_email=encoding((isset($_POST['email_contact']) ? $_POST['email_contact'] : ''));
		$al_first_name=encoding((isset($_POST['first_name_contact']) ? $_POST['first_name_contact'] : ''));
		$al_last_name=encoding((isset($_POST['last_name_contact']) ? $_POST['last_name_contact'] : ''));
		$al_date=encoding((isset($_POST['date_contact']) ? $_POST['date_contact'] : ''));
		$al_time=encoding((isset($_POST['time_contact']) ? $_POST['time_contact'] : ''));
		$al_phone=encoding((isset($_POST['phone_contact']) ? $_POST['phone_contact'] : ''));
		$al_post_order=encoding((isset($_POST['post_order_contact']) ? $_POST['post_order_contact'] : ''));
		$buildQuery = '';
		
		if($al_gender || $al_email_search){	
			$order="WHERE";
			$order1=array();
			
			if($al_gender){
				$order1[].=" gender LIKE '%".$al_gender."%'";
			}
			if($al_email_search){
				$order1[].=" email LIKE '%".$al_email_search."%'";
			}
			$buildQuery.=$order.implode(" AND ",$order1);
		}
	
		if($al_email || $al_first_name || $al_last_name || $al_phone){
			$order=	" ORDER BY";
			$order2=array();
			if($al_email){
				$order2[].=" email ".$al_email;
			}
			if($al_first_name){
				$order2[].=" first_name ".$al_first_name;
			}
			if($al_last_name){
				$order2[].=" last_name ".$al_last_name;
			}
			if($al_phone){
				$order2[].=" phone ".$al_phone;
			}
			if($al_date){
				$order2[].=" date ".$al_date;
			}
			if($al_time){
				$order2[].=" time ".$al_time;
			}
			$buildQuery.=$order.implode(", ",$order2);
		}
		if(isset($_POST['post_order_contact'])){
			$_SESSION['order_contact_query'] = $buildQuery;
		} else {
			$buildQuery = isset($_SESSION['order_contact_query']) ? $_SESSION['order_contact_query'] : '';
		}	
		
		$select1=$al_connexion->query("SELECT * FROM cms_contact $buildQuery LIMIT ".get_pagination());
		$select1->setFetchMode(PDO::FETCH_OBJ);
		
		$select2=$al_connexion->query("SELECT * FROM cms_contact");
		$al_init_contact_rows = $select2->rowCount();
		
		return render(array('al_connexion' => $al_connexion, 'select1' => $select1, 'al_init_contact_rows' => $al_init_contact_rows, 'al_fetch_contact_config' => $al_fetch_contact_config), 'contact', 'contacts_list');
	}
	
	function show_list_contact ($al_connexion) {
		$al_id=encoding((isset($_GET['id_contact']) ? $_GET['id_contact'] : ''));
		$select1=$al_connexion->prepare("SELECT * FROM cms_contact WHERE id = :al_id");
		$select1->bindParam(':al_id', $al_id);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_contact = $select1->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_contact' => $al_fetch_contact), 'contact', 'show_contact');
	}
	
	function delete_list_contact ($al_connexion) {
		$al_id=encoding((isset($_GET['id_contact']) ? $_GET['id_contact'] : ''));
		$select1=$al_connexion->prepare("DELETE FROM cms_contact WHERE id='$al_id'");
		$select1->execute();
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
?>