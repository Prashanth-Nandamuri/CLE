<<<<<<< HEAD
<?php
//create_cat.php
include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';



function smileys ($ReplaceText)
{
	//smiley pareser... works like a charm :D :D
	$Numbers=array(
			'3:)' => "<img src='/cle/smile/devil.gif' />",
			'o:)' => "<img src='/cle/smile/angel.gif' />",
			'O:)' => "<img src='/cle/smile/angel.gif' />",
			';)' => "<img src='/cle/smile/wink.gif' />",
			';-)' => "<img src='/cle/smile/wink.gif' />",
			':P' => "<img src='/cle/smile/tongue.gif' />",
			':D' => "<img src='/cle/smile/teeth.gif' />",
			':)' => "<img src='/cle/smile/smile.gif' />",
			':-)' => "<img src='/cle/smile/smile.gif' />",
			':O' => "<img src='/cle/smile/surprise.gif' />",
			':o' => "<img src='/cle/smile/surprise.gif' />",
			':p' => "<img src='/cle/smile/tongue.gif' />",
			':@' => "<img src='/cle/smile/angry.gif' />",
			':-@' => "<img src='/cle/smile/angry.gif' />",
			':((' => "<img src='/cle/smile/cry.gif' />",
			':(' => "<img src='/cle/smile/sad.gif' />",
			':-(' => "<img src='/cle/smile/sad.gif' />",
			':-|' => "<img src='/cle/smile/blank.png' />",
			':-*' => "<img src='/cle/smile/kiss.gif' />",
			':*' => "<img src='/cle/smile/kiss.gif' />",
			'<3' => "<img src='/cle/smile/heart.jpg' />",
			':-/' => "<img src='/cle/smile/confused.gif' />",
			':/' => "<img src='/cle/smile/confused.gif' />",
			'b-)' => "<img src='/cle/smile/nerd.png' />",
			'b)' => "<img src='/cle/smile/nerd.png' />",
			'b-|' => "<img src='/cle/smile/cool.gif' />",
			'b|' => "<img src='/cle/smile/cool.gif' />",
			'B-|' => "<img src='/cle/smile/cool.gif' />",
			'B|' => "<img src='/cle/smile/cool.gif' />",
			':-/' => "<img src='/cle/smile/confused.gif' />",
			'lol' => "<img src='/cle/smile/lol.gif' height='42' width='52' />",
			'rofl' => "<img src='/cle/smile/rofl.gif' height='42' width='52' />",
			'lmao' => "<img src='/cle/smile/lmao.jpg' height='42' width='52' />",
			
		
	);

	$Date=str_replace(array_keys($Numbers), array_values($Numbers), $ReplaceText);

	return $Date;	
}
$sql = "SELECT
			message_id,
			message_subject,
			is_closed
		
		FROM
			pm
		WHERE
			pm.message_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The message could not be displayed, please try again later.';
}
else
{
	echo '<div style="width:100%;margin:1;padding:1;border:none;">';
	if(htmlspecialchars($_GET["id"]) == 0)
	{
		$sql1 = "SELECT DISTINCT
						pm.message_by,
						pm.message_to,
						pm.message_id,
						pm.reported_by,
						users.user_id,
						users.user_name
					FROM
						pm
					LEFT JOIN
						users
					ON
						pm.message_by = users.user_id
					WHERE
						message_to = $_SESSION[user_id]"; //user 1 name taken 
			
		$result1 = mysql_query($sql1);
		
		$sql2 = "SELECT DISTINCT
		pm.message_id,
		pm.message_by,
		pm.message_to,
		users.user_id,
		users.user_name
		FROM
		pm
		LEFT JOIN
		users
		ON
		pm.message_to = users.user_id
		WHERE
		message_by = $_SESSION[user_id] "; // user 2 should be printed
			
		$result2 = mysql_query($sql2);
		
		if(mysql_num_rows($result1) == 0 && mysql_num_rows($result2) == 0)
		{
			echo '<table><tr>';
			echo '<td align="middle"><h3>There are no messages for you. You can start a conversation by sending messages. </h3></td></tr></table>';
		}
		else
		{
			echo '<div style="float:left;width:25%;align:left;">
			<table border="1" style="width:90%;">
			<th class="admin" style="color:#F0F0F0;">Inbox</th>';
			while($row = mysql_fetch_assoc($result1))
			{
				if($row['message_to'] == $_SESSION['user_id'])
					echo '<tr><td><a href="inbox.php?id= '. $row['message_id'] . '">' . $row['user_name'] . '</a>';//from others
		
			}
		
		while($row2 = mysql_fetch_assoc($result2))
		{
			if($row2['message_by'] == $_SESSION['user_id'])
			echo '<tr><td><a href="inbox.php?id= '. $row2['message_id'] . '">' . $row2['user_name'] . '</a>';//to others
   
		}
				
	echo '</table></div>';
		}
	
	}
	
	else
	{
		
		while($row = mysql_fetch_assoc($result))
		{	
			echo '<div style="float:left;width:25%;align:left;">
			<table border="1" style="width:90%;">
			<th class="admin" style="color:#F0F0F0;">Inbox</th>';
		$sql1 = "SELECT DISTINCT
						pm.message_id,
						pm.message_by,
						pm.message_to,
						users.user_id,
						users.user_name
					FROM
						pm
					LEFT JOIN
						users
					ON
						pm.message_by = users.user_id
					WHERE
						message_to = $_SESSION[user_id]"; //user 1 name taken 
			
		$result1 = mysql_query($sql1);
		while($row3 = mysql_fetch_assoc($result1))
		{
			if($row3['message_to'] == $_SESSION['user_id'])
				echo '<tr><td><a href="inbox.php?id= '. $row3['message_id'] . '">' . $row3['user_name'] . '</a>';
			 
		}
		
		$sql2 = "SELECT DISTINCT
		pm.message_id,
		pm.message_by,
		pm.message_to,
		users.user_id,
		users.user_name
		FROM
		pm
		LEFT JOIN
		users
		ON
		pm.message_to = users.user_id
		WHERE
		message_by = $_SESSION[user_id] "; // user 2 should be printed
			
		$result2 = mysql_query($sql2);
		
		while($row2 = mysql_fetch_assoc($result2))
		{
			if($row2['message_by'] == $_SESSION['user_id'])
			echo '<tr><td><a href="inbox.php?id= '. $row2['message_id'] . '">' . $row2['user_name'] . '</a>';
   
		}
			echo '</table></div>';
			
		
			
			
			//display post data
			echo '<div style="float:left;width:75%;color:black;">
					<table class="topic" border="1">
					<tr>
						<th colspan="2" style="font-size:22px"><b>' . $row['message_subject'] . '</b></th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						messages.m_topic,
						messages.m_content,
						messages.m_date,
						messages.m_by,
						users.user_id,
						users.user_name
					FROM
						messages
					LEFT JOIN
						users
					ON
						messages.m_by = users.user_id
					WHERE
						messages.m_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = mysql_query($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The messages could not be displayed, please try again later.</td></tr></table></div>';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{
					echo '<tr class="topic-post">
							<td class="user-post" align="center"><p><a href="user.php?id=5&name=' . $posts_row['user_name'] . '">' . $posts_row['user_name'] . '</a><br/>' . date('d-m-Y H:i', strtotime($posts_row['m_date'])) . '</p></td>';
							
					echo nl2br('<td class="post-content"><p>' . stripslashes(smileys($posts_row['m_content'])) . '</p></td>');
					
					echo '</tr>';
				}
				echo '</table><br>';
			}
			
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{	
				if($row['is_closed'] == 0)
				{
				//show reply box
				echo '<tr><td colspan="2">';
				echo '<div style="width:100%;margin:0;padding:0px;border:none;">
						<div style="float:left;width:50%;">
						<h2>Reply:</h2><br />
						<form method="post" action="mreply.php?id=' . $row['message_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					
						</form>';
			
						if( $_SESSION['signed_in'] == true)
						{
								echo '
								<form method="post" action="">
								
								<br><input type="submit" value="Block User" name ="tclose"/></form>
								</div>';
						}
				if(isset($_POST['tclose']))
				{	
					$tcloseid = $row['message_id'];
					
					mysql_query("UPDATE pm SET is_closed = 1 WHERE message_id =$tcloseid ");
					mysql_query("UPDATE pm SET reported_by = '" . mysql_real_escape_string($_SESSION['user_name']) . "' WHERE message_id=$tcloseid");
					echo '<script>location.href="inbox.php?id=' . htmlentities($_GET['id']) . '"</script> ';
					
				}
					//<div style="float:right;width:10%;">
				//<img src="d.jpg" align="right" width="500px" height="300px">
				//</div></td></tr>';
				}
				else 
				{
					echo ' <h4>This Conversation is blocked<br><br>';
					$sql5 = "SELECT
							reported_by
							FROM
							pm
							WHERE
							pm.message_id = " . mysql_real_escape_string($_GET['id']);
						
					$result5 = mysql_query($sql5);
					$row5 = mysql_fetch_assoc($result5);
					
					if( $_SESSION['signed_in'] == true && $row5['reported_by'] == $_SESSION['user_name'])
					{
						echo '
								<form method="post" action="">
					
								<br><input type="submit" value="UnBlock User" name ="topen"/></form>
								</div>';
					}
					if(isset($_POST['topen']))
					{
						$tcloseid = $row['message_id'];
						mysql_query("UPDATE pm SET is_closed = 0 WHERE message_id =$tcloseid ");
						mysql_query("UPDATE pm SET reported_by = '" . mysql_real_escape_string($_SESSION['user_name']) . "' WHERE message_id=$tcloseid");
						echo '<script>location.href="inbox.php?id=' . htmlentities($_GET['id']) . '"</script> ';
			
							
					}
				}
			}
			
			//finish the table
			echo '</table></div></div>';
			
		}
		
	}
	
}
echo '</div>';
function threadclose()
{	
	$tcloseid = $row['message_id'];
				
					mysql_query("UPDATE pm SET is_closed = 1 WHERE message_id =$tcloseid ");
	
}
include 'footer.php';
=======
<?php
//create_cat.php
include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';



