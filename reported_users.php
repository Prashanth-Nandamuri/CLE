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
			reported_by,
			rep_count
		FROM
			users
		WHERE
			is_reported = 'Yes' ";
	
	
	$result = mysql_query($sql);
	
	
	echo '<table><tr>';
	echo '<th align="middle">Reported Users</th></tr></table>';
	
		
		if(mysql_num_rows($result) == 0)
		{
			echo '<br><h3>There are no reported users. </h3>';
		}
		else {
			echo '<br><br><div style="width:100%;color:black;">';
		echo '<table border="1">';
		//echo '<tr><th colspan="4" class="admin"><B>Reported Users</B></th></tr>';
		echo '<tr align="middle"><td width="10%"><b>UserID</td><td width="*"><b>UserName</td><td width="28%"><b>email-id</b></td><td width="27%"><b>Reported By</b></td><td width="10%"><b>Ignore</b></td></tr>';
		echo '<form method="post" action="">';
		while($row = mysql_fetch_assoc($result))
		{
	
			echo '<tr align="middle"><td>'.$row['user_id'].'</td><td><a href="user.php?id=5&name=' . $row['user_name'] . '">'.$row['user_name'].'</a>  </td> <td>'.$row['user_email'].' </td><td><a href="user.php?id=5&name=' . $row['reported_by'] . '">'.$row['reported_by'].'</a>  </td> ';
			echo '<td align="middle"><input type="checkbox" value="' . $row['user_id'] .'"name="unreport[]" />&nbsp</td>';
	
				
		}
		echo '</table>';
		echo '</div>';
		echo '<br><input type="submit" class = "mybutton" name="report1" value="UnReport" style="float: right;width:10%;"/>';
	}
		if(isset($_POST['report1']))
		{
			if(isset($_POST['unreport']))
			{
			foreach($_POST['unreport'] as $report_id) {
				mysql_query("UPDATE users SET rep_count = 0 WHERE user_id=$report_id");
				mysql_query("UPDATE users SET is_reported = 'No' WHERE user_id=$report_id");
				mysql_query("UPDATE users SET reported_by = NULL WHERE user_id=$report_id");
				echo '<script>location.href="reported_users.php"</script> ';
			}
			}
		}
		include 'footer.php';
		echo '<br>';
		?>
		