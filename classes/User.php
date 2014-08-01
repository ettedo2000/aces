<?php
/*
 * *Setup for connecting to Database and inserting fields, updating, quering and delating tables
 */
class User {
	private $_db,
			$_sessionName = null,
			$_cookieName = null,
			$_data = array(),
			$_isLoggedIn = false;

	public function __construct($user = null) {
		$this->_db = DB::getInstance();
	
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		// Check if a session exists and set user if so.
		if(Session::exists($this->_sessionName) && !$user) {
			$user = Session::get($this->_sessionName);

			if($this->find($user)) {
				$this->_isLoggedIn = true;
			} else {
				$this->logout();
			}
		} else {
			$this->find($user);
		}
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function find($user = null) {
		// Check if user_id specified and grab details
		if($user) {
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->_db->get('users', array($field, '=', $user));

			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	//setup for registration Form database
	public function create($fields = array()) {
		if(!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating an account.');
		}
	}
	//setup for password revovery
	public function create_pass($fields = array()) {
		if(!$this->_db->insert('recover', $fields)) {
			throw new Exception('There was a problem creating an recover password.');
		}
	}
	//setup of contact Form database
	public function contact($fields = array()) {
		if(!$this->_db->insert('contact', $fields)) {
			throw new Exception('There was a problem sending the Contact Form.');
		}
	}
	//database setup for updating information
	public function update($fields = array(), $id = null) {
		if(!$id && $this->isLoggedIn()) {
			$id = $this->data()->id;
		}
		
		if(!$this->_db->update('users', $id, $fields)) {
			throw new Exception('There was a problem updating.');
		}
	}

	public function login($username = null, $password = null, $remember = false) {

		if(!$username && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		} else {
			$user = $this->find($username);

			if($user) {
				if($this->data()->password === Hash::make($password, $this->data()->salt)) {
					Session::put($this->_sessionName, $this->data()->id);

					if($remember) {
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

						if(!$hashCheck->count()) {
							$this->_db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash
							));
						} else {
							$hash = $hashCheck->first()->hash;
						}

						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}

					return true;
				}
			}
		}

		return false;
	}

	public function hasPermission($key) {
		$group = $this->_db->query("SELECT * FROM groups WHERE id = ?", array($this->data()->group));
		
		if($group->count()) {
			$permissions = json_decode($group->first()->permissions, true);

			if($permissions[$key] === 1) {
				return true;
			}
		}

		return false;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

	public function data() {
		return $this->_data;
	}

	public function logout() {
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

		Cookie::delete($this->_cookieName);
		Session::delete($this->_sessionName);
	}

	 public function emailExists($email){
	    
	    $email_exist = DB::getInstance()->query("SELECT email FROM users WHERE email = ?", array($email));
		if($email_exist->count()){
		return true;
		} 
		return false;		
	}
	
	public function getUserEmail($pass) {
		$is_pass = DB::getInstance()->query("SELECT pwkey FROM recover WHERE pwkey = ?", array($pass));	
		if($is_pass->count()){
		return true;
		} 
		return false;	
	}
	
	public function updatePass($password,$salt,$email) {
		$sucess = DB::getInstance()->query("UPDATE users SET password = '".$password."', salt = '".$salt."' WHERE email = '".$email."'"); 
		if($sucess->count()){
			return true;
		}
		return false;
	}
	
		public function deletePass($email) {
		$delete_pass = DB::getInstance()->query("DELETE FROM recover WHERE email = ?", array($email));	
		if($delete_pass->count()){
		return true;
		} 
		return false;	
	}
		
	public function randomPassword() {
  	  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
   	  $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
   		 for ($i = 0; $i < 8; $i++) {
       		 $n = rand(0, $alphaLength);
       		 $pass[] = $alphabet[$n];
    	}
    return implode($pass); //turn the array into a string
}
	
	public function mailresetlink($to,$pass){
		$email = $_POST["email"];
		$subject = "Forgot Password on ACES";
		$uri = 'http://'. $_SERVER['HTTP_HOST'] ;
		$message = '
		Forgot Password For ACES<br/><br/>
  
		Reset for: '.$to.'<br/><br/>
		
		Click on link to reset password:<br/>http://gotoamericancenter.com/reset.php?pass='.$pass.'&email=' .$email.'
		<br/><br/>		
		If link is inactive or not responding correctly try to copy web link and past into address bar <br/> 
		';
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: ACES Password Admin <odetteds@comcast.net>' . "\r\n";
		$headers .= 'Cc: odetteds@comcast.net' . "\r\n";
		
		if(mail($to,$subject,$message,$headers)){
			echo "<h3>We have sent the password reset link to your email id <b>".$to."</b></h3>"; 
	}}
	
		public function mailUsername($to,$username){
		$email = $_POST["email"];
		$subject = "Forgot Username on ACES";
		$uri = 'http://'. $_SERVER['HTTP_HOST'] ;
		$message = '
		Forgot Username For ACES<br/>
  		Username for '.$email.';<br/><br/>
		Your Username is:  <b>'.$username.'</b><br/><br/>
		
		Click on link to login:<br/>http://gotoamericancenter.com/login.php	<br/><br/>		
		 
		';
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: ACES Username Admin <odetteds@comcast.net>' . "\r\n";
		$headers .= 'Cc: odetteds@comcast.net' . "\r\n";
		
		if(mail($to,$subject,$message,$headers)){
			echo "<h3>We have sent a email to <b>".$to." with username</b></h3>";
			echo '<a href = "index.php">Home</a>'; 
	}}
}
?>