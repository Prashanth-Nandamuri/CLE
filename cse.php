<?php
//create_cat.php
include 'connection.php';
if($_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 1)
	include 'header1.php';
else
include 'header.php';

if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="http://localhost/proj/signin.php"><b>signed in</b></a> to view user details.';
}
else
{	
	$result1 = mysql_query("Select id,Name,code FROM subjects WHERE Branch ='CSE' ");
	
	echo '<div style="width:100%;margin:1;padding:1;border:none;">';
		
	if(htmlspecialchars($_GET["id"]) == 0)
	{
		if(htmlspecialchars($_GET["id"]) != 'video' && htmlspecialchars($_GET["id"]) != 'mat' && htmlspecialchars($_GET["id"]) != 'asgn' && htmlspecialchars($_GET["id"]) != 'a' && htmlspecialchars($_GET["id"]) != 'b' && htmlspecialchars($_GET["id"]) != 'c' && htmlspecialchars($_GET["id"]) != 'd'  )
		{
		echo'	<div style="float:left;width:25%;align:left;">
		<table border="1" style="width:90%;">
		<th class="admin" style="color:#F0F0F0;">Subjects</th>';
	while($data = mysql_fetch_assoc($result1))
	{
		echo '<tr><td><a href="cse.php?id='. $data['id'] . '&code='. $data['code'] .'">'. $data['Name'] .'</a>';
	}
		echo '</table></div>';
		echo '<div style="float:left;width:75%;color:black;">';
		echo '</div>';
		}
	}
	else
	{
		echo'	<div style="float:left;width:25%;align:left;">
		<table border="1" style="width:90%;">';
		$code1 = $_GET['code'];
		$name3 = mysql_query("Select * FROM subjects WHERE Branch ='CSE' AND code = '$code1' ");
		$data3 = mysql_fetch_assoc($name3);
		echo '<th class="admin" style="color:#F0F0F0;"><a href="cse.php?id=0" style="color:white">'. $data3['Name'] .'</a></th>';
		echo '<tr><td align="middle"><a href="cse.php?id=a&code='. $code1 .'">Video Lectures</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=b&code='. $code1 .'">Materials</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=c&code='. $code1 .'">Assignments</a></tr></td>
				';
		echo '</table></div>';
		echo '<div style="float:left;width:15%;color:black;">&nbsp</div>';
		echo '<div style="float:left;width:55%;color:black;">';
		echo '<table border="1" style="width:75%;float:left;">';
		echo '<tr><th colspan="2"><B>'. $data3['Name'] .'</B></th></tr>';
		echo '<tr><td>Subject Code:</td><td>'. $data3['code'] .'</td></tr>';// subject information
		echo '<tr><td>Year/Sem:</td><td>'. $data3['year'] .'</td></tr>';
		echo '<tr><td>Text Books:</td><td>'. $data3['text'] .'</td></tr>';
		echo '<tr><td>Reference Books:</td><td>'. $data3['ref'] .'</td></tr>';
		echo '</table><br>';
		echo '</div>';
	}
	if(htmlspecialchars($_GET["id"]) == 'a')
	{
		echo'	<div style="float:left;width:25%;align:left;">
		<table border="1" style="width:90%;">';
		$code1 = $_GET['code'];
		$name3 = mysql_query("Select Name FROM subjects WHERE Branch ='CSE' AND code = '$code1' ");
		$data3 = mysql_fetch_assoc($name3);
		echo '<th class="admin" style="color:#F0F0F0;"><a href="cse.php?id=0" style="color:white">'. $data3['Name'] .'</a></th>';
		echo '<tr><td align="middle"><a href="cse.php?id=a&code='. $code1 .'">Video Lectures</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=b&code='. $code1 .'">Materials</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=c&code='. $code1 .'">Assignments</a></tr></td>
				';
		echo '</table></div>';
		$result2 = mysql_query("SELECT * FROM vid WHERE branch='CSE' AND subj= '$code1' ");
		echo '<div style="float:left;width:15%;color:black;">&nbsp</div>';
		echo '<div style="float:left;width:50%;color:black;">';
		echo '<table>';
		echo '<th class="admin" style="color:#F0F0F0;">Videos Available</th>';
		while($data2 = mysql_fetch_assoc($result2))
		{
			
			echo '<tr align="center"><td><a href =cse.php?id=video&vid='. $data2['v_id']. '&code='. $code1 .'>'. $data2['name'] .'</a></td></tr>';
		}
		echo '</table></div>';
		
	}
	if(htmlspecialchars($_GET["id"]) == 'video')
	{
		echo'	<div style="float:left;width:25%;align:left;">
		<table border="1" style="width:90%;">';
		$code1 = $_GET['code'];
		$vidname= $_GET['vid'];
		$name4 = mysql_query("Select video,name FROM vid WHERE Branch ='CSE' AND v_id = $vidname ");
		$data4 = mysql_fetch_assoc($name4);
		$name3 = mysql_query("Select Name FROM subjects WHERE Branch ='CSE' AND code = '$code1' ");
		$data3 = mysql_fetch_assoc($name3);
		echo '<th class="admin" style="color:#F0F0F0;"><a href="cse.php?id=0" style="color:white">'. $data3['Name'] .'</a></th>';
		echo '<tr><td align="middle"><a href="cse.php?id=a&code='. $code1 .'">Video Lectures</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=b&code='. $code1 .'">Materials</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=c&code='. $code1 .'">Assignments</a></tr></td>
				';
		echo '</table></div>';
		echo '<div style="float:left;width:15%;color:black;">&nbsp</div>';
		
		echo '<div style="float:left;width:50%;color:black;">';
		echo '<table border="0" style="width:640;"><td align="middle">'.$data4['name']. '</td></table><br>';
				echo '<video id="example_video_1" class="video-js vjs-default-skin"
				controls preload="auto" width="640" height="264"
						poster="http://video-js.zencoder.com/oceans-clip.png"
								data-setup="{"example_option":true}">
								<source src="vid/videos/'.$data4['video'].'" type="video/mp4" />
								</video>';
		echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 'b')
	{
		echo'	<div style="float:left;width:25%;align:left;">
		<table border="1" style="width:90%;">';
		$code1 = $_GET['code'];
		$name3 = mysql_query("Select Name FROM subjects WHERE Branch ='CSE' AND code = '$code1' ");
		$data3 = mysql_fetch_assoc($name3);
		echo '<th class="admin" style="color:#F0F0F0;"><a href="cse.php?id=0" style="color:white">'. $data3['Name'] .'</a></th>';
		echo '<tr><td align="middle"><a href="cse.php?id=a&code='. $code1 .'">Video Lectures</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=b&code='. $code1 .'">Materials</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=c&code='. $code1 .'">Assignments</a></tr></td>
				';
		echo '</table></div>';
		$result2 = mysql_query("SELECT * FROM mat WHERE branch='CSE' AND subj= '$code1' ");
		echo '<div style="float:left;width:15%;color:black;">&nbsp</div>';
		echo '<div style="float:left;width:50%;color:black;">';
		echo '<table>';
		echo '<th class="admin" style="color:#F0F0F0;">Materials Available</th>';
		while($data2 = mysql_fetch_assoc($result2))
		{
			echo '<tr align="center"><td><a href="viewer/pdf.php?name='.$data2['material'].'" target="_blank">'. $data2['name'] .'</a></td></tr>';
		}
		echo '</table></div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 'mat')
	{
		//this is not being used. please ignore.
		echo'	<div style="float:left;width:25%;align:left;">
		<table border="1" style="width:90%;">';
		$code1 = $_GET['code'];
		$matname= $_GET['mid'];
		$name4 = mysql_query("Select material,name FROM mat WHERE Branch ='CSE' AND m_id = $matname ");
		$data4 = mysql_fetch_assoc($name4);
		$name3 = mysql_query("Select Name FROM subjects WHERE Branch ='CSE' AND code = '$code1' ");
		$data3 = mysql_fetch_assoc($name3);
		echo '<th class="admin" style="color:#F0F0F0;"><a href="cse.php?id=0" style="color:white">'. $data3['Name'] .'</a></th>';
		echo '<tr><td align="middle"><a href="cse.php?id=a&code='. $code1 .'">Video Lectures</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=b&code='. $code1 .'">Materials</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=c&code='. $code1 .'">Assignments</a></tr></td>
				';
		echo '</table></div>';
		echo '<div style="float:left;width:15%;color:black;">&nbsp</div>';
	
		echo '<div style="float:left;width:50%;color:black;">';
		echo '<table border="0" style="width:640;"><td align="middle">'.$data4['name']. '</td></table><br>';
		//code to open the file
		echo '</div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 'c')
	{
		echo'	<div style="float:left;width:25%;align:left;">
		<table border="1" style="width:90%;">';
		$code1 = $_GET['code'];
		$name3 = mysql_query("Select Name FROM subjects WHERE Branch ='CSE' AND code = '$code1' ");
		$data3 = mysql_fetch_assoc($name3);
		echo '<th class="admin" style="color:#F0F0F0;"><a href="cse.php?id=0" style="color:white">'. $data3['Name'] .'</a></th>';
		echo '<tr><td align="middle"><a href="cse.php?id=a&code='. $code1 .'">Video Lectures</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=b&code='. $code1 .'">Materials</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=c&code='. $code1 .'">Assignments</a></tr></td>
				';
		echo '</table></div>';
		$result2 = mysql_query("SELECT * FROM asgn WHERE branch='CSE' AND subj= '$code1' ");
		echo '<div style="float:left;width:15%;color:black;">&nbsp</div>';
		echo '<div style="float:left;width:50%;color:black;">';
		echo '<table>';
		echo '<th class="admin" style="color:#F0F0F0;">Assignments Available</th>';
		while($data2 = mysql_fetch_assoc($result2))
		{
			
			echo '<tr align="center"><td><a href =cse.php?id=asgn&aid='. $data2['a_id']. '&code='. $code1 .'>'. $data2['name'] .'</a></td></tr>';
		}
		echo '</table></div>';
	
	}
	if(htmlspecialchars($_GET["id"]) == 'asgn')
	{
		echo'	<div style="float:left;width:25%;align:left;">
		<table border="1" style="width:90%;">';
		$code1 = $_GET['code'];
		$asgnname= $_GET['aid'];
		$name4 = mysql_query("Select assign,name FROM asgn WHERE Branch ='CSE' AND a_id = $asgnname ");
		$data4 = mysql_fetch_assoc($name4);
		$name3 = mysql_query("Select Name FROM subjects WHERE Branch ='CSE' AND code = '$code1' ");
		$data3 = mysql_fetch_assoc($name3);
		echo '<th class="admin" style="color:#F0F0F0;"><a href="cse.php?id=0" style="color:white">'. $data3['Name'] .'</a></th>';
		echo '<tr><td align="middle"><a href="cse.php?id=a&code='. $code1 .'">Video Lectures</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=b&code='. $code1 .'">Materials</a></tr></td>
				<tr><td align="middle"><a href="cse.php?id=c&code='. $code1 .'">Assignments</a></tr></td>
				';
		echo '</table></div>';
		echo '<div style="float:left;width:15%;color:black;">&nbsp</div>';
	
		echo '<div style="float:left;width:50%;color:black;">';
		echo '<table border="0" style="width:640;"><td align="middle">'.$data4['name']. '</td></table><br>';
		//code to open the file
		$file = fopen ("files/$data4[assign]", "r");
		echo nl2br(' '.file_get_contents("files/$data4[assign]").' ');
		fclose ($file);
		echo '</div>';
	
	}
	

	
	
									
														
	echo '</div>';
}
include 'footer.php';
?>