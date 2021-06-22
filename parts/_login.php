<?php
  require 'php-func/dbconn.php';


  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = "SELECT * FROM users where username = '$username'";

    $run = mysqli_query($GLOBALS['conn'], $check);

    $rowlen = mysqli_num_rows($run);

    if($rowlen == 1){
      $row = mysqli_fetch_assoc($run);
      $name = $row['user_name'];
      $id = $row['user_id'];
      $img = $row['user_img'];

      $originalPassword = $row['user_password'];

      if(password_verify($password, $originalPassword)){
          session_start();

          $_SESSION['username'] = $username;
          $_SESSION['name'] = $name;
          $_SESSION['id'] = $id;
          $_SESSION['user_img'] = $img;

          header("location: " . $_SERVER['REQUEST_URI']);
      } else {
        echo "<div class='alert alert-danger' role='alert'>Wrong Password</div>";
      }
    } else{
      echo "<div class='alert alert-danger' role='alert'>Username don't Exist</div>";
    }
  }
?>
<div class="modal" tabindex="-1" id="login-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php $_SERVER['REQUEST_URI']?>" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
