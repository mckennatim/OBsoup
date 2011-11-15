<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hot Soup</title>
	<link type="text/css" href="stylesheets/blueprint/screen.css" rel="stylesheet" />	
	<link type="text/css" href="stylesheets/custom.css" rel="stylesheet" />	
</head>
<body>

	<div class="container">
		<header>
			<nav class="round">
			</nav>
			<section class="round">
			<img src="images/soupbanner.jpg" alt="soup banner" /> 
			</section>
		</header>
		<section class="round">
			<h1>OB Hot Soup project organizer/volunteer sign up</h1>
			<p>
We will contact you when we are ready to go	
<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
			</p>
			<form id="form1" name="Update" method="post" action="soup-signup.php">
			  <label>
			  name: <input type="text" name="name" id="quesfrom" size="60"/>
			  </label>
			  <br />
			  <label>
			  email: <input type="text" name="email" id="choicefrom" size="60"/>
			  </label>
			  <br />
			  <label>
			  password: <input type="password" name="password" id="choicefrom" size="60"/>
			  </label>
			  <br />
              <label> 			
			  confirm password: <input type="password" name="cpassword" id="choicefrom" size="60"/>
			  </label>
			  <br />
			<input class="signup_button round" type="submit" value="send your info" />
			</form>
		</section>
	</div>
</body>
</html>
