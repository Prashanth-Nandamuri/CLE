<?php
//signup.php
include 'connection.php';
include 'header.php';

echo '<h3>Sign up</h3><br />';

$result = mysql_query("SELECT uniq_id FROM fac");
$storeArray = Array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{
    array_push($storeArray,$row['uniq_id']);
}

$check = 0;
//echo sizeof($storeArray); size
//print_r($storeArray); values

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */
    echo '<form method="post" action="">
    		<table border="1" style="width:30%;">
 	 	<tr><td>Username: <td align="center"><input type="text" name="user_name" required/><br />
 		<tr><td>Password: <td align="center"><input type="password" name="user_pass" required><br />
		<tr><td>Password again: <td align="center"><input type="password" name="user_pass_check" required><br />
    	<tr><td>Unique ID: <td align="center"><input type="text" name="user_fac" required/><br />
    	<tr><td>E-mail: <td align="center"><input type="email" name="user_email"><br />
    		</table><br>
 		<input type="submit" value="Create Account" />
 	 </form>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors = array(); /* declare the array for later use */
	
	if(isset($_POST['user_name']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[] = 'The username can only contain letters and digits.';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field must not be empty.';
	}
	if(isset($_POST['user_fac']))
	{
			for ($x=0; $x<sizeof($storeArray); $x++)
			{
				if($_POST['user_fac'] == $storeArray[$x])
				$check = 1;
			}
			if($check != 1)
			$errors[] = 'The ID you specified is not valid. Please enter the correct Unique ID or contact the administrator to register your ID.';
			else if($check == 1)
			{
				$result2 = mysql_query("SELECT taken FROM fac WHERE uniq_id = '$_POST[user_fac]'");
				while($row6 = mysql_fetch_assoc($result2))
				{
					$taken = $row6['taken'];
				}
				if($taken == 1)
				$errors[] = 'The ID you specified is already registered. Please contact the administrator.';
			}
	}
	
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = 'The two passwords did not match.';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty.';
	}
	
	if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	{
		echo 'Uh-oh.. a couple of fields are not filled in correctly..<br /><br />';
		echo '<ul>';
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; /* this generates a nice error list */
		}
		echo '</ul>';
	}
	else
	{
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql6 = "Select fac_name from fac WHERE uniq_id='" . mysql_real_escape_string($_POST['user_fac']) . "'";
		
		$result9 = mysql_query($sql6);
		$row3 = mysql_fetch_assoc($result9);
		$sql = "INSERT INTO
					users(user_name, user_pass, user_email ,user_date, user_level,real_name)
				VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
					   '" . sha1($_POST['user_pass']) . "',
					   '" . mysql_real_escape_string($_POST['user_email']) . "',
						NOW(),
						6,'".$row3['fac_name']."')";
						
		$result = mysql_query($sql);
		$sql4 = "UPDATE fac SET name='" . mysql_real_escape_string($_POST['user_name']) . "',
								taken=1 
				WHERE uniq_id='" . mysql_real_escape_string($_POST['user_fac']) . "'";
		
		$result7 = mysql_query($sql4);
		
		$sql5 = "INSERT INTO news(news) VALUES('" . mysql_real_escape_string($row3['fac_name']) . " has joined the website.' )";
		
		$result8 = mysql_query($sql5);
		
		if(!$result || !$result7)
		{
			//something went wrong, display the error
			echo 'Username already exists. Please choose other name.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			echo 'Succesfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
		}
	}
}

include 'footer.php';
?>
