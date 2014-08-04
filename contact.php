<?php require_once 'core/init.php';
 $user = new User();
  if(Input::exists()) {

	if(Token::check(Input::get('token'))) {
				
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'min' => 2,
				'max' => 20),
			'first_name' => array(
				'required' => true,
				'min' => 2,
				'max' => 30),
			'last_name' => array(
				'required' => true,
				'min' => 2,
				'max' => 30),
			'email' => array(
				'required' => true,
				'email_tag' => true,
				'min' => 2,
				'max' => 60),
			'coment' => array(
				'required' => true,
				'min' => 5,
				'max' => 500)
		));

		if($validation->passed()) {
			
			//$salt = Hash::salt(32);
			
			try {
				$user->contact(array(
					'username' 	=> Input::get('username'),
					'first_name'=> Input::get('first_name'),
					'last_name' => Input::get('last_name'),
					'email' 	=> Input::get('email'),
					'coment' 	=> Input::get('coment'),
					'sent'	=> date('Y-m-d H:i:s')
				));
					$first_name = $_POST['first_name'];
					$last_name = $_POST['last_name'];
					$username = $_POST['username'];
					$email = $_POST['email'];
					$coment = $_POST['coment'];
					
					$email_from = 'fairtradetn@gmail.com';
					$email_subject = "A Contact Form has been sent to DB";
					$email_body = "ACES:\n \n ".
					"First Name:   $first_name \n".
					"Last Name:   $last_name \n".
					"Username:   $username \n".
					"Email:   $email \n ".
					"Coment: $coment \n ".
					"Messege send to:   ".
			
					$to = $email_from;
					$headers = "From: $email_from \r\n";
					$headers .= "Reply-To: $email \r\n";
		
					mail($to,$email_subject,$email_body,$headers);
					
					Session::flash('home', $email. ' <br/>Your message has been sent. Thank you for contacting us!<br/>');
				    Redirect::to('index.php');
			
				
			} catch(Exception $e) {
				die($e->getMessage());
			}
			
		}else {
			foreach($validate->errors() as $error) {
			echo '<b>', $error, '</b><br>';
			}
		}
	}
  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Layout.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ACES</title>
<style type="text/css">
.style6 {
	font-weight: bold;
	color: #F00;
	font-size: 12px;
}
</style>
<!-- InstanceEndEditable -->
<link href="CSS/thrColLiqHdr.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a:link {
	color: #0033CC;
}
a:visited {
	color: #000066;
}
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div class="container"><!-- InstanceBeginEditable name="LoginHeader" --> <?php include 'includes/login_user_header.php'; ?><!-- InstanceEndEditable -->
<div class="header"><img src="Images/banner1.png" width="100%" height="133" alt="logo" />
<!-- end .header --></div>
<div class="header2">
  <ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="index.php">Home</a></li>
<li><a class="MenuBarItemSubmenu" href="#">Member</a>
  <ul>
    <li><a href="register.php">Become a Member</a>      </li>
    <li><a href="login.php">Login</a></li>
    <li><a href="profile.php">Member Profiles</a></li>
  </ul>
</li>
<li><a href="#">Payment</a>  </li>
<li><a class="MenuBarItemSubmenu" href="#">Support</a>
  <ul>
    <li><a href="page1.html">FAQ</a></li>
    <li><a href="contact.php">Contact Us</a></li>
<li><a href="page1.html">Services Offered</a></li>
  </ul>
</li>
    <li><a href="#" class="MenuBarItemSubmenu">More</a>
      <ul>
        <li><a href="page1.html">Advertise</a></li>
        <li><a href="page1.html">Links</a></li>
</ul>
  </li>
  </ul>
</div>
  <div class="sidebar1"><!-- Left Sidebar with links and media buttons-->    
  <a href="http://www.facebook.com" target="new"><img src="Images/facebook-logo1.jpg" width="112" height="39" alt="fb" /></a>
  <a href="contact.php"><img src="Images/button1.png" width="112" height="38" alt="contact" /></a>
  <a href="register.php"><img src="Images/button2.png" width="112" height="39" alt="Be a Member" /></a> 
  <a href="login.php"><img src="Images/button3.png" width="115" height="38" alt="Login" /></a> 
  <br /><br />

  </div>  

 
  <!-- end .sidebar1 -->
  <div class="content">
  <!-- InstanceBeginEditable name="EditRegion4" -->
