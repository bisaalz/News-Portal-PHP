<?php 
	function debug($data, $is_exit=false){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if($is_exit){
			exit;
		}
	}

	function redirect($path, $key= null, $message = null){
		if($key != null && $message != null){
			setFlash($key, $message);
		}
		header('location: '.$path);
		exit;
	}

	function setFlash($key, $message){
		if(!isset($_SESSION)){
			session_start();
		}

		$_SESSION[$key] = $message;
	}

	function flash(){
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			echo "<p class='alert alert-danger'>".$_SESSION['error']."</p>";
			unset($_SESSION['error']);
		}
		if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
			echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
			unset($_SESSION['success']);
		}
	}

	function generateRandomString($length = 100){
		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$strlen = strlen($chars);
		$random = "";
		for($i=0; $i<$length; $i++){
			$pos = rand(0,$strlen-1);
			$random .= $chars[$pos];
		}
		return $random;

	}

	function uploadSingleFile($file, $upload_dir){
		if($file['error'] == 0){
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			if(in_array(strtolower($ext), ALLOWED_EXTENSION)){
				if($file['size'] <= 3000000){
					$path = UPLOAD_DIR."/".$upload_dir;

					if(!is_dir($path)){
						mkdir($path, 0777, true);
					}
					$file_name = $upload_dir."-".date('Ymdhis').rand(0, 999).".".$ext;
					$success = move_uploaded_file($file['tmp_name'], $path."/".$file_name);
					if($success){
						return $file_name;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function uploadMultipleFile($files, $dir_name){
		$count = count($files['name']);
		if($count <=0){
			return false;
		} else {
			$path = UPLOAD_DIR."/".$dir_name;
			if(!is_dir($path)){
				mkdir($path, 0777, true);
			}

			$file_names = array();
			for($i=0; $i<$count; $i++){
				if($files['error'][$i] == 0){
					$ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
					if(in_array(strtolower($ext), ALLOWED_EXTENSION)){
						if($files['size'][$i] <= 3000000){
							$file_name = ucfirst($dir_name)."-".date('Ymdhis').rand(0,999).".".$ext;
							$success = move_uploaded_file($files['tmp_name'][$i], $path."/".$file_name);
							if($success){
								$file_names[] = $file_name;
							}
						}	
					}
				}
			
			}

			return $file_names;
		}
	}

	function checkPassword($pwd) {
	    $errors = array();

	    if (strlen($pwd) < 8) {
	        $errors[] = "Password too short!";
	    }

	    if (!preg_match("#[0-9]+#", $pwd)) {
	        $errors[] = "Password must include at least one number!";
	    }

	    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
	        $errors[] = "Password must include at least one letter!";
	    }     

	    return $errors;
	}


	function getCurrentPage(){
		return pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
	}

	function getCurrentUrl(){
		return SITE_URL.$_SERVER['REQUEST_URI'];
	}