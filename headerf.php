<<<<<<< HEAD


<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	<title>CLE Forum</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<br>
<div style="padding-left:10%;" align="left">
<h1>CLE Forum</h1>
</div>
<br>
	<div id="wrapper" class="page-wrap">
	<div id="menu">
		<a class="item" href="/cle/indexf.php">Home</a> -
		<a class="item" href="/cle/create_topic.php">Create a topic</a>
		
		 
		<?php
		if (!isset($_SESSION["signed_in"]))
  {
   $_SESSION['signed_in'] = NULL;
$_SESSION['user_level'] = NULL;
	
	
  } else
  if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 0)
  {
  	//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
  	//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
  	//if($_SESSION['signed_in'] == true && $_SESSION['is_reported'] == 'No')
  	//echo ' - <a class="item" href="report_user.php">Report User</a>';
  	//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
  
  		
  }
  if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
  {
  	//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
  	//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
  	//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
  }
  
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 1 )
		{	
			
			//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
			//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
			echo ' - <a class="item" href="/cle/create_cat.php">Create a category</a>';
			//echo ' - <a class="item" href="reported_users.php">Reported Users</a>';
	
			
		}
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 5 )
		{
			//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
			//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
			//echo ' - <a class="item" href="reported_users.php">Reported Users</a>';
		
				
		}
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 6 )
		{
			echo ' - <a class="item" href="/cle/create_cat.php">Create Category</a>';
			//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
			//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
			//echo ' - <a class="item" href="admin_panelf.php?id=0">Admin Panel</a>';
			//echo ' - <a class="item" href="reported_users.php">Reported Users</a>';
		
				
		}
		?>
		
		<div id="userbar">
		<?php
		if($_SESSION['signed_in'])
		{
			echo 'Hello <strong style="color: white;">' . htmlentities($_SESSION['user_name']) . '</strong>. &nbspNot you? <a class="item" href="signout.php">Sign out</a>';
		}
		else
		{
			echo '<a class="item" href="signin.php">Sign in</a> or <a class="item" href="signup.php">create an account</a>';
		}
		
		
		
		
		?>
		
		</div>
		
	</div>
	<?php 
	if($_SESSION['signed_in'] == true && $_SESSION['is_reported'] == 'Yes')
	{
		echo '<h4 style="text-align:center;color:red;background-color:black;width:105.7%;">Warning!! You have been reported for abusive behaviour. </h4><br>';
	}
	if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
	{
		echo '<h4 style="text-align:center;color:red;background-color:black;width:105.7%;">Warning!! You have been Banned. </h4><br>';
	}
	?>
	
=======


<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	<title>CLE Forum</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<br>
<div style="padding-left:10%;" align="left">
<h1>CLE Forum</h1>
</div>
<br>
	<div id="wrapper" class="page-wrap">
	<div id="menu">
		<a class="item" href="/cle/indexf.php">Home</a> -
		<a class="item" href="/cle/create_topic.php">Create a topic</a>
		
		 
		<?php
		if (!isset($_SESSION["signed_in"]))
  {
   $_SESSION['signed_in'] = NULL;
$_SESSION['user_level'] = NULL;
	
	
  } else
  if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 0)
  {
  	//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
  	//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
  	//if($_SESSION['signed_in'] == true && $_SESSION['is_reported'] == 'No')
  	//echo ' - <a class="item" href="report_user.php">Report User</a>';
  	//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
  
  		
  }
  if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
  {
  	//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
  	//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
  	//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
  }
  
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 1 )
		{	
			
			//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
			//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
			echo ' - <a class="item" href="/cle/create_cat.php">Create a category</a>';
			//echo ' - <a class="item" href="reported_users.php">Reported Users</a>';
	
			
		}
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 5 )
		{
			//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
			//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
			//echo ' - <a class="item" href="reported_users.php">Reported Users</a>';
		
				
		}
		if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 6 )
		{
			echo ' - <a class="item" href="/cle/create_cat.php">Create Category</a>';
			//echo ' - <a class="item" href="/cle/message.php">Send Message</a>';
			//echo ' - <a class="item" href="/cle/inbox.php?id=0">Inbox</a>';
			//echo ' - <a class="item" href="user.php?id=0">Profile</a>';
			//echo ' - <a class="item" href="admin_panelf.php?id=0">Admin Panel</a>';
			//echo ' - <a class="item" href="reported_users.php">Reported Users</a>';
		
				
		}
		?>
		
		<div id="userbar">
		<?php
		if($_SESSION['signed_in'])
		{
			echo 'Hello <strong style="color: white;">' . htmlentities($_SESSION['user_name']) . '</strong>. &nbspNot you? <a class="item" href="signout.php">Sign out</a>';
		}
		else
		{
			echo '<a class="item" href="signin.php">Sign in</a> or <a class="item" href="signup.php">create an account</a>';
		}
		
		
		
		
		?>
		
		</div>
		
	</div>
	<?php 
	if($_SESSION['signed_in'] == true && $_SESSION['is_reported'] == 'Yes')
	{
		echo '<h4 style="text-align:center;color:red;background-color:black;width:105.7%;">Warning!! You have been reported for abusive behaviour. </h4><br>';
	}
	if($_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
	{
		echo '<h4 style="text-align:center;color:red;background-color:black;width:105.7%;">Warning!! You have been Banned. </h4><br>';
	}
	?>
	
>>>>>>> origin/master
	<div id="content">