<?php
  require 'php-func/dbconn.php';

  function checkUsername($user){
		$check = "SELECT * FROM users where username = '$user'";

		$run = mysqli_query($GLOBALS['conn'], $check);

		$rowlen = mysqli_num_rows($run);

		if($rowlen == 0){
			return true;
		} else{
			return false;
		}
	}

  if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];


    $check = checkUsername($username);

		if(!$check){
			echo "<div class='alert alert-danger' role='alert'>Choose Another Username</div>";
		} else {

      if(isset($_FILES['avatar'])){
        $file_type = $_FILES['avatar']['type'];

        if($file_type == "image/png" || $file_type == "image/jpg" || $file_type == "image/jpeg" || $file_type == ""){
          $file_name = $_FILES['avatar']['name'];
          $file_tmp = $_FILES['avatar']['tmp_name'];

          if($file_name == ""){
            $file_name = "avatar.png";
          }

			    $securePassword = password_hash($password, PASSWORD_DEFAULT);
          $insertQuery = "INSERT INTO users(user_name, username, user_password, user_img) values('$name', '$username', '$securePassword', '$file_name')";
          $runInsert = mysqli_query($GLOBALS['conn'], $insertQuery);

          move_uploaded_file($file_tmp, "assets/profile_pic/".$file_name);

          echo "<div class='alert alert-success' role='alert'>
          <h4 class='alert-heading'>Success!</h4>
          <p>You are Now Signed Up</p>
          <hr>
          <p>You can Login Now</p>
          <a type='submit' class='btn btn-primary' data-toggle='modal' data-target='#login-modal'>Login</a>
          </div>";

          } else{
            echo "<div class='alert alert-danger' role='alert'>File Must be JPG/PNG/JPEG</div>";
          }
        }


		}
	}
?>
<div class="modal" tabindex="-1" id="signup-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group mb-4">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>


          <b>Get Yourself a Avatar</b>
          <div class="input-group mb-3">
      			<input id="avatar" name="avatar" type="file" class="file" data-browse-on-zone-click="true">
      		</div>

          <button type="submit" class="btn btn-primary mt-4" name="signup">SignUp</button>
        </form>
      </div>
    </div>
  </div>
</div>
