<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$reset_val = $_POST['reset_val'];


if(empty($first_name) or empty($last_name) or empty($email) ) 
	{
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "First and Last Name, Email, are requiered!";
		$valid = false;
	}
else
	{
		$valid = true;
	}
/*
 if(!empty($first_name))
	{
		if (is_numeric($name))
		{
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "Data that was entred: " . $name. '<br/>';
		echo "You entred a numeric value in the Name field";
		$valid = false;
		}
		else if (strlen($name) < 3 || strlen($name) > 40)
		{
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "Data that was entred: " . $name. '<br/>';
		echo "Names has to be beween 3 and 40 charachters long";
		$valid = false;
		}
		else 
		{
			$valid = true;
		}
	}

 if(!empty($city))
	{
		if (is_numeric($city))
		{
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "Data that was entred: " . $city. '<br/>';
		echo "You entred a numeric value in the City field";
		$valid = false;
		}
		else if (strlen($city) < 3 || strlen($city) > 40)
		{
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "Data that was entred: " . $city. '<br/>';
		echo "City has to be beween 3 and 40 charachters long";
		$valid = false;
		}
		else
		{
			$valid = true;
		}
	}

 if(!empty($phone))
	{
		if (!is_numeric($phone))
		{
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "Data that was entred: " . $phone. '<br/>';
		echo "<p>Phone number can only be a numeric value (ex: 4235555555)</p>";
		}
		else if (strlen($phone) > 10)
		{
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "Data that was entred: " . $phone. '<br/>';
		echo "Phone has to be 10 charachters long";
		$valid = false;
		}
		else
		{
		$valid = true;	
		}
	}

 if(!empty($message))
	{
		if (strlen($message) < 3 || strlen($message) > 300)
		{
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "Data that was entred: " . $message. '<br/>';
		echo "<p>Message has to be beween 3 and 300 charachters long</p>";
		$valid = false;
		}
		else
		{
		$valid = true;	
		}
	}
 
 if(!empty($email))
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL))	//If Email is not correct return error message	
		{
		
		//var_dump(filter_var($email, FILTER_VALIDATE_EMAIL)); 
		$valid = true;
    	}
 		else
    	{ 
		echo "<h3><u> ERROR </u></h3>";
		echo "<hr>";
		echo "Data that was entred: " . $email. '<br/>';
		echo "<p>Please make sure you entred a correct Email (jon@email.com)!</p>\n";  
		$valid = false; 
    	} 
	}
	
	if (!$valid)
	{
		echo "<hr>";
		echo "<b> Please go back and try again</b>";
		echo "<p><input type='button' value='Retry' onClick='history.go(-1)'></p>";
	}*/	

if($valid == true)
{		

$email_from = 'odetteds@comcast.net';
$email_subject = "Reset Password/username";
$email_body = "ACES:\n \n ".
"First Name:   $first_name \n".
"Last Name:   $last_name \n".
"Username:   $username \n".
"Email:   $email \n ".
"Reset:   $reset_val \n\n ".
"Messege send to:".
    
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
		echo "Reset" . $reset_val;
}
?>

</html>