<?php

include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';




if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'You have to be signed in from a Deactivated Account to View this page ';
}

else 
						{
							
							$sql = "SELECT
			user_id,
			user_name,
			user_email,
			user_level
		FROM
			users";
							$result = mysql_query($sql);
		
							if($_SESSION['user_level'] == 4)
							{
						//echo '<div style="float:left;width:75%;color:black;">';
						echo '<table>
					<tr align="middle">';
				echo '<td>You have De-Activated your account. Are you sure you want to Re-Activate your account?</td></table></tr>';
				
				
				echo '<form method="post" action=""><div style="text-align:center;" ';
				
				echo '<br><br><input type="checkbox"  value="' . $_SESSION['user_id'] .'"name="todelete[]" id="myid1" class="box"></input><label for="myid1">	Yes, Re-Activate my Account</label>';
				echo '<br><br><input type="checkbox"  value="' . $_SESSION['user_id'] .' "name="nodelete[]" id="myid2" class="box"></input><label for="myid2">	No, Not now</label>';
				
				echo '<br><br><input type="submit" class = "mybutton" name="submit9" value="Accept"/></form></div><br><br>';
				if(isset($_POST['submit9']))
				{
					if(isset($_POST['todelete']))
					{
					foreach($_POST['todelete'] as $delete_id)
					{$_SESSION['signed_in'] = NULL;
				$_SESSION['user_name'] = NULL;
				$_SESSION['user_id']   = NULL;
				$_SESSION['user_level']= NULL;
					mysql_query("UPDATE users SET user_level = reac_level WHERE user_id = $delete_id");
					echo '<table>
					<tr align="middle">';
					echo '<td>Account Re-Activated!! Sign-in Again to start posting</td></table></tr>';
					
					echo '<script>location.href="index.php"</script> ';
					}
					} else
					foreach($_POST['nodelete'] as $delete_id)
					{
						$_SESSION['signed_in'] = NULL;
					$_SESSION['user_name'] = NULL;
					$_SESSION['user_id']   = NULL;
					$_SESSION['user_level']= NULL;
					mysql_query("UPDATE users SET user_level = 4 WHERE user_id = $delete_id");
					echo '<table>
					<tr align="middle">';
					echo '<td>Account Not Re-Activated!! Reactivate to start posting</td></table></tr>';
						
					echo '<script>location.href="index.php"</script> ';
					}
				}
					
				}
				
					}
					
?>