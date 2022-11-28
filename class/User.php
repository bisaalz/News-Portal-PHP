<?php 

class User extends Database{
	public function __construct(){
		parent::__construct();
		$this->table('users');
	}
	public function getUserByUsername($user_name){

		//$sql = "SELECT * FROM users WHERE password = '".$user_name."'";

		$cond = array(

			//'fields' => 'id, full_name, email, role, password, status',

			//'fields' => array('id', 'full_name', 'email', 'role', 'password', 'status')

			//'where' => " email = '".$user_name."' AND status = 'active' "
			'where' => array(
				'email' => $user_name,
				//'status' => 'active'


			)
		);


		 return $this->select($cond);
	}

	public function updateRememberToken($token, $user_id){
		// UPDATE users SET remember_token = $token WHERE id = $user_id
		$data = array(
			'remember_token' => $token
		);
		$args = array(
			'where' => array(
				'id' => $user_id
			)
		);
		//$sql = "UPDATE users SET remember_token = '".$token."' WHERE id=".$user_id;
		return $this->update($data, $args);
	}

	public function getUserFromToken($token){
		/* "SELECT * FROM users WHERE remember_token = '".$token."'"*/
		/*$sql = "SELECT * FROM users WHERE remember_token = '".$token."'"

		$data = $this->runRaw();*/

		$args = array(
			'where' => array(
				'remember_token' => $token
			)
		);
		return $this->select($args);
	}

	public function getUserByRole($roles){
		/* SELECT * FROM users WHERE role = 'reporter'*/

		$args = array(
			'where' => array(
				'role' => $roles

			)

		);

		return $this->select($args);
	}

	public function updateUser($data, $user_id){
		$args = array(
			'where' => array(
				'id' => $user_id
			)
		);
		return $this->update($data, $args);
	}
}

