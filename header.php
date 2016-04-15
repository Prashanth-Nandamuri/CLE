

    <?php
    if (!isset($_SESSION["signed_in"]))
    {
    	$_SESSION['signed_in'] = NULL;
    	$_SESSION['user_level'] = NULL;
    		
    
    } 
    if($_SESSION['signed_in'] == true)
    {
    $sql4 = "SELECT
    			theme
    		FROM
    			users
    		WHERE
    user_id = $_SESSION[user_id]";
    		
    $result6 = mysql_query($sql4);
while($row4 = mysql_fetch_assoc($result6))
		{
			
			$layout= $row4['theme'];
   			
		}
    
  }
   if($_SESSION['signed_in'] == false)
   	$layout="style";
   //Themes milestone achieved 
    ?>
    
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	
 	<title>Cyber Learning Environment</title>
 	
 	<link rel="stylesheet" href="<?php echo $layout ?>.css" type="text/css">
 	<link href="vid/video-js.css" rel="stylesheet">
<script src="vid/video.js"></script>
<script>
  videojs.options.flash.swf = "vid/video-js.swf"
</script>
 		</head>
<body>
<br>
<div style="width:100%;">
	<div style="float:left;width:50%;align:left;">
		<h1><a class="title" href="/cle/index.php">Cyber Learning Environment </a></h1><br>
	</div>
	<div style="float:right;width:20%;align:right;">
		<h4><br><a class="title" href="/cle/indexf.php" target="_blank">Visit Forum</a></h4>
	</div>
</div>


	<div id="wrapper" class="page-wrap">
	<div id="menu">
		
		
		 
		<?php
		if($_SESSION['signed_in'])
		{
			echo '<font size="4"><b class="wel">Welcome</b></font> <strong><a href="user.php?id=5&name=' . $_SESSION['user_name'] . '" class="nomenu" style="color:white;text-decoration:none;">' . htmlentities($_SESSION['user_name']) . '</strong>.';
		}
		else
		{
			echo '<a class="item" href="signin.php">Sign in</a> or  <a class="item" href="signup.php">Create a Student account</a> - <a class="item" href="signup1.php">Create a Faculty account</a>';
		}
		
		?>
		
		<div id="userbar">
		<?php
		if (!isset($_SESSION["signed_in"]))
		{
			$_SESSION['signed_in'] = NULL;
			$_SESSION['user_level'] = NULL;
			
		
		} else
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 0)
		{
			echo '<a class="item" href="/cle/index.php">Home</a> - ';
			echo '<a class="item" href="/cle/message.php">Send Message</a>';
			echo ' - <a class="item" href="/cle/mesfac.php">Message Faculty</a>';
			echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			if($_SESSION['signed_in'] == true && $_SESSION['is_reported'] == 'No')
				echo ' - <a class="item" href="/cle/report_user.php">Report User</a>';
			echo ' - <a class="item" href="/cle/user.php?id=0">Profile</a> - ';
			echo '<a class="item" href="/cle/signout.php">Sign out</a>';
		
		
		}
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
		{
			echo '<a class="item" href="/cle/index.php">Home</a> - ';
			echo ' <a class="item" href="/cle/message.php">Send Message</a>';
			echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			echo ' - <a class="item" href="/cle/user.php?id=0">Profile</a> - ';
			echo '<a class="item" href="/cle/signout.php">Sign out</a>';
		}
		
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 1 )
		{
			echo '<a class="item" href="/cle/index.php">Home</a> - ';
				
			echo ' <a class="item" href="/cle/mesall.php">Send Message</a>';
			echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			echo ' - <a class="item" href="/cle/user.php?id=0">Profile</a>';
			echo ' - <a class="item" href="/cle/admin_panel.php?id=0">Admin Panel</a>';
			echo ' - <a class="item" href="/cle/reported_users.php">Reported Users</a> - ';
			echo '<a class="item" href="/cle/signout.php">Sign out</a>';
				
		}
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 5 )
		{
			echo '<a class="item" href="/cle/index.php">Home</a> - ';
			echo ' <a class="item" href="/cle/mesall.php">Send Message</a>';
			echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			echo ' - <a class="item" href="/cle/user.php?id=0">Profile</a>';
			echo ' - <a class="item" href="/cle/reported_users.php">Reported Users</a> - ';
			echo '<a class="item" href="/cle/signout.php">Sign out</a>';
		
		}
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 6 )
		{
			echo '<a class="item" href="/cle/index1.php">Home</a> - ';
			echo ' <a class="item" href="/cle/mesfac.php">Send Message</a>';
			echo ' - <a class="item" href="/cle/message.php">Message Students</a>';
			echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			echo ' - <a class="item" href="/cle/user.php?id=0">Profile</a>';
			echo ' - <a class="item" href="/cle/report_user.php">Report User</a>';
			echo ' - <a class="item" href="/cle/signout.php">Sign out</a>';
		
		}
		
		?>
		
		
		</div>
		
	</div>
	<?php
	
			if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
			{
				echo '<br><br><br><br><h4 style="text-align:center;color:red;background-color:black;width:105.2%;">Warning!! You have been Banned. </h4><br>';
			}
		elseif($_SESSION['signed_in'] == true && $_SESSION['is_reported'] == 'Yes')
		{
			echo '<br><br><br><br><h4 style="text-align:center;color:red;background-color:black;width:105.2%;">Warning!! You have been reported for abusive behaviour. </h4><br>';
		}
		
		?>
	
	<div id="content">