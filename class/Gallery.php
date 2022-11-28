<?php  

  class Gallery extends Database{
    public function __construct(){
      parent::__construct();
      $this->table('galleries');
    }

    public function addGallery($data){
      /*INSERT INTO categories SET column_name  = value*/
      return $this->insert($data);
    }

    public function getAllGalleries($status = null){
      if($status){
        $args = array('where'=>'status  = "active" ');
      } else {
        $args = array();
      }
    /*  $args = array(
        'order_by' => ' created_at ASC '
      );*/
      return $this->select($args);
    }

    public function getGalleryById($gallery_id){
      /*SELECT * FROM categories WHERE id = $gallery_id*/
      $args = array(
        'where' => array(
          'id' => $gallery_id
        )
      );

      return $this->select($args);
    }

    public function deleteGallery($gallery_id){
      /*DELETE FROM categories WHERE id = $gallery_id*/

      $args = array(
        'where' => array(
          'id' => $gallery_id
        )
      );

      return $this->delete($args);
    }


    public function updateGallery($data, $gallery_id){


      $args = array(
        'where' => array(
          'id' => $gallery_id
        )
      );

      $success = $this->update($data, $args);
      if($success){
        return $gallery_id;
      } else{
        return false;
      }
    }


    public function getTotal(){
      $args = array(
        'fields' => "count('id') as total_gal"

      );

      return $this->select($args);
    }

    public function getGallery($limit){
      $args = array(
        'where' => 'status = "active"',
        'order_by' => 'id DESC',
        'limit' => ' 0, '.$limit
      );
      return $this->select($args);
    }

  }