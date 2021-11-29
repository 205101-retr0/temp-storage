<html>

<style>
fieldset{
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

<head>
<script type="text/javascript" src="scripts/jquery.min.js"> </script>
<script type="text/javascript">
function XMLFunction(){
    var xml = '' +
        '<?xml version="1.0" encoding="UTF-8"?>' +
        '<root>' +
        '<name>' + $('#name').val() + '</name>' +
        '<search>' + $('#search').val() + '</search>' +
        '</root>';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if(xmlhttp.readyState == 4){
            console.log(xmlhttp.readyState);
            console.log(xmlhttp.responseText);
            document.getElementById('errorMessage').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","forms.php",true);
    xmlhttp.send(xml);
};
</script>

</head>



<body>


<ul>
	<li><a href="dashboard.php">Dashboard</a></li>
	<li><a href="depo.php">Deposit Money</a></li>
	<li><a href="acc.php">My Account</a></li>
	<li><a href="forms.php">command</a></li>
	<li><a href="logout.php">Logout</a></li>
</ul>
<br><br>
<br><br>

<fieldset>
	<p>
	<label for="name">Account Number</label>
	<input id="name" name="name" type="text" value="" />
	</p>

	<p>
	<label for="search">Remark</label>
	<input id="search" name="search" type="text" value="" />
	</p>

	<p>
	<button name="snd" id="Login" onclick="XMLFunction()">Send Message</button>
	</p>
</fieldset>




</body>


</html>

<?php

session_start();

	if(isset($_SESSION['favcolor']) and $_SESSION['favcolor'] === "admin@bank.a"){
		libxml_disable_entity_loader (false);
		$xmlfile = file_get_contents('php://input');
		$dom = new DOMDocument();
		$dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
		$info = simplexml_import_dom($dom);
		$name = $info->name;
		$search = $info->search;
		echo "Sorry, account number $search is not active!";

	} else {
		echo "<script>alert('Only Admins can access this page!')</script>";
		session_destroy();
		unset($_SESSION['favcolor']);
		header("Refresh: 0.1; url=index.html");
	}
?>
