<?php
//create_cat.php
include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';
$con=mysqli_connect("localhost","root","","source2");
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	
	else 
	{
		//a real user posted a real reply
		$sql = "INSERT INTO 
					messages(m_content,
						  m_date,
						  m_topic,
						  m_by) 
				VALUES ('" .mysqli_real_escape_string($con,$_POST['reply-content']). "',
						NOW(),
						" . mysql_real_escape_string($_GET['id']) . ",
						" . $_SESSION['user_id'] . ")";
						
		$result = mysql_query($sql);

		
		if(!$result)
		{
			echo 'Your reply has not been saved, Please try again.';
		}
		else
		{
//echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
//milestone reached :P
echo '<script>location.href="inbox.php?id=' . htmlentities($_GET['id']) . '"</script> ';

		}
	}
}

include 'footer.php';
echo '<br>';
?>