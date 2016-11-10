<?php error_reporting(0); 

function detect_any_uppercase($string) {
  // true if lowercasing changes string
  return strtolower($string) != $string;
}

function detect_any_lowercase($string) {
  // true if uppercasing changes string
  return strtoupper($string) != $string;
}

function count_numbers($string) {
  return preg_match_all('/[0-9]/', $string);
}

function count_symbols($string) {
  // You have to decide which symbols count
  // Regex \W is any non-letter, non-number: too broad
  // Better to list the ones that count
  return preg_match_all('/[!@#$%^&*-_+=?]/', $string);
}


function password_strength($password) {
  $strength = 0;
  $possible_points = 12;
  $length = strlen($password);
  
  if(detect_any_uppercase($password)) {
    $strength += 1;
  }
  if(detect_any_lowercase($password)) {
    $strength += 1;
  }
  
  $strength += min(count_numbers($password), 2);
  $strength += min(count_symbols($password), 2);
  
  if($length >= 8) {
    $strength += 2;
    $strength += min(($length -8) * 0.5, 4);
  }
  
  $strength_percent = $strength / (float) $possible_points;
  $rating = floor($strength_percent * 10);
  return $rating;
}

$password = $_POST['rate'];
$rating = password_strength($password);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Password Utilities</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet" type="text/css">
	<style>
		
		    #meter div {
      height: 20px; width: 20px;
      margin: 0 1px 0 0; padding: 0;
      float: left;
      background-color: #DDDDDD;
    }
    #meter div.rating-1, #meter div.rating-2 {
      background-color: green;
    }
    #meter div.rating-3, #meter div.rating-4 {
      background-color: blue;
    }
    #meter div.rating-5, #meter div.rating-6 {
      background-color: yellow;
    }
    #meter div.rating-7, #meter div.rating-8 {
      background-color: orange;
    }
    #meter div.rating-9, #meter div.rating-10 {
      background-color: red;
		</style>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
  <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/lobster-two:n4:default;cardo:n4:default;miama:n4:default;abril-fatface:n4:default.js" type="text/javascript"></script>
</head>
  <body>
	<div class="container">
	  <nav class="navbar navbar-default">
	    <div class="container-fluid">
	      <!-- Brand and toggle get grouped for better mobile display -->
	      <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
</div>
	      <!-- Collect the nav links, forms, and other content for toggling -->
	      <div class="collapse navbar-collapse" id="defaultNavbar1">
<ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Rate Password</a></li>
          <li><a href="Generate.php">Generate Password</a></li>
          </ul>
        </div>
	      <!-- /.navbar-collapse -->
      </div>
	    <!-- /.container-fluid -->
    </nav>
<div class="row">
    <div class="col-lg-7 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12">
	      <h3>I know, life is too short.. not in this project. Have fun,intelligently!</h3>
        <hr class="divider"></hr>
	       <p> Your password rating is: <?php echo $rating; ?>
	       
	   <div id="meter">
      <?php
      for($i=0; $i < 10; $i++) {
        echo "<div";
        if($rating > $i) {
          echo " class=\"rating-{$rating}\"";
        }
        echo "></div>";
      }
      ?>
    </div>
	     
<br><br>
	     <p>Please Rate The strength of your password</p>
			<form action="Password.php" method="post">
				<div class="form-group">
					<div class="controls">
						<input class=" form-control col-sm-6 col-lg-6" type="text" name="rate" id="rate" autofocus placeholder="Password">
					</div><!-- controls -->
				</div><!-- form-group -->

      <input type="submit" class="btn btn-default" value="submit">
	      
	
			</form>
</div>
    </div>
	</div>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.js"></script>
  </body>
</html>