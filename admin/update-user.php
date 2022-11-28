<?php require 'inc/header.php';
  require 'inc/checkLogin.php';
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
          <h1 class="h3 mb-4 text-gray-800">Update Profile</h1>

          <div class="row">
            
            <div class="col-12">
                <form action="process/user.php" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" required id="full_name" name="full_name" class="form-control form-control-sm" value="<?php echo $_SESSION['full_name']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="" class="col-sm-3">Change password: </label>
                      <div class="col-sm-9">
                        <input type="checkbox" name="change_pwd" id="change_pwd" value="1"> Yes
                      </div>
                    </div>
                    
                    <div class="d-none" id="password_div">
                      <div class="form-group row">
                          <label for="" class="col-sm-3">Old password:</label>
                          <div class="col-sm-9">
                              <input type="password" id="old_password" name="old_password" class="form-control form-control-sm" value="">
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="" class="col-sm-3">Password:</label>
                          <div class="col-sm-9">
                              <input type="password" id="password" name="password" class="form-control form-control-sm" value="">
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="" class="col-sm-3">Confirm Password:</label>
                          <div class="col-sm-9">
                              <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-sm" value="">
                              <span class="alert-danger" id="error_password"></span>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3">Profile Image:</label>
                        <div class="col-sm-9">
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-9">
                            <button class="btn btn-danger" type="reset">
                                Reset
                            </button>
                            <button class="btn btn-success" type="submit" id="submit">
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

<script>
  $('#change_pwd').on('change', function(){
      var checked = $('#change_pwd').prop('checked');
      if(checked){
          $('#password_div').removeClass('d-none');
          $('#password').attr('required', true);
          $('#old_password').attr('required', true);
          $('#confirm_password').attr('required', true);
      } else {
          $('#password_div').addClass('d-none');
          $('#password').removeAttr('required', true);
          $('#old_password').removeAttr('required', true);
          $('#confirm_password').removeAttr('required', true);
      }
  });

  $('#confirm_password').keyup(function(){
      var password = $('#password').val();
      var confirm_password = $('#confirm_password').val();

      if(password == ''){
        $('#error_password').html('Password cannot be empty.');
        $('#submit').attr('disabled', true);
      } else {
          if(password.length < 8){
            $('#error_password').html('Password should be atleast 8 character long.');
            $('#submit').attr('disabled', true);
          } else {
              if(password == confirm_password){
                $('#error_password').html('');
                $('#submit').removeAttr('disabled', true);
              } else {
                $('#error_password').html('Password and confirm password should match.');
                $('#submit').attr('disabled', true);
              }
          }
      }
  });
</script>