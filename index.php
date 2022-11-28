<?php require 'config/init.php'; ?>
<?php require 'inc/header.php';
  $news  = new News; ?>
  <?php require 'inc/sticky-news.php'; ?>

  <!-- politics -->

    <?php 

    $cat_id = 1;
    $cat_news = $news->getCatNews($cat_id, 4);
    if($cat_news){

     ?>

    <section class="politics">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">राजनीति</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
          <?php require 'inc/politics-layout.php' ?>
        </div>
    </section>
<?php } ?>

<!-- politics close -->

<!--world-->

  <?php 

    $cat_id = 8;
    $cat_news = $news->getCatNews($cat_id, 6);
    if($cat_news){

     ?>
    <section class="politics">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">विश्व</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
            <div class="news-wrapper">
                <div class="row">
                <?php require 'inc/world-layout.php' ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

   <!--world closes -->


<!-- economy -->
  <?php 

    $cat_id = 3;
    $cat_news = $news->getCatNews($cat_id, 3);
    if($cat_news){

     ?>
    <section class="money">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">अर्थ</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
            <div class="news-wrapper">
                <div class="row">
                       <?php 
                                if($cat_news){
                                    foreach($cat_news as $category_news){
                                        ?>
                    <div class="col-lg-4">
                        <div class="money-listing">
                              
                            <a herf="news.php?id=<?php echo $category_news->id; ?>"><figure style="background-image: url('<?php echo UPLOAD_URL.'/news/'.$category_news->image ?>')"></figure></a>
                            <h3><a href="news.php?id=<?php echo $category_news->id; ?>"><?php echo $category_news->title ?></a></h3>
                        </div>
                    </div>
                        
                                    <?php  
                                    }
                                }
                            ?>
                
                </div>
            </div>
        </div>
    </section>
      <?php } ?>

      <!-- economy closes -->


    <!-- society -->
    <?php 

    $cat_id = 4;
    $cat_news = $news->getCatNews($cat_id, 5);
    if($cat_news){

     ?>
    <section class="socity">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">समाज</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
            <div class="news-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="socity-big">
                            <a href="news.php?id=<?php echo $category_news->id; ?>"><figure style="background-image: url('<?php echo UPLOAD_URL.'/news/'.$category_news->image ?>')"></figure></a>
                            <h3><a href="news.php?id=<?php echo $category_news->id; ?>"><?php echo $category_news->title ?></a></h3>
                            <p>
                          <?php echo $category_news->summary; ?> 
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <?php 
                                if($cat_news){
                                    foreach($cat_news as $category_news){
                                        ?>
                            <div class="col-md-6">
                                <div class="socity-small">
                                    <a href="news.php?id=<?php echo $category_news->id; ?>"><figure style="background-image: url('<?php echo UPLOAD_URL.'/news/'.$category_news->image ?>');"></figure></a>
                                    <h3><a href="news.php?id=<?php echo $category_news->id; ?>"><?php echo $category_news->title ?></a></h3>
                                    <p>
                                       <?php echo $category_news->summary; ?> 
                                    </p>
                                </div>
                            </div>
                     
                                    <?php  
                                    }
                                }
                            ?>
                    
                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- society closes -->


<!-- videos -->
   <?php 
        $video = new Video;
        $all_video = $video->getAllVideos();
        if($all_video){
    ?>

    <section class="video">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">भिडियो</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
            <div class="news-wrapper">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <?php 

                            $first_video = array_shift($all_video);

                         ?>
                        <div class="big-video">
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $first_video->video_id ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            <h3><a href="video.php?id=<?php echo $first_video->id ?>"><?php echo $first_video->title ?></a></h3>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="small-video">
                            <div class="row">
                             <?php 
                             if($all_video){
                                foreach($all_video as $video_section){
                                    ?>
                                <div class="col-md-5">
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $video_section->video_id ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                                <div class="col-md-7">
                                        <h3><a href="video.php?id=<?php echo $video_section->id ?>"><?php echo $video_section->title ?></a></h3>
                                </div>
                                    <?php
                                }
                             }
                              ?>
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- video closes -->

    <!-- entertainment -->

      <?php 
    $cat_id = 5;
    $cat_news = $news->getCatNews($cat_id, 4);
    if($cat_news){

     ?>


    <section class="politics">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">मनोरन्जन</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
         <?php require 'inc/politics-layout.php' ?>
        </div>
    </section>

<?php } ?>

<!-- entertainment closes -->

<!-- gallery -->

 <section class="gallery">
            <div class="container">
                <div class="section-title">
                    <h2><a href="#">फोटो फिचर</a></h2>
                    <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
                </div>
                <div class="news-wrapper">
                    <div class="row">
                        <?php 
                            $gallery = new Gallery;
                            $all_list = $gallery->getGallery(4);
                            if($all_list){
                                foreach($all_list as $gallery_info){
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="gallery-fig">
                                <a href="gallery.php?id=<?php echo $gallery_info->id ?>">
                                    <img src="<?php echo UPLOAD_URL.'/gallery/'.$gallery_info->cover_image ?>" style="max-height: 100%;">
                                </a>
                            </div>
                        </div>
                                <?php
                                }
                            }
                        ?>
                    </div>
                </div>
             </div>
        </section>

        <!-- gallery closes -->


<?php require 'inc/footer.php'; ?>