<?php
error_reporting(0);

//Generates a random character
function random_char($string){
    $i = mt_rand(0, strlen($string)-1);
    return $string[$i];
}
//echo random_char($chars);

//Generates random string
function random_strings($length, $char_set){
    $output = '';
    for($i = 0; $i < $length; $i++){
        $output .= random_char($char_set);
    }
    return $output;
}

$options = array();
$options = array(
    'length' => $_POST['length'],
    'lower' => $_POST['length'],
    'upper' => $_POST['upper'],
    'numbers' => $_POST['numbers'],
    'symbols' => $_POST['symbols'],
);

//Generates random password
function generate_password($options){
   
    // Define character sets with PHP range()
    $lower   = implode(range('a', 'z'));
    $upper   = implode(range('A', 'Z'));
    $numbers = implode(range(0, 9));
    $symbols = '$*?!-';

    //extract configuration flags into variables
    $use_lower   = isset($options['lower']) ? $options['lower'] : '0' ;
    $use_upper   = isset($options['upper']) ? $options['upper'] : '0' ;
    $use_numbers = isset($options['numbers']) ? $options['numbers'] : '0' ;
    $use_symbols = isset($options['symbols']) ? $options['symbols'] : '0' ;


    $chars = ''; //master character set
    if($use_lower == 1){ $chars .= $lower; }
    if($use_upper == 1){ $chars .= $upper; }
    if($use_numbers == 1){ $chars .= $numbers; }
    if($use_symbols == 1){ $chars .= $symbols; }

    $length = isset($options['length']) ? $options['length'] : 8 ;
    return random_strings($length, $chars);
}
$password = generate_password($options);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Password Generator</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet" type="text/css">
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
          <li><a href="Password.php">Rate Password</a></li>
          <li><a href="Generate.php">Generate Password</a></li>
          </ul>
        </div>
	      <!-- /.navbar-collapse -->
      </div>
	    <!-- /.container-fluid -->
    </nav>
   
   <div class="row">
    <div class="col-lg-7 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12">
    
      <p>Generated Password: <?php echo $password; ?></p>

  <p>Generate a new password using the form options.</p>
  <form action="Generate.php" method="post">
      Length: <input type="text" class=""name="length" value="<?php if(isset($_POST['length'])) { echo $_POST['length']; } ?>" /><br />
      <input type="checkbox" name="lower" value="1" <?php if($_POST['lower'] == 1) { echo 'checked'; } ?> /> Lowercase<br />
      <input type="checkbox" name="upper" value="1" <?php if($_POST['upper'] == 1) { echo 'checked'; } ?> /> Uppercase<br />
      <input type="checkbox" name="numbers" value="1" <?php if($_POST['numbers'] == 1) { echo 'checked'; } ?> /> Numbers<br />
      <input type="checkbox" name="symbols" value="1" <?php if($_POST['symbols'] == 1) { echo 'checked'; } ?> /> Symbols<br />
      <input type="submit" class="btn btn-default"value="Submit" />
  </form>

</div> <!--colum-->
    </div> <!--row-->
	</div> <!--container-->
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.js"></script>
  </body>
</html>