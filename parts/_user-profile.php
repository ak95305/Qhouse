<?php
  require 'php-func/dbconn.php';
  if(isset($_SESSION['username'])){
    echo '<div class="card">
    <div class="card-body">
      <div class="d-flex flex-column align-items-center text-center">
        <img src="assets/profile_pic/'.$_SESSION["user_img"].' " alt="Admin" class="rounded-circle" height="150" width="150">
        <div class="mt-3">
          <h4>'.$_SESSION["name"].'</h4>
          <p class="text-secondary mb-1">'.$_SESSION["username"].'</p>
        </div>
      </div>
    </div>
  </div>';
}else{
  echo '<div class="card">
  <div class="card-body">
    <div class="d-flex flex-column align-items-center text-center">
      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
      <div class="mt-3">
        <h4>You are not Logged In!</h4>
        <p class="text-secondary mb-1">Log in for asking question and posting comments.</p>
      </div>
    </div>
  </div>
</div>';
}
?>
