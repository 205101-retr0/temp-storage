<?php

session_start();

	if(isset($_SESSION['favcolor']) and isset($_SESSION['cnum']))
		{
			session_destroy();
			unset($_SESSION['favcolor']);
			unset($_SESSION['cnum']);
			header('Location: admin.php');
		}
	else
		{
			header('Location: admin.php');
		}

?>
