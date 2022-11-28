<?php 

  
    $sticky = $news->getStickyNews();
    if($sticky){
        foreach($sticky as $sticky_news){

 ?>
    <section class="big-news">
        <div class="container">
            <div class="news-details">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="big-news-img">
                            <a href="news.php?id=<?php echo $sticky_news->id ?>">
                                <figure style="background-image: url('<?php echo UPLOAD_URL.'/news/'.$sticky_news->image ?>')"></figure>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="big-news-detail news-title">
                            <h2><a href="news.php?id=<?php echo $sticky_news->id ?>"><?php echo $sticky_news->title ?></a></h2>
                            <p>
                                <span><?php echo $sticky_news->location ?></span>
                                <span><?php echo ", " .$sticky_news->full_name ?></span>
                            </p>
                            <p>
                                <?php echo $sticky_news->summary; ?>
                            </p>
                            <span><?php echo $sticky_news->news_date ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }
} ?>