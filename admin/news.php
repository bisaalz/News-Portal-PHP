<?php require 'inc/header.php';
  require 'inc/checkLogin.php'
 ?>
<link rel="stylesheet" href="<?php echo ADMIN_CSS_URL; ?>/jquery.dataTables.min.css">
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
          <?php  flash() ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">
            News page
            <a href="news-form.php" class="btn btn-success float-right">
              <i class="fas fa-fw fa-plus"></i>
              Add News
            </a>
          </h1>

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
                                $all_news = $news->getAllNews();
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
<script src="<?php echo ADMIN_JS_URL ?>/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    $('.table').DataTable();
  } );
</script>