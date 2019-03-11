<?php
	function load_comment ($al_connexion, $al_id_module, $al_shortcut, $al_modules){
		$select1=$al_connexion->prepare("SELECT * FROM cms_comments WHERE shortcut = :al_shortcut");
		$select1->bindParam(':al_shortcut', $al_shortcut);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		
		return render(array('al_connexion' => $al_connexion, 'select1' => $select1, 'al_id_module' => $al_id_module, 'al_shortcut' => $al_shortcut, 'al_modules' => $al_modules), 'comment', 'comment');
	}
 
	function post_comments ($al_connexion){
		$al_shortcut = (isset($_POST['shortcut']) ? $_POST['shortcut'] : '');
		$al_content = encoding((isset($_POST['content']) ? $_POST['content'] : ''));
		$al_username = encoding((isset($_POST['username']) ? $_POST['username'] : ''));
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_id_module = encoding((isset($_POST['id_module']) ? $_POST['id_module'] : ''));
		$al_question = encoding((isset($_POST['question']) ? $_POST['question'] : ''));
		$al_date = date('Y-m-d');
		$al_time = date('H:i:s');
		$al_error = array(
			"Message:textarea:fill:30" => $al_content,
			"Username:input:fill:30" => $al_username,
			"Title:input:fill:50" => $al_title,
			"Title:input:maxLength:50" => $al_title
		);
		error_message(true,$al_error);
		
		if(empty($_SESSION['error_message']) && ($al_question=="53")){
			$query = $al_connexion->prepare("INSERT INTO cms_comments (id_module, title, content, date, time, username, shortcut) VALUES (:id_module,:title,:content,:date,:time,:username,:shortcut)");
			$query->execute(
				array(
				':id_module'=>$al_id_module,
				':title'=>$al_title,
				':content'=>$al_content,
				':date'=>$al_date,
				':time'=>$al_time,
				':username'=>$al_username,
				':shortcut'=>$al_shortcut
				)
			);
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	function delete_comment ($al_connexion){
		$al_id = decoding((isset($_GET['id']) ? $_GET['id'] : ''));
		$select1=$al_connexion->prepare("DELETE FROM cms_comments WHERE id = :al_id");
		$select1->bindParam(':al_id', $al_id);
		$select1->execute();
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
?>