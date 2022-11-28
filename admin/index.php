<?php require 'inc/header.php'; 
  if(isset($_SESSION['token']) && !empty($_SESSION['token'])){
    redirect('dashboard.php');
  }

  if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])){
   redirect('dashboard.php'); 
  }
?>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                    <?php flash(); ?>        

                  <form class="user" method="post" action="process/login.php">

                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" required aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" required class="form-control form-control-user" id="password" name="password" placeholder="Password">
                      <span id="error"></span>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

<?php require 'inc/footer.php'; ?>

<script>
    $('#password').keyup(function(){
        var passwrd = $('#password').val();
        checkPasswordStrength(passwrd);
    });

    function checkPasswordStrength(password){
        var strength = 1;
        if(password.length < 8){
          $('#error').html('password length should be greater or equal to 8 character.');
        } else {
          $('#error').html('');
        }

        if(!password.match(/[0-9]+/)){
          $('#error').html('password must contain atleast one digit.');
        }

        if(!password.match(/[a-zA-Z]+/)){
          $('#error').html('password must contain atleast one capital alphabet.');

        }

        /*if(strength <=0){
          $('#error').html('Weak password');
        }*/

    }
</script>