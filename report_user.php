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
			rep_count,
			reported_by
		FROM
			users
		WHERE
			user_level=0 AND rep_count < 3 AND user_id != $_SESSION[user_id] ";
		
		
$result = mysql_query($sql);

//echo '<h1 align="center" style="background-color:black;" >Admin Panel</h1><br>';
if($_SESSION['user_level'] == 0 || $_SESSION['user_level'] == 6)
{
	echo '<table><tr>';
	echo '<td align="middle">Welcome to users reporting page</td></tr></table>';
	echo '<br><br><div style="width:100%;color:black;">';
	echo '<table border="1">';
	echo '<tr><th colspan="4"><B>Report Users</B></th></tr>';
	echo '<tr align="middle"><td width="10%"><b>UserID</td><td width="*"><b>UserName</td><td width="55%"><b>email-id</b></td><td width="10%"><b>Report User</b></td></tr>';
	echo '<form method="post" action="">';
	while($row = mysql_fetch_assoc($result))
	{
	
		echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td> <td>'.$row['user_email'].' </td>';
		echo '<td align="middle"><input type="checkbox" value="' . $row['user_id'] .'"name="report[]" />&nbsp</td>';
		
			
	}
	echo '</table>';
	echo '</div>';
	echo '<br><input type="submit" class = "mybutton" name="report1" value="Report" style="float: right;width:10%;"/>';
	
	if(isset($_POST['report1']))
	{
		if(isset($_POST['report']))
		{
		foreach($_POST['report'] as $report_id) {
			//query to acces only reprted member details.
			$result1=mysql_query("SELECT * FROM users WHERE user_id=$report_id");
			$row1=mysql_fetch_assoc($result1);
			$count=$row1['rep_count']+1;
			$by=$_SESSION['user_name'].",".$row1['reported_by'];
			mysql_query("UPDATE users SET rep_count = $count WHERE user_id=$report_id");
			mysql_query("UPDATE users SET is_reported = 'Yes' WHERE user_id=$report_id");
			mysql_query("UPDATE users SET reported_by = '$by' WHERE user_id=$report_id");
			if($count == 3)
			{
				mysql_query("UPDATE users SET user_level = 2 WHERE user_id=$report_id");
			}
			echo '<script>location.href="report_user.php"</script> ';
		}
		}
	}
	$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level,
			reported_by
		FROM
			users
		WHERE
			user_level=0 AND is_reported = 'Yes' ";
	
	
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 0)
	{
		//echo '<br><h3>There are no reported users. </h3>';
	}
	else {
		echo '<br><br><br><div style="width:100%;color:black;">';
		echo '<table border="1">';
		echo '<tr><th colspan="5"><B>Reported Users</B></th></tr>';
		echo '<tr align="middle"><td width="10%"><b>UserID</td><td width="*"><b>UserName</td><td width="28%"><b>email-id</b></td><td width="27%"><b>Reported by</b></td><td width="10%"><b>Reported User</b></td></tr>';
		echo '<form method="post" action="">';
		while($row = mysql_fetch_assoc($result))
		{
	
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td>'.$row['user_name'].'  </td> <td>'.$row['user_email'].' </td><td>'.$row['reported_by'].'  </td> ';
			echo '<td align="middle">Reported</td>';
	
				
		}
		echo '</table>';
		echo '</div>';
	}

}
	
	

include 'footer.php';
echo '<br>';
?>