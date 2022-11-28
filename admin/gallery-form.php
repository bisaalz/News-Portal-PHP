<?php require 'inc/header.php';
  require 'inc/checkLogin.php';

  $gallery = new Gallery;
  $act = "Add";
  if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $act = "Update";
    $gallery_id = (int)$_GET['id'];
    if($gallery_id <=0){
      redirect('gallery.php', 'error','Inavalid Gallery Id.');
    }

    $gallery_info = $gallery->getGalleryById($gallery_id);
    if(!$gallery_info){
      redirect('gallery.php', 'error', 'Gallery not found.');
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
          <h1 class="h3 mb-4 text-gray-800">Gallery <?php echo $act; ?></h1>

          <div class="row">
            
            <div class="col-12">
                <form action="process/gallery.php" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Title:</label>
                        <div class="col-sm-9">
                            <input type="text" required id="title" name="title" class="form-control form-control-sm" value="<?php echo @$gallery_info[0]->title; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Summary:</label>
                        <div class="col-sm-9">
                            <textarea name="summary" id="summary" rows="4" style="resize: none;" class="form-control form-control-sm"><?php echo @$gallery_info[0]->summary; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Status:</label>
                        <div class="col-sm-9">
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="active" <?php echo (isset($gallery_info) && @$gallery_info[0]->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo (isset($gallery_info) && @$gallery_info[0]->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Cover Image:</label>
                        <div class="col-sm-4">
                            <input type="file" name="image" accept="image/*">
                        </div>
                        <div class="col-sm-4">
                            <?php 
                                if($act == 'Update' && isset($gallery_info) && !empty($gallery_info[0]->cover_image) && file_exists(UPLOAD_DIR.'/gallery/'.$gallery_info[0]->cover_image)){
                                  ?>
                                    <img src="<?php echo UPLOAD_URL.'/gallery/'.$gallery_info[0]->cover_image ?>" alt="" class="img img-thumbnail img-responsive">
                                    <input type="checkbox" name="del_image" value="<?php echo $gallery_info[0]->cover_image ?>"> Delete
                                  <?php
                                }
                            ?>
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Other Images:</label>
                        <div class="col-sm-9">
                          <input type="file" name="other_images[]" multiple accept="image/*" id="other_images">
                        </div>
                    </div>
                                        
                    
                    <div class="form-group row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-9">
                          <input type="hidden" name="gallery_id" value="<?php echo @$gallery_info[0]->id ?>">
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