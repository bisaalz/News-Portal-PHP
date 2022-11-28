<?php require 'config/init.php'; ?>
<?php require 'inc/header.php';
    $video = new Video;
    $no_video = true;
    if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
        $video_id =  (int)$_GET['id'];
        if($video_id <= 0){
            $no_video = true;
        } else {
            $no_video = false;

            $video_detail = $video->getVideoById($video_id);
            if(!$video_detail){
                $no_video  = true;
            }
        }
    }

 ?>
    <section class="video-inner">
        <div class="container">
            <div class="full-video">
                <?php 
                    if($no_video){
                        echo "Video not found.";
                    } else {

                    ?>


                        <h2><?php echo $video_detail[0]->title ?></h2>
                        
                        <div class="big-video">
                            <iframe width="100%" src="https://www.youtube.com/embed/<?php echo $video_detail[0]->video_id ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                
                    <div class="fb-share-button" data-href="<?php echo getCurrentUrl(); ?>" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo getCurrentUrl(); ?>" class="fb-xfbml-parse-ignore">Share</a></div>

                    <?php 

                        echo html_entity_decode($video_detail[0]->summary);
                    }
                 ?>
            </div>
            <div class="comment">
                <h4>Comment</h4>
                <div class="fb-comments" data-href="<?php echo getCurrentUrl(); ?>" data-width="1110" data-numposts="10"></div>
            </div>
        </div>
    </section>
<?php require 'inc/footer.php'; ?>