<?php 
require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
$user = new User;


if(isset($_POST) && !empty($_POST)){
	/*Form submit*/
	$user_name = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);	// email or false

	if(!$user_name){
		redirect('../','error','Invalid user email.');
	}

	$password = sha1($user_name.$_POST['password']);
	/* DB validation*/
	/*
		SELECT * FROM users WHERE email = '$user_name' AND password = '$password';
	*/
	$user_info = $user->getUserByUsername($user_name);
	if($user_info){
		/*Username Match*/
		if($user_info[0]->password == $password){
			if($user_info[0]->status == 'active'){
				if($user_info[0]->role == 'admin'){
					/*Final success login*/
					$_SESSION['user_id'] = $user_info[0]->id;
					$_SESSION['full_name'] = $user_info[0]->full_name;
					$_SESSION['email'] = $user_info[0]->email;

					$token = generateRandomString(100);
					$_SESSION['token'] = $token;
					if(isset($_POST['remember']) && $_POST['remember'] == 'on'){
						
						setcookie('_au', $token, (time()+864000), '/');

						$user->updateRemeberToken($token, $user_info[0]->id);

					}

					redirect('../dashboard.php', 'success', 'Welcome to admin panel');

				} else {
					redirect('../','error','You do not have permission to access.');
				}
			} else {
				redirect('../','error','User not activated.');
			}
		} else {
			redirect('../','error','Password does not match.');
		}
	} else {
		redirect('../','error','Invalid Username.');
	}
} else {
	redirect('../','error','Unauthorized access.');
}
