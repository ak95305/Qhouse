<?php
ob_start();
//SignUp Modal
  require 'parts/_signup.php';

//Login Modal
  require 'parts/_login.php';
  ob_end_flush();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/Qhouse">Qhouse</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/Qhouse">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Catogories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Python</a>
          <a class="dropdown-item" href="#">JavaScript</a>
          <a class="dropdown-item" href="#">Java</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <?php
      if(!isset($_SESSION['username'])){
      echo '<button class="btn btn-outline-warning m-2 my-sm-0" type="button" data-toggle="modal" data-target="#login-modal">Login</button>
      <button class="btn btn-primary m-2 my-sm-0" type="button" data-toggle="modal" data-target="#signup-modal">Sign Up</button>';
      }else{
      echo '<a class="btn btn-danger m-2 my-sm-0" type="submit" href="parts/_logout.php">Logout</a>';
      }
      ?>
    </form>
  </div>
</nav>
