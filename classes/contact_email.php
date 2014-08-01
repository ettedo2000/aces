<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];


$email_from = 'odetteds@comcast.net';
$email_subject = "A Contact Form has been sent to DB";
$email_body = "ACES:\n \n ".
"First Name:   $first_name \n".
"Last Name:   $last_name \n".
"Username:   $username \n".
"Email:   $email \n ".
"Messege send to:   ".
    
$to = $email_from;
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $email \r\n";

//Send the email!
mail($to,$email_subject,$email_body,$headers);

//done. redirect to thank-you page.
//header('Location:../thank_you.php');
        echo "<h3>Thank you for your submission!</h3>";
		echo "<p>Please expect 24 hours for responds time.</p>";
		echo "First Name: " .$first_name .'</br>';
		echo "Last name: " . $first_name .'</br>';
		echo "email: " . $email .'</br>';
		echo "Username: " . $username .'</br>';


?>
<br/><br/>
Return to <a href="../index.php">ACES</a> Website
</html>