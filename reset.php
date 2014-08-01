<?php require_once 'core/init.php';

$user = new User();

$pass = $_GET['pass'];
$email = $_GET['email'];

if($user->isLoggedIn()) {
	echo 'You can not be Loged in to access this page';
	echo '<p> Return to home page: <a href = "index.php">Home</a></p>';
	exit;
}
if($user->getUserEmail($pass)){
	//echo '<p>This is a  valid token link </p>';

	$is_email = DB::getInstance()->query("SELECT email FROM recover WHERE pwkey = '".$pass."'");
	
		if($is_email->count()){
			//echo '<p> email is true </p>';
			foreach($is_email->results() as $is_email) {
			echo '<p>',$is_email->email ,'</p>';
			}
			}else{
			echo '<p>EMAIL ERROR:Invalid link or Password already changed! </p> ';
			echo '<p>If link in email is not working, have a new "Password Reset" email sent to your email address!</p>';
			echo 'If problem continuous contact: <a href="mailto:odetteds@comcast.net">Admin</a> with your email and error message displayed.</p>';
			exit;
			}

		if ($is_email->email == $email) {
			
			//echo '<p> Email match reset password</p>';
						
					if(Input::exists()) {
						if(Token::check(Input::get('token'))) {
							
						$validate = new Validate();
						$validation = $validate->check($_POST, array(
							'password' => array(
								'required' => true,
								'min' => 6),
							'password_again' => array(
								'required' => true,
								'min' => 6,
								'matches' => 'password_again')
						));
						
						if($validation->passed()) {
							
							if ($_POST['password'] === $_POST['password_again']) {
								//echo 'password match<br/>';
								
									$salt = Hash::salt(32);
										
									$password = Hash::make(Input::get('password'), $salt);
									//echo $email.'<br/>'. $password. '<br/>' . $salt . '<br/>';
								
									if($user->updatePass($password, $salt, $email)){
										
										if ($user->deletePass($email)){
										echo '<h3>You have sucessfully reset your password: <a href = "login.php">Login</a></h3>';
										exit;
										}else {
										echo 'DELET ERROR: A problame in the updating of Database occured';
										echo '<p>Please contact <a href="mailto:odetteds@comcast.net">Admin</a> with your email and error message displayed</p>';
										exit;
										}
										
										}else {
										echo '<h3>UPDATE ERROR: There was a problem updating password. Please try aggain in a few minutes.</3>';
										echo '<p>If problem continuous contact <a href="mailto:odetteds@comcast.net">Admin</a></p>';
										echo '<p> Return to home page: <a href = "index.php">Home</a></p>';
										exit;
										}
							}
						} else {
							foreach($validate->errors() as $error) {
								echo $error, '<br>';
							}
						}
				}
			}
					}else{
					echo '<p>EMAIL TOKEN ERROR: Invalid link or Password already changed! </p> ';
					echo '<p>If link in email is not working have a new "Password Rese"t email sent to your email address!</p>';
					echo 'If problem continuous contact: <a href="mailto:odetteds@comcast.net">Admin</a> with your email and error message displayed</p>';
					exit;
					}
	}else {
	echo '<p>PASS ERROR: Invalid link or Password already changed! </p> ';
	echo '<p>If link in email is not working have a new "Password Reset" email sent to your email address!</p>';
	echo 'If problem continuous contact: <a href="mailto:odetteds@comcast.net">Admin</a> with your email and error message displayed</p>';
	exit;	
	}	
?>
  <h1>Enter New Password:</h1>
   <form action="" method="post">
  <table width="550" border="0" class="form_field" >
  <tr>
    <td><label for="password">New Password :</label></td>
    <td> <input name="password" type="password" id="password" size="41" /></td>
  </tr>
  <tr>
    <td><label for="password_again">Confirm New Password :</label></td>
    <td><input name="password_again" type="password" id="password_again" size="41" /></td>
  </tr>
  <tr>
    <td height="55" align="center"><input type="submit" value="Change"></td>
    <td><input type="hidden" name="token" value="<?php echo Token::generate(); ?>"></td>
  </tr>
  </table>
</form>