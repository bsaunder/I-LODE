<?
if($f == "login"){
	// Search first Database for Username
	// If there is a Match, send to ILO 1
	// If not, then send to ILO 2
	$match = false;
	
	// Connection Variables
	$password = 'abc123';
	$username = 'ilo1101usr';
	$mySQLdatabase = 'ilo1101';
	
	// Connect to Database
	$MyConn = mysql_connect('localhost', $username, $password) or die("Invalid server or user");
	mysql_select_db("$mySQLdatabase",$MyConn);
	
	$sql = "SELECT * FROM students WHERE email='$user'"; 
	$r = mysql_query($sql); 
	if(@mysql_num_rows($r) == 1)
	{ 
		$match = true;
	}else{
		$match = false;
	}
	
	if($match){
		header("Location: http://www.orionwebdesigns.com/ccu/1101");
	}else{
		header("Location: http://www.orionwebdesigns.com/ccu/1102");
	}
}else{
	echo "
		<form method=post action=iloredirect.php?f=login>
		<input type=text name=user value=\"Enter User Name\">
		<br><input type=submit value=Redirect name=s1>
		</form>
	";	
}
?>