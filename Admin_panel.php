<<<<<<< HEAD
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
			user_level
		FROM
			users
		WHERE
			user_level=0 or user_level = 5 or user_level = 6 AND user_id != $_SESSION[user_id]";
		
		
$result = mysql_query($sql);

//echo '<h1 align="center" style="background-color:black;" >Admin Panel</h1><br>';
if($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1 )
{
	//the user is not an admin
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">Admin-Panel</th>
	<tr><td><a href="admin_panel.php?id=6">Add Subjects</a>
   <tr><td><a href="admin_panel.php?id=1">Ban/Unban</a>
	<tr><td><a href="admin_panel.php?id=4">Promote/Demote</a>
   <tr><td><a href="admin_panel.php?id=2">User Details</a>
  <tr><td><a href="admin_panel.php?id=5">Add New Faculty ID</a>
   <tr><td><a href="admin_panel.php?id=3">Delete Account</a>		
	</table></div>';
	if(htmlspecialchars($_GET["id"]) == 0)
	{
		
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<img src="d.png" align="right" width="400px" height="200px">';
		echo '</div>';
		
	}
	if(htmlspecialchars($_GET["id"]) == 1)		
	{
	echo '<div style="float:left;width:75%;color:black;">';
	echo '<table border="1">';
	echo '<tr align="middle"><th colspan="4" class="admin" style="color:#F0F0F0;"><B>Ban Users</B></th></tr>';
	echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>BAN</b></td></tr>';
	echo '<form method="post" action="">';
	while($row = mysql_fetch_assoc($result))
	{
		
		echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
		if($row['user_level']==0)
		{
			echo '<td>Normal User</td>';
		}
		else if($row['user_level']==2)
		{
			echo '<td>Banned</td>';
		}
		else if($row['user_level']==1)
		{
			echo '<td>Administrator</td>';
		}
		else if($row['user_level']==5)
		{
			echo '<td>Moderator</td>';
		}
		else if($row['user_level']==6)
		{
			echo '<td>Faculty</td>';
		}
		echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="todelete[]" />&nbsp</td>';
	}
	echo '</table>';
	echo '<br><input type="submit" class = "mybutton" name="submit" value="Ban" style="float: right;width:10%;"/></form><br><br>';
	if(isset($_POST['submit']))
	{
		if(isset($_POST['todelete']))
		{
		foreach($_POST['todelete'] as $delete_id) {
			mysql_query("UPDATE users SET user_level = 2 WHERE user_id = $delete_id ");
			echo '<script>location.href="admin_panel.php?id=1"</script> ';
		}
		}
	}
	
	
	$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			user_level = 2";
	
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 0)
	{
		echo ' ';
	}
	else {
		echo '<table border="1">';
		echo '<tr><th colspan="4" class="admin" style="color:#F0F0F0;"><B>UnBan Users</B></th></tr>';
		echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>UnBAN</b></td></tr>';
		echo '<form method="post" action="">';
	
	while($row = mysql_fetch_assoc($result))
	{
		
		
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
			if($row['user_level']==0)
			{
				echo '<td>Normal User</td>';
			}
			else if($row['user_level']==2)
			{
				echo '<td>Banned</td>';
			}
			else if($row['user_level']==1)
			{
				echo '<td>Administrator</td>';
			}
			else if($row['user_level']==5)
			{
				echo '<td>Moderator</td>';
			}
			else if($_SESSION['user_level']==6)
			{
				echo '<td align="left">Faculty</td>';
			}
		echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="todelete[]" />&nbsp</td>';
			
		
	}
	echo '</table>';
	echo '<br><input type="submit" class = "mybutton" name="unban" value="UnBan" style="float: right;width:10%;"/></form>';
	}
	if(isset($_POST['unban']))
	{
		if(isset($_POST['todelete']))
		{
		foreach($_POST['todelete'] as $delete_id) {
			mysql_query("UPDATE users SET user_level = 0 WHERE user_id = $delete_id ");
			mysql_query("UPDATE users SET rep_count = 0 WHERE user_id = $delete_id ");
			mysql_query("UPDATE users SET reported_by = NULL WHERE user_id = $delete_id ");
			mysql_query("UPDATE users SET is_reported = 'No' WHERE user_id = $delete_id ");
			echo '<script>location.href="admin_panel.php?id=1"</script> ';
		}
		}
	}
	
			echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 2)
	{
		$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			user_level = 0 Or user_level = 2 OR user_level = 5 OR user_level = 6";
	
	
		$result = mysql_query($sql);
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table border="1">';
		echo '<tr><th colspan="4" class="admin" style="color:#F0F0F0;"><B>User Details</B></th></tr>';
		echo '<tr><td width="15%"><b>UserID</td><td width="*"><b>UserName</td><td width="55%"><b>email-id</b></td><td width="23%"><b>UserLevel</b></td></tr>';
		echo '<form method="post" action="">';
		while($row = mysql_fetch_assoc($result))
		{
	
			echo '<tr><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td> <td>'.$row['user_email'].' </td>';
				if($row['user_level']==0)
				{
					echo '<td>Normal User</td>';
				}
				else if($row['user_level']==2)
				{
					echo '<td>Banned</td>';
				}
				else if($row['user_level']==1)
				{
					echo '<td>Administrator</td>';
				}
				else if($row['user_level']==5)
				{
					echo '<td>Moderator</td>';
				}
				else if($row['user_level']==6)
				{
					echo '<td>Faculty</td>';
				}
			
		}
		echo '</table>';
		echo '</div>';
	}
	if(htmlspecialchars($_GET["id"]) == 3)
	{
		$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			user_level = 0 Or user_level = 2 or user_level = 5 or user_level = 6";
		
		
		$result = mysql_query($sql);
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table border="1" >';
		echo '<tr ><th colspan="4" class="admin" style="color:#F0F0F0;"><B>Delete Account</B></th></tr>';
		echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>Delete Account</b></td></tr>';
		echo '<form method="post" action="">';
		while($row = mysql_fetch_assoc($result))
		{
			
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
			if($row['user_level']==0)
			{
				echo '<td>Normal User</td>';
			}
			else if($row['user_level']==2)
			{
				echo '<td>Banned</td>';
			}
			else if($row['user_level']==1)
			{
				echo '<td>Administrator</td>';
			}
			else if($row['user_level']==5)
			{
				echo '<td>Moderator</td>';
			}
			else if($row['user_level']==6)
			{
				echo '<td>Faculty</td>';
			}
			echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="todelete[]" />&nbsp</td>';
		}
		echo '</table>';
		echo '<br><input type="submit" class = "mybutton" name="delacc" value="Delete" style="float: right;width:13%;"/></form><br><br>';
		if(isset($_POST['delacc']))
		{
			if(isset($_POST['todelete']))
			{
			foreach($_POST['todelete'] as $delete_id) {
				mysql_query("UPDATE  users SET user_level = 3 WHERE user_id = $delete_id");
				echo '<script>location.href="admin_panel.php?id=3"</script> ';
			}
			}
		}
		echo '</div>';
	}
	if(htmlspecialchars($_GET["id"]) == 4)
	{
		$sql = "SELECT
		user_id,
		user_name,
		user_email,
		user_level
		FROM
		users
		WHERE
		user_level=0 or user_level = 5 AND user_id != $_SESSION[user_id]";
		$result = mysql_query($sql);
		
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table border="1">';
		echo '<tr align="middle"><th colspan="4" class="admin" style="color:#F0F0F0;"><B>Promote Users</B></th></tr>';
		echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>Promote</b></td></tr>';
		echo '<form method="post" action="">';
		
		while($row = mysql_fetch_assoc($result))
		{
	
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
			if($row['user_level']==5)
			{
				echo '<td>Moderator</td>';
			}
			else if($row['user_level']==0)
			{
				echo '<td>Normal User</td>';
			}
			echo ' </td>';
			echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="topromote[]" />&nbsp</td>';
		}
		echo '</table>';
		echo '<br><input type="submit" class = "mybutton" name="submit" value="Promote to Admin" style="float: left;width:20%;"/>
				<input type="submit" class = "mybutton" name="submit1" value="Promote to Moderator" style="float: right;width:20%;"/></form><br><br>';
		if(isset($_POST['submit']))
		{
			if(isset($_POST['topromote']))
			{
			foreach($_POST['topromote'] as $promote_id) {
				mysql_query("UPDATE users SET user_level = 1 WHERE user_id = $promote_id ");
				echo '<script>location.href="admin_panel.php?id=4"</script> ';
			}
			}
		}
		if(isset($_POST['submit1']))
		{
			if(isset($_POST['topromote']))
			{
			foreach($_POST['topromote'] as $promote_id) {
				mysql_query("UPDATE users SET user_level = 5 WHERE user_id = $promote_id ");
				echo '<script>location.href="admin_panel.php?id=4"</script> ';
			}
			}
		}
		echo '<table border="1">';
		echo '<tr><th colspan="4" class="admin" style="color:#F0F0F0;"><B>Demote Users</B></th></tr>';
		echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>Demote</b></td></tr>';
		echo '<form method="post" action="">';
		$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			(user_level = 1 OR user_level = 5) AND user_id != $_SESSION[user_id]";
	
		$result = mysql_query($sql);
		while($row = mysql_fetch_assoc($result))
		{
	
	
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
					
				if($row['user_level']==5)
				{
					echo '<td>Moderator</td>';
				}
				else if($row['user_level']==1)
				{
					echo '<td>Administrator</td>';
				}
			echo ' </td>';
			echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="todemote[]" />&nbsp</td>';
				
	
		}
		echo '</table>';
		echo '<br><input type="submit" class = "mybutton" name="demote" value="Demote to User" style="float: right;width:20%;"/>
				<input type="submit" class = "mybutton" name="demote1" value="Demote to Moderator" style="float: left;width:20%;"/></form>';
		if(isset($_POST['demote']))
		{
			if(isset($_POST['todemote']))
			{
			foreach($_POST['todemote'] as $demote_id) {
				mysql_query("UPDATE users SET user_level = 0 WHERE user_id = $demote_id ");
				echo '<script>location.href="admin_panel.php?id=4"</script> ';
			}
			}
		}
		if(isset($_POST['demote1']))
		{
			if(isset($_POST['todemote']))
			{
			foreach($_POST['todemote'] as $demote_id) {
				mysql_query("UPDATE users SET user_level = 5 WHERE user_id = $demote_id ");
				echo '<script>location.href="admin_panel.php?id=4"</script> ';
			}
			}
		}
	
		echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 5)
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
			echo '<form method="post" action="">
					<table border="1" width="60%">
					<th colspan="2">Add New Faculty</th>
 	 	<tr><td>Faculty Name:</td> <td> <input type="text" name="user_name" /></td><br />
 		<tr><td>Unique ID: <td> <input type="text" name="uniq_id" required/ ><br />
		<tr><td>Department:</td> <td> <select name="dept_name">
 			 <option value="CSE">CSE</option>
 			 <option value="ECE">ECE</option>
 			 <option value="EEE">EEE</option>
 			 <option value="Civil">CIVIL</option>
					<option value="Mechanical">Mechanical</option>
					</select> </td><br />
					</table><br>
					<div style="text-align:center;">
 		<input type="submit"  value="Register" /></div>
 	 </form></div>';
		}
		else 
		{
			$errors = array();
			if(isset($_POST['uniq_id']))
			{
				//the id exists
			 	if(!ctype_alnum($_POST['uniq_id']))
				{
					$errors[] = 'The Unique ID can only contain letters and digits.';
				}
				if(strlen($_POST['uniq_id']) != 5)
				{
					$errors[] = 'The Unique ID must be of 5 characters.';
				}
			}
			if(isset($_POST['user_name']))
			{
				//the user name exists
				/*if(!ctype_alnum($_POST['user_name']))
				{
					$errors[] = 'The username can only contain letters and digits.';
				}*/
				if(strlen($_POST['user_name']) > 30)
				{
					$errors[] = 'The username cannot be longer than 30 characters.';
				}
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
			
				$sql = "INSERT INTO fac (fac_name,uniq_id,branch) VALUES ('" . mysql_real_escape_string($_POST['user_name']) . "',
																		'" . mysql_real_escape_string($_POST['uniq_id']) . "',
																		'" . mysql_real_escape_string($_POST['dept_name']) . "')";
			
			
				$result = mysql_query($sql);
				if(!$result)
				{
					//something went wrong, display the error
					echo 'Something went wrong while registering. Please try again later.';
					//echo mysql_error(); //debugging purposes, uncomment when needed
				}
				else
				{
						echo '<table>
								<tr align="middle">';
						echo '<td>successfully Registered </td></table></tr>';
						echo '<script>location.href="admin_panel.php?id=5"</script> ';
				}
						
			}
		}
	}
