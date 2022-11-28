<?php require 'config/init.php'; ?>
<?php require 'inc/header.php'; 

    $no_cat = true;
    $category = new Category;
    $news = new News;

    if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
        $no_cat = false;
        $cat_id = (int)$_GET['id'];

        if($cat_id <= 0){
            $no_cat = true;
        } else {
            $cat_info = $category->getCategoryById($cat_id);
            if(!$cat_info){
                $no_cat = true;
            } else {
                $news_info = $news->getCatNews($cat_id, 20);
            }
        }
    }

?>

    <section class="inner">
        <div class="container">
            <div class="row">
                <?php 
                    if($no_cat == true){
                        echo "Category not found.";
                    } else {
                        if($news_info){
                            foreach($news_info as $cat_news){
                    ?>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="inner-img">
                                <a href="news.php?id=<?php echo $cat_news->id ?>">
                                    <figure style="background-image: url(<?php echo UPLOAD_URL.'/news/'.$cat_news->image ?>)"></figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="inner-details">
                                <h2><a href="news.php?id=<?php echo $cat_news->id ?>"><?php echo $cat_news->title; ?>र</a></h2>
                                <p><?php echo $cat_news->location ?>– <?php echo $cat_news->summary  ?></p>
                            </div>
                        </div>
                    <?php
                            }
                        } else {
                            echo "No news in this category.";
                        }
                    }
                ?>
            </div>
        </div>
    </section>
<?php require 'inc/footer.php' ?>