<div class="user_bar" >  
Please expect 24 hour respond time!
<?php 
 if ($validation === false){
	  				foreach($validate->errors() as $error) {
					echo '<br>',$error ;
				}
 }
	?>
   </div>  
 <!-- InstanceEndEditable -->
  <!-- InstanceBeginEditable name="EditRegion3" --> 

    <h1>Contact Form:</h1>
        <form action="" method="post">
          <table width="548" border="0" cellspacing="10" class="form_field" >
            <tr>
    <td width="228"><label for="username">Username : </label></td>
    <td width="286"><input name="username" type="text" id="username" size="40" value="<?php echo escape($user->data()->username); ?>" ></td>
  </tr>
  <tr>
    <td><label for="first_name">First Name:</label></td>
    <td><input name="first_name" type="text" id="first_name" size="40"></td>
  </tr>
    <tr>
    <td><label for="last_name">Last Name:</label></td>
    <td><input name="last_name" type="text" id="last_name" size="40"></td>
  </tr>
  <tr>
    <td><label for="email">Email address:</label></td> 
<td><input name="email" type="text" id="email" size="40" value="<?php echo escape($user->data()->email); ?>" ></td>
  </tr>
  <tr>
    <td><label for+"coment">Coment:</label></td>
    <td><textarea name="coment" cols="40" rows="5"></textarea></td>
  </tr>
  <tr>
    <td height="48" align="center"><input name="reset" type="reset" value="Reset" />&nbsp;&nbsp;<input name="submit" type="submit" value="Send " /> </td>
    <td><input type="hidden" name="token" value="<?php echo Token::generate(); ?>"></td>
  </tr>
</table>
    </form>

<br/>
<p>If there are any problems with this Form please contact: <a href="mailto:odetteds@comcast.net">Maintnance</a></p>
	<!-- InstanceEndEditable -->
  
  <!-- end .content --></div>
  <div class="sidebar2">
 
<!-- Begining of random Advertisment Images with hyperlink -->
<script type="text/javascript">
var total_images = 5;
var random_number = Math.floor((Math.random()*total_images));
var random_img = new Array();
random_img[0] = '<a href="http://www.docbo.com" target="new"><img src="Images/drBo.jpg"></a>';
random_img[1] = '<a href="http://www.johnsoncityhonda.com" target="new"><img src="Images/jc_honda.jpg"></a>';
random_img[2] = '<a href="http://www.northeaststate.edu" target="new" ><img src="Images/nestcc.jpg"></a>';
random_img[3] = '<a href="http://www.americanimportservices.com" target="new" ><img src="Images/american_auto_banner.jpg"></a>';
random_img[4] = '<a href="http://www.sahibsindianrestaurant.com" target="new"><img src="Images/sahib.jpg"></a>';
document.write(random_img[random_number]);
</script>
<!--End of Advertisment script  -->

  <!-- end .sidebar2 --></div>
  <div class="footer">
   This website is created and maintained by <a href="mailto:odetteds@comcast.net.com">Odette Simons </a><br/>
   © Copyright 2014 All Right Reserved / <a href="Development%20Report.pdf">Last updated</a>: 
   <!-- #BeginDate format:Am2 -->8/4/14<!-- #EndDate -->
   <br/><br/>
   <a href="index.php">Home</a> | <a href="register.php">Become a Member</a> | <a href="profile.php">Member Profiles </a>| <a href="login.php">Login</a> | <a href="contact.php">Contact Us</a> | <a href="page1.html">Services Offered</a> | <a href="page1.html">Payment</a> | <a href="page1.html">FAQ</a> | <a href="page1.html">Advertise</a> | <a href="page1.html">Links</a><br/>
  </div>
    <!-- end .footer -->
    
<!-- end .container --></div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>

</body>
<!-- InstanceEnd --></html>
