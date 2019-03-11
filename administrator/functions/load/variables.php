<?php
	function loadvariable ($al_connexion){
		$select=$al_connexion->query("SELECT * FROM ".HASH."_config");
		$select->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_config = $select->fetch();
		$al_title_page = $al_fetch_config->title;
		return $al_title_page;
	}
	
	function loadfileinfo ($al_connexion){
		$select=$al_connexion->query("SELECT * FROM ".HASH."_template WHERE active='1' AND admin='1'");
		$select->setFetchMode(PDO::FETCH_OBJ);
		$al_init_template = $select->fetch();
		$al_title_template = $al_init_template->title;
		return $al_title_template;
	}
	
	function loaddefaulttemplate ($al_connexion){
		$select=$al_connexion->query("SELECT * FROM ".HASH."_template WHERE active='1' AND admin='0'");
		$select->setFetchMode(PDO::FETCH_OBJ);
		$al_init_template = $select->fetch();
		$al_title_template = $al_init_template->title;
		return $al_title_template;
	}
	
	function format_link($al_txt_string) {
		$al_txt = str_replace("'", "_", $al_txt_string);
		$al_txt = str_replace("\"", "_", $al_txt);
		$al_txt = str_replace("&#39;", "_", $al_txt);
		$al_txt = str_replace("&quot;", "_", $al_txt);
		$al_transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ç' => 'c', 'Ç' => 'C', 'Ð' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ƒ' => 'f', 'ƒ' => 'F', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ñ' => 'n', 'Ñ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ö' => 'oe', 'Ö' => 'OE', 'š' => 's', 'Š' => 'S', 'ß' => 'SS', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'û' => 'u', 'Û' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ý' => 'y', 'Ý' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ž' => 'z', 'Ž' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u');
		$al_txt = str_replace(array_keys($al_transliterationTable), array_values($al_transliterationTable), html_entity_decode($al_txt));
		$al_txt = preg_replace_callback("/[^a-zA-Z0-9]/", function(){ return "_"; }, $al_txt);
		return $al_txt;
	}
	
	function security (){
		if(!isset($_SESSION['pseudom'])){
			die('Not enough permission');
		}
	}
	
	function buildMenu ($al_connexion){
		$menu = '
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="index.php?page=cpanel">Admin</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
			  <ul class="nav navbar-nav">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">Modules <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="index.php">Modules</a></li>
					<li><a href="index.php?page=addmodule">Add module</a></li>
				  </ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">Articles <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="index.php?page=list_article">Articles</a></li>
					<li><a href="index.php?page=add_article">Add article</a></li>
				  </ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">Users <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="index.php?page=list_user">Users</a></li>
					<li><a href="index.php?page=add_user">Add user</a></li>
				  </ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">Menu <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="index.php?page=menu_list">Menu</a></li>
					<li><a href="index.php?page=add_link">Add link</a></li>
				  </ul>
				</li>
				<li><a href="index.php?page=list_template">Templates</a></li>
				<li><a href="index.php?page=configuration">Configuration</a></li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">Plugins <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="index.php?page=plugins&action=add">Add a plugin</a></li>
					<li><a href="index.php?page=plugins">List of plugins</a></li>';
					
					$select1=$al_connexion->query("SELECT * FROM ".HASH."_plugins WHERE publish='1'");
					$select1->setFetchMode(PDO::FETCH_OBJ);
					
					while($al_fetch_plugins = $select1->fetch()){
						$plugin_default_link=$al_fetch_plugins->default_shortcut;
						$plugin_title=$al_fetch_plugins->title;
						$menu .= "<li><a href=\"index.php?page=$plugin_default_link\">$plugin_title</a></li>";
					}
					$menu .= '
					</ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">Media <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="index.php?page=media">Add Media</a></li>
					<li><a href="index.php?page=media_show">Show Media</a></li>
				  </ul>
				</li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View site <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="../index.php" target="_blank">View site</a></li>
					<li><a href="index.php?page=disconnect">Disconnect</a></li>
				  </ul>
				</li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>';
		return $menu;
	}
	
	function detectEmptyParameter($al_string){
		if($al_string){	
			$al_tableau = explode('?',$al_string);
			$al_string1 = $al_tableau[1];
			
			if(substr_count($al_string1, '&') == 0){
				$al_tableau=explode('=', $al_string1);
				
				if($al_tableau[1]==""){
					die("Missing parameter in the url !");
				}
			}
			else{
				$al_tableau=explode('&',$al_string1);
				
				for($al_i=0; $al_i<count($al_tableau); $al_i++){
					$al_get_value=explode("=",$al_tableau[$al_i]);			
					
					if($al_get_value[1]==""){
						die("Missing parameter in the url !");
					}
				}
			}
		}
	}
	
	function error_message($al_storing, $al_array) {
		$_SESSION['error_message']='';
		$al_error='';
		foreach($al_array as $al_key => $al_value){
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
					if($al_value=='NONE'){
						$al_error.="The value NONE is not permitted ! (Field ".$al_name.")<br />";
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
				$utf8DecodedEncodeArray[$key] = addslashes($value);	
			}
			else {
				$utf8DecodedEncodeArray[$key] =  htmlspecialchars(stripslashes($value), ENT_QUOTES);
			}
		}
		return $utf8DecodedEncodeArray;
	}
	
	function encoding($al_string) {
		if(is_array($al_string)){
			return utf8DecodeEncodeArray($al_string, 'decode');
		}
		else {
			return addslashes($al_string);
		}
	}
	
	function decoding($al_string) {
		if(is_array($al_string)){
			return utf8DecodeEncodeArray($al_string, 'encode');
		}
		else {
			return htmlspecialchars(stripslashes($al_string), ENT_QUOTES);
		}	
	}
	
	function encoding_ck($al_string) {
		return addslashes($al_string);
	}
	
	function decoding_ck($al_string) {
		return stripslashes(htmlspecialchars($al_string));
	}
	
	function repopulateform($al_array) {
		foreach($al_array as $al_key => $al_value){
			$_SESSION['populate'][$al_key]=$al_value;
		}
	}
	
	function substr_count_array( $al_string, $al_array ) {
		 $al_count = 0;
		 foreach ($al_array as $al_value) {
			  if($al_value==$al_string){
				$al_count++;
			  }
		 }
		 return $al_count;
	}
	
	function get_pagination() {
		$var_Pa=(isset($_GET['k']) ? $_GET['k'] : '');
		$var_item = "10";
		if($var_Pa == ""){$var_Pa = 0;}
		$var_St = $var_Pa*$var_item;
		if($var_St == ""){$var_St = 0;}
		return $var_St.",".$var_item;
	}
	
	function pagination($var_nbT) {
		$var_Pa = (isset($_GET['page']) ? $_GET['page'] : '');
		$var_k = (isset($_GET['k']) ? $_GET['k'] : '');
		if($var_Pa){
			$page="?page=".$var_Pa."&k=";
		}
		else {
			$page="?k=";
		}
		$var_array = array();
		$var_item = "10";
		if($var_k == ""){$var_k = 0;}
		$var_St = $var_k*$var_item;
		if($var_St == ""){$var_St = 0;}
		$pagination="";
		$pagination .= "<div class=\"pagination-content\">";
		if($var_k > 0){
			$var_Pr=$var_k - 1;
			$pagination .= "<a href=\"/administrator/index.php".$page.$var_Pr."\" class=\"pagination\"><< Previous</a> ";
		}
		$var_i = 0;
		$var_j = 1;
		if($var_nbT > $var_item) {
			while($var_i < ($var_nbT / $var_item)){
				if($var_i != $var_k){
					$pagination .= "<a href=\"/administrator/index.php".$page.$var_i."\" class=\"pagination\">$var_j</a> ";
				} 
				else{
					$pagination .= "<span class=\"pagination\"><b>$var_j</b></span> ";
				}
				$var_i++;
				$var_j++;
			}
		}
		if($var_St + $var_item < $var_nbT){
			$var_Ne = $var_k + 1;
			$pagination .= "<a href=\"/administrator/index.php".$page.$var_Ne."\" class=\"pagination\">Next >></a>";
		}
		$pagination .= "</div>";
		return $pagination;
	}
?>