if(htmlspecialchars($_GET["id"]) == 6)
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
			echo '<form method="post" action="">
					<table border="1" style="width:100%;">
					<th colspan="2">Add New Subject</th>
 	 	<tr><td style="width:40%;">Subject Name:</td> <td> <input type="text" name="subj_name" required/></td>
			<tr><td>Subject Code:</td> <td> <input type="text" name="subj_code" required/></td>
 		<tr><td>Branch:</td> <td> <select name="dept_name">
  <option value="CSE">CSE</option>
  <option value="ECE">ECE</option>
  <option value="EEE">EEE</option>
  <option value="Civil">CIVIL</option>
					<option value="Mechanical">Mechanical</option>
					<option value="NonTechnical">Non-Technical</option>
</select> </td><br />
			<tr><td>Year/Sem:</td> <td> <input type="text" name="yearsem"></td>
			<tr><td>Text Book:</td> <td> <input type="text" name="text_book" required/></td>
			<tr><td>Reference Books:</td> <td><textarea name="ref_book" style="width:150px;height:40px;"></textarea></td>
		</table><br>
					<div style="text-align:center;">
 		<input type="submit"  value="Add Subject" /></div>
 	 </form></div>';
		}
		else 
		{
			$qry = "SELECT Name FROM subjects WHERE Name = '" . mysql_real_escape_string($_POST['subj_name']) . "'";
			$result2 = mysql_query($qry);
			$data=mysql_fetch_assoc($result2);
			
			$errors = array();
			
			if($data['Name'] == $_POST['subj_name'])
			{
				$errors[] = 'This Subject already exists.';
			}	
			if(isset($_POST['subj_name']))
			{
				//the id exists
			 	if(strlen($_POST['subj_name']) > 30)
				{
					$errors[] = 'The Subject Name must be at most 30 characters.';
				}
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
			
				$sql = "INSERT INTO Subjects (Name,Branch,code,year,text,ref) VALUES ('" . mysql_real_escape_string($_POST['subj_name']) . "',
																		'" . mysql_real_escape_string($_POST['dept_name']) . "',
																		'" . mysql_real_escape_string($_POST['subj_code']) . "',
																		'" . mysql_real_escape_string($_POST['yearsem']) . "',
																		'" . mysql_real_escape_string($_POST['text_book']) . "',
																		'" . mysql_real_escape_string($_POST['ref_book']) . "')";
			
			
				$result = mysql_query($sql);
				$sql5 = "INSERT INTO news(news) VALUES('" . mysql_real_escape_string($_POST['subj_name']) . " subject has been added for " . mysql_real_escape_string($_POST['dept_name']) . " department.')";
				
				$result8 = mysql_query($sql5);
				if(!$result)
				{
					//something went wrong, display the error
					echo 'Something went wrong while adding new subject. Please try again later.';
					//echo mysql_error(); //debugging purposes, uncomment when needed
				}
				else
				{
						echo '<br><br><table>
								<tr align="middle">';
						echo '<td>Successfully added </td><br></table></tr>';
						//echo $data['Name'];
						echo '<script>location.href="admin_panel.php?id=6"</script> ';
				}
						
			}
		}
	}
	echo '</div>';
}

