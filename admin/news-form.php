<?php require 'inc/header.php';
  require 'inc/checkLogin.php';

  $news = new News;
  $act = "Add";
  if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $act = "Update";
    $news_id= (int)$_GET['id'];
    if($news_id<=0){
      redirect('news.php', 'error','Inavalid News Id.');
    }

    $news_info = $news->getNewsById($news_id);
    if(!$news_info){
      redirect('news.php', 'error', 'News not found.');
    }

  }

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
          <h1 class="h3 mb-4 text-gray-800">News <?php echo $act; ?></h1>

          <div class="row">
            
            <div class="col-12">
                <form action="process/news.php" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Title:</label>
                        <div class="col-sm-9">
                            <input type="text" required id="title" name="title" class="form-control form-control-sm" value="<?php echo @$news_info[0]->title; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Summary:</label>
                        <div class="col-sm-9">
                            <textarea name="summary" id="summary" rows="4" style="resize: none;" class="form-control form-control-sm"><?php echo @$news_info[0]->summary; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Description:</label>
                        <div class="col-sm-9">
                            <textarea name="description" id="description" rows="4" style="resize: none;" class="form-control form-control-sm"><?php echo @$news_info[0]->description; ?></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="" class="col-sm-3">Category:</label>
                        <div class="col-sm-9">
                            <select name="cat_id" id="cat_id" class="form-control form-control-sm" required>
                                <option value="" selected disabled>--Select Any One--</option>
                                <?php 
                                    $category = new Category;
                                    $all_cats = $category->getAllCategories();
                                    if($all_cats){
                                      foreach($all_cats as $cat_info){
                                      ?>
                                          <option value="<?php echo $cat_info->id ?>" <?php echo (isset($news_info) && $news_info[0]->cat_id == $cat_info->id) ? 'selected' : '' ?>><?php echo $cat_info->title ?></option>
                                      <?php
                                      }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Reporter:</label>
                        <div class="col-sm-9">
                            <select name="reporter_id" id="reporter_id" class="form-control form-control-sm">
                                <option value="" selected disabled>--Select Any One--</option>
                                <?php 
                                    $user = new User;
                                    $reporters = $user->getUserByRole('reporter');
                                    if($reporters){
                                      foreach($reporters as $reporter_info){
                                      ?>
                                          <option value="<?php echo $reporter_info->id ?>" <?php echo (isset($news_info) && $news_info[0]->reporter_id == $reporter_info->id) ? 'selected' : '' ?>><?php echo $reporter_info->full_name ?></option>
                                      <?php
                                      }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Location:</label>
                        <div class="col-sm-9">
                            <input type="text" id="location" name="location" class="form-control form-control-sm" value="<?php echo @$news_info[0]->location; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">News Date:</label>
                        <div class="col-sm-9">
                            <input type="text" id="date" name="news_date" class="form-control form-control-sm date-picker" value="<?php echo @$news_info[0]->news_date; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Is sticky:</label>
                        <div class="col-sm-9">
                          <input type="checkbox" name="is_sticky" value="1" <?php echo (isset($news_info) && $news_info[0]->is_sticky == true) ? 'checked' : '' ?>> Yes
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Status:</label>
                        <div class="col-sm-9">
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="published" <?php echo (isset($news_info) && @$news_info[0]->status == 'published') ? 'selected' : ''; ?>>Published</option>
                                <option value="unpublished" <?php echo (isset($news_info) && @$news_info[0]->status == 'unpublished') ? 'selected' : ''; ?>>Unpublished</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Image:</label>
                        <div class="col-sm-4">
                            <input type="file" name="image" accept="image/*">
                        </div>
                        <div class="col-sm-4">
                            <?php 
                                if($act == 'Update' && isset($news_info) && !empty($news_info[0]->image) && file_exists(UPLOAD_DIR.'/news/'.$news_info[0]->image)){
                                  ?>
                                    <img src="<?php echo UPLOAD_URL.'/news/'.$news_info[0]->image ?>" alt="" class="img img-thumbnail img-responsive">
                                    <input type="checkbox" name="del_image" value="<?php echo $news_info[0]->image ?>"> Delete
                                  <?php
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-9">
                          <input type="hidden" name="news_id" value="<?php echo @$news_info[0]->id ?>">
                            <button class="btn btn-danger" type="reset">
                                Reset
                            </button>
                            <button class="btn btn-success" type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                                        
                    
                </form>
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
<script src="<?php echo ADMIN_ASSETS_URL; ?>/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo ADMIN_ASSETS_URL; ?>/plugins/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS_URL ?>/jquery.nepaliDatePicker.min.js"></script>
<link rel="stylesheet" href="<?php echo ADMIN_CSS_URL; ?>/nepaliDatePicker.min.css">
<script>
  
  ClassicEditor.create(document.querySelector('#description'),{
    ckfinder: {
      uploadUrl: '/admin/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
    }
  });


  $(".date-picker").nepaliDatePicker({
    dateFormat: "%y-%M-%d",
    closeOnDateSelect: true
});
</script>