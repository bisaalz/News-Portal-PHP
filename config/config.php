<?php 
	ob_start();
	session_start();

	define('SITE_URL', 'http://nepalnews.loc');

	
	define('ADMIN_URL', SITE_URL.'/admin');
	// define('SITE_URL', 'http://localhost/project-path');	// no vhost

	define('ADMIN_ASSETS_URL', ADMIN_URL.'/assets');
	define('ADMIN_CSS_URL', ADMIN_ASSETS_URL.'/css');
	define('ADMIN_JS_URL', ADMIN_ASSETS_URL.'/js');
	define('ADMIN_IMAGES_URL', ADMIN_ASSETS_URL.'/img');
	define('ADMIN_VENDORS_URL', ADMIN_ASSETS_URL.'/vendor');


	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PWD', '');
	define('DB_NAME', 'nepalnews');

	define('SITE_NAME', "Nepalnews, always online.");

	define('ERROR_LOG', $_SERVER['DOCUMENT_ROOT'].'/error/error.log');

	define('ALLOWED_EXTENSION', array('jpg','jpeg','png','gif'));

	define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/uploads');
	

	define('UPLOAD_URL', SITE_URL.'/uploads');