include 'footer.php';
echo '<br>';
?>
=======
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
			user_level
		FROM
			users
		WHERE
			user_level=0 or user_level = 5 or user_level = 6 AND user_id != $_SESSION[user_id]";
		
		
$result = mysql_query($sql);

//echo '<h1 align="center" style="background-color:black;" >Admin Panel</h1><br>';
if($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1 )
{
	//the user is not an admin
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">Admin-Panel</th>
	<tr><td><a href="admin_panel.php?id=6">Add Subjects</a>
   <tr><td><a href="admin_panel.php?id=1">Ban/Unban</a>
	<tr><td><a href="admin_panel.php?id=4">Promote/Demote</a>
   <tr><td><a href="admin_panel.php?id=2">User Details</a>
  <tr><td><a href="admin_panel.php?id=5">Add New Faculty ID</a>
   <tr><td><a href="admin_panel.php?id=3">Delete Account</a>		
	</table></div>';
	if(htmlspecialchars($_GET["id"]) == 0)
	{
		
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<img src="d.png" align="right" width="400px" height="200px">';
		echo '</div>';
		
	}
	if(htmlspecialchars($_GET["id"]) == 1)		
	{
	echo '<div style="float:left;width:75%;color:black;">';
	echo '<table border="1">';
	echo '<tr align="middle"><th colspan="4" class="admin" style="color:#F0F0F0;"><B>Ban Users</B></th></tr>';
	echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>BAN</b></td></tr>';
	echo '<form method="post" action="">';
	while($row = mysql_fetch_assoc($result))
	{
		
		echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
		if($row['user_level']==0)
		{
			echo '<td>Normal User</td>';
		}
		else if($row['user_level']==2)
		{
			echo '<td>Banned</td>';
		}
		else if($row['user_level']==1)
		{
			echo '<td>Administrator</td>';
		}
		else if($row['user_level']==5)
		{
			echo '<td>Moderator</td>';
		}
		else if($row['user_level']==6)
		{
			echo '<td>Faculty</td>';
		}
		echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="todelete[]" />&nbsp</td>';
	}
	echo '</table>';
	echo '<br><input type="submit" class = "mybutton" name="submit" value="Ban" style="float: right;width:10%;"/></form><br><br>';
	if(isset($_POST['submit']))
	{
		if(isset($_POST['todelete']))
		{
		foreach($_POST['todelete'] as $delete_id) {
			mysql_query("UPDATE users SET user_level = 2 WHERE user_id = $delete_id ");
			echo '<script>location.href="admin_panel.php?id=1"</script> ';
		}
		}
	}
	
	
	$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			user_level = 2";
	
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 0)
	{
		echo ' ';
	}
	else {
		echo '<table border="1">';
		echo '<tr><th colspan="4" class="admin" style="color:#F0F0F0;"><B>UnBan Users</B></th></tr>';
		echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>UnBAN</b></td></tr>';
		echo '<form method="post" action="">';
	
	while($row = mysql_fetch_assoc($result))
	{
		
		
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
			if($row['user_level']==0)
			{
				echo '<td>Normal User</td>';
			}
			else if($row['user_level']==2)
			{
				echo '<td>Banned</td>';
			}
			else if($row['user_level']==1)
			{
				echo '<td>Administrator</td>';
			}
			else if($row['user_level']==5)
			{
				echo '<td>Moderator</td>';
			}
			else if($_SESSION['user_level']==6)
			{
				echo '<td align="left">Faculty</td>';
			}
		echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="todelete[]" />&nbsp</td>';
			
		
	}
	echo '</table>';
	echo '<br><input type="submit" class = "mybutton" name="unban" value="UnBan" style="float: right;width:10%;"/></form>';
	}
	if(isset($_POST['unban']))
	{
		if(isset($_POST['todelete']))
		{
		foreach($_POST['todelete'] as $delete_id) {
			mysql_query("UPDATE users SET user_level = 0 WHERE user_id = $delete_id ");
			mysql_query("UPDATE users SET rep_count = 0 WHERE user_id = $delete_id ");
			mysql_query("UPDATE users SET reported_by = NULL WHERE user_id = $delete_id ");
			mysql_query("UPDATE users SET is_reported = 'No' WHERE user_id = $delete_id ");
			echo '<script>location.href="admin_panel.php?id=1"</script> ';
		}
		}
	}
	
			echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 2)
	{
		$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			user_level = 0 Or user_level = 2 OR user_level = 5 OR user_level = 6";
	
	
		$result = mysql_query($sql);
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table border="1">';
		echo '<tr><th colspan="4" class="admin" style="color:#F0F0F0;"><B>User Details</B></th></tr>';
		echo '<tr><td width="15%"><b>UserID</td><td width="*"><b>UserName</td><td width="55%"><b>email-id</b></td><td width="23%"><b>UserLevel</b></td></tr>';
		echo '<form method="post" action="">';
		while($row = mysql_fetch_assoc($result))
		{
	
			echo '<tr><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td> <td>'.$row['user_email'].' </td>';
				if($row['user_level']==0)
				{
					echo '<td>Normal User</td>';
				}
				else if($row['user_level']==2)
				{
					echo '<td>Banned</td>';
				}
				else if($row['user_level']==1)
				{
					echo '<td>Administrator</td>';
				}
				else if($row['user_level']==5)
				{
					echo '<td>Moderator</td>';
				}
				else if($row['user_level']==6)
				{
					echo '<td>Faculty</td>';
				}
			
		}
		echo '</table>';
		echo '</div>';
	}
	if(htmlspecialchars($_GET["id"]) == 3)
	{
		$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			user_level = 0 Or user_level = 2 or user_level = 5 or user_level = 6";
		
		
		$result = mysql_query($sql);
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table border="1" >';
		echo '<tr ><th colspan="4" class="admin" style="color:#F0F0F0;"><B>Delete Account</B></th></tr>';
		echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>Delete Account</b></td></tr>';
		echo '<form method="post" action="">';
		while($row = mysql_fetch_assoc($result))
		{
			
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
			if($row['user_level']==0)
			{
				echo '<td>Normal User</td>';
			}
			else if($row['user_level']==2)
			{
				echo '<td>Banned</td>';
			}
			else if($row['user_level']==1)
			{
				echo '<td>Administrator</td>';
			}
			else if($row['user_level']==5)
			{
				echo '<td>Moderator</td>';
			}
			else if($row['user_level']==6)
			{
				echo '<td>Faculty</td>';
			}
			echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="todelete[]" />&nbsp</td>';
		}
		echo '</table>';
		echo '<br><input type="submit" class = "mybutton" name="delacc" value="Delete" style="float: right;width:13%;"/></form><br><br>';
		if(isset($_POST['delacc']))
		{
			if(isset($_POST['todelete']))
			{
			foreach($_POST['todelete'] as $delete_id) {
				mysql_query("UPDATE  users SET user_level = 3 WHERE user_id = $delete_id");
				echo '<script>location.href="admin_panel.php?id=3"</script> ';
			}
			}
		}
		echo '</div>';
	}
	if(htmlspecialchars($_GET["id"]) == 4)
	{
		$sql = "SELECT
		user_id,
		user_name,
		user_email,
		user_level
		FROM
		users
		WHERE
		user_level=0 or user_level = 5 AND user_id != $_SESSION[user_id]";
		$result = mysql_query($sql);
		
		echo '<div style="float:left;width:75%;color:black;">';
		echo '<table border="1">';
		echo '<tr align="middle"><th colspan="4" class="admin" style="color:#F0F0F0;"><B>Promote Users</B></th></tr>';
		echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>Promote</b></td></tr>';
		echo '<form method="post" action="">';
		
		while($row = mysql_fetch_assoc($result))
		{
	
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
			if($row['user_level']==5)
			{
				echo '<td>Moderator</td>';
			}
			else if($row['user_level']==0)
			{
				echo '<td>Normal User</td>';
			}
			echo ' </td>';
			echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="topromote[]" />&nbsp</td>';
		}
		echo '</table>';
		echo '<br><input type="submit" class = "mybutton" name="submit" value="Promote to Admin" style="float: left;width:20%;"/>
				<input type="submit" class = "mybutton" name="submit1" value="Promote to Moderator" style="float: right;width:20%;"/></form><br><br>';
		if(isset($_POST['submit']))
		{
			if(isset($_POST['topromote']))
			{
			foreach($_POST['topromote'] as $promote_id) {
				mysql_query("UPDATE users SET user_level = 1 WHERE user_id = $promote_id ");
				echo '<script>location.href="admin_panel.php?id=4"</script> ';
			}
			}
		}
		if(isset($_POST['submit1']))
		{
			if(isset($_POST['topromote']))
			{
			foreach($_POST['topromote'] as $promote_id) {
				mysql_query("UPDATE users SET user_level = 5 WHERE user_id = $promote_id ");
				echo '<script>location.href="admin_panel.php?id=4"</script> ';
			}
			}
		}
		echo '<table border="1">';
		echo '<tr><th colspan="4" class="admin" style="color:#F0F0F0;"><B>Demote Users</B></th></tr>';
		echo '<tr align="middle"><td width="15%"><b>UserID</td><td><b>UserName</td><td><b>UserLevel</td><td width="13%"><b>Demote</b></td></tr>';
		echo '<form method="post" action="">';
		$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			(user_level = 1 OR user_level = 5) AND user_id != $_SESSION[user_id]";
	
		$result = mysql_query($sql);
		while($row = mysql_fetch_assoc($result))
		{
	
	
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td>';
					
				if($row['user_level']==5)
				{
					echo '<td>Moderator</td>';
				}
				else if($row['user_level']==1)
				{
					echo '<td>Administrator</td>';
				}
			echo ' </td>';
			echo '<td><input type="checkbox" value="' . $row['user_id'] .'"name="todemote[]" />&nbsp</td>';
				
	
		}
		echo '</table>';
		echo '<br><input type="submit" class = "mybutton" name="demote" value="Demote to User" style="float: right;width:20%;"/>
				<input type="submit" class = "mybutton" name="demote1" value="Demote to Moderator" style="float: left;width:20%;"/></form>';
		if(isset($_POST['demote']))
		{
			if(isset($_POST['todemote']))
			{
			foreach($_POST['todemote'] as $demote_id) {
				mysql_query("UPDATE users SET user_level = 0 WHERE user_id = $demote_id ");
				echo '<script>location.href="admin_panel.php?id=4"</script> ';
			}
			}
		}
		if(isset($_POST['demote1']))
		{
			if(isset($_POST['todemote']))
			{
			foreach($_POST['todemote'] as $demote_id) {
				mysql_query("UPDATE users SET user_level = 5 WHERE user_id = $demote_id ");
				echo '<script>location.href="admin_panel.php?id=4"</script> ';
			}
			}
		}
	
		echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 5)
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
			echo '<form method="post" action="">
					<table border="1" width="60%">
					<th colspan="2">Add New Faculty</th>
 	 	<tr><td>Faculty Name:</td> <td> <input type="text" name="user_name" /></td><br />
 		<tr><td>Unique ID: <td> <input type="text" name="uniq_id" required/ ><br />
		<tr><td>Department:</td> <td> <select name="dept_name">
 			 <option value="CSE">CSE</option>
 			 <option value="ECE">ECE</option>
 			 <option value="EEE">EEE</option>
 			 <option value="Civil">CIVIL</option>
					<option value="Mechanical">Mechanical</option>
					</select> </td><br />
					</table><br>
					<div style="text-align:center;">
 		<input type="submit"  value="Register" /></div>
 	 </form></div>';
		}
		else 
		{
			$errors = array();
			if(isset($_POST['uniq_id']))
			{
				//the id exists
			 	if(!ctype_alnum($_POST['uniq_id']))
				{
					$errors[] = 'The Unique ID can only contain letters and digits.';
				}
				if(strlen($_POST['uniq_id']) != 5)
				{
					$errors[] = 'The Unique ID must be of 5 characters.';
				}
			}
			if(isset($_POST['user_name']))
			{
				//the user name exists
				/*if(!ctype_alnum($_POST['user_name']))
				{
					$errors[] = 'The username can only contain letters and digits.';
				}*/
				if(strlen($_POST['user_name']) > 30)
				{
					$errors[] = 'The username cannot be longer than 30 characters.';
				}
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
			
				$sql = "INSERT INTO fac (fac_name,uniq_id,branch) VALUES ('" . mysql_real_escape_string($_POST['user_name']) . "',
																		'" . mysql_real_escape_string($_POST['uniq_id']) . "',
																		'" . mysql_real_escape_string($_POST['dept_name']) . "')";
			
			
				$result = mysql_query($sql);
				if(!$result)
				{
					//something went wrong, display the error
					echo 'Something went wrong while registering. Please try again later.';
					//echo mysql_error(); //debugging purposes, uncomment when needed
				}
				else
				{
						echo '<table>
								<tr align="middle">';
						echo '<td>successfully Registered </td></table></tr>';
						echo '<script>location.href="admin_panel.php?id=5"</script> ';
				}
						
			}
		}
	}
