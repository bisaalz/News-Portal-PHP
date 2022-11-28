<?php  

  class GalleryImage extends Database{
    public function __construct(){
      parent::__construct();
      $this->table('gallery_images');
    }

    public function addImages($data){
      /*INSERT INTO categories SET column_name  = value*/
      return $this->insert($data);
    }

    public function getGalleryImageById($gallery_id){
      /*SELECT * FROM gallery_images WHERE gallery_id = $gallery_id*/
      $args = array(
        'where' => array(
          'gallery_id' => $gallery_id
        )
      );

      return $this->select($args);
    }

    public function deleteGalleryImages($gallery_id){
      /*DELETE FROM categories WHERE id = $gallery_id*/

      $args = array(
        'where' => array(
          'gallery_id' => $gallery_id
        )
      );

      return $this->delete($args);
    }
  }