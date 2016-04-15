<<<<<<< HEAD
<?php
//create_cat.php
include 'connection.php';
include 'headerf.php';


function smileys ($ReplaceText)
{
	//smiley pareser... works like a charm :D :D
	$Numbers=array(
			'3:)' => "<img src='/proj/smile/devil.gif' />",
			'o:)' => "<img src='/proj/smile/angel.gif' />",
			'O:)' => "<img src='/proj/smile/angel.gif' />",
			';)' => "<img src='/proj/smile/wink.gif' />",
			';-)' => "<img src='/proj/smile/wink.gif' />",
			':P' => "<img src='/proj/smile/tongue.gif' />",
			':D' => "<img src='/proj/smile/teeth.gif' />",
			':)' => "<img src='/proj/smile/smile.gif' />",
			':-)' => "<img src='/proj/smile/smile.gif' />",
			':O' => "<img src='/proj/smile/surprise.gif' />",
			':o' => "<img src='/proj/smile/surprise.gif' />",
			':p' => "<img src='/proj/smile/tongue.gif' />",
			':@' => "<img src='/proj/smile/angry.gif' />",
			':-@' => "<img src='/proj/smile/angry.gif' />",
			':((' => "<img src='/proj/smile/cry.gif' />",
			':(' => "<img src='/proj/smile/sad.gif' />",
			':-(' => "<img src='/proj/smile/sad.gif' />",
			':-|' => "<img src='/proj/smile/blank.png' />",
			':-*' => "<img src='/proj/smile/kiss.gif' />",
			':*' => "<img src='/proj/smile/kiss.gif' />",
			'<3' => "<img src='/proj/smile/heart.jpg' />",
			':-/' => "<img src='/proj/smile/confused.gif' />",
			':/' => "<img src='/proj/smile/confused.gif' />",
			'b-)' => "<img src='/proj/smile/nerd.png' />",
			'b)' => "<img src='/proj/smile/nerd.png' />",
			'b-|' => "<img src='/proj/smile/cool.gif' />",
			'b|' => "<img src='/proj/smile/cool.gif' />",
			'B-|' => "<img src='/proj/smile/cool.gif' />",
			'B|' => "<img src='/proj/smile/cool.gif' />",
			':-/' => "<img src='/proj/smile/confused.gif' />",
			'lol' => "<img src='/proj/smile/lol.gif' height='42' width='52' />",
			'rofl' => "<img src='/proj/smile/rofl.gif' height='42' width='52' />",
			'lmao' => "<img src='/proj/smile/lmao.jpg' height='42' width='52' />",
			
		
	);

	$Date=str_replace(array_keys($Numbers), array_values($Numbers), $ReplaceText);

	return $Date;	
}
$sql = "SELECT
			topic_id,
			topic_subject,
			topic_cat,
			is_closed
		
		FROM
			topics
		WHERE
			topics.topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This topic does not exist.';
	}
	else
	{
		
		while($row = mysql_fetch_assoc($result))
		{	
			//echo '<a href="category.php?id =" '. $row['cat_id'] . '" ' . $row['cat_name'] . '</a> -> '. $row['topic_subject']. '';
			echo '<a href="category.php?id='. $row['topic_cat'] . '"><B>See other topics in this Category</B></a><br><br>';
			
			
			//display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2" style="font-size:22px"><b>' . $row['topic_subject'] . '</b></th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = mysql_query($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</td></tr></table>';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{
					echo '<tr class="topic-post">
							<td class="user-post" align="center"><p><a href="user.php?id=5&name=' . $posts_row['user_name'] . '">' . $posts_row['user_name'] . '</a><br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</p></td>';
							
					echo nl2br('<td class="post-content"><p>' . stripslashes(smileys($posts_row['post_content'])) . '</p></td>');
					
					echo '</tr>';
				}
			}
			
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2 )
			{
				echo '<tr><td colspan=2> You are Banned you can not post the reply.';
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
						<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					
						</form>';
						if( $_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 5){
						echo '
								<form method="post" action="">
								
								<br><input type="submit" value="Close Thread" name ="tclose"/></form>
						</div>';}
				if(isset($_POST['tclose']))
				{	
					$tcloseid = $row['topic_id'];
					
					mysql_query("UPDATE topics SET is_closed = 1 WHERE topic_id =$tcloseid ");
					echo '<script>location.href="topic.php?id=' . htmlentities($_GET['id']) . '"</script> ';
					
				}
					//<div style="float:right;width:10%;">
				//<img src="d.jpg" align="right" width="500px" height="300px">
				//</div></td></tr>';
				}
				else 
				{
					echo ' <h4>This thread is closed<br><br>';
				}
			}
			
			//finish the table
			echo '</table>';
			
		}
	}
	
}
function threadclose()
{	
	$tcloseid = $row['topic_id'];
					echo ' hello';
					mysql_query("UPDATE topics SET is_closed = 1 WHERE topic_id =$tcloseid ");
	
}
include 'footer.php';
=======
<?php
//create_cat.php
include 'connection.php';
include 'headerf.php';


