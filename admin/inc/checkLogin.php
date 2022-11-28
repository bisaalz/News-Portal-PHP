<?php 

	if(!isset($_SESSION, $_SESSION['token']) || empty($_SESSION['token'])){
		
		if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])){
			$token = $_COOKIE['_au'];	

			/*fetch user with $token value*/

			$user = new User;
			$user_info = $user->getUserFromToken($token);

			if(!$user_info){
				setcookie('_au', '', time()-60, '/');

				redirect('./','error','Please login first.');
			}


			$_SESSION['user_id'] = $user_info[0]->id;
			$_SESSION['full_name'] = $user_info[0]->full_name;
			$_SESSION['email'] = $user_info[0]->email;

			$token = generateRandomString(100);
			$_SESSION['token'] = $token;

			setcookie('_au', $token, time()+864000, '/');

			$user->updateRemeberToken($token, $user_info[0]->id);
		} else {
			redirect('./','error','Please login first.');
		}
	}