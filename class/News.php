<?php  

	class News extends Database{
		public function __construct(){
			parent::__construct();
			$this->table('news');
		}

		public function addNews($data){
			/*INSERT INTO categories SET column_name  = value*/
			return $this->insert($data);
		}

		public function getAllNews(){
		/*	$args = array(
				'order_by' => ' created_at ASC '
			);*/
			return $this->select();
		}

		public function getNewsById($news_id){
			/*SELECT * FROM categories WHERE id = $news_id*/
			$args = array(
				'where' => array(
					'id' => $news_id
				)
			);

			return $this->select($args);
		}

		public function deleteNews($news_id){
			/*DELETE FROM categories WHERE id = $news_id*/

			$args = array(
				'where' => array(
					'id' => $news_id
				)
			);

			return $this->delete($args);
		}


		public function updateNews($data, $news_id){


			$args = array(
				'where' => array(
					'id' => $news_id
				)
			);

			$success = $this->update($data, $args);
			if($success){
				return $news_id;
			} else{
				return false;
			}
		}

		public function getTotal(){
			
			$args = array(
				'fields' => "count('id') as total_news"

			);

			return $this->select($args);

		}

		public function getAllNewsByRange($no_days=0){
			$today = date('Y-m-d')." -".$no_days." days";
			$date = date('Y-m-d',strtotime($today));

			// "SELECT * FROM news WHERE DATE(created_at) = '$date'";

			$args = array(
				'where' =>  " DATE(created_at) >= '".$date."' "
			);

			return $this->select($args);

		}

		public function getStickyNews(){
			//SELECT news.id, news.title, news.summary, news.location, news.image, news.news_date, users.full_name FROM news LEFT JOIN users ON users.id = news.reporter_id WHERE news.status = "published" AND DATE(news.created_at) = "2019-04-07" AND news.is_sticky = 1 ORDER BY news.id DESC
			$args = array(
				'fields' => 'news.id, news.title, news.summary, news.location, news.image, news.news_date, users.full_name',
				'join' => 'LEFT JOIN users ON users.id = news.reporter_id',
		        'where' => 'news.status = "published" AND DATE(news.created_at) = "'.date('Y-m-d').'" AND news.is_sticky = 1',
		        'order_by' => 'news.id DESC',
		        'limit' => '0,3' 
		    );
			return $this->select($args);
		}

		public function getCatNews($cat_id, $limit){
		$args = array(
				'fields' => 'news.id, news.title, news.summary, news.location, news.image, news.news_date, users.full_name',
				'join' => 'LEFT JOIN users ON users.id = news.reporter_id',
		        'where' => 'news.status = "published" AND cat_id ='.$cat_id,
		        'order_by' => 'news.id DESC',
		        'limit' => '0,'.$limit 
		    );
			return $this->select($args);	
		}

		public function getRelatedNews($cat_id, $current_id, $limit=4){
			$args = array(
				'fields' => 'news.id, news.title, news.summary, news.location, news.image, news.news_date, users.full_name',
				'join' => 'LEFT JOIN users ON users.id = news.reporter_id',
		        'where' => ' news.status = "published" AND cat_id ='.$cat_id.' AND news.id != '.$current_id,
		        'order_by' => 'news.id DESC',
		        'limit' => '0,'.$limit
		    );
			return $this->select($args);

		}	

		public function getLatestNews($limit=4){
			$args = array(
				'fields' => 'news.id, news.title, news.summary, news.location, news.image, news.news_date, users.full_name',
				'join' => 'LEFT JOIN users ON users.id = news.reporter_id',
		        'where' => ' news.status = "published" ',
		        'order_by' => 'news.id DESC',
		        'limit' => '0,'.$limit
		    );
			return $this->select($args);	

		}

	}