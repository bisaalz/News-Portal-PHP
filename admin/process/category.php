<?php 
	require '../../config/init.php';
	require '../inc/checkLogin.php';

	$category = new Category();

	if(isset($_POST) && !empty($_POST)){

		$data = array(
			'title' => $_POST['title'],
			'summary' => $_POST['summary'],
			'status' => $_POST['status'],
			'added_by' => $_SESSION['user_id']
		);

		if(isset($_POST['del_image']) && file_exists(UPLOAD_DIR.'/category/'.$_POST['del_image'])){
			unlink(UPLOAD_DIR.'/category/'.$_POST['del_image']);
			$data['image'] = '';
		}

		if(isset($_FILES, $_FILES['image']) && $_FILES['image']['error'] == 0){
			/*File upload*/
			$file_name = uploadSingleFile($_FILES['image'], 'category');
			if($file_name){
				$data['image'] = $file_name;
			}
		}





		$category_id = (isset($_POST['cat_id']) && !empty($_POST['cat_id'])) ? (int)$_POST['cat_id'] : null;
		if($category_id){
			$act = "updat";
			$cat_id = $category->updateCategory($data, $category_id);
		} else {
			$act = "add";
			$cat_id = $category->addCategory($data);
		}

		if($cat_id){
			redirect('../category.php','success', 'Category '.$act.'ed successfully.');
		} else {
			redirect('../category.php','error', 'Problem while '.$act.'ing category.');
		}
		//debug($data, true);
	} elseif(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
		$cat_id = (int)$_GET['id'];
		if($cat_id <= 0){
			redirect('../category.php','error','Inavalid category id.');
		}

		$cat_info  = $category->getCategoryById($cat_id);

		if(!$cat_info){
			redirect('../category.php', 'error', 'Category not found.');
		}

		$del = $category->deleteCategory($cat_id);

		if($del){
			if(!empty($cat_info[0]->image) && file_exists(UPLOAD_DIR.'/category/'.$cat_info[0]->image)){
				unlink(UPLOAD_DIR.'/category/'.$cat_info[0]->image);
			}

			redirect('../category.php','success', 'Category deleted successfully.');
		} else {
			redirect('../category.php','error', 'Category could not be deleted at this moment.');
		}
	}
	else {
		redirect('../category.php', 'error', 'Unauthorized access.');
	}