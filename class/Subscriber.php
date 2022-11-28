<?php 

	class Subscriber extends Database{
		public function __construct(){
			parent::__construct();
			$this->table('subscribers');
		}

		public function addEmail($email){
			$data = array('email'=>$email);

			return $this->insert($data);
		}
	}