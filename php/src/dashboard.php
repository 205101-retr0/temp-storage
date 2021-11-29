<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
	background-color: blue;
}
</style>
</head>
<body>

<ul>
	<li><a href="dashboard.php">Dashboard</a></li>
	<li><a href="depo.php">Deposit Money</a></li>
	<li><a href="acc.php">My Account</a></li>
	<li><a href="forms.php">command</a></li>
	<li><a href="logout.php">Logout</a></li>
</ul><br><br><br><br>

</body>
</html>


<?php

	session_start();
	if(isset($_SESSION['favcolor']))
	{
		echo 'Welcome User : '.$_SESSION['favcolor'];echo "<br><br><br>";
		echo 'Account Number :'.$_SESSION['cnum'];echo "<br><br><br>";
		echo 'Current Balance : '.$_SESSION['amont'];echo "<br><br><br>";
		echo 'Bank Name : '.$_SESSION['bkname'];echo "<br><br><br>";
	}
	else
	{
		header('Location: admin.php');
	}

?>
