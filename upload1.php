<<<<<<< HEAD
<?php
include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';
if($_SESSION['signed_in'] == false && $_SESSION['user_level']!=1 && $_SESSION['user_level']!=6)
{
	//the user is not a faculty or admin
	echo 'Sorry, you do not have sufficient rights to view this page.';
}
else
{
	echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">Upload-Panel</th>
	<tr><td><a href="upload1.php?id=1">Video Lectures</a>
  <tr><td><a href="upload1.php?id=2">Materials</a>
	<tr><td><a href="upload1.php?id=3">Assignments</a>
	</table></div>';
	if(htmlspecialchars($_GET["id"]) == 0)
	{
	
		echo '<div style="float:left;width:75%;color:black;">';
	$target = "cle/vid/videos/";
    $target = $target . basename( $_FILES['ufile']['name']);
    //This gets all the other information from the form
    $pic=($_FILES['ufile']['name']);
    $typ=($_FILES['ufile']['type']);
    $siz=($_FILES['ufile']['size']);
    $na=$_POST['vname'];
    $br=$_POST['branch'];
    $su=$_POST['subject'];
    //Writes the information to the database
    if($typ!='video/mp4')
    {
    	echo '<table><tr align="middle">';
    	echo "<td>Upload only mp4 format videos.</td></table></tr>";
    	exit;
    }
    if($siz>94371840)
    {
    	echo '<table><tr align="middle">';
    	echo "<td>Your video exceeds 90MB size limit. Please upload a smaller video.</td></table></tr>";
    	exit;
    }
    else {
    mysql_query("INSERT INTO `vid` (video,name,branch,subj,uname) VALUES ('$pic','$na','$br','$su','" . mysql_real_escape_string($_SESSION['user_name']) . "')") ;
    $sql5 = "INSERT INTO news(news) VALUES('$na video has been uploaded by " . mysql_real_escape_string($_SESSION['user_name']) . " for $su.')";
    
    $result8 = mysql_query($sql5);
    //Writes the video to the server
    if(move_uploaded_file($_FILES["ufile"]["tmp_name"], "vid/videos/" . $_FILES["ufile"]["name"]))
    {
    //Tells you if its all ok
    	echo '<table>
					<tr align="middle">';
    	echo "<td>Your video has been uploaded.</td></table></tr>";
    	echo '<script>location.href="upload1.php?id=1"</script> ';
    }
    else {
    //Gives and error if its not
    	echo '<table>
					<tr align="middle">';
    	echo "<td>Sorry, there was a problem uploading your video.</td></table></tr>";
    mysql_query("Delete FROM vid WHERE name='$na");
    echo '<script>location.href="upload1.php?id=1"</script> ';
    }
    }
    echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 1)
	{
		$sql = "SELECT
			*
		FROM
			subjects";
		$result = mysql_query($sql);
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
		echo '<form method="post" enctype="multipart/form-data" action ="upload1.php?id=0">
				<table border="1" width="60%">
				<th colspan="2">Upload video</th>';
				echo '<tr><td>Video Name:</td><td><input name="vname" type="text" required/><br />
						<tr><td>Branch:</td><td> <select name="branch">
  						<option value="CSE">CSE</option>
  						<option value="ECE">ECE</option>
  						<option value="EEE">EEE</option>
  						<option value="Civil">CIVIL</option>
						<option value="Mechanical">Mechanical</option>
						<option value="NonTechnical">Non-Technical</option>
						</select> </td><br />
						<tr><td>Subject Code:</td><td><input name="subject" type="text"  required/><br />
						<tr><td colspan="2"><input name="ufile" type="file" id="ufile"><br />
						<tr align="middle"><td colspan="2"><p><strong>The max. video size is 90 MB</strong></p>
		</table><br>
					<div style="float:left;">	
	   <input name="upload" type="submit" id="upload" value=" Upload "></div></form></div>';

				echo '<div style="float:left;width:45%;color:black;">&nbsp</div>';
				echo '<div style="float:left;width:35%;color:black;">';
				echo '<br><table><th colspan="2">Subject Codes</th>';
				while($row = mysql_fetch_assoc($result))
				{
					echo '<tr><td>'.$row['Name'].'</td><td>'.$row['code'].'</td>';
				}
				echo '</table></div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 2)
	{
	
		$sql = "SELECT
			*
		FROM
			subjects";
		$result = mysql_query($sql);
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
		echo '<form method="post" enctype="multipart/form-data" action ="upload1.php?id=4">
				<table border="1" width="60%">
				<th colspan="2">Upload Material</th>';
				echo '<tr><td>Material Name:</td><td><input name="mname" type="text" required/><br />
						<tr><td>Branch:</td><td> <select name="branch">
  						<option value="CSE">CSE</option>
  						<option value="ECE">ECE</option>
  						<option value="EEE">EEE</option>
  						<option value="Civil">CIVIL</option>
						<option value="Mechanical">Mechanical</option>
						<option value="NonTechnical">Non-Technical</option>
						</select> </td><br />
						<tr><td>Subject Code:</td><td><input name="subject" type="text" required/><br />
						<tr><td colspan="2"><input name="ufile" type="file" id="ufile"><br />
						<tr align="middle"><td colspan="2"><p><strong>The max. material size is 10 MB</strong></p>
						<tr align="middle"><td colspan="2"><p><strong>*The file name must not contain spaces. Rename the file if it does.</strong></p>
		</table><br>
				<div style="float:left;">	
	   <input name="upload" type="submit" id="upload" value=" Upload "></div></form></div>';
				
				echo '<div style="float:left;width:45%;color:black;">&nbsp</div>';
				echo '<div style="float:left;width:35%;color:black;">';
				echo '<br><table><th colspan="2">Subject Codes</th>';
				while($row = mysql_fetch_assoc($result))
				{
					echo '<tr><td>'.$row['Name'].'</td><td>'.$row['code'].'</td>';
				}
				echo '</table></div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 3)
	{
	
		$sql = "SELECT
			*
		FROM
			subjects";
		$result = mysql_query($sql);
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
		echo '<form method="post" enctype="multipart/form-data" action ="upload1.php?id=5">
				<table border="1" width="60%">
				<th colspan="2">Upload Assignment</th>';
				echo '<tr><td>Assignment Name:</td><td><input name="aname" type="text" required/><br />
						<tr><td>Branch:</td><td> <select name="branch">
  						<option value="CSE">CSE</option>
  						<option value="ECE">ECE</option>
  						<option value="EEE">EEE</option>
  						<option value="Civil">CIVIL</option>
						<option value="Mechanical">Mechanical</option>
						<option value="NonTechnical">Non-Technical</option>
						</select> </td><br />
						<tr><td>Subject Code:</td><td><input name="subject" type="text" required/><br />
						<tr><td colspan="2"><input name="ufile" type="file" id="ufile"><br />
						<tr align="middle"><td colspan="2"><p><strong>The max. file size is 5 MB</strong></p>
		</table><br>
					<div style="float:left;">	
	   <input name="upload" type="submit" id="upload" value=" Upload "></div></form></div>';
				
				echo '<div style="float:left;width:45%;color:black;">&nbsp</div>';
				echo '<div style="float:left;width:35%;color:black;">';
				echo '<br><table><th colspan="2">Subject Codes</th>';
				while($row = mysql_fetch_assoc($result))
				{
					echo '<tr><td>'.$row['Name'].'</td><td>'.$row['code'].'</td>';
				}
				echo '</table></div>';
	}
	if(htmlspecialchars($_GET["id"]) == 4)
	{
		$name5 = mysql_query("SELECT count(*) as count FROM mat");
		$data5 = mysql_fetch_assoc($name5);
		$ide=$data5['count'];
		
		echo '<div style="float:left;width:75%;color:black;">';
		$target = "cle/viewer/docs/";
		$target = $target . basename( $_FILES['ufile']['name']);
		//This gets all the other information from the form
		$pic=basename(($_FILES['ufile']['name']),".pdf");
		$typ=($_FILES['ufile']['type']);
		$siz=($_FILES['ufile']['size']);
		$na=$_POST['mname'];
		$br=$_POST['branch'];
		$su=$_POST['subject'];
		$ide=$ide+1;
		//Writes the information to the database
		if($typ!='application/pdf')
		{
			echo '<table><tr align="middle">';
			echo "<td>Please upload only .pdf format files.</td></table></tr>";
			exit;
		}
		if($siz>10485760)
		{
			echo '<table><tr align="middle">';
			echo "<td>Your material exceeds 10MB size limit. Please upload a smaller file.</td></table></tr>";
			exit;
		}
		else {
		mysql_query("INSERT INTO `mat` (material,name,branch,subj,uname,ide) VALUES ('$pic','$na','$br','$su','" . mysql_real_escape_string($_SESSION['user_name']) . "',$ide)") ;
		$sql5 = "INSERT INTO news(news) VALUES('$na material has been uploaded by " . mysql_real_escape_string($_SESSION['user_name']) . " for $su.')";
		
		$result8 = mysql_query($sql5);
		//Writes the video to the server
		if(move_uploaded_file($_FILES["ufile"]["tmp_name"], "viewer/docs/" . $_FILES["ufile"]["name"]))
		{
			//Tells you if its all ok
			echo '<table>
					<tr align="middle">';
			echo "<td>Your material has been uploaded.</td></table></tr>";
			$name4 = mysql_query("Select material FROM mat WHERE ide = $ide ");
			$data4 = mysql_fetch_assoc($name4);
			$mtn=$data4['material'];
			$command="C:\\xampp\\htdocs\\cle\\viewer\\conv\\pdf2swf.exe C:\\xampp\\htdocs\\cle\\viewer\\docs\\$mtn.pdf -o C:\\xampp\\htdocs\\cle\\viewer\\docs\\$mtn.swf -f -T 9 -t -s storeallcharacters";
			exec (''.$command.'');
			//unlink("viewer//docs//$mtn.pdf");
			//echo '<script>location.href="upload1.php?id=2"</script> ';
		}
		else {
			//Gives and error if its not
			echo '<table>
					<tr align="middle">';
			echo "<td>Sorry, there was a problem uploading your material.</td></table></tr>";
			mysql_query("Delete FROM mat WHERE name='$na");
			echo '<script>location.href="upload1.php?id=2"</script> ';
		}
		}
		echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 5)
	{
	
		echo '<div style="float:left;width:75%;color:black;">';
		$target = "cle/files/";
		$target = $target . basename( $_FILES['ufile']['name']);
		//This gets all the other information from the form
		$pic=($_FILES['ufile']['name']);
		$typ=($_FILES['ufile']['type']);
		$siz=($_FILES['ufile']['size']);
		$na=$_POST['aname'];
		$br=$_POST['branch'];
		$su=$_POST['subject'];
		//Writes the information to the database
		if($typ!='text/plain')
		{
			echo '<table><tr align="middle">';
			echo "<td>Please upload only .txt format files.</td></table></tr>";
			exit;
		}
		if($siz>5242880)
		{
			echo '<table><tr align="middle">';
			echo "<td>Your file exceeds 5MB size limit. Please upload a smaller file.</td></table></tr>";
			exit;
		}
		else {
		mysql_query("INSERT INTO `asgn` (assign,name,branch,subj,uname) VALUES ('$pic','$na','$br','$su','" . mysql_real_escape_string($_SESSION['user_name']) . "')") ;
		$sql5 = "INSERT INTO news(news) VALUES('$na assignment has been uploaded by " . mysql_real_escape_string($_SESSION['user_name']) . " for $su.')";
		
		$result8 = mysql_query($sql5);
		//Writes the video to the server
		if(move_uploaded_file($_FILES["ufile"]["tmp_name"], "files/" . $_FILES["ufile"]["name"]))
		{
			//Tells you if its all ok
			echo '<table>
					<tr align="middle">';
			echo "<td>Your document has been uploaded.</td></table></tr>";
			echo '<script>location.href="upload1.php?id=3"</script> ';
		}
		else {
			//Gives and error if its not
			echo '<table>
					<tr align="middle">';
			echo "<td>Sorry, there was a problem uploading your document.</td></table></tr>";
			mysql_query("Delete FROM asgn WHERE name='$na");
		echo '<script>location.href="upload1.php?id=3"</script> ';
		}
		}
		echo '</div>';
	
	}
	echo '</div>';
}
include 'footer.php';
echo '<br>';
=======
<?php
include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';
if($_SESSION['signed_in'] == false && $_SESSION['user_level']!=1 && $_SESSION['user_level']!=6)
{
	//the user is not a faculty or admin
	echo 'Sorry, you do not have sufficient rights to view this page.';
}
else
{
	echo '<div style="width:100%;margin:1;padding:1;border:none;">
	<div style="float:left;width:25%;align:left;">
	<table border="1" style="width:90%;">
   <th class="admin" style="color:#F0F0F0;">Upload-Panel</th>
	<tr><td><a href="upload1.php?id=1">Video Lectures</a>
  <tr><td><a href="upload1.php?id=2">Materials</a>
	<tr><td><a href="upload1.php?id=3">Assignments</a>
	</table></div>';
	if(htmlspecialchars($_GET["id"]) == 0)
	{
	
		echo '<div style="float:left;width:75%;color:black;">';
	$target = "cle/vid/videos/";
    $target = $target . basename( $_FILES['ufile']['name']);
    //This gets all the other information from the form
    $pic=($_FILES['ufile']['name']);
    $typ=($_FILES['ufile']['type']);
    $siz=($_FILES['ufile']['size']);
    $na=$_POST['vname'];
    $br=$_POST['branch'];
    $su=$_POST['subject'];
    //Writes the information to the database
    if($typ!='video/mp4')
    {
    	echo '<table><tr align="middle">';
    	echo "<td>Upload only mp4 format videos.</td></table></tr>";
    	exit;
    }
    if($siz>94371840)
    {
    	echo '<table><tr align="middle">';
    	echo "<td>Your video exceeds 90MB size limit. Please upload a smaller video.</td></table></tr>";
    	exit;
    }
    else {
    mysql_query("INSERT INTO `vid` (video,name,branch,subj,uname) VALUES ('$pic','$na','$br','$su','" . mysql_real_escape_string($_SESSION['user_name']) . "')") ;
    $sql5 = "INSERT INTO news(news) VALUES('$na video has been uploaded by " . mysql_real_escape_string($_SESSION['user_name']) . " for $su.')";
    
    $result8 = mysql_query($sql5);
    //Writes the video to the server
    if(move_uploaded_file($_FILES["ufile"]["tmp_name"], "vid/videos/" . $_FILES["ufile"]["name"]))
    {
    //Tells you if its all ok
    	echo '<table>
					<tr align="middle">';
    	echo "<td>Your video has been uploaded.</td></table></tr>";
    	echo '<script>location.href="upload1.php?id=1"</script> ';
    }
    else {
    //Gives and error if its not
    	echo '<table>
					<tr align="middle">';
    	echo "<td>Sorry, there was a problem uploading your video.</td></table></tr>";
    mysql_query("Delete FROM vid WHERE name='$na");
    echo '<script>location.href="upload1.php?id=1"</script> ';
    }
    }
    echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 1)
	{
		$sql = "SELECT
			*
		FROM
			subjects";
		$result = mysql_query($sql);
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
		echo '<form method="post" enctype="multipart/form-data" action ="upload1.php?id=0">
				<table border="1" width="60%">
				<th colspan="2">Upload video</th>';
				echo '<tr><td>Video Name:</td><td><input name="vname" type="text" required/><br />
						<tr><td>Branch:</td><td> <select name="branch">
  						<option value="CSE">CSE</option>
  						<option value="ECE">ECE</option>
  						<option value="EEE">EEE</option>
  						<option value="Civil">CIVIL</option>
						<option value="Mechanical">Mechanical</option>
						<option value="NonTechnical">Non-Technical</option>
						</select> </td><br />
						<tr><td>Subject Code:</td><td><input name="subject" type="text"  required/><br />
						<tr><td colspan="2"><input name="ufile" type="file" id="ufile"><br />
						<tr align="middle"><td colspan="2"><p><strong>The max. video size is 90 MB</strong></p>
		</table><br>
					<div style="float:left;">	
	   <input name="upload" type="submit" id="upload" value=" Upload "></div></form></div>';

				echo '<div style="float:left;width:45%;color:black;">&nbsp</div>';
				echo '<div style="float:left;width:35%;color:black;">';
				echo '<br><table><th colspan="2">Subject Codes</th>';
				while($row = mysql_fetch_assoc($result))
				{
					echo '<tr><td>'.$row['Name'].'</td><td>'.$row['code'].'</td>';
				}
				echo '</table></div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 2)
	{
	
		$sql = "SELECT
			*
		FROM
			subjects";
		$result = mysql_query($sql);
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
		echo '<form method="post" enctype="multipart/form-data" action ="upload1.php?id=4">
				<table border="1" width="60%">
				<th colspan="2">Upload Material</th>';
				echo '<tr><td>Material Name:</td><td><input name="mname" type="text" required/><br />
						<tr><td>Branch:</td><td> <select name="branch">
  						<option value="CSE">CSE</option>
  						<option value="ECE">ECE</option>
  						<option value="EEE">EEE</option>
  						<option value="Civil">CIVIL</option>
						<option value="Mechanical">Mechanical</option>
						<option value="NonTechnical">Non-Technical</option>
						</select> </td><br />
						<tr><td>Subject Code:</td><td><input name="subject" type="text" required/><br />
						<tr><td colspan="2"><input name="ufile" type="file" id="ufile"><br />
						<tr align="middle"><td colspan="2"><p><strong>The max. material size is 10 MB</strong></p>
						<tr align="middle"><td colspan="2"><p><strong>*The file name must not contain spaces. Rename the file if it does.</strong></p>
		</table><br>
				<div style="float:left;">	
	   <input name="upload" type="submit" id="upload" value=" Upload "></div></form></div>';
				
				echo '<div style="float:left;width:45%;color:black;">&nbsp</div>';
				echo '<div style="float:left;width:35%;color:black;">';
				echo '<br><table><th colspan="2">Subject Codes</th>';
				while($row = mysql_fetch_assoc($result))
				{
					echo '<tr><td>'.$row['Name'].'</td><td>'.$row['code'].'</td>';
				}
				echo '</table></div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 3)
	{
	
		$sql = "SELECT
			*
		FROM
			subjects";
		$result = mysql_query($sql);
			echo '<div style="float:left;width:20%;color:black;">&nbsp</div>';
			echo '<div style="float:left;width:35%;color:black;">';
		echo '<form method="post" enctype="multipart/form-data" action ="upload1.php?id=5">
				<table border="1" width="60%">
				<th colspan="2">Upload Assignment</th>';
				echo '<tr><td>Assignment Name:</td><td><input name="aname" type="text" required/><br />
						<tr><td>Branch:</td><td> <select name="branch">
  						<option value="CSE">CSE</option>
  						<option value="ECE">ECE</option>
  						<option value="EEE">EEE</option>
  						<option value="Civil">CIVIL</option>
						<option value="Mechanical">Mechanical</option>
						<option value="NonTechnical">Non-Technical</option>
						</select> </td><br />
						<tr><td>Subject Code:</td><td><input name="subject" type="text" required/><br />
						<tr><td colspan="2"><input name="ufile" type="file" id="ufile"><br />
						<tr align="middle"><td colspan="2"><p><strong>The max. file size is 5 MB</strong></p>
		</table><br>
					<div style="float:left;">	
	   <input name="upload" type="submit" id="upload" value=" Upload "></div></form></div>';
				
				echo '<div style="float:left;width:45%;color:black;">&nbsp</div>';
				echo '<div style="float:left;width:35%;color:black;">';
				echo '<br><table><th colspan="2">Subject Codes</th>';
				while($row = mysql_fetch_assoc($result))
				{
					echo '<tr><td>'.$row['Name'].'</td><td>'.$row['code'].'</td>';
				}
				echo '</table></div>';
	}
	if(htmlspecialchars($_GET["id"]) == 4)
	{
		$name5 = mysql_query("SELECT count(*) as count FROM mat");
		$data5 = mysql_fetch_assoc($name5);
		$ide=$data5['count'];
		
		echo '<div style="float:left;width:75%;color:black;">';
		$target = "cle/viewer/docs/";
		$target = $target . basename( $_FILES['ufile']['name']);
		//This gets all the other information from the form
		$pic=basename(($_FILES['ufile']['name']),".pdf");
		$typ=($_FILES['ufile']['type']);
		$siz=($_FILES['ufile']['size']);
		$na=$_POST['mname'];
		$br=$_POST['branch'];
		$su=$_POST['subject'];
		$ide=$ide+1;
		//Writes the information to the database
		if($typ!='application/pdf')
		{
			echo '<table><tr align="middle">';
			echo "<td>Please upload only .pdf format files.</td></table></tr>";
			exit;
		}
		if($siz>10485760)
		{
			echo '<table><tr align="middle">';
			echo "<td>Your material exceeds 10MB size limit. Please upload a smaller file.</td></table></tr>";
			exit;
		}
		else {
		mysql_query("INSERT INTO `mat` (material,name,branch,subj,uname,ide) VALUES ('$pic','$na','$br','$su','" . mysql_real_escape_string($_SESSION['user_name']) . "',$ide)") ;
		$sql5 = "INSERT INTO news(news) VALUES('$na material has been uploaded by " . mysql_real_escape_string($_SESSION['user_name']) . " for $su.')";
		
		$result8 = mysql_query($sql5);
		//Writes the video to the server
		if(move_uploaded_file($_FILES["ufile"]["tmp_name"], "viewer/docs/" . $_FILES["ufile"]["name"]))
		{
			//Tells you if its all ok
			echo '<table>
					<tr align="middle">';
			echo "<td>Your material has been uploaded.</td></table></tr>";
			$name4 = mysql_query("Select material FROM mat WHERE ide = $ide ");
			$data4 = mysql_fetch_assoc($name4);
			$mtn=$data4['material'];
			$command="C:\\xampp\\htdocs\\cle\\viewer\\conv\\pdf2swf.exe C:\\xampp\\htdocs\\cle\\viewer\\docs\\$mtn.pdf -o C:\\xampp\\htdocs\\cle\\viewer\\docs\\$mtn.swf -f -T 9 -t -s storeallcharacters";
			exec (''.$command.'');
			//unlink("viewer//docs//$mtn.pdf");
			//echo '<script>location.href="upload1.php?id=2"</script> ';
		}
		else {
			//Gives and error if its not
			echo '<table>
					<tr align="middle">';
			echo "<td>Sorry, there was a problem uploading your material.</td></table></tr>";
			mysql_query("Delete FROM mat WHERE name='$na");
			echo '<script>location.href="upload1.php?id=2"</script> ';
		}
		}
		echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 5)
	{
	
		echo '<div style="float:left;width:75%;color:black;">';
		$target = "cle/files/";
		$target = $target . basename( $_FILES['ufile']['name']);
		//This gets all the other information from the form
		$pic=($_FILES['ufile']['name']);
		$typ=($_FILES['ufile']['type']);
		$siz=($_FILES['ufile']['size']);
		$na=$_POST['aname'];
		$br=$_POST['branch'];
		$su=$_POST['subject'];
		//Writes the information to the database
		if($typ!='text/plain')
		{
			echo '<table><tr align="middle">';
			echo "<td>Please upload only .txt format files.</td></table></tr>";
			exit;
		}
		if($siz>5242880)
		{
			echo '<table><tr align="middle">';
			echo "<td>Your file exceeds 5MB size limit. Please upload a smaller file.</td></table></tr>";
			exit;
		}
		else {
		mysql_query("INSERT INTO `asgn` (assign,name,branch,subj,uname) VALUES ('$pic','$na','$br','$su','" . mysql_real_escape_string($_SESSION['user_name']) . "')") ;
		$sql5 = "INSERT INTO news(news) VALUES('$na assignment has been uploaded by " . mysql_real_escape_string($_SESSION['user_name']) . " for $su.')";
		
		$result8 = mysql_query($sql5);
		//Writes the video to the server
		if(move_uploaded_file($_FILES["ufile"]["tmp_name"], "files/" . $_FILES["ufile"]["name"]))
		{
			//Tells you if its all ok
			echo '<table>
					<tr align="middle">';
			echo "<td>Your document has been uploaded.</td></table></tr>";
			echo '<script>location.href="upload1.php?id=3"</script> ';
		}
		else {
			//Gives and error if its not
			echo '<table>
					<tr align="middle">';
			echo "<td>Sorry, there was a problem uploading your document.</td></table></tr>";
			mysql_query("Delete FROM asgn WHERE name='$na");
		echo '<script>location.href="upload1.php?id=3"</script> ';
		}
		}
		echo '</div>';
	
	}
	echo '</div>';
}
include 'footer.php';
echo '<br>';
>>>>>>> origin/master
?>