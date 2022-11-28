<?php 
if($cat_news){
$fisrt_3 = array_slice($cat_news,0,3);   /*0,3 is the limit 3*/
$last_3 = array_slice($cat_news, 3, 3);
if($fisrt_3){
?>
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="politics-news-list">
        <div class="listing">
            <div class="row">
                <?php foreach($fisrt_3 as $category_news){ ?>
                <div class="col-md-4">
                    <a href="news.php?id=<?php echo $category_news->id; ?>"><figure style="background-image: url('<?php echo UPLOAD_URL.'/news/'.$category_news->image ?>')"></figure></a>
                </div>
                <div class="col-md-8">
                    <h3><a href="news.php?id=<?php echo $category_news->id; ?>"><?php echo $category_news->title ?></a></h3>
                    <p>
                       <?php echo $category_news->summary; ?>
                    </p>
                </div>               
               <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } 
if($last_3) {?>
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="politics-news-list">
        <div class="listing">
            <div class="row">
                <?php foreach($last_3 as $category_news){ ?>
                <div class="col-md-4">
                    <a href="news.php?id=<?php echo $category_news->id; ?>"><figure style="background-image: url('<?php echo UPLOAD_URL.'/news/'.$category_news->image ?>')"></figure></a>
                </div>
                <div class="col-md-8">
                    <h3><a href="news.php?id=<?php echo $category_news->id; ?>"><?php echo $category_news->title ?></a></h3>
                    <p>
                       <?php echo $category_news->summary; ?>
                    </p>
                </div>               
               <?php } ?>
            </div>
        </div>
    </div>
</div>
                        
    <?php  
}
}
?>
