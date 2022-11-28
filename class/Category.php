<?php  

	class Category extends Database{
		public function __construct(){
			parent::__construct();
			$this->table('categories');
		}

		public function addCategory($data){
			/*INSERT INTO categories SET column_name  = value*/
			return $this->insert($data);
		}

		public function getAllCategories(){
		/*	$args = array(
				'order_by' => ' created_at ASC '
			);*/
			return $this->select();
		}

		public function getCategoryById($cat_id){
			/*SELECT * FROM categories WHERE id = $cat_id*/
			$args = array(
				'where' => array(
					'id' => $cat_id
				)
			);

			return $this->select($args);
		}

		public function deleteCategory($cat_id){
			/*DELETE FROM categories WHERE id = $cat_id*/

			$args = array(
				'where' => array(
					'id' => $cat_id
				)
			);

			return $this->delete($args);
		}


		public function updateCategory($data, $category_id){


			$args = array(
				'where' => array(
					'id' => $category_id
				)
			);

			$success = $this->update($data, $args);
			if($success){
				return $category_id;
			} else{
				return false;
			}
		}

		public function getTotal(){
			$args = array(
				'fields' => "count('id') as total_cat"

			);

			return $this->select($args);
		}

		public function getMenu(){
			$args = array(
				'where' => array(
					'status' => 'active'
				),
				'order_by' => 'id ASC'
			);
			return $this->select($args);
		}
	}