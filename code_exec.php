<?php
session_start();
include('connection.php');
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$sex=$_POST['sex'];
$address=$_POST['address'];
$contact=$_POST['contact'];
$branch=$_POST['branch'];
$dob=$_POST['dob'];
$username=$_POST['username'];
$displayname=$_POST['displayname'];
$password=$_POST['password'];
mysql_query("INSERT INTO users(fname, lname, sex, address, dob, contact, branch, username, displayname, password)VALUES('$fname', '$lname', '$sex', '$address', '$dob', '$contact', '$branch', '$username', '$displayname', '$password')");
header("location: index.php?remarks=success");
mysql_close($con);
?>