<?php
	require 'php-func/dbconn.php';
	session_start();

	$ques_id = $_GET['id'];


	//get Question
	$getQuesQuery = "SELECT * FROM threads WHERE ques_id=".$ques_id;

	$runQues = mysqli_query($GLOBALS['conn'], $getQuesQuery);

	$ques = mysqli_fetch_assoc($runQues);

	$quesID = $ques['ques_id'];
	$quesTitle = $ques['ques_title'];
	$quesDesc = $ques['ques_desc'];
	$userID = $ques['user_id'];

	//get User
	$getUserQuery = "SELECT * FROM users WHERE user_id='$userID';";
	$getUser = mysqli_query($GLOBALS['conn'], $getUserQuery);
	$row = mysqli_fetch_assoc($getUser);


	//get Comments
	$getCommQuery = "SELECT * FROM comments WHERE ques_id = '$ques_id' ORDER BY comment_time DESC" ;
	//SELECT * FROM `comments` ORDER BY `comments`.`comment_time` DESC

	$runCom = mysqli_query($GLOBALS['conn'], $getCommQuery);

	if(isset($_POST['submit'])){
		//add Comments
		if(isset($_SESSION['username'])){
			$comment = $_POST['comment'];
			$userID = $_SESSION['id'];


			$addCommQuery = "INSERT INTO comments (user_id, ques_id, comment_content) VALUES ('$userID', '$ques_id', '$comment');";

			$addComm = mysqli_query($GLOBALS['conn'], $addCommQuery);



			header("location: " . $_SERVER['REQUEST_URI']);


		} else{
			echo '<div class="jumbotron">
							<h1 class="display-4">You are not Logged In!</h1>
							<p class="lead">You have to Login for posting a comment.</p>
							<button class="btn btn-outline-warning m-2 my-sm-0" type="button" data-toggle="modal" data-target="#login-modal">Login</button>
							<hr class="my-4">
							<p>If you don\'t have account, Sign Up here</p>
							<button class="btn btn-primary m-2 my-sm-0" type="button" data-toggle="modal" data-target="#signup-modal">Sign Up</button>
						</div>';
		}
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">

    <title>Qhouse</title>
  </head>
  <body>
		<?php require 'parts/_header.php' ?>
  	<!-- Main Content -->
		<main class="container-fluid row mt-3">

      <!-- Language Discription -->
      <aside class="col-md-3">
	      <?php
	      	echo "<div class='card text-white bg-info mb-3' style='max-width: 18rem;'>
				  <div class='card-header'>Question</div>
				  <div class='card-body'>
				    <h5 class='card-title'>".$quesTitle."</h5>
				    <p class='card-text'>".$quesDesc."</p>
						<p class='mt-n3'>Posted By: <b>". $row['user_name'] ."</b></p>
				  </div>
				</div>";
	      ?>
      </aside>

      <!-- Questions Area -->
      <section class="col-md-6">
      	<form class="mb-4" action="" method="post">
				  <div class="form-group">
				    <label for="comment">Add Your Answer</label>
				    <textarea type="text" class="form-control" id="comment" name="comment"></textarea>
				  </div>
				  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
				</form>

      	<h3 class="mb-4">Discussion</h3>
				<?php

	     	while($comment = mysqli_fetch_assoc($runCom)){
					$commentUserID = $comment['user_id'];

					//get User
					$getUserQuery = "SELECT * FROM users WHERE user_id='$commentUserID';";
					$getUser = mysqli_query($GLOBALS['conn'], $getUserQuery);
					$row = mysqli_fetch_assoc($getUser);


					$commentID = $comment['comment_id'];
					$commentContent = $comment['comment_content'];

	    	echo "<div class='media my-4'>
			  <img src='assets/profile_pic/". $row['user_img'] ."' height='50' width='50' class='mr-3 rounded-circle' alt='...'>
			  <div class='media-body'>
			    <p>".$commentContent."</p>
					<p class='mt-n3'>Posted By: <b>". $row['user_name'] ."</b></p>
			  </div>
			</div>";
		}
		?>
      </section>

      <!-- User Profile -->
      <aside class="col-md-3">
      	<?php require 'parts/_user-profile.php' ?>
      </aside>

  	</main>


	<?php require 'parts/_footer.php' ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


  </body>
</html>