function smileys ($ReplaceText)
{
	//smiley pareser... works like a charm :D :D
	$Numbers=array(
			'3:)' => "<img src='/proj/smile/devil.gif' />",
			'o:)' => "<img src='/proj/smile/angel.gif' />",
			'O:)' => "<img src='/proj/smile/angel.gif' />",
			';)' => "<img src='/proj/smile/wink.gif' />",
			';-)' => "<img src='/proj/smile/wink.gif' />",
			':P' => "<img src='/proj/smile/tongue.gif' />",
			':D' => "<img src='/proj/smile/teeth.gif' />",
			':)' => "<img src='/proj/smile/smile.gif' />",
			':-)' => "<img src='/proj/smile/smile.gif' />",
			':O' => "<img src='/proj/smile/surprise.gif' />",
			':o' => "<img src='/proj/smile/surprise.gif' />",
			':p' => "<img src='/proj/smile/tongue.gif' />",
			':@' => "<img src='/proj/smile/angry.gif' />",
			':-@' => "<img src='/proj/smile/angry.gif' />",
			':((' => "<img src='/proj/smile/cry.gif' />",
			':(' => "<img src='/proj/smile/sad.gif' />",
			':-(' => "<img src='/proj/smile/sad.gif' />",
			':-|' => "<img src='/proj/smile/blank.png' />",
			':-*' => "<img src='/proj/smile/kiss.gif' />",
			':*' => "<img src='/proj/smile/kiss.gif' />",
			'<3' => "<img src='/proj/smile/heart.jpg' />",
			':-/' => "<img src='/proj/smile/confused.gif' />",
			':/' => "<img src='/proj/smile/confused.gif' />",
			'b-)' => "<img src='/proj/smile/nerd.png' />",
			'b)' => "<img src='/proj/smile/nerd.png' />",
			'b-|' => "<img src='/proj/smile/cool.gif' />",
			'b|' => "<img src='/proj/smile/cool.gif' />",
			'B-|' => "<img src='/proj/smile/cool.gif' />",
			'B|' => "<img src='/proj/smile/cool.gif' />",
			':-/' => "<img src='/proj/smile/confused.gif' />",
			'lol' => "<img src='/proj/smile/lol.gif' height='42' width='52' />",
			'rofl' => "<img src='/proj/smile/rofl.gif' height='42' width='52' />",
			'lmao' => "<img src='/proj/smile/lmao.jpg' height='42' width='52' />",
			
		
	);

	$Date=str_replace(array_keys($Numbers), array_values($Numbers), $ReplaceText);

	return $Date;	
}
$sql = "SELECT
			topic_id,
			topic_subject,
			topic_cat,
			is_closed
		
		FROM
			topics
		WHERE
			topics.topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This topic does not exist.';
	}
	else
	{
		
		while($row = mysql_fetch_assoc($result))
		{	
			//echo '<a href="category.php?id =" '. $row['cat_id'] . '" ' . $row['cat_name'] . '</a> -> '. $row['topic_subject']. '';
			echo '<a href="category.php?id='. $row['topic_cat'] . '"><B>See other topics in this Category</B></a><br><br>';
			
			
			//display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2" style="font-size:22px"><b>' . $row['topic_subject'] . '</b></th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = mysql_query($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</td></tr></table>';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{
					echo '<tr class="topic-post">
							<td class="user-post" align="center"><p><a href="user.php?id=5&name=' . $posts_row['user_name'] . '">' . $posts_row['user_name'] . '</a><br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</p></td>';
							
					echo nl2br('<td class="post-content"><p>' . stripslashes(smileys($posts_row['post_content'])) . '</p></td>');
					
					echo '</tr>';
				}
			}
			
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2 )
			{
				echo '<tr><td colspan=2> You are Banned you can not post the reply.';
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
						<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					
						</form>';
						if( $_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 5){
						echo '
								<form method="post" action="">
								
								<br><input type="submit" value="Close Thread" name ="tclose"/></form>
						</div>';}
				if(isset($_POST['tclose']))
				{	
					$tcloseid = $row['topic_id'];
					
					mysql_query("UPDATE topics SET is_closed = 1 WHERE topic_id =$tcloseid ");
					echo '<script>location.href="topic.php?id=' . htmlentities($_GET['id']) . '"</script> ';
					
				}
					//<div style="float:right;width:10%;">
				//<img src="d.jpg" align="right" width="500px" height="300px">
				//</div></td></tr>';
				}
				else 
				{
					echo ' <h4>This thread is closed<br><br>';
				}
			}
			
			//finish the table
			echo '</table>';
			
		}
	}
	
}
function threadclose()
{	
	$tcloseid = $row['topic_id'];
					echo ' hello';
					mysql_query("UPDATE topics SET is_closed = 1 WHERE topic_id =$tcloseid ");
	
}
include 'footer.php';
>>>>>>> origin/master
?>