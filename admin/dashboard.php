<?php require 'inc/header.php';
  require 'inc/checkLogin.php';
  $news = new News;
  $cat = new Category;
  $gal = new Gallery;
  $vid = new Video;

  $total_news_count = $news->getTotal();
  $total_cat_count = $cat->getTotal();
  $total_gal_count = $gal->getTotal();
  $total_vid_count = $vid->getTotal();
 ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php require 'inc/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php require 'inc/top-nav.php' ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
          <?php flash(); ?>

          
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">News Count</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_news_count[0]->total_news ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Category</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_cat_count[0]->total_cat ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Gallery Count</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_gal_count[0]->total_gal ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fab fa-envira fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Video Count</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_vid_count[0]->total_vid ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-video fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          

          <div class="row">
            <div class="col-12">
              <table class="table">
                        <thead>
                            <th>S.N</th>
                            <th>Title</th>
                            <th>Summary</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Added Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $news = new News;
                                $all_news = $news->getAllNewsByRange(2);

                                if($all_news){
                                    foreach($all_news as $key => $news_info){
                                    ?>
                                        <tr>
                                            <td><?php echo ($key+1); ?></td>
                                            <td><?php echo $news_info->title ?></td>
                                            <td><?php echo $news_info->summary ?></td>
                                            <td><?php echo ucfirst($news_info->status) ?></td>
                                            <td>
                                                <?php 
                                                    if(!empty($news_info->image) && file_exists(UPLOAD_DIR.'/news/'.$news_info->image)){
                                                ?>
                                                <img src="<?php echo UPLOAD_URL; ?>/news/<?php echo $news_info->image ?>" class="img img-responsive img-thumbnail" style="max-width: 100px" alt="">
                                            <?php  } else{
                                                echo "No image uploaded.";

                                            } ?>
                                            </td>
                                            <td>
                                              <?php echo $news_info->created_at ?>
                                            </td>
                                            <td>
                                                <a href="news-form.php?id=<?php echo $news_info->id ?>" class="btn btn-success" style="border-radius: 50%">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>

                                                <a href="process/news.php?id=<?php echo $news_info->id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this news?');" style="border-radius: 50%">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="news.php" class="btn btn-link">See All News</a>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 

<?php require 'inc/footer.php' ?>