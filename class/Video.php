<?php  

	class Video extends Database{
		public function __construct(){
			parent::__construct();
			$this->table('videos');
		}

		public function addVideo($data){
			/*INSERT INTO videos SET column_name  = value*/
			return $this->insert($data);
		}

		public function getAllVideos($status = null){
			if($status){
				$args = array('where'=>'status = "active"  ');
			} else {
				$args = array();
			}

		/*	$args = array(
				'order_by' => ' created_at ASC '
			);*/
			return $this->select($args);
		}

		public function getVideoById($video_id){
			/*SELECT * FROM videos WHERE id = $video_id*/
			$args = array(
				'where' => array(
					'id' => $video_id
				)
			);

			return $this->select($args);
		}

		public function deleteVideo($video_id){
			/*DELETE FROM videos WHERE id = $video_id*/

			$args = array(
				'where' => array(
					'id' => $video_id
				)
			);

			return $this->delete($args);
		}


		public function updateVideo($data, $video_id){


			$args = array(
				'where' => array(
					'id' => $video_id
				)
			);

			$success = $this->update($data, $args);
			if($success){
				return $video_id;
			} else{
				return false;
			}
		}

		public function getVideoId($link){
	/*		parse_str($link, $data);
			debug($data, true);
*/
			preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $link, $match);
			return $match[1];
		}

		public function getTotal(){
			$args = array(
				'fields' => "count('id') as total_vid"

			);

			return $this->select($args);
		}
		
	}