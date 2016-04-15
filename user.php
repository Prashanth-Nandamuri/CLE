<?php
//create_cat.php
include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';

$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level,
			theme
		FROM
			users
		WHERE
			user_level=0 OR user_level =1";
		
		
$result = mysql_query($sql);
$result7 = mysql_query("SELECT image FROM upload where name='" . mysql_real_escape_string($_SESSION['user_name']) . "'");
$row9 = mysql_fetch_assoc($result7);
//echo '<h1 align="center" style="background-color:black;" >Admin Panel</h1><br>';
if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="http://localhost/proj/signin.php"><b>signed in</b></a> to view user details.';
}
else
{
	
	if(htmlspecialchars($_GET["id"]) == 0)
	{
		echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">User Options</th>
   <tr><td><a href="user.php?id=1">User Details</a>
	<tr><td><a href="user.php?id=7">Change Profile Picture</a>
   <tr><td><a href="user.php?id=2">Change UserName</a>
   <tr><td><a href="user.php?id=3">Change Password</a>
	<tr><td><a href=user.php?id=6">Change Theme</a>
	<tr><td><a href="user.php?id=4">Delete Account</a>
		
	</table></div>';
		
		echo '<div style="float:left;width:75%;color:black;">';
		//echo '<img src="e.jpg" align="right" width="600px" height="200px">';
		echo '</div>';
		
	}
	if(htmlspecialchars($_GET["id"]) == 1)		
	{
		$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level,
			real_name,
			birthday,
			gender,
			city,
			country,
			interests,
			you,
			quotes
		FROM
			users
		WHERE
			user_id= $_SESSION[user_id] ";
		
		
		$result = mysql_query($sql);
		
		$result9 = mysql_query("SELECT fac_name,uniq_id FROM fac WHERE name= '$_SESSION[user_name]'");
		
		$row2 = mysql_fetch_assoc($result9);
		$row = mysql_fetch_assoc($result);
		
		echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">User Options</th>
   <tr><td><a href="user.php?id=1">User Details</a>
   <tr><td><a href="user.php?id=7">Change Profile Picture</a>
   <tr><td><a href="user.php?id=2">Change UserName</a>
   <tr><td><a href="user.php?id=3">Change Password</a>
				<tr><td><a href=user.php?id=6">Change Theme</a>
	<tr><td><a href="user.php?id=4">Delete Account</a>
		
	</table></div>';
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table border="1">';
		echo '<tr><th colspan="2"><B>User Details</B></th></tr>';
		echo '<tr><td>ID: <td align="left">'.$_SESSION['user_id'].' <br />
		<tr><td>Username: <td align="left">'.$_SESSION['user_name'].'  <br />
		<tr><td>User Level: ';
		if($_SESSION['user_level']==0)
			{
				echo '<td align="left">Normal User</td>';
			}
			else if($_SESSION['user_level']==2)
			{
				echo '<td align="left">Banned</td>';
			}
			else if($_SESSION['user_level']==1)
			{
				echo '<td align="left">Administrator</td>';
			}
			else if($_SESSION['user_level']==5)
			{
				echo '<td align="left">Moderator</td>';
			}
			else if($_SESSION['user_level']==6)
			{
				echo '<td align="left">Faculty</td>';
			}
			echo 	'<tr><td>E-mail: <td align="left">'.$_SESSION['user_email'].' <br />';
			if($_SESSION['user_level'] == 6)
			{	echo '<tr><td>Real Name: <td align="left">'.$row2['fac_name'].' <br />
					<tr><td>Unique ID: <td align="left">'.$row2['uniq_id'].' <br />';
			}
			if($_SESSION['user_level'] != 6)
			echo	'<tr><td>Real Name: <td align="left">'.$row['real_name'].' <br />';
		echo	'<tr><td>Gender: <td align="left">'.$row['gender'].' <br />
				<tr><td>Birthday: <td align="left">'.$row['birthday'].' <br />
			<tr><td>City: <td align="left">'.$row['city'].' <br />
			<tr><td>Country: <td align="left">'.$row['country'].' <br />
			<tr><td>Interests: <td align="left">'.$row['interests'].' <br />
			<tr><td>About you: <td align="left">'.$row['you'].' <br />
			<tr><td>Favourite Quotes: <td align="left">'.$row['quotes'].' <br />';
		
		
		
		echo '</table><br>';
		
		echo '<h4>Edit your details below:<h4><br>';
		
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<div style="float:left;width:100%;color:black;">';
			echo '<form method="post" action="">
				<table border="1" width="60%">
				<th colspan="2">Tell us something about yourself</th>
 	 	<tr><td width="30%">Your real name:</td><td> <input type="text" name="realname" size="65" value="'.$row['real_name'].'"><br />
		<tr><td>Birthday:</td> <td><input type="text" name="bday" size="65" value="'.$row['birthday'].'"><br />
		<tr><td>Gender: </td><td><input type="text" name="gender" size="65" value="'.$row['gender'].'"><br />
					<tr><td>City: </td><td><input type="text" name="city" size="65" value="'.$row['city'].'"><br />
					<tr><td>Country: </td><td><input type="text" name="country" size="65" value="'.$row['country'].'"><br />
					<tr><td>Interests: </td><td><input type="text" name="interests" size="65" value="'.$row['interests'].'"><br />
					<tr><td>About you: </td><td><textarea name="you" style="width:461px;height:20px;">'.$row['you'].'</textarea><br />
					<tr><td>Favourite Quotes: </td><td><textarea name="quote" style="width:461px;height:20px;">'.$row['quotes'].'</textarea><br />
				</table><br>
					<div style="text-align:center;">
	   <input type="submit" value="Update" name ="change" /></div>
 	 </form></div>';
		}
		
		else
		{
			if(isset($_POST['change']))
			{
				$sql = "UPDATE users SET
						
						real_name = '" . mysql_real_escape_string($_POST['realname']) . "',
						birthday = '" . mysql_real_escape_string($_POST['bday']) . "',
						gender = '" . mysql_real_escape_string($_POST['gender']) . "',
						city = '" . mysql_real_escape_string($_POST['city']) . "',
						country = '" . mysql_real_escape_string($_POST['country']) . "',
						interests = '" . mysql_real_escape_string($_POST['interests']) . "',
						you = '" . mysql_real_escape_string($_POST['you']) . "',
						quotes = '" . mysql_real_escape_string($_POST['quote']) . "'
								
						WHERE user_id = '".$_SESSION['user_id']."' ";
						
				$result = mysql_query($sql);
				$result7 = mysql_query("UPDATE fac SET fac_name = '" . mysql_real_escape_string($_POST['realname']) . "' WHERE name = '".$_SESSION['user_name']."' ");
				if(!$result || !$result7)
				{
					//something went wrong, display the error
					echo 'Something went wrong . Please try again later.';
					//echo mysql_error(); //debugging purposes, uncomment when needed
				}
				else
				{
		
					if($_SESSION['signed_in'] == true)
					{
						echo 'Succesfully updated.';
						echo '<script>location.href="user.php?id=1"</script> ';
					}
		
				}
			}
			
		} 
		
		echo '</div>';
		
	}
	if(htmlspecialchars($_GET["id"]) == 2)
	{
		echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">User Options</th>
   <tr><td><a href="user.php?id=1">User Details</a>
	<tr><td><a href="user.php?id=7">Change Profile Picture</a>
   <tr><td><a href="user.php?id=2">Change UserName</a>
   <tr><td><a href="user.php?id=3">Change Password</a>
	<tr><td><a href=user.php?id=6">Change Theme</a>
	<tr><td><a href="user.php?id=4">Delete Account</a>
		
	</table></div>';
		
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
			/*the form hasn't been posted yet, display it
			 note that the action="" will cause the form to post to the same page it is on */
			echo '<form method="post" action="">
					<table border="1" width="60%">
					<th colspan="2">Change Username</th>
 	 	<tr><td>New Username:</td> <td> <input type="text" name="user_name" /></td><br />
 		<tr><td>Password: <td> <input type="password" name="user_pass"><br />
		</table><br>
					<div style="text-align:center;">
 		<input type="submit"  value="Change" /></div>
 	 </form></div>';
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
		
		
			if(isset($_POST['user_pass']))
			{
				
				
				
				if(sha1($_POST['user_pass']) != $_SESSION['user_pass'] )
				{
					$errors[] = 'Incorrect Password';
				}
			}
			else
			{
				$errors[] = 'The password field cannot be empty.';
			}
		
			if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
			{
				echo 'Error!!<br /><br />';
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
				
				$sql = "UPDATE users SET user_name = '" . mysql_real_escape_string($_POST['user_name']) . "'  WHERE user_id = '".$_SESSION['user_id']."' ";
				
		
				$result = mysql_query($sql);
				if(!$result)
				{
					//something went wrong, display the error
					echo 'Something went wrong while registering. Please try again later.';
					//echo mysql_error(); //debugging purposes, uncomment when needed
				}
				else
				{
				
					if($_SESSION['signed_in'] == true)
					{
						//unset all variables
						$_SESSION['signed_in'] = NULL;
						$_SESSION['user_name'] = NULL;
						$_SESSION['user_id']   = NULL;
					
						echo 'Succesfully Changed, Please Login With Your New UserName';
						echo '<script>location.href="signin.php"</script> ';
					}
					
				}
			}
		}
		
	}
	if(htmlspecialchars($_GET["id"]) == 3)
	{
		echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">User Options</th>
   <tr><td><a href="user.php?id=1">User Details</a>
	<tr><td><a href="user.php?id=7">Change Profile Picture</a>
   <tr><td><a href="user.php?id=2">Change UserName</a>
   <tr><td><a href="user.php?id=3">Change Password</a>
   <tr><td><a href=user.php?id=6">Change Theme</a>
	<tr><td><a href="user.php?id=4">Delete Account</a>
		
	</table></div>';
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
		echo '<form method="post" action="">
				<table border="1" width="60%">
				<th colspan="2">Change Username</th>
 	 	<tr><td>Old Password:</td><td> <input type="password" name="old_user_pass"><br />
		<tr><td>New Password:</td> <td><input type="password" name="user_pass_check"><br />
		<tr><td>Confirm: </td><td><input type="password" name="user_pass_check2"><br />	
				</table><br>
					<div style="text-align:center;">	
	   <input type="submit" value="Change" name ="change" /></div>
 	 </form></div>';
		}
		else
		{
			/* so, the form has been posted, we'll process the data in three steps:
			 1.	Check the data
			2.	Let the user refill the wrong fields (if necessary)
			3.	Save the data
			*/
			$errors = array(); /* declare the array for later use */
		
			
		
		
			if(isset($_POST['change']))
			{
				
				
				if(sha1($_POST['old_user_pass']) != $_SESSION['user_pass'])
				{
					$errors[] = 'WRONG PASSWORD!!';
				}
				if($_POST['user_pass_check'] == NULL || $_POST['user_pass_check2']== NULL)
				{
					$errors[] =' Password Fields cannot be empty :)';
				}
				if($_POST['user_pass_check'] != $_POST['user_pass_check2'])
				{
					$errors[] = 'The two passwords did not match.';
				}
			}
			else
			{
				$errors[] = 'Invalid Password!!!';
			}
		
			if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
			{
				echo 'ERROR!!!<br /><br />';
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
		
				$sql = "UPDATE users SET user_pass = '" .sha1($_POST['user_pass_check2']) . "'  WHERE user_id = '".$_SESSION['user_id']."' ";
		
		
				$result = mysql_query($sql);
				if(!$result)
				{
					//something went wrong, display the error
					echo 'Something went wrong . Please try again later.';
					//echo mysql_error(); //debugging purposes, uncomment when needed
				}
				else
				{
		
					if($_SESSION['signed_in'] == true)
					{
						//unset all variables
						$_SESSION['signed_in'] = NULL;
						$_SESSION['user_name'] = NULL;
						$_SESSION['user_id']   = NULL;
							
						echo 'Succesfully Changed, Please Login With Your New Password';
						echo '<script>location.href="signin.php"</script> ';
					}
						
				}
			}
		}
		
	}	
	if(htmlspecialchars($_GET["id"]) == 4)
	{
		echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">User Options</th>
   <tr><td><a href="user.php?id=1">User Details</a>
	<tr><td><a href="user.php?id=7">Change Profile Picture</a>
   <tr><td><a href="user.php?id=2">Change UserName</a>
   <tr><td><a href="user.php?id=3">Change Password</a>
   <tr><td><a href=user.php?id=6">Change Theme</a>
	<tr><td><a href="user.php?id=4">Delete Account</a>
		
	</table></div>';
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table>
					<tr align="middle">';
				echo '<td>Are you sure you want to Delete your account?</td></table></tr>';
				
				
				echo '<form method="post" action=""><div style="text-align:center;" ';
				
				echo '<br><br><input type="checkbox"  value="' . $_SESSION['user_id'] .' "name="todelete[]" id="myid1" class="box"></input><label for="myid1">	Yes, Delete my Account</label>';
				echo '<br><br><input type="checkbox"  value="' . $_SESSION['user_id'] .' " name="nodelete[]" id="myid2" class="box"></input><label for="myid2">	No, Not now</label>';
				
				echo '<br><br><input type="submit" class = "mybutton" name="submit12" value="Accept"/></form></div></div><br><br>';
	if(isset($_POST['submit12']))
	{	
		if(empty($_POST['todelete'])== true)
		{
			echo '<script>location.href="user.php?id=0"</script> ';
		
			
		}else 
		{
		foreach($_POST['todelete'] as $delete_id) 
		{
			mysql_query("UPDATE users SET reac_level = user_level WHERE user_id = $delete_id ");
			mysql_query("UPDATE  users SET user_level = 4 WHERE user_id = $delete_id");
			$_SESSION['signed_in'] = NULL;
			$_SESSION['user_name'] = NULL;
			$_SESSION['user_id']   = NULL;
			$_SESSION['user_level']= NULL;
			echo '<table>
					<tr align="middle">';
			echo '<td>Account Deleted!!</td></table></tr>';
			
			echo '<script>location.href="signin.php"</script> ';
		}
		}
		
	}
				
				
	}
	if(htmlspecialchars($_GET["id"]) == 5)
	{
		$Name = $_GET['name'];
		$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level,
			real_name,
			birthday,
			gender,
			city,
			country,
			interests,
			you,
			quotes	
		FROM
			users";
		
		$result9 = mysql_query("SELECT fac_name,uniq_id FROM fac WHERE name= '$_SESSION[user_name]'");
		$result8 = mysql_query("SELECT image FROM upload where name='$_GET[name]'");
		$row8 = mysql_fetch_assoc($result8);
		$result = mysql_query($sql);
		$row2 = mysql_fetch_assoc($result9);
		echo '<div style="width:100%;margin:1;padding:1;border:none;">
		<div style="float:left;width:15%;align:left;">&nbsp';
		if($row8['image'] == NULL)
			echo '<tr align="middle"><td colspan="2"><img src="/cle/image/def.png" height="100" width="100"  /></td></tr></div>';
		else
			echo '<tr align="middle"><td colspan="2"><img src="/cle/image/'.$row8['image'].'" height="100" width="100"  /></td></tr></div>';
		//<tr align="middle"><td colspan="2"><img src="/cle/image/'.$row8['image'].'" height="100" width="100"  /></td></tr></div>
		echo '<div style="float:left;width:70%;color:black;">';
		//echo '<a href="message.php" style="color:blue;">Create Message</a><br><br>';
		echo '<table border="0">';
		echo '<tr><th colspan="2" class="admin" style="color:#F0F0F0;"><B>User Info</B></th></tr>';
		
		
		while($row = mysql_fetch_array($result))
		{if($row['user_name'] == htmlspecialchars($_GET["name"]))
		{
			echo '<tr><td>Username: <td align="left">'.$row['user_name'].'  <br />
 		<tr><td>E-mail: <td align="left">'.$row['user_email'].' <br />
		<tr><td>User Level: ';
		if($row['user_level']==0)
			{
				echo '<td align="left">Normal User</td>';
			}
			else if($row['user_level']==2)
			{
				echo '<td align="left">Banned</td>';
			}
			else if($row['user_level']==1)
			{
				echo '<td align="left">Administrator</td>';
			}
			else if($row['user_level']==5)
			{
				echo '<td align="left">Moderator</td>';
			}
			else if($row['user_level']==6)
			{
				echo '<td align="left">Faculty</td>';
			}
			else if($row['user_level']==4)
			{
				echo '<td align="left">Deactivated User</td>';
			}
			else if($row['user_level']==3)
			{
				echo '<td align="left">Deleted User</td>';
			}
			if($_SESSION['user_level'] == 6)
			{	echo '<tr><td>Real Name: <td align="left">'.$row2['fac_name'].' <br />
					<tr><td>Unique ID: <td align="left">'.$row2['uniq_id'].' <br />';
			}
			if($_SESSION['user_level'] != 6)
			echo	'<tr><td>Real Name: <td align="left">'.$row['real_name'].' <br />';
			echo	'<tr><td>Gender: <td align="left">'.$row['gender'].' <br />
			<tr><td>Birthday: <td align="left">'.$row['birthday'].' <br />
			<tr><td>City: <td align="left">'.$row['city'].' <br />
			<tr><td>Country: <td align="left">'.$row['country'].' <br />
			<tr><td>Interests: <td align="left">'.$row['interests'].' <br />
			<tr><td>About you: <td align="left">'.$row['you'].' <br />
			<tr><td>Favourite Quotes: <td align="left">'.$row['quotes'].' <br />';
		}
		}
		echo '</table>';
		echo '</div>';
		
	}
	if(htmlspecialchars($_GET["id"]) == 6)
	{
		echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">User Options</th>
   <tr><td><a href="user.php?id=1">User Details</a>
	<tr><td><a href="user.php?id=7">Change Profile Picture</a>
   <tr><td><a href="user.php?id=2">Change UserName</a>
   <tr><td><a href="user.php?id=3">Change Password</a>
	<tr><td><a href=user.php?id=6">Change Theme</a>
	<tr><td><a href="user.php?id=4">Delete Account</a>
	
	</table></div>';
	
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table>
					<tr align="middle">';
				echo '<td>Themes</td></table></tr>';
				echo '<form method="post" action=""><div style="text-align:center;"<br><br>';
	echo '<br><br><input type="checkbox"  value="' . $_SESSION['user_id'] .' "name="todelete[]" id="myid1" class="box"></input><label for="myid1">Classic Blue</label>';
				echo '<br><br><input type="checkbox"  value="' . $_SESSION['user_id'] .' " name="nodelete[]" id="myid2" class="box"></input><label for="myid2">Girly Pink</label>';
				
				echo '<br><br><input type="submit" class = "mybutton" name="submit13" value="Change Theme"/></form></div></div><br><br>';
	if(isset($_POST['submit13']))
	{	
		if(empty($_POST['todelete'])== true)
		{
			//echo '<script>location.href="user.php?id=0"</script> ';
		
			
		}else 
		{
		foreach($_POST['todelete'] as $delete_id) 
		{
			mysql_query("UPDATE users SET theme = 'style' WHERE user_id = $delete_id ");
			
			echo '<table>
					<tr align="middle">';
			echo '<td>Theme Changed</td></table></tr>';
			
			echo '<script>location.href="user.php?id=0"</script> ';
		}
	}
	if(empty($_POST['nodelete'])== true)
	{
		//echo '<script>location.href="user.php?id=0"</script> ';
	
			
	}else
	{
		foreach($_POST['nodelete'] as $delete_id)
		{
			mysql_query("UPDATE users SET theme = 'style1' WHERE user_id = $delete_id ");
			
			echo '<table>
					<tr align="middle">';
			echo '<td>Theme Changed</td></table></tr>';
				
			echo '<script>location.href="user.php?id=0"</script> ';
		}
	}	
	}
}
if(htmlspecialchars($_GET["id"]) == 7)
{
	$result6 = mysql_query("SELECT image FROM upload WHERE name='" . mysql_real_escape_string($_SESSION['user_name']) . "'");
	$row6 = mysql_fetch_assoc($result6);
	echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">User Options</th>
   <tr><td><a href="user.php?id=1">User Details</a>
	<tr><td><a href="user.php?id=7">Change Profile Picture</a>
   <tr><td><a href="user.php?id=2">Change UserName</a>
   <tr><td><a href="user.php?id=3">Change Password</a>
	<tr><td><a href=user.php?id=6">Change Theme</a>
	<tr><td><a href="user.php?id=4">Delete Account</a>

	</table></div>';

	echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
		echo '<form method="post" enctype="multipart/form-data" action ="user.php?id=8">
				<table border="1" width="60%">
				<th colspan="2">Change Display Picture</th>';
		if($row6['image'] == NULL)
			echo '<tr align="middle"><td colspan="2"><img src="/cle/image/def.png" height="100" width="100"  /></td></tr>';
		else
		{
		echo '<tr align="middle"><td colspan="2"><img src="/cle/image/'.$row6['image'].'" height="100" width="100"  /></td></tr>';
		}
 	 	echo '<tr><td><input name="ufile" type="file" id="ufile"><br />
		<tr align="middle"><td><p><strong>The max. image size is 20 MB</strong></p>
		</table><br>
					<div style="float:left;">	
	   <input name="upload" type="submit" id="upload" value=" Upload "></div>
			 </form>
				<div style="float:right;">
				<form method="POST" action="">
	   			<input name="remove" type="submit" id="remove" value=" Remove "></form></div></div>';
		if(isset($_POST['remove']))
		{
			if($row6['image'] == NULL);
			else
			{
			//echo("You clicked button one!");
			unlink("image/". $row6['image']);
			mysql_query("Delete FROM upload WHERE name ='" . mysql_real_escape_string($_SESSION['user_name']) . "'");
			echo '<script>location.href="user.php?id=7"</script> ';
			}
		}

}
if(htmlspecialchars($_GET["id"]) == 8)
{
	echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">User Options</th>
   <tr><td><a href="user.php?id=1">User Details</a>
	<tr><td><a href="user.php?id=7">Change Profile Picture</a>
   <tr><td><a href="user.php?id=2">Change UserName</a>
   <tr><td><a href="user.php?id=3">Change Password</a>
	<tr><td><a href=user.php?id=6">Change Theme</a>
	<tr><td><a href="user.php?id=4">Delete Account</a>

	</table></div>';

	echo '<div style="float:left;width:75%;color:black;">';
	$target = "cle/image/";
    $target = $target . basename( $_FILES['ufile']['name']);
    //This gets all the other information from the form
    $pic=($_FILES['ufile']['name']);
    $typ=($_FILES['ufile']['type']);
    $siz=($_FILES['ufile']['size']);
    //Writes the information to the database
    if($typ!='image/jpeg' && $typ!='image/png')
    {
    echo 'Please upload only .jpg or .png format images.';
    exit;
    }
    if($siz>20971520)
    {
    	echo 'Your image exceeds 20MB size limit. Please upload a smaller image.';
    	exit;
    }
    else {
    $result2 = mysql_query("SELECT * FROM upload WHERE name='" . mysql_real_escape_string($_SESSION['user_name']) . "'");
    $row7 = mysql_fetch_assoc($result2);
    if($row7['name'] == NULL)
    mysql_query("INSERT INTO `upload` (image,name) VALUES ('$pic','" . mysql_real_escape_string($_SESSION['user_name']) . "')") ;
    else if($row7['name'] == $_SESSION['user_name'])
    {
    	unlink("image/". $row7['image']);
    mysql_query("UPDATE upload SET image='$pic' WHERE name='" . mysql_real_escape_string($_SESSION['user_name']) . "' ") ;
    }
    //Writes the photo to the server
    if(move_uploaded_file($_FILES["ufile"]["tmp_name"], "image/" . $_FILES["ufile"]["name"]))
    {
    //Tells you if its all ok
    	echo '<table>
					<tr align="middle">';
    	echo "<td>Your Profile Picture has been updated.</td></table></tr>";
    	echo '<script>location.href="user.php?id=7"</script> ';
    }
    else {
    //Gives and error if its not
    	echo '<table>
					<tr align="middle">';
    	echo "<td>Sorry, there was a problem uploading your file.</td></table></tr>";
    mysql_query("Delete FROM upload WHERE name='" . mysql_real_escape_string($_SESSION['user_name']) . "'");
    echo '<script>location.href="user.php?id=7"</script> ';
    }
    }
    echo '</div>';

}
			
	echo '</div>';
}
include 'footer.php';
echo '<br>';
?>