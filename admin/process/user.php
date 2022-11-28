<?php 
	require '../../config/init.php';
	require '../inc/checkLogin.php';
	$user = new User;

	if(isset($_POST) && !empty($_POST)){
		$user_info = $user->getUserByUsername($_SESSION['email']);
		$data = array(
			'full_name' => $_POST['full_name']
		);

		if(isset($_POST['change_pwd']) && $_POST['change_pwd'] == 1 ){

			if(strlen($_POST['password']) < 8){
				redirect('../update-user.php','error', 'Password length atleast should be 8 character long.');
			}

			if($_POST['password'] != $_POST['confirm_password']){	
				redirect('../update-user.php','error', 'Password and confirm password does not match.');
			}
			if($user_info[0]->password != sha1($_SESSION['email'].$_POST['old_password'])){
				redirect('../', 'error', 'Old password does not match.');
			}

			$data['password'] = sha1($_SESSION['email'].$_POST['password']);
		}

		if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
			$file_name = uploadSingleFile($_FILES['image'], 'user');
			if($file_name){
				$data['image'] = $file_name;
			}
		}

		$update = $user->updateUser($data, $_SESSION['user_id']);

		if($update){
			$_SESSION['full_name'] = $_POST['full_name'];
			redirect('../','success','User updated successfully.');
		} else {
			redirect('../','error','Problem while updating user.');			
		}
		
	} else {
		redirect('../', 'error', 'Unauthorized access');
	}