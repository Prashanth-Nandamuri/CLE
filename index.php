
<form method="post" action="">

<?php
ob_start(); 
//create_cat.php
include 'connection.php';
include 'header.php';


function newfunc()
{
	$_SESSION['signed_in'] = NULL;
}


//echo $row9['image'];
if($_SESSION['signed_in'] == false)

		{	
			$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;
			echo nl2br("Welcome to Virtual Learning Environment.\n\nYou must be <a href='signin.php'>signed in</a> to view the offered courses and become an active participant.");

		}
		$sql = "SELECT
		*
		FROM
		users
		WHERE
		user_id= $_SESSION[user_id] ";
		
		$result = mysql_query($sql);
		$result5 = mysql_query("SELECT news FROM news ORDER BY idnews DESC LIMIT 10");
		$result7 = mysql_query("SELECT image FROM upload WHERE name='" . mysql_real_escape_string($_SESSION['user_name']) . "'");
		$row9 = mysql_fetch_assoc($result7);
		if($_SESSION['signed_in'] == true)
		{
		echo '<div style="width:100%;margin:1;padding:1;border:none;">
		<div style="float:left;width:25%;">
		<div >
		<p>Courses offered in:<br><br>
		</div>
		<div style="color:black">
		<menu type="list">
		<ul type="square">
		<li><a href="cse.php?id=0"><button type="button">CSE</button></a><br><br>
		<li><a href="ece.php?id=0"><button type="button">ECE</button></a><br><br>
		<li><a href="eee.php?id=0"><button type="button">EEE</button></a><br><br>
		<li><a href="mech.php?id=0"><button type="button">Mech</button></a><br><br>
		<li><a href="civil.php?id=0"><button type="button">Civil</button></a><br><br>
		<li><a href="ntech.php?id=0"><button type="button">Non Technical</button></a>
		</ul>
		</div>
		</div>
		<div style="float:left;width:50%;color:Black;">';
		$row = mysql_fetch_assoc($result);
		echo '<table border="1">';
		echo '<tr><th colspan="2"><B>Personal Profile</B></th></tr>';
		if($row9['image'] == NULL)
			echo '<tr align="middle"><td colspan="2"><a href="user.php?id=7"><img src="/cle/image/def.png" height="100" width="100"  /></a></td></tr>';
		else
		echo '<tr align="middle"><td colspan="2"><a href="user.php?id=7"><img src="/cle/image/'.$row9['image'].'" height="100" width="100"  /></a></td></tr>';
		echo  '<tr><td>ID: <td align="left">'.$_SESSION['user_id'].' <br />
		<tr><td>Username: <td align="left">'.$_SESSION['user_name'].'  <br />
		<tr><td>User Level: ';
		if($_SESSION['user_level']==0)
			{
				echo '<td align="left">Student</td>';
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
			}else if($_SESSION['user_level']==6)
			{
				echo '<td align="left">Faculty</td>';
			}
		echo 	'<tr><td>E-mail: <td align="left">'.$_SESSION['user_email'].' <br />
				<tr><td>Real Name: <td align="left">'.$row['real_name'].' <br />
				<tr><td>Gender: <td align="left">'.$row['gender'].' <br />
			<tr><td>Birthday: <td align="left">'.$row['birthday'].' <br />
			<tr><td>City: <td align="left">'.$row['city'].' <br />
			<tr><td>Country: <td align="left">'.$row['country'].' <br />
			<tr><td>Interests: <td align="left">'.$row['interests'].' <br />
			<tr><td>About you: <td align="left">'.$row['you'].' <br />
			<tr><td>Favourite Quotes: <td align="left">'.$row['quotes'].' <br />';
		echo '</table><br></div>';
		echo '<div style="float:right;width:20%;">
		<marquee loop="-1" direction="up" height="75%" onMouseOver="stop()" onMouseOut="start()">
		<b style="color:red">Latest Updates:-</b><br>
		<br>';
		while($row4 = mysql_fetch_assoc($result5))
		{
			echo ''.$row4['news'].'<br><br>';
		}
		echo '</marquee>
		</div>';

		}


echo '</div></table>';
include 'footer.php';
?>
