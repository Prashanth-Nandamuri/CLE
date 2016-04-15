<?php
//signout.php
include 'connection.php';
include 'header.php';

echo '<h2>Sign out</h2>';

//check if user if signed in
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$lastseen= date('Y/m/d h:i:s a', time());
	//echo $lastseen;
	mysql_query(" UPDATE users SET lastlog = NOW() WHERE user_id = $_SESSION[user_id] ");
	$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;

	echo 'Succesfully signed out, thank you for visiting.';
	echo '<script>location.href="index.php"</script> ';
}
else
{
	echo 'You are not signed in. Would you like to <a href="signin.php">Sign in</a>?';
}

include 'footer.php';
?>