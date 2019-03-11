<?php 

//KEEP THIS STRUCTURE

//Action

if($al_action=='post_comment'){
	post_comments($al_connexion);
}

if($al_action=='delete_comment'){
	delete_comment($al_connexion);
}


//Module


?>