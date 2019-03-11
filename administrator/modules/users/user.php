<?php
	function list_user ($al_connexion) {
		$al_search=encoding((isset($_POST['search_user']) ? $_POST['search_user'] : ''));
		$al_username=encoding((isset($_POST['username_user']) ? $_POST['username_user'] : ''));
		$al_first_name_search=encoding((isset($_POST['first_name_search_user']) ? $_POST['first_name_search_user'] : ''));
		$al_first_name=encoding((isset($_POST['first_name_user']) ? $_POST['first_name_user'] : ''));
		$al_last_name_search=encoding((isset($_POST['last_name_search_user']) ? $_POST['last_name_search_user'] : ''));
		$al_last_name=encoding((isset($_POST['last_name_user']) ? $_POST['last_name_user'] : ''));
		$al_email_search=encoding((isset($_POST['email_search_user']) ? $_POST['email_search_user'] : ''));
		$al_email=encoding((isset($_POST['email_user']) ? $_POST['email_user'] : ''));
		$al_post_order=encoding((isset($_POST['post_order_user']) ? $_POST['post_order_user'] : ''));
		$buildQuery = '';

		if($al_search || $al_first_name_search || $al_last_name_search || $al_email_search){	
			$order="WHERE";
			$order1=array();
			if($al_search){
				$order1[].=" username LIKE '%".$al_search."%'";
			}
			if($al_first_name_search){
				$order1[].=" first_name LIKE '%".$al_first_name_search."%'";
			}
			if($al_last_name_search){
				$order1[].=" last_name LIKE '%".$al_last_name_search."%'";
			}
			if($al_email_search){
				$order1[].=" email LIKE '%".$al_email_search."%'";
			}
			$buildQuery.=$order.implode(" AND ",$order1);
		}
	
		if($al_first_name || $al_last_name || $al_email || $al_username){
			$order=	" ORDER BY";
			$order2=array();
			if($al_username){
				$order2[].=" username ".$al_username;
			}
			if($al_first_name){
				$order2[].=" first_name ".$al_first_name;
			}
			if($al_last_name){
				$order2[].=" last_name ".$al_last_name;
			}
			if($al_email){
				$order2[].=" email ".$al_email;
			}
			$buildQuery.=$order.implode(", ",$order2);
		}
		
		if(isset($_POST['post_order_user'])){
			$_SESSION['order_user_query'] = $buildQuery;
		} else {
			$buildQuery = isset($_SESSION['order_user_query']) ? $_SESSION['order_user_query'] : '';
		}
		
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_users $buildQuery LIMIT ".get_pagination());
		$select1->setFetchMode(PDO::FETCH_OBJ);
		
		$select2=$al_connexion->query("SELECT * FROM ".HASH."_users");
		$al_init_users_rows = $select2->rowCount();
		
		return render(array('al_connexion' => $al_connexion, 'select1' => $select1, 'al_init_users_rows' => $al_init_users_rows), 'users', 'users_list');
	}
	
	function update_user ($al_connexion) {
		$al_username = encoding((isset($_POST['username']) ? $_POST['username'] : ''));
		$al_first_name = encoding((isset($_POST['first_name']) ? $_POST['first_name'] : ''));
		$al_last_name = encoding((isset($_POST['last_name']) ? $_POST['last_name'] : ''));
		$al_password = encoding((isset($_POST['password']) ? $_POST['password'] : ''));
		$al_email = encoding((isset($_POST['email']) ? $_POST['email'] : ''));
		$al_gender = encoding((isset($_POST['gender']) ? $_POST['gender'] : ''));
		$al_city = encoding((isset($_POST['city']) ? $_POST['city'] : ''));
		$al_age = encoding((isset($_POST['age']) ? $_POST['age'] : ''));
		$al_about = encoding((isset($_POST['about']) ? $_POST['about'] : ''));
		$al_country = encoding((isset($_POST['country']) ? $_POST['country'] : ''));
		$al_error = array(
			"User:input:fill:30" => $al_username,
			"User:input:noSpecial:30" => $al_username,
			"User:input:maxLength:50" => $al_username,
			"First name:input:fill:30" => $al_first_name,
			"Last name:input:fill:30" => $al_last_name,
			"Email:input:fill:30" => $al_email,
			"Email:input:email:30" => $al_email,
			"City:input:fill:30" => $al_city,
			"Age:input:fill:30" => $al_age,
			"About:textarea:fill:30" => $al_about,
			"Country:input:fill:30" => $al_country
		);
		error_message(true,$al_error);
				
		if(empty($_SESSION['error_message'])){
			$al_password=md5($al_password);
			
			if(isset($_POST['update'])){
				if(isset($_POST['password'])){
					$update_user = $al_connexion->prepare("UPDATE ".HASH."_users SET username=?,password=?,email=?,gender=?,city=?,first_name=?,last_name=?,age=?,about=?,country=? WHERE id=?");
					$update_user->execute(array($al_username,$al_password,$al_email,$al_gender,$al_city,$al_first_name,$al_last_name,$al_age,$al_about,$al_country,$_POST['update']));
				}
				else {
					$update_user = $al_connexion->prepare("UPDATE ".HASH."_users SET username=?,email=?,gender=?,city=?,first_name=?,last_name=?,age=?,about=?,country=? WHERE id=?");
					$update_user->execute(array($al_username,$al_email,$al_gender,$al_city,$al_first_name,$al_last_name,$al_age,$al_about,$al_country,$_POST['update']));
				}
			}
			else {
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_users (username, password, email, gender, ip, city, first_name, last_name, age, about, country) VALUES (:username,:password, :email, :gender, :ip, :city, :first_name, :last_name, :age, :about, :country)");
				$query->execute(
					array(
					':username'=>$al_username,
					':password'=>$al_password,
					':email'=>$al_email,
					':gender'=>$al_gender,
					':ip'=>$_SERVER["REMOTE_ADDR"],
					':city'=>$al_city,
					':first_name'=>$al_first_name,
					':last_name'=>$al_last_name,
					':age'=>$al_age,
					':about'=>$al_about,
					':country'=>$al_country
					)
				);
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	function add_user ($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'users', 'add_user');
	}
	
	function update_user_old ($al_connexion) {
		$al_id=decoding((isset($_GET['id']) ? $_GET['id'] : ''));
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_users WHERE id = :al_id");
		$select1->bindParam(':al_id', $al_id);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_users = $select1->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_users' => $al_fetch_users), 'users', 'modif_user');
	}
	
	function delete_user ($al_connexion) {
		$al_id=encoding((isset($_POST['delete']) ? $_POST['delete'] : ''));
		foreach($al_id as $key => $value){
			if($value != '1'){
				$select1=$al_connexion->prepare("DELETE FROM ".HASH."_users WHERE id='$value'");
				$select1->execute();
			}
		}
		
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
?>