
<form name="form" method="post" style="margin: 0; text-align: center">



<?php
//category.php
include 'connection.php';
include 'headerf.php';



//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			categories
		WHERE
			cat_id = " . mysql_real_escape_string($_GET['id']);

$result = mysql_query($sql);

if(!$result)
{
	echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		//display category data
		while($row = mysql_fetch_assoc($result))
		{
			echo '<div style="width:100%;margin:1;padding:1;border:none;">';
			echo '<div style="float:left;width:50%;">';
			echo '<h2>Topics in &prime;' . $row['cat_name'] . '&prime; category</h2><br />';
			echo '</div>';
			echo '<div style="float:right;width:15%;">';
			echo '<div id="tp">
		<a class="item" href="/cle/create_topic.php">Create Topic</a></div></div>';
				echo '</div>';
			
			
			
		}
	
		//do a query for the topics
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat,
					topic_by
				FROM
					topics
				WHERE
					topic_cat = " . mysql_real_escape_string($_GET['id']);
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			echo 'The topics could not be displayed, please try again later.';
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				echo '<table>
					<tr>';
				echo '<td>There are no topics in this category yet. Do you want to create one?</td></tr></table>';
			}
			else
			{
				//prepare the table
				echo '<table border="1">
					  <tr style="font-size:22px">
						<th colspan="1">Topic</th>
						<th>Created on</th>
					  </tr>';	
				
				while($row = mysql_fetch_assoc($result))
				{				
					echo '<tr>';
						
						echo '<td class="leftpart">';
						echo '<div style="width:100%;margin:1;padding:1;border:none;">';
						echo '<div style="float:left;width:50%;">';
							echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3>';
							echo '</div>';
							//milestone to delete :P
							if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 0 || $_SESSION['user_level'] == 5 && $row['topic_by'] == $_SESSION['user_id'] )
							{
								echo '<div style="float:right;width:15%;">';
								echo '<input type="checkbox" value="' . $row['topic_id'] .'"name="todelete[]"  />
									<input type="submit" name="deltopic" value="Remove" /></form></div>';
								echo '</div>';
									
									
							}
							if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 1 )
							{
								echo '<div style="float:right;width:15%;">';
								echo '<input type="checkbox" value="' . $row['topic_id'] .'"name="todelete[]"  />
									<input type="submit" name="submit" value="Remove" /></form></div>';
								echo '</div>';
															
							
							}
						echo '</td>';
						echo '<td class="rightpart" align="center">';
						echo date('d-m-Y', strtotime($row['topic_date']));
						echo '</td>';
					
					
					echo '</tr>';
						


							}
							if(isset($_POST['submit']))
							{		if(isset($_POST['todelete']))
							{			
									foreach($_POST['todelete'] as $delete_id) {
									mysql_query("DELETE FROM topics WHERE topic_id=$delete_id");
									echo '<script>location.href="category.php?id=' . htmlentities($_GET['id']) . '"</script> ';
							}
							}
							
							
						}
						if(isset($_POST['deltopic']))
						{
							if(isset($_POST['todelete']))
							{
							foreach($_POST['todelete'] as $delete_id) {
								mysql_query("DELETE FROM topics WHERE topic_id=$delete_id");
								echo '<script>location.href="category.php?id=' . htmlentities($_GET['id']) . '"</script> ';
							}
							}	
								
						}
							
/*
							if(isset($_POST['button1'])){
							
								echo'<td>' . $row['topic_id'] .  '</td>';
									
								mysql_query("DELETE FROM topics WHERE topic_id=".$row['topic_id']."");
							
									
							
							
							
									
							} */
							

			}
			echo '</table>';
		}
	}
}

include 'footer.php';
//echo '<br>';
?>

	