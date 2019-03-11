<?php
	if($al_shortcut){
		if(preg_match('/\{(.*?)\}$/',$al_modules,$al_match2)){
			if(preg_match('/category\{(.*?)\}/',$al_match2[1],$al_match3)){		
				$al_options = explode(':',$al_match3[1]);
				
				if($al_options[0]=='show_title'){$al_show_title='yes';}else{$al_show_title='no';}
			}
		}	
			
		if($al_show_title=='yes'){$al_section=$al_fetch_section_name->section;}
?>
	<ul class="nav navbar-nav">
<?php		
		while($al_fetch_link_menu = $select2->fetch()){
			$al_name=$al_fetch_link_menu->name;
			$al_shortcut_unique=$al_fetch_link_menu->shortcut;
?>
			<li><a href="/<?php echo $al_shortcut_unique ?>"><?php echo $al_name ?></a></li>
<?php
		}
?>
	</ul>
<?php
	}
?>