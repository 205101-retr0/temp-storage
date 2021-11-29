<html>
<title>Login</title>
<body style="background-color:black">
<br><br><br>
<h3 style="color:red;text-align:center">Bank Of Abc User Registration</h3>
<br>
<style>
form{
	border: 2px solid black;
	outline: #4CAF50 solid 3px;
	margin: auto;
	width:180px;
	padding: 20px;
	text-align: center;
}

p{
	color: red;
	font-size: 20px;
	text-align: center;
}

</style>
<form method="POST" style="text-align:center">
<input type="text" name="uname" placeholder="Username" maxlength="12"><br><br><br>
<input type="text" name="bank" placeholder="Bank name (ABC or DEF)"><br><br><br>
<input type="password" name="password" placeholder="password"><br><br><br>
<input type="submit" value="Register me!" name="btn"><br><br>
<a href="admin.php">Login</a>
</form>
</body>
</html>

<?php
	error_reporting(0);
	session_start();

	if(isset($_POST['btn']))
	{
		$bkn=$_POST['bank'];
		$id=$_POST['uname'];
		$pass=$_POST['password'];

		
		$servername = "localhost";
		$database = "details";
		$username = "root";
		$password = "root";

		try {
			$dsn = "mysql:host=$servername;dbname=$database";
			$pdo = new PDO($dsn, $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $ex){
			echo 'Execute Failed: '.$ex->getMessage();
		}
		if ($id!=='' and $pass!=='')
		{
			$am=0; 	
			$sq = "select username from users where username = :id";
			$q = "insert into users (username,password,amount,bank_name) values(:id,:pass,:am,:bkn)";
			$sth = $pdo->prepare($q);
			$sths = $pdo->prepare($sq);
			$sths->bindParam(':id',$id);
			$sth->bindParam(':id', $id);
			$sth->bindParam(':pass',$pass);
			$sth->bindParam(':am',$am);
			$sth->bindParam(':bkn',$bkn);
			$sths->execute();
			$result = $sths->fetchAll(PDO::FETCH_ASSOC);  // Check if this is being executed somehow.
			echo "<p>". $result ."</p>";
			foreach ($r as $result) {
				echo "<p>". $r['username'] . "</p>" . '<br>';
			}
			if(!$result){
				if ($sth->execute()){
					echo "<script>alert('Registered successfully!')</script>";
				}
			} else {
				echo "<script>alert('Nope you are wasting your time ;)')</script>";
			}
	}
	else
		{
			echo "<script>alert('Please fill out both the fields')</script>";
		}
	}
?>

