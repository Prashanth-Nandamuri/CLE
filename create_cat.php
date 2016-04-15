<?php
//create_cat.php
include 'connection.php';
include 'headerf.php';

echo '<h2>Create a category</h2><br>';
if($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1 && $_SESSION['user_level'] != 6)
{
	//the user is not an admin
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//echo '<img src="c.jpg" align="right" width="51%" height="50%">';
		//the form hasn't been posted yet, display it
		echo '<form method="post" action="">
			Category name: <input type="text" name="cat_name" required/><br />
			<br>Category description:<br /> <textarea name="cat_description" cols="50" /></textarea><br /><br />
			<input type="submit" value="Add category" />
		 </form>';
	}
	else
	{
		//the form has been posted, so save it
		$sql = "INSERT INTO categories(cat_name, cat_description)
		   VALUES('" . mysql_real_escape_string($_POST['cat_name']) . "',
				 '" . mysql_real_escape_string($_POST['cat_description']) . "')";
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysql_error();
		}
		else
		{
			$catid= mysql_insert_id();
			echo 'New category succesfully added.';
			echo '<script>location.href="category.php?id='. $catid . '"</script> ';
		}
	}
}

include 'footer.php';
//echo '<br>';
?>
