<?php 
session_start();
//connection.php
$server	    = 'localhost';
$username	= 'root';
$password	= '';
$database	= 'source3';

if(!mysql_connect($server, $username, $password))
{
 	exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
 	exit('Error: could not select the database');

			
}

?>