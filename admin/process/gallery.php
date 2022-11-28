<?php 
	require '../../config/init.php';
	require '../inc/checkLogin.php';

	$gallery = new Gallery();

	if(isset($_POST) && !empty($_POST)){
		/*debug($_POST);
		debug($_FILES, true);*/
		
		$data = array(
			'title' => $_POST['title'],
			'summary' => $_POST['summary'],
			'status' => $_POST['status'],
			'added_by' => $_SESSION['user_id']
		);

		if(isset($_POST['del_image']) && file_exists(UPLOAD_DIR.'/gallery/'.$_POST['del_image'])){
			unlink(UPLOAD_DIR.'/gallery/'.$_POST['del_image']);
			$data['cover_image'] = '';
		}

		if(isset($_FILES, $_FILES['image']) && $_FILES['image']['error'] == 0){
			/*File upload*/
			$file_name = uploadSingleFile($_FILES['image'], 'gallery');
			if($file_name){
				$data['cover_image'] = $file_name;
			}
		}





		$gallery_id = (isset($_POST['gallery_id']) && !empty($_POST['gallery_id'])) ? (int)$_POST['gallery_id'] : null;

		if($gallery_id){
			$act = "updat";
			$gallery_id = $gallery->updateGallery($data, $gallery_id);
		} else {
			$act = "add";
			$gallery_id = $gallery->addGallery($data);
		}

		if($gallery_id){
			/*We have to upload multiple files here*/

			$file_names = uploadMultipleFile($_FILES['other_images'], 'gallery');

			if($file_names){
				foreach($file_names as $image_name){
					$temp = array(
						'gallery_id' => $gallery_id,
						'image_name' => $image_name
					);
					$gallery_image = new GalleryImage;
					$gallery_image->addImages($temp);
				}
			}

			redirect('../gallery.php','success', 'Gallery '.$act.'ed successfully.');
		} else {
			redirect('../gallery.php','error', 'Problem while '.$act.'ing gallery.');
		}
		//debug($data, true);
	} elseif(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
		$gallery_id = (int)$_GET['id'];
		if($gallery_id <= 0){
			redirect('../gallery.php','error','Inavalid gallery id.');
		}

		$gallery_info  = $gallery->getGalleryById($gallery_id);

		if(!$gallery_info){
			redirect('../gallery.php', 'error', 'Gallery not found.');
		}

		$del = $gallery->deleteGallery($gallery_id);

		if($del){
			if(!empty($gallery_info[0]->image) && file_exists(UPLOAD_DIR.'/gallery/'.$gallery_info[0]->image)){
				unlink(UPLOAD_DIR.'/gallery/'.$gallery_info[0]->image);
			}

			redirect('../gallery.php','success', 'Gallery deleted successfully.');
		} else {
			redirect('../gallery.php','error', 'Gallery could not be deleted at this moment.');
		}
	}
	else {
		redirect('../gallery.php', 'error', 'Unauthorized access.');
	}