<<<<<<< HEAD
<?php
//create_cat.php
include 'connection.php';
include 'headerf.php';

$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			user_level=0 or user_level = 5";
		
		
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
	<tr><td><a href="/cle/create_cat.php">Create a category</a>
   <tr><td><a href="admin_panel.php?id=1">Ban/Unban</a>
	<tr><td><a href="admin_panel.php?id=4">Promote/Demote</a>
   <tr><td><a href="admin_panel.php?id=2">User Details</a>
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
			echo '<script>location.href="admin_panelf.php?id=1"</script> ';
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
			echo '<script>location.href="admin_panelf.php?id=1"</script> ';
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
			user_level = 0 Or user_level = 2 OR user_level = 5";
	
	
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
			user_level = 0 Or user_level = 2 or user_level = 5";
		
		
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
				echo '<script>location.href="admin_panelf.php?id=3"</script> ';
			}
			}
		}
		echo '</div>';
	}
	if(htmlspecialchars($_GET["id"]) == 4)
	{
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
				echo '<script>location.href="admin_panelf.php?id=4"</script> ';
			}
			}
		}
		if(isset($_POST['submit1']))
		{
			if(isset($_POST['topromote']))
			{
			foreach($_POST['topromote'] as $promote_id) {
				mysql_query("UPDATE users SET user_level = 5 WHERE user_id = $promote_id ");
				echo '<script>location.href="admin_panelf.php?id=4"</script> ';
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
			user_level = 1 OR user_level = 5";
	
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
				echo '<script>location.href="admin_panelf.php?id=4"</script> ';
			}
			}
		}
		if(isset($_POST['demote1']))
		{
			if(isset($_POST['todemote']))
			{
			foreach($_POST['todemote'] as $demote_id) {
				mysql_query("UPDATE users SET user_level = 5 WHERE user_id = $demote_id ");
				echo '<script>location.href="admin_panelf.php?id=4"</script> ';
			}
			}
		}
	
		echo '</div>';
	
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
include 'headerf.php';

$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users
		WHERE
			user_level=0 or user_level = 5";
		
		
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
	<tr><td><a href="/cle/create_cat.php">Create a category</a>
   <tr><td><a href="admin_panel.php?id=1">Ban/Unban</a>
	<tr><td><a href="admin_panel.php?id=4">Promote/Demote</a>
   <tr><td><a href="admin_panel.php?id=2">User Details</a>
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
			echo '<script>location.href="admin_panelf.php?id=1"</script> ';
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
			echo '<script>location.href="admin_panelf.php?id=1"</script> ';
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
			user_level = 0 Or user_level = 2 OR user_level = 5";
	
	
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
			user_level = 0 Or user_level = 2 or user_level = 5";
		
		
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
				echo '<script>location.href="admin_panelf.php?id=3"</script> ';
			}
			}
		}
		echo '</div>';
	}
	if(htmlspecialchars($_GET["id"]) == 4)
	{
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
				echo '<script>location.href="admin_panelf.php?id=4"</script> ';
			}
			}
		}
		if(isset($_POST['submit1']))
		{
			if(isset($_POST['topromote']))
			{
			foreach($_POST['topromote'] as $promote_id) {
				mysql_query("UPDATE users SET user_level = 5 WHERE user_id = $promote_id ");
				echo '<script>location.href="admin_panelf.php?id=4"</script> ';
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
			user_level = 1 OR user_level = 5";
	
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
				echo '<script>location.href="admin_panelf.php?id=4"</script> ';
			}
			}
		}
		if(isset($_POST['demote1']))
		{
			if(isset($_POST['todemote']))
			{
			foreach($_POST['todemote'] as $demote_id) {
				mysql_query("UPDATE users SET user_level = 5 WHERE user_id = $demote_id ");
				echo '<script>location.href="admin_panelf.php?id=4"</script> ';
			}
			}
		}
	
		echo '</div>';
	
	}		
	
	
	echo '</div>';
}

include 'footer.php';
echo '<br>';
?>
>>>>>>> origin/master
