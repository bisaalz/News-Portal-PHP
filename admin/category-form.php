<?php require 'inc/header.php';
  require 'inc/checkLogin.php';

  $category = new Category;
  $act = "Add";
  if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $act = "Update";
    $cat_id = (int)$_GET['id'];
    if($cat_id <=0){
      redirect('category.php', 'error','Inavalid Category Id.');
    }

    $cat_info = $category->getCategoryById($cat_id);
    if(!$cat_info){
      redirect('category.php', 'error', 'Category not found.');
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
          <h1 class="h3 mb-4 text-gray-800">Category <?php echo $act; ?></h1>

          <div class="row">
            
            <div class="col-12">
                <form action="process/category.php" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Title:</label>
                        <div class="col-sm-9">
                            <input type="text" required id="title" name="title" class="form-control form-control-sm" value="<?php echo @$cat_info[0]->title; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Summary:</label>
                        <div class="col-sm-9">
                            <textarea name="summary" id="summary" rows="4" style="resize: none;" class="form-control form-control-sm"><?php echo @$cat_info[0]->summary; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Status:</label>
                        <div class="col-sm-9">
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="active" <?php echo (isset($cat_info) && @$cat_info[0]->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo (isset($cat_info) && @$cat_info[0]->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
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
                                if($act == 'Update' && isset($cat_info) && !empty($cat_info[0]->image) && file_exists(UPLOAD_DIR.'/category/'.$cat_info[0]->image)){
                                  ?>
                                    <img src="<?php echo UPLOAD_URL.'/category/'.$cat_info[0]->image ?>" alt="" class="img img-thumbnail img-responsive">
                                    <input type="checkbox" name="del_image" value="<?php echo $cat_info[0]->image ?>"> Delete
                                  <?php
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-9">
                          <input type="hidden" name="cat_id" value="<?php echo @$cat_info[0]->id ?>">
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