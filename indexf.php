<<<<<<< HEAD

<form method="post" action="">

<?php
ob_start(); 
//create_cat.php
include 'connection.php';
include 'headerf.php';

function newfunc()
{
	$_SESSION['signed_in'] = NULL;
}

$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id";

$result = mysql_query($sql);

if($_SESSION['signed_in'] == false)

		{	
			$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;
			//echo ' Click here To Sign In <a class="item" href="/forum/signin.php"> Sign In</a>';

	
			
		} 

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		//prepare the table
		echo '<table border="1">
			  <tr style="font-size:22px">
				<th colspan="1">Category</th>
				<th>Last topic</th>
			  </tr>';	
			
		while($row = mysql_fetch_assoc($result))
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
				echo '<div style="width:100%;margin:1;padding:1;border:none;">';
				echo '<div style="float:left;width:50%;">';
					echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
					echo '</div>';
					if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 6)
					{
						echo '<div style="float:right;width:15%;">';
						
										echo '<input type="checkbox" value="' . $row['cat_id'] .'"name="todelete[]" />
									
									<input type="submit" class = "mybutton" name="submit" value="Remove" /></form></form></div>';
						echo '</div>';
						
					}
					echo '</td>';
				echo '<td class="rightpart" align="center">';
				
				//fetch last topic for each cat
					$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
								
					$topicsresult = mysql_query($topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysql_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($topicrow = mysql_fetch_assoc($topicsresult))
							echo '<a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a> on ' . date('d-m-Y', strtotime($topicrow['topic_date']));
						}
					}
						
				echo '</td>';
			echo '</tr>';
		}
		
		
	}
}
if(isset($_POST['submit']))
{
	if(isset($_POST['todelete']))
	{
	foreach($_POST['todelete'] as $delete_id) {
		mysql_query("DELETE FROM categories WHERE cat_id=$delete_id");
		echo '<script>location.href="indexf.php"</script> ';
	}
	}
	else {}
}
echo '</table>';
include 'footer.php';
?>
=======

<form method="post" action="">

<?php
ob_start(); 
//create_cat.php
include 'connection.php';
include 'headerf.php';

function newfunc()
{
	$_SESSION['signed_in'] = NULL;
}

$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id";

$result = mysql_query($sql);

if($_SESSION['signed_in'] == false)

		{	
			$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;
			//echo ' Click here To Sign In <a class="item" href="/forum/signin.php"> Sign In</a>';

	
			
		} 

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		//prepare the table
		echo '<table border="1">
			  <tr style="font-size:22px">
				<th colspan="1">Category</th>
				<th>Last topic</th>
			  </tr>';	
			
		while($row = mysql_fetch_assoc($result))
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
				echo '<div style="width:100%;margin:1;padding:1;border:none;">';
				echo '<div style="float:left;width:50%;">';
					echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
					echo '</div>';
					if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 6)
					{
						echo '<div style="float:right;width:15%;">';
						
										echo '<input type="checkbox" value="' . $row['cat_id'] .'"name="todelete[]" />
									
									<input type="submit" class = "mybutton" name="submit" value="Remove" /></form></form></div>';
						echo '</div>';
						
					}
					echo '</td>';
				echo '<td class="rightpart" align="center">';
				
				//fetch last topic for each cat
					$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
								
					$topicsresult = mysql_query($topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysql_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($topicrow = mysql_fetch_assoc($topicsresult))
							echo '<a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a> on ' . date('d-m-Y', strtotime($topicrow['topic_date']));
						}
					}
						
				echo '</td>';
			echo '</tr>';
		}
		
		
	}
}
if(isset($_POST['submit']))
{
	if(isset($_POST['todelete']))
	{
	foreach($_POST['todelete'] as $delete_id) {
		mysql_query("DELETE FROM categories WHERE cat_id=$delete_id");
		echo '<script>location.href="indexf.php"</script> ';
	}
	}
	else {}
}
echo '</table>';
include 'footer.php';
?>
>>>>>>> origin/master
