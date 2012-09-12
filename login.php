<?

	function authenticate_user(){ 
		header("WWW-Authenticate: Basic realm=\"Intelligent Learning Objects\""); 
		header("HTTP/1.0 401 Unauthorized"); 
		include("html_header.inc");
		include("html_middle.inc");
		echo "You are not authorized to use this system!<br>"; 
		include("html_footer.inc");
		exit; 
	} 

	if(!isset($PHP_AUTH_USER)) 
	{ 
		authenticate_user(); 
	}
	else
	{
		include("conn.inc");
		$sql = "SELECT * FROM students WHERE email='$PHP_AUTH_USER' && password='$PHP_AUTH_PW'"; 

		$r = mysql_query($sql); 
		if(@mysql_num_rows($r) != 1)
		{ 
			authenticate_user(); 
		} else {
			setcookie("user", "$PHP_AUTH_USER", time() + 14400);
			setcookie("ILOUserAuth", "yes", time() + 14400);
			$login_sql = "UPDATE students SET lastlogin = NOW() WHERE email='$PHP_AUTH_USER' && password='$PHP_AUTH_PW'";
			$login_result = mysql_query($login_sql);
			header("Location: menu.php");
			exit;
		} 
	} 
?>