if(htmlspecialchars($_GET["id"]) == 6)
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
			echo '<form method="post" action="">
					<table border="1" style="width:100%;">
					<th colspan="2">Add New Subject</th>
 	 	<tr><td style="width:40%;">Subject Name:</td> <td> <input type="text" name="subj_name" required/></td>
			<tr><td>Subject Code:</td> <td> <input type="text" name="subj_code" required/></td>
 		<tr><td>Branch:</td> <td> <select name="dept_name">
  <option value="CSE">CSE</option>
  <option value="ECE">ECE</option>
  <option value="EEE">EEE</option>
  <option value="Civil">CIVIL</option>
					<option value="Mechanical">Mechanical</option>
					<option value="NonTechnical">Non-Technical</option>
</select> </td><br />
			<tr><td>Year/Sem:</td> <td> <input type="text" name="yearsem"></td>
			<tr><td>Text Book:</td> <td> <input type="text" name="text_book" required/></td>
			<tr><td>Reference Books:</td> <td><textarea name="ref_book" style="width:150px;height:40px;"></textarea></td>
		</table><br>
					<div style="text-align:center;">
 		<input type="submit"  value="Add Subject" /></div>
 	 </form></div>';
		}
		else 
		{
			$qry = "SELECT Name FROM subjects WHERE Name = '" . mysql_real_escape_string($_POST['subj_name']) . "'";
			$result2 = mysql_query($qry);
			$data=mysql_fetch_assoc($result2);
			
			$errors = array();
			
			if($data['Name'] == $_POST['subj_name'])
			{
				$errors[] = 'This Subject already exists.';
			}	
			if(isset($_POST['subj_name']))
			{
				//the id exists
			 	if(strlen($_POST['subj_name']) > 30)
				{
					$errors[] = 'The Subject Name must be at most 30 characters.';
				}
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
			
				$sql = "INSERT INTO Subjects (Name,Branch,code,year,text,ref) VALUES ('" . mysql_real_escape_string($_POST['subj_name']) . "',
																		'" . mysql_real_escape_string($_POST['dept_name']) . "',
																		'" . mysql_real_escape_string($_POST['subj_code']) . "',
																		'" . mysql_real_escape_string($_POST['yearsem']) . "',
																		'" . mysql_real_escape_string($_POST['text_book']) . "',
																		'" . mysql_real_escape_string($_POST['ref_book']) . "')";
			
			
				$result = mysql_query($sql);
				$sql5 = "INSERT INTO news(news) VALUES('" . mysql_real_escape_string($_POST['subj_name']) . " subject has been added for " . mysql_real_escape_string($_POST['dept_name']) . " department.')";
				
				$result8 = mysql_query($sql5);
				if(!$result)
				{
					//something went wrong, display the error
					echo 'Something went wrong while adding new subject. Please try again later.';
					//echo mysql_error(); //debugging purposes, uncomment when needed
				}
				else
				{
						echo '<br><br><table>
								<tr align="middle">';
						echo '<td>Successfully added </td><br></table></tr>';
						//echo $data['Name'];
						echo '<script>location.href="admin_panel.php?id=6"</script> ';
				}
						
			}
		}
	}
	echo '</div>';
}

include 'footer.php';
echo '<br>';
?>
>>>>>>> origin/master
