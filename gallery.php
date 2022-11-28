<?php require 'config/init.php'; ?>
<?php require 'inc/header.php'; 

    $no_gallery = true;
    $gallery = new Gallery;
    $images = new GalleryImage;

    if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
        $no_gallery = false;
        $gallery_id = (int)$_GET['id'];

        if($gallery_id <= 0){
            $no_gallery = true;
        } else {
            $gallery_info = $gallery->getGalleryById($gallery_id);
            if(!$gallery_info){
                $no_gallery = true;
            } else {
                $images_info = $images->getGalleryImageById($gallery_id);
            }
        }
    }

?>

    <section class="inner">
        <div class="container">
            <div class="row">
                <?php 
                    if($no_gallery){
                        echo "Gallery not found.";
                    } else {
                        if($images_info){
                            foreach($images_info as $gallery_image){
                        ?>
                            <div class="col-sm-3">
                                <a href="<?php echo UPLOAD_URL.'/gallery/'.$gallery_image->image_name ?>" data-lightbox="roadtrip">
                                    <img src="<?php echo UPLOAD_URL.'/gallery/'.$gallery_image->image_name ?>" alt="" class="img img-responsive img-thumbnail">
                                </a>

                            </div>
                        <?php
                            }
                        } else {
                            echo "No gallery images";
                        }
                    }
                ?>
            </div>
        </div>
    </section>
<?php require 'inc/footer.php' ?>