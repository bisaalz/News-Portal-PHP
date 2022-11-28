<?php 
	require '../../config/init.php';
	require '../inc/checkLogin.php';

	$news = new News();

	if(isset($_POST) && !empty($_POST)){

/*		debug($_POST);
		debug($_FILES,true);
*/
		$data = array(
			'title' => $_POST['title'],
			'summary' => $_POST['summary'],
			'description' => htmlentities($_POST['description']),

			/*
					This is test => <p>This is test</p> => &lt;p&gt;This is test&lt;/p&gt; 
					html_entity_decode() 

			*/
			'cat_id' => (int)$_POST['cat_id'],
			'location' => $_POST['location'],
			'news_date' => $_POST['news_date'],
			'reporter_id' => $_POST['reporter_id'],
			'is_sticky' => isset($_POST['is_sticky']) ? 1 : 0,
			'status' => $_POST['status'],
			'added_by' => $_SESSION['user_id']
		);

		if(isset($_POST['del_image']) && file_exists(UPLOAD_DIR.'/news/'.$_POST['del_image'])){
			unlink(UPLOAD_DIR.'/news/'.$_POST['del_image']);
			$data['image'] = '';
		}

		if(isset($_FILES, $_FILES['image']) && $_FILES['image']['error'] == 0){
			/*File upload*/
			$file_name = uploadSingleFile($_FILES['image'], 'news');
			if($file_name){
				$data['image'] = $file_name;
			}
		}





		$news_id = (isset($_POST['news_id']) && !empty($_POST['news_id'])) ? (int)$_POST['news_id'] : null;
		if($news_id){
			$act = "updat";
			$news_id = $news->updateNews($data, $news_id);
		} else {
			$act = "add";
			$news_id = $news->addNews($data);
		}

		if($news_id){
			redirect('../news.php','success', 'News '.$act.'ed successfully.');
		} else {
			redirect('../news.php','error', 'Problem while '.$act.'ing news.');
		}
		//debug($data, true);
	} elseif(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
		$news_id = (int)$_GET['id'];
		if($news_id <= 0){
			redirect('../news.php','error','Inavalid news id.');
		}

		$news_info  = $news->getNewsById($news_id);

		if(!$news_info){
			redirect('../news.php', 'error', 'News not found.');
		}

		$del = $news->deleteNews($news_id);

		if($del){
			if(!empty($news_info[0]->image) && file_exists(UPLOAD_DIR.'/news/'.$news_info[0]->image)){
				unlink(UPLOAD_DIR.'/news/'.$news_info[0]->image);
			}

			redirect('../news.php','success', 'News deleted successfully.');
		} else {
			redirect('../news.php','error', 'News could not be deleted at this moment.');
		}
	}
	else {
		redirect('../news.php', 'error', 'Unauthorized access.');
	}