function smileys ($ReplaceText)
{
	//smiley pareser... works like a charm :D :D
	$Numbers=array(
			'3:)' => "<img src='/cle/smile/devil.gif' />",
			'o:)' => "<img src='/cle/smile/angel.gif' />",
			'O:)' => "<img src='/cle/smile/angel.gif' />",
			';)' => "<img src='/cle/smile/wink.gif' />",
			';-)' => "<img src='/cle/smile/wink.gif' />",
			':P' => "<img src='/cle/smile/tongue.gif' />",
			':D' => "<img src='/cle/smile/teeth.gif' />",
			':)' => "<img src='/cle/smile/smile.gif' />",
			':-)' => "<img src='/cle/smile/smile.gif' />",
			':O' => "<img src='/cle/smile/surprise.gif' />",
			':o' => "<img src='/cle/smile/surprise.gif' />",
			':p' => "<img src='/cle/smile/tongue.gif' />",
			':@' => "<img src='/cle/smile/angry.gif' />",
			':-@' => "<img src='/cle/smile/angry.gif' />",
			':((' => "<img src='/cle/smile/cry.gif' />",
			':(' => "<img src='/cle/smile/sad.gif' />",
			':-(' => "<img src='/cle/smile/sad.gif' />",
			':-|' => "<img src='/cle/smile/blank.png' />",
			':-*' => "<img src='/cle/smile/kiss.gif' />",
			':*' => "<img src='/cle/smile/kiss.gif' />",
			'<3' => "<img src='/cle/smile/heart.jpg' />",
			':-/' => "<img src='/cle/smile/confused.gif' />",
			':/' => "<img src='/cle/smile/confused.gif' />",
			'b-)' => "<img src='/cle/smile/nerd.png' />",
			'b)' => "<img src='/cle/smile/nerd.png' />",
			'b-|' => "<img src='/cle/smile/cool.gif' />",
			'b|' => "<img src='/cle/smile/cool.gif' />",
			'B-|' => "<img src='/cle/smile/cool.gif' />",
			'B|' => "<img src='/cle/smile/cool.gif' />",
			':-/' => "<img src='/cle/smile/confused.gif' />",
			'lol' => "<img src='/cle/smile/lol.gif' height='42' width='52' />",
			'rofl' => "<img src='/cle/smile/rofl.gif' height='42' width='52' />",
			'lmao' => "<img src='/cle/smile/lmao.jpg' height='42' width='52' />",
			
		
	);

	$Date=str_replace(array_keys($Numbers), array_values($Numbers), $ReplaceText);

	return $Date;	
}
$sql = "SELECT
			message_id,
			message_subject,
			is_closed
		
		FROM
			pm
		WHERE
			pm.message_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The message could not be displayed, please try again later.';
}
else
{
	echo '<div style="width:100%;margin:1;padding:1;border:none;">';
	if(htmlspecialchars($_GET["id"]) == 0)
	{
		$sql1 = "SELECT DISTINCT
						pm.message_by,
						pm.message_to,
						pm.message_id,
						pm.reported_by,
						users.user_id,
						users.user_name
					FROM
						pm
					LEFT JOIN
						users
					ON
						pm.message_by = users.user_id
					WHERE
						message_to = $_SESSION[user_id]"; //user 1 name taken 
			
		$result1 = mysql_query($sql1);
		
		$sql2 = "SELECT DISTINCT
		pm.message_id,
		pm.message_by,
		pm.message_to,
		users.user_id,
		users.user_name
		FROM
		pm
		LEFT JOIN
		users
		ON
		pm.message_to = users.user_id
		WHERE
		message_by = $_SESSION[user_id] "; // user 2 should be printed
			
		$result2 = mysql_query($sql2);
		
		if(mysql_num_rows($result1) == 0 && mysql_num_rows($result2) == 0)
		{
			echo '<table><tr>';
			echo '<td align="middle"><h3>There are no messages for you. You can start a conversation by sending messages. </h3></td></tr></table>';
		}
		else
		{
			echo '<div style="float:left;width:25%;align:left;">
			<table border="1" style="width:90%;">
			<th class="admin" style="color:#F0F0F0;">Inbox</th>';
			while($row = mysql_fetch_assoc($result1))
			{
				if($row['message_to'] == $_SESSION['user_id'])
					echo '<tr><td><a href="inbox.php?id= '. $row['message_id'] . '">' . $row['user_name'] . '</a>';//from others
		
			}
		
		while($row2 = mysql_fetch_assoc($result2))
		{
			if($row2['message_by'] == $_SESSION['user_id'])
			echo '<tr><td><a href="inbox.php?id= '. $row2['message_id'] . '">' . $row2['user_name'] . '</a>';//to others
   
		}
				
	echo '</table></div>';
		}
	
	}
	
	else
	{
		
		while($row = mysql_fetch_assoc($result))
		{	
			echo '<div style="float:left;width:25%;align:left;">
			<table border="1" style="width:90%;">
			<th class="admin" style="color:#F0F0F0;">Inbox</th>';
		$sql1 = "SELECT DISTINCT
						pm.message_id,
						pm.message_by,
						pm.message_to,
						users.user_id,
						users.user_name
					FROM
						pm
					LEFT JOIN
						users
					ON
						pm.message_by = users.user_id
					WHERE
						message_to = $_SESSION[user_id]"; //user 1 name taken 
			
		$result1 = mysql_query($sql1);
		while($row3 = mysql_fetch_assoc($result1))
		{
			if($row3['message_to'] == $_SESSION['user_id'])
				echo '<tr><td><a href="inbox.php?id= '. $row3['message_id'] . '">' . $row3['user_name'] . '</a>';
			 
		}
		
		$sql2 = "SELECT DISTINCT
		pm.message_id,
		pm.message_by,
		pm.message_to,
		users.user_id,
		users.user_name
		FROM
		pm
		LEFT JOIN
		users
		ON
		pm.message_to = users.user_id
		WHERE
		message_by = $_SESSION[user_id] "; // user 2 should be printed
			
		$result2 = mysql_query($sql2);
		
		while($row2 = mysql_fetch_assoc($result2))
		{
			if($row2['message_by'] == $_SESSION['user_id'])
			echo '<tr><td><a href="inbox.php?id= '. $row2['message_id'] . '">' . $row2['user_name'] . '</a>';
   
		}
			echo '</table></div>';
			
		
			
			
			//display post data
			echo '<div style="float:left;width:75%;color:black;">
					<table class="topic" border="1">
					<tr>
						<th colspan="2" style="font-size:22px"><b>' . $row['message_subject'] . '</b></th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						messages.m_topic,
						messages.m_content,
						messages.m_date,
						messages.m_by,
						users.user_id,
						users.user_name
					FROM
						messages
					LEFT JOIN
						users
					ON
						messages.m_by = users.user_id
					WHERE
						messages.m_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = mysql_query($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The messages could not be displayed, please try again later.</td></tr></table></div>';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{
					echo '<tr class="topic-post">
							<td class="user-post" align="center"><p><a href="user.php?id=5&name=' . $posts_row['user_name'] . '">' . $posts_row['user_name'] . '</a><br/>' . date('d-m-Y H:i', strtotime($posts_row['m_date'])) . '</p></td>';
							
					echo nl2br('<td class="post-content"><p>' . stripslashes(smileys($posts_row['m_content'])) . '</p></td>');
					
					echo '</tr>';
				}
				echo '</table><br>';
			}
			
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{	
				if($row['is_closed'] == 0)
				{
				//show reply box
				echo '<tr><td colspan="2">';
				echo '<div style="width:100%;margin:0;padding:0px;border:none;">
						<div style="float:left;width:50%;">
						<h2>Reply:</h2><br />
						<form method="post" action="mreply.php?id=' . $row['message_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					
						</form>';
			
						if( $_SESSION['signed_in'] == true)
						{
								echo '
								<form method="post" action="">
								
								<br><input type="submit" value="Block User" name ="tclose"/></form>
								</div>';
						}
				if(isset($_POST['tclose']))
				{	
					$tcloseid = $row['message_id'];
					
					mysql_query("UPDATE pm SET is_closed = 1 WHERE message_id =$tcloseid ");
					mysql_query("UPDATE pm SET reported_by = '" . mysql_real_escape_string($_SESSION['user_name']) . "' WHERE message_id=$tcloseid");
					echo '<script>location.href="inbox.php?id=' . htmlentities($_GET['id']) . '"</script> ';
					
				}
					//<div style="float:right;width:10%;">
				//<img src="d.jpg" align="right" width="500px" height="300px">
				//</div></td></tr>';
				}
				else 
				{
					echo ' <h4>This Conversation is blocked<br><br>';
					$sql5 = "SELECT
							reported_by
							FROM
							pm
							WHERE
							pm.message_id = " . mysql_real_escape_string($_GET['id']);
						
					$result5 = mysql_query($sql5);
					$row5 = mysql_fetch_assoc($result5);
					
					if( $_SESSION['signed_in'] == true && $row5['reported_by'] == $_SESSION['user_name'])
					{
						echo '
								<form method="post" action="">
					
								<br><input type="submit" value="UnBlock User" name ="topen"/></form>
								</div>';
					}
					if(isset($_POST['topen']))
					{
						$tcloseid = $row['message_id'];
						mysql_query("UPDATE pm SET is_closed = 0 WHERE message_id =$tcloseid ");
						mysql_query("UPDATE pm SET reported_by = '" . mysql_real_escape_string($_SESSION['user_name']) . "' WHERE message_id=$tcloseid");
						echo '<script>location.href="inbox.php?id=' . htmlentities($_GET['id']) . '"</script> ';
			
							
					}
				}
			}
			
			//finish the table
			echo '</table></div></div>';
			
		}
		
	}
	
}
echo '</div>';
function threadclose()
{	
	$tcloseid = $row['message_id'];
				
					mysql_query("UPDATE pm SET is_closed = 1 WHERE message_id =$tcloseid ");
	
}
include 'footer.php';
>>>>>>> origin/master
?>