<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
  </head>
  <body>
      <div class="container-fluid">

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
              <h2 class="text-center"><img class="" src="./img/logo3.png"></h2>
          </div>
        </div>
      </div>
    </header>
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <form id="login" method="post" action="./processors/log-in.php" class="well">
                  <?php if(isset($_GET['uerror'])) : ?>
                  <div class="alert alert-danger">
                      Username doesn't exist
                  </div>
                  <?php elseif(isset($_GET['perror'])) : ?>
                  <div class="alert alert-danger">
                      Incorrect password
                  </div>
                  <?php elseif(isset($_GET['inactive'])) : ?>
                  <div class="alert alert-danger">
                      Please activate your account from your email
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label>Email Address/Username</label>
                    <input type="text" class="form-control" name="uid" placeholder="Enter Email or Username" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pwd" placeholder="Password" required>
                  </div>
                   <div class="hidden">
                       <input type="text" name="id" value="<?php echo $id ?>">
                  </div>
                  
                  <button type="submit" id="return" class="btn btn-default btn-block" name="submit">Login</button>
                  <br>
                  <p class=""><a href="./forgot_password.php">Forgot password?</a></p>
                  <p><strong>OR</strong></p>
                  <p>Don't have an account? <a href="signup.php">Signup here.</a></p>
              </form>
              
          </div>
        </div>
      </div>
    </section>
          <p class="text-center"><a href="blog.php"class="btn btn-default" id="return">Return to Blog Page</a></p>
  
      </div>
  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
