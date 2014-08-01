<?php require_once 'core/init.php'; 
$user = new User();

if($user->isLoggedIn()) {
	echo '<b>You can not be Loged in to access this page</b>';
	exit;
}
	if(Input::exists()) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'email' => array(
					'required' => true),
					
			));
	
			if($validation->passed()) {
				$email = $_POST["email"];
				
				if($user->emailExists($email)){
					$pass = $user->randomPassword();
						
					//echo "Email exists in database. ";
					//echo $pass;
					$user->mailresetlink($email,$pass);
					
					
					try {
						$user->create_pass(array(
						'pwkey' => $pass,
						'email' => Input::get('email'),
						'created'=> date('Y-m-d H:i:s')
						));	
						
						
					} catch(Exception $e) {
						die($e->getMessage());
					}

				} else {
					echo "<b>The email " .$email ." is not found in our Database.</b>";
				}
		}else {
			echo '<b>You did not enter an email address!</b>';
		}
			}
?>
 <h2>Request to Reset Password for ACES</h2>
 <h3>Your email must match email from account</h3><br/>
    <form method="post" action=""> 
      <table width="602" border="0" cellspacing="2" cellpadding="1"> 
<tr> 
<td width="41%">Enter your email address:</td> 
<td width="59%"><input name="email" type="text" size="40"></td> 
</tr> 
<tr> 
  <td></td> 
  <td align="left" valign="top"><input type="submit" name="submit" value="Request New Password"></td> 
</tr> 
</table> 
</form>
<br/>
<p>Return to <a href="index.php">ACES</a> Website</p>
<p>If there are any problems with this Form please contact: <a href="mailto:odetteds@comcast.net">Maintnance</a></p>

