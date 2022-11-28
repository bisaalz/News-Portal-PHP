  <?php 
  $first_element = array_shift($cat_news);


   ?>
  <div class="news-wrapper">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="politics-img-news news-title">
                            <figure style="background-image: url('<?php echo UPLOAD_URL.'/news/'.$first_element->image ?>')"></figure>
                            <h2><a href="news.php?id=<?php echo $first_element->id; ?>"><?php echo $first_element->title ?></a></h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <div class="politics-news-list">
                            <div class="listing">
                                <div class="row">
                           <?php 
                                if($cat_news){
                                    foreach($cat_news as $category_news){
                                        ?>
                                    <div class="col-md-4">
                                        <a href="news.php?id=<?php echo $category_news->id; ?>"><figure style="background-image: url('<?php echo UPLOAD_URL.'/news/'.$category_news->image ?>')"></figure></a>
                                    </div>
                                    <div class="col-md-8">
                                        <h3><a href="news.php?id=<?php echo $category_news->id; ?>"><?php echo $category_news->title ?></a></h3>
                                        <p>
                                            <?php echo $category_news->summary; ?>
                                        </p>
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