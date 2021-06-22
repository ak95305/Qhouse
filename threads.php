<?php
	require 'php-func/dbconn.php';
	session_start();
	$cat_id = $_GET['id'];


	//get Category
	$getCatQuery = "SELECT * FROM categories WHERE cat_id=".$cat_id;

	$runCat = mysqli_query($GLOBALS['conn'], $getCatQuery);

	$cat = mysqli_fetch_assoc($runCat);


	//get Category Questions
	$getQuesQuery = "SELECT * FROM threads WHERE ques_cat_id=".$cat_id;

	$runQues = mysqli_query($GLOBALS['conn'], $getQuesQuery);

	//Add Question to Database
	if(isset($_POST['ask'])){
		if(isset($_SESSION['username'])){
			$question = $_POST['question'];
			$description = $_POST['description'];
			$user_id = $_SESSION['id'];

			$addQuesQuery = "INSERT INTO threads (ques_title, ques_desc, ques_cat_id, user_id) VALUES ('$question', '$description', '$cat_id', '$user_id');";

			$addQues = mysqli_query($GLOBALS['conn'], $addQuesQuery);

			header("location: " . $_SERVER['REQUEST_URI']);

		} else{
			echo '<div class="jumbotron">
							<h1 class="display-4">You are not Logged In!</h1>
							<p class="lead">You have to Login before posting Questions.</p>
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

    <title><?php echo $cat['cat_title']?> - Discuss</title>

  </head>
  <body>

  	<?php require 'parts/_header.php' ?>

  	<!-- Main Content -->
	<main class="container-fluid row mt-3">

      <!-- Language Discription -->
      <aside class="col-md-3">
	      <?php
	      	echo "<div class='card text-white bg-primary mb-3' style='max-width: 18rem;'>
				  <div class='card-header'>Language</div>
				  <div class='card-body'>
				    <h5 class='card-title'>". $cat['cat_title'] ."</h5>
				    <p class='card-text'>". $cat['cat_desc'] ."</p>
				  </div>
				</div>";
	      ?>
      </aside>

      <!-- Questions Area -->
      <section class="col-md-6">
    	<!--Question Form-->
		  <form class="mb-5" action="<?php echo $_SERVER["REQUEST_URI"];?>" method="post">
  	  <h4>Ask a Question</h4>
		  <div class="form-group">
		    <label for="question">Question</label>
		    <input type="text" class="form-control" id="question" name="question">
		  </div>
		  <div class="form-group">
		    <label for="description">Description</label>
		    <textarea type="text" class="form-control" id="description" name="description" rows="5"></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary" name="ask">Ask</button>
		</form>

		<!--Questions-->
      	<h3 class="mb-4">Questions</h3>
	    <?php
	     	while($catQues = mysqli_fetch_assoc($runQues)){
	     		$quesID = $catQues['ques_id'];
	     		$quesTitle = $catQues['ques_title'];
	     		$quesDesc = $catQues['ques_desc'];
					$userID = $catQues['user_id'];

					$getUserQuery = "SELECT * FROM users WHERE user_id='$userID';";
					$getUser = mysqli_query($GLOBALS['conn'], $getUserQuery);
					$row = mysqli_fetch_assoc($getUser);

	    	echo "<div class='media my-4'>
			  <img src='assets/profile_pic/". $row['user_img'] ."' height='50' width='50' class='mr-3 rounded-circle' alt='...'>
			  <div class='media-body'>
			    <h5 class='mt-0'><a href='question.php?id=".$quesID."' class='text-dark'>".$quesTitle."</a></h5>
			    <p>".$quesDesc."</p>
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
