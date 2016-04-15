<?php
ob_start(); 
//message.php
include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';
function hello()
{
	header('Location:  index.php');

}
echo '<h2>Send a message</h2><br>';
if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="http://localhost/Student page/signin.php"><b>signed in</b></a> to create a topic.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the messages from the database for use in the dropdown
		$sql = "SELECT
					user_id,
					user_name,
					real_name
				FROM
					users WHERE user_level = 6 AND user_id != $_SESSION[user_id]";
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			echo '<form method="post" action="">
					
					To:'; 
				
				echo '<select name="topic_cat">';
					while($row = mysql_fetch_assoc($result))
					{
						echo '<option value="' . $row['user_id'] . '">' . $row['real_name'] . '</option>';
					}
				echo '</select><br />';	
					
				echo '</br>Subject: <input type="text" name="topic_subject" value="Message" required/><br /><br>
						Your Message: <br /><textarea name="post_content" rows="7" cols="50" /></textarea><br /><br />
					<input type="submit" name = "create" value="Send Message"> 
						<br>
				 </form>';
				
				if(isset($_POST['create'])){ }
		}
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysql_query($query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your message. Please try again later.';
		}
		else
		{
			$qry = "SELECT count(*) as exist FROM pm WHERE message_by = $_SESSION[user_id] AND message_to = $_POST[topic_cat]";
			$result2 = mysql_query($qry);
			$data=mysql_fetch_assoc($result2);
			//echo $data['exist'];
			
			$qry2 = "SELECT count(*) as exist1 FROM pm WHERE message_to = $_SESSION[user_id] AND message_by = $_POST[topic_cat]";
			$result3 = mysql_query($qry2);
			$data1=mysql_fetch_assoc($result3);
			//echo $data1['exist1'];
			
			if ($data['exist'] != 0 || $data1['exist1'] != 0)
			{
			echo 'The conversation already exists';
			echo '<script>location.href="message.php"</script> ';
			break;
			} 
			if($_POST['topic_cat'] == $_SESSION['user_id'] )
			{
				
				echo 'You can not send messages to yourself';
				echo '<script>location.href="message.php"</script> ';
				//break;
			}
			else 
			{
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$sql = "INSERT INTO 
						pm(message_subject,
							   message_date,
							   message_by,
								message_to)
				   VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "',
							   NOW(),
							   " . $_SESSION['user_id'] . ",
							'" . mysql_real_escape_string($_POST['topic_cat']) . "'	
							   )";
					 
			$result = mysql_query($sql);
			
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occured while inserting your data. Please try again later.<br /><br />' . mysql_error();
				$sql = "ROLLBACK;";
				$result = mysql_query($sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				$topicid = mysql_insert_id();
				
				$sql = "INSERT INTO
							messages(m_content,
								  m_date,
								  m_topic,
								  m_by)
						VALUES
							('" . mysql_real_escape_string($_POST['post_content']) . "',
								  NOW(),
								  " . $topicid . ",
								  " . $_SESSION['user_id'] . "
							)";
				$result = mysql_query($sql);
				
				if(!$result)
				{
					//something went wrong, display the error
					echo 'An error occured while inserting your post. Please try again later.<br /><br />' . mysql_error();
					$sql = "ROLLBACK;";
					$result = mysql_query($sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysql_query($sql);
					
					//after a lot of work, the query succeeded!
						
					//echo 'You have succesfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
					//milestone two for auto redirect :D
				echo '<script>location.href="inbox.php?id='. $topicid . '"</script> ';

				}
			}
		}
	}
	}
}
include 'footer.php';
//echo '<br>';
?>
