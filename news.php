<?php require 'config/init.php'; ?>
<?php require 'inc/header.php'; 
    $news = new News;
    $no_news = true;
    if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
        $news_id = (int)$_GET['id'];
        if($news_id <= 0){
            $no_news = true;
        } else {
            $no_news = false;

            $news_detail = $news->getNewsById($news_id);
            if(!$news_detail){
                $no_news =  true;
            }
        }
    }
?>
    <section class="news-inner">
        <div class="container">
            <div class="full-news">
                <?php 
                    if($no_news){
                        echo "News not found.";
                    } else {
                ?>

                        <h2><?php echo $news_detail[0]->title ?></h2>
                        <?php 
                            if($news_detail[0]->image != null && file_exists(UPLOAD_DIR.'/news/'.$news_detail[0]->image)){
                        ?>
                        <figure style="background-image: url(<?php echo UPLOAD_URL.'/news/'.$news_detail[0]->image ?>)"></figure>
                    <?php }
                ?>
                    <div class="fb-share-button" data-href="<?php echo getCurrentUrl() ?>" data-layout="button_count" data-size="large">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo getCurrentUrl() ?>" class="fb-xfbml-parse-ignore">Share</a></div>
                <?php
                        echo html_entity_decode($news_detail[0]->description);
                    }
                ?>
            </div>
            <div class="comment">
                <h4>Comment</h4>
               <div class="fb-comments" data-href="<?php echo getCurrentUrl(); ?>" data-width="1110" data-numposts="5"></div>
            </div>
            <div class="news-wrapper">
                <div class="section-title more">
                    <h2>थप समाचार</h2>
                </div>
                <div class="more-list"></div>
                   <?php 
                    if($no_news){
                        $related_news = $news->getLatestNews();
                    } else {
                        $related_news = $news->getRelatedNews($news_detail[0]->cat_id, $news_detail[0]->id);
                    }
                    if($related_news){
                    ?>
                        <div class="row">
                            <?php 
                                foreach($related_news as $news_info){
                            ?>
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="more-news">
                                    <a href="news.php?id=<?php echo $news_info->id ?>">
                                        <figure style="background-image: url(<?php echo UPLOAD_URL.'/news/'.$news_info->image ?>)"></figure>
                                    </a>
                                    <h2><a href="news.php?id=<?php echo $news_info->id ?>"><?php echo $news_info->title ?></a></h2>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    <?php
                    }
                   ?>
                </div>
            </div>
        </div>
    </section>

<?php require 'inc/footer.php' ?>