<?php require_once 'core/init.php'; 
$user = new User();

if($user->isLoggedIn()) {
	echo 'You can not be Loged in to access this page';
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
					
					$usern = DB::getInstance()->query("SELECT username FROM users WHERE email = '".$email."'");
	
					if($usern->count()){
						
						foreach($usern->results() as $usern) {
						$username = $usern->username;
						$user->mailUsername($email,$username);
						exit;
						}
					}else{
						echo 'No username found!';	
					}
				} else {
					echo "The email " .$email ." is not found in our Database.";
				}
		}else {
			echo 'You did not enter an email address!';
		}
			}
?>
 <h2>Request  of Username for ACES</h2>
  <h3>Your email must match email from account</h3><br/>
    <form method="post" action=""> 
      <table width="602" border="0" cellspacing="2" cellpadding="1"> 
<tr> 
<td width="41%">Enter your email address:</td> 
<td width="59%"><input name="email" type="text" size="40"></td> 
</tr> 
<tr> 
  <td></td> 
  <td align="left" valign="top"><input type="submit" name="submit" value="Request Username"></td> 
</tr> 
</table> 
</form>
<br/>
<p>Return to <a href="index.php">ACES</a> Website</p>
<p>If there are any problems with this Form please contact: <a href="mailto:odetteds@comcast.net">Maintnance</a></p>

