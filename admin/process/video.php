<?php 
	require '../../config/init.php';
	require '../inc/checkLogin.php';

	$video = new Video();

	if(isset($_POST) && !empty($_POST)){

		$data = array(
			'title' => $_POST['title'],
			'summary' => $_POST['summary'],
			'status' => $_POST['status'],
			'added_by' => $_SESSION['user_id'],
			'video_link' => $_POST['link'],
			'video_id' => $video->getVideoId($_POST['link'])
		);

		$video_id = (isset($_POST['video_id']) && !empty($_POST['video_id'])) ? (int)$_POST['video_id'] : null;

		if($video_id){
			$act = "updat";
			$video_id = $video->updateVideo($data, $video_id);
		} else {
			$act = "add";
			$video_id = $video->addVideo($data);
		}

		if($video_id){
			redirect('../video.php','success', 'Video '.$act.'ed successfully.');
		} else {
			redirect('../video.php','error', 'Problem while '.$act.'ing video.');
		}
		//debug($data, true);
	} elseif(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
		$video_id = (int)$_GET['id'];
		if($video_id <= 0){
			redirect('../video.php','error','Inavalid video id.');
		}

		$cat_info  = $video->getVideoById($video_id);

		if(!$cat_info){
			redirect('../video.php', 'error', 'Video not found.');
		}

		$del = $video->deleteVideo($video_id);

		if($del){
			redirect('../video.php','success', 'Video deleted successfully.');
		} else {
			redirect('../video.php','error', 'Video could not be deleted at this moment.');
		}
	}
	else {
		redirect('../video.php', 'error', 'Unauthorized access.');
	}