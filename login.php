<?php require_once 'core/init.php'; 
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$user = new User();

		$remember = (Input::get('remember') === 'on') ? true : false;
		$login = $user->login(Input::get('username'), Input::get('password'), $remember);

		if($login) {
			Redirect::to('index.php');
		} else 
		  {
			Redirect::to('includes/errors/login_error.php');
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
<div class="container">
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
  </div>  <!-- end .sidebar1 -->
  <div class="content">
  <!-- InstanceBeginEditable name="EditRegion4" -->

  <!-- InstanceEndEditable -->
  <!-- InstanceBeginEditable name="EditRegion3" --> 
  
  <h1>Login:</h1>
          <form method="post" action="">
    <table width="548" border="0" cellspacing="10">
  <tr>
    <td width="228"><label for="username">Username :</label></td>
    <td width="286"><input name="username" type="text" id="username" autocomplete="off" size="40"></td>
  </tr>
  <tr>
    <td><label for="password">Password :</label></td>
    <td> <input name="password" type="password" id="password" size="41"  autocomplete="off"></td>
  </tr>
  <tr>
    <td><lable> Remember me</lable></td>
    <td><input name="remember" type="checkbox" id="remember" ></td>
  </tr>
  <tr>
    <td height="48" align="center"><input name="reset" type="reset" value="Reset" />&nbsp;&nbsp;<input name="submit" type="submit" value="Login" /> </td>
    <td><input type="hidden" name="token" value="<?php echo Token::generate(); ?>"></td>
  </tr>
</table>
    </form>
  <p>Forgott your <a href="reset_passw.php">Password</a> or <a href="reset_usern.php">Username</a></p>
  <p><a href="reset_usern.php">Testing</a></p>
  <br/>
<p>If theer are any problems with this Form please contact: <a href="mailto:odetteds@comcast.net">Maintnance</a></p>
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
   <!-- #BeginDate format:Am2 -->8/1/14<!-- #EndDate -->
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
