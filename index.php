<?php
	//echo " Today is " . date("l") . ". ";

	// Message Vars
	$msg = '';
	$msgClass = '';
	// Check for submit
	if (filter_has_var(INPUT_POST, 'submit')) {
		//Get Form Data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		// Check required fields
		if (!empty($email) && !empty($name) && !empty($message)) {
			// Passed
			//CHeck email
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				//failed
				$msg = 'Please use a valid email';
				$msgClass = 'alert alert-dismissible alert-danger';
			} else {
				//Passed
				$toEmail = 'coc2016vzla@gmail.com';
				$subject = 'Contact request from '.$name;
				$body = '<h2>Contact Request</h2>
						 <h4>Name</h4><p>'.$name.'</p>
						 <h4>Email</h4><p>'.$email.'</p>
						 <h4>Message</h4><p>'.$message.'</p>
				';

				//Email Headers
				$headers = "MIME-Version: 1.0" ."\r\n";
				$headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

				//Additional headers
				$headers .= "From: ".$name. "<".$email.">". "\r\n";

				if (mail($toEmail, $subject, $headers)) {
					// Email Send
					$msg = 'Your message have been send <strong>successfully</strong>';
					$msgClass = 'alert alert-dismissible alert-success';
				} else {
					// Failed
					$msg = '<strong>Change a few things up</strong> and try submitting again.';
					$msgClass = 'alert alert-dismissible alert-danger';
				}
			}
		} else {
			// Failed
			$msg = 'Please fill in all fields';
			$msgClass = 'alert-danger';
		}

	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Contact US</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav> 
</header>

		<div class="container">
			<?php if ($msg != ''): ?>
				<div class="alert <?php echo $msgClass ?>"> <?php echo $msg; ?> </div>
			<?php endif; ?>
			<form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<fieldset>
					<legend>Contact us for get more information about ethical hacking service</legend>
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" value="<?php echo isset($_POST['name']) ? $name : ' '; ?>">
				</div>
				<div class="form-group">
					<label>Email address</label>
					<input class="form-control" type="text" name="email" value="<?php echo isset($_POST['email']) ? $email : ' '; ?>">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div>
				<div class="form-group">
					<label>Message</label>
					<textarea class="form-control" type="text" name="message" value="<?php echo isset($_POST['message']) ? $message : ' '; ?>" rows="3"></textarea>
				</div>
				<br>
				<button class="btn btn-primary" type="submit" name="submit">Submit</button>
				</fieldset>
			</form>
			</div>
	</body>
</html>
