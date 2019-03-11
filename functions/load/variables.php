<?php
	function loadvariable ($al_connexion){
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_config");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_title = $select1->fetch();
		$al_title_page = $al_fetch_title->title;
		return $al_title_page;
	}
	
	function loadtemplatetitle($al_connexion) {
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_template WHERE active='1' AND admin='0'");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_template = $select1->fetch();
		$al_title_template=$al_fetch_template->title;
		return $al_title_template;
	}
	
	function loadtitle($al_connexion,$al_title_page){
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_link_menu WHERE shortcut = :al_title_page");
		$select1->bindParam(':al_title_page', $al_title_page);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_title_article = $select1->fetch();

		$al_title_page = !empty($al_fetch_title_article->name) ? $al_fetch_title_article->name : '';
		return $al_title_page;
	}

	function security (){
		if(empty($_SESSION['pseudom'])){
			die('Not enough permission');
		}
	}
	
	function ifpause ($al_connexion){
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_config");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_title = $select1->fetch();
		$al_title_page = $al_fetch_title->pause;
		if($al_title_page=='1'){
			return true;
		}
		else {
			return false;
		}
	}
	
	function error_message($al_storing, $al_array) {
		$_SESSION['error_message']='';
		
		foreach($al_array as $al_key => $al_value){
			$al_error='';
			$al_key = explode(':',$al_key);
			$al_name=$al_key[0];
			$al_type=$al_key[1];
			$al_validation=$al_key[2];
			$al_length=$al_key[3];
			// INPUT
			// VALIDATION 
			// email,fill,noSpecial,maxLength,minLength
			if($al_type=="input"){
				if($al_validation=="email"){
					if(!filter_var($al_value, FILTER_VALIDATE_EMAIL)){
						$al_error.="Please enter a valid email adress ! (Field ".$al_name.")<br />";
					}	
				}
				
				if($al_validation=="fill"){
					if(empty($al_value)){
						$al_error.="Please enter a value ! (Field ".$al_name.")<br />";
					}
				}
				
				if($al_validation=="noSpecial"){
					if(!preg_match("/[A-Za-z, :,0-9]/", $al_value)){
						$al_error.="Specials caracters are forbidden ! (Field ".$al_name.")<br />";
					}
				}
				
				if($al_validation=="maxLength"){
					if(strlen($al_value) > $al_length){
						$al_error.="The maximum length of the field have been reached ! (Field ".$al_name.")<br />";
					}
				}
				
				if($al_validation=="minLength"){
					if(strlen($al_value) < $al_length){
						$al_error.="The minimal length of the field have been reached ! (Field ".$al_name.")<br />";
					}
				}
			}
			// TEXTAREA
			// VALIDATION 
			// fill,maxLength,minLength
			if($al_type=="textarea"){
				
				if($al_validation=="fill"){
					if(empty($al_value)){
						$al_error.="Please enter a value ! (Field ".$al_name.")<br />";
					}
				}
				
				if($al_validation=="maxLength"){
					if(strlen($al_value) > $al_length){
						$al_error.="The maximum length of the field have been reached ! (Field ".$al_name.")<br />";
					}
				}
				
				if($al_validation=="minLength"){
					if(strlen($al_value) < $al_length){
						$al_error.="The minimal length of the field have been reached ! (Field ".$al_name.")<br />";
					}
				}
			}
			
			// SELECT
			// VALIDATION 
			// select
			if($al_type=="select"){
				if($al_validation=="select"){
					if($al_value=='defaut' || $al_value=='0' || $al_value=='' || $al_value=='00'){
						$al_error.="Please choose an option from the select menu ! (Field ".$al_name.")<br />";
					}
				}
			}
			// RADIO
			// VALIDATION 
			// check,defaut
			if($al_type=="radio"){
				if($al_validation=="check"){
					if(empty($al_value)){
						$al_error.="Please choose an option ! (Field ".$al_name.")<br />";
					}
					
					if($al_value=="defaut"){
						$al_error.="Please choose an option else than the default one ! (Field ".$al_name.")<br />";
					}
				}
			}
			// CHECKBOX
			// VALIDATION 
			// check
			if($al_type=="checkbox"){
				if($al_validation=="check"){
					if(empty($al_value)){
						$al_error.="Please choose an option ! (Field ".$al_name.")<br />";
					}
				}
			}
		}
		if($al_storing==true){
			$_SESSION['error_message'] = $al_error;
		}
		else {
			return $al_error;
		}
	}
	
	/*encoding*/
	
	function utf8DecodeEncodeArray($array, $decodeEncode) {
		$utf8DecodedEncodeArray = array();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$utf8DecodedEncodeArray[$key] = utf8DecodeEncodeArray($value, $decodeEncode);
				continue;
			}		
		   	if($decodeEncode=='decode'){
				$utf8DecodedEncodeArray[$key] = stripslashes($value);
			}
			if($decodeEncode=='table'){
				$utf8DecodedEncodeArray[$key] = addslashes($value);
			}
		}
		return $utf8DecodedEncodeArray;
	}
	
	function encoding($al_string) {
		if(is_array($al_string)){
			return utf8DecodeEncodeArray($al_string, 'table');
		}
		else {
			return addslashes($al_string);
		}
	}
	
	function decoding($al_string) {
		if(is_array($al_string)){
			return utf8DecodeEncodeArray($al_string, 'decode');
		}
		else {
			return stripslashes($al_string);
		}
	}
	
	function decoding_ck($al_string) {
		$al_string=str_replace('&nbsp;',' ',$al_string);
		return html_entity_decode(stripslashes($al_string));
		/*****************************************
		Use <?php eval( '?> '.$article.' <?php ' ); ?> to output php in template 
		where article is the main position
		******************************************/
	}
	
	
	function repopulateform($al_array) {
		foreach($al_array as $al_key => $al_value){
			$_SESSION['populate'][$al_key]=$al_value;
		}
	}
?>