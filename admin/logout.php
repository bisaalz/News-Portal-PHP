<?php 
	include '../config/init.php';

	session_destroy();

	if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])){
		setcookie('_au','', time()-60, '/');
	}

	redirect('./');