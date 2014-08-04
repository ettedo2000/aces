 <?php
  $user = new User();
if($user->isLoggedIn()) {
	?>
  <div class="user_barII" > 
 <b><a href="logout.php">Log out</a></b> | <a href="update.php">Update Account</a> 
   | <a href="changepassw.php">Change Password</a> | <a href="user_profile_create.php">Update Profile</a> | <a href="user_profile.php?user=<?php echo escape($user->data()->username); ?>">View Your Profile</a>
     | Upload Files(<a href="files.php">#</a>) | Upload Pictures
   <?php if($user->hasPermission('admin')) {
		?> | 
   You are an Administrator <a href="db_admin.php">Update DB</a>
        <?php
	}
	?></div>
    <?php 
 }
?>