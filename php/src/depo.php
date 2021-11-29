<!DOCTYPE html>
<html>
<head>
<style>
form
{
	border: 2px solid black;
	outline: #4CAF50 solid 3px;
	margin: auto;
	width:180px;
	padding: 20px;
	text-align: center;
}

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

<form method="POST">
<input type="text" placeholder="Amount" name="amnt"><br><br><br>
<input type="pasword" placeholder="password" name="pswd"><br><br><br>
<input type="submit" value="Deposit" name="wth">
</form>

</body>
</html>

<?php

session_start();
try
{
		$dbh = new PDO('mysql:host=127.0.0.1;dbname=details', 'root', 'root');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
				echo 'Execute Failed: '.$ex->getMessage();
}
if(isset($_SESSION['favcolor']))
{

$us=$_SESSION['favcolor'];
$am=(int)$_POST['amnt'];
$pa=$_POST['pswd'];

if(isset($_POST['wth']))


{
$q = "SELECT username,password,amount FROM users WHERE password= :pa and username= :us";
$sth = $dbh->prepare($q);
$sth->bindParam(':pa',$pa);
$sth->bindParam(':us',$us);
$sth->execute();
$result = $sth->fetchAll();
if($result)
{
	foreach($result as $row)
	{
		if ($row['username']!=='')
		{
			if ($row['password']!=='')
			{
			if($am>=0)
				{
				$fam=(int)$row['amount'];
				$am=(int)$am;
				$newam=$fam+$am;
				$sq="update users set amount= :newam where username = :us";
				$sths = $dbh->prepare($sq);
				$sths->bindParam(':newam',$newam);
				$sths->bindParam(':us',$us);
				$sths->execute();
				echo "<script>alert('Money deposited : $am')</script>";
			}
			else
			{
				echo "<script>alert('Invalid Amount')</script>";
			}
		}
	}

	}

}

}
}
else
{
header('Location: admin.php');
}
?>
