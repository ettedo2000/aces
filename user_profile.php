<?php require_once 'core/init.php'; 
 if(!$username = Input::get('user')) {
	Redirect::to('index.php');
} else {
	$user = new User($username);
	//echo $username;
	
	if(!$user->exists()) {
		Redirect::to(404);
	} else {
		//echo 'exist';
		$data = $user->data();
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
<div class="container"><!-- InstanceBeginEditable name="LoginHeader" -->
<!-- InstanceEndEditable -->
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

  <!-- InstanceEndEditable -->
  <!-- InstanceBeginEditable name="EditRegion3" --> 
  <table width="567" border="0" class="user_barI">
        <tr>
        <td width="216" height="142"><?php
		if (empty($user->data()->profile) === false) {
		echo '<img width="126" height="127" src="' , $user->data()->profile, '" alt="', $user->data()->username, '\'s Profile Image">';
		}else{
        echo'<img src="Images/male-upload-md.png" width="126" height="127" alt="upload image" />';} 
		?> </td>
        <td width="318"><strong><?php echo escape($user->data()->first_name);?> <?php echo escape($user->data()->last_name); ?><br/><?php echo escape($user->data()->city); ?><br/>
        <?php echo escape($user->data()->state);?> <?php echo escape($user->data()->zip); ?><br/> <?php echo escape($user->data()->country); ?></strong></td>
      </tr>
      <tr>
        <td height="36" colspan="2"><strong>Introduction:</strong></td>
        </tr>
      <tr>
        <td height="45" colspan="2" valign="top" bgcolor="#FFFFFF" ><?php echo nl2br($user->data()->intro); ?></td>
      </tr>
      <tr>
        <td height="36" colspan="2"><strong>Education:</strong>  </strong></td>
      </tr>
      <tr>
        <td height="36" colspan="2" bgcolor="#FFFFFF"><?php echo ($user->data()->edu); ?></td>
      </tr>
      <tr>
        <td height="36" colspan="2"><strong>Proffession: </strong></td>
      </tr>
      <tr>
        <td height="36" colspan="2" bgcolor="#FFFFFF"><?php echo ($user->data()->proff); ?></td>
      </tr>
      <tr>
        <td height="36" colspan="2"><strong>Professional and Personal Accomplishments:</strong></td>
        </tr>
      <tr>
        <td height="81" colspan="2" valign="top" bgcolor="#FFFFFF"><?php echo nl2br($user->data()->accomp); ?></td>
      </tr>
      <tr>
        <td height="35" colspan="2"><strong>List of downloded files: (comming soon)</strong></td>
      </tr>
      <tr valign="top">
        <td height="54" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table>
  </td>
  </tr>
  </table>
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
