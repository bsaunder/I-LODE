<?
include("../html_header.inc");
include("html_middle.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

switch($func){
	case "add":
		include("../conn.inc");
		$sql = "SELECT email FROM students WHERE email = '$email'";
		$results = mysql_query($sql) or die("Could Not Add User.<br>");
		if(@mysql_num_rows($results) >= 1)
		{
			// User Exists
			echo "User Already Exists<br>";
			echo "<a href=addStudent.php?func=tryAgain>Please Try Again</a><br>";
		} else {
			// Add User
			$sql = "INSERT INTO students (fname,lname,email,password) VALUES('$fname','$lname','$email','$pword')";
			$results = mysql_query($sql) or die("Could Not Add User.<br>");
			echo "<font size=3><b>User Added</b></font><br><br>";
			echo "<b>Added User:</b> $fname $lname<br>";
			echo "<b>User Login:</b> $email<br>";
			echo "<b>User Pass:</b> $pword<br>";
		}
		break;
	default:
		// Display Form
		echo "
		<table border=0 width=80% align=center>		
		<form method=POST action=addStudent.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>First Name</font></b></td>
		      <td width=145><input type=text name=fname size=20></td>
		    </tr>
		    <tr>
		      <td width=105><b><font face=Arial size=2>Last Name</font></b></td>
		      <td width=145><input type=text name=lname size=20></td>
		    </tr>
		    <tr>
		      <td width=105><b><font size=2 face=Arial>Email </font>
		      <font face=Arial size=1>(User ID)</font></b></td>
		      <td width=145><input type=text name=email size=20></td>
		    </tr>
		    <tr>
		      <td width=105><b><font face=Arial size=2>Password</font></b></td>
		      <td width=145><input type=text name=pword size=20></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=add>
		  <p align=center><input type=submit value=\"Add Student\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>