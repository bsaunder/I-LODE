<?
include("../html_header.inc");
include("html_middle.inc");
include("../conn.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

switch($func)
{
	case "set":
		$sql = "SELECT password FROM admins WHERE email = '$admin'";
		$results = mysql_query($sql);
		if(@mysql_num_rows($results) == 1)
		{
			$row = mysql_fetch_array($results);
			$curpass = $row['password'];
			if($oldpass == $curpass){
				if($newpass == $newpass2){
					$sql = "UPDATE admins SET password = '$newpass2' WHERE email = '$admin'";
					$results = mysql_query($sql) or die("Could Not Change Password.<br>");
					echo "Password Successfully Changed.<br>";
				} else {
					echo "Your New Password Did Not Match.<br>Password Not Changed.<br>";
				}
			} else {
				echo "Your Current Password was Incorrect.<br>Password Not Changed.<br>";	
			}
		} else {
			echo "User Not Found.<br>";
		}
		break;
	default:
		if($admin != "admin"){
			echo "
			<table border=0 width=80% align=center>		
			<form method=POST action=newPassword.php>
			  <tr>
			      <td width=105><b><font face=Arial size=2>Old Password</font></b></td>
			      <td width=145><input type=text name=oldpass size=20></td>
			    </tr>
			    <tr>
			      <td width=105><b><font face=Arial size=2>New Password</font></b></td>
			      <td width=145><input type=text name=newpass size=20></td>
			    </tr>
			    <tr>
			      <td width=105><b><font face=Arial size=2>Re-Enter New Password</font></b></td>
			      <td width=145><input type=text name=newpass2 size=20></td>
			    </tr>
			  </table>
			<input type=hidden name=func value=set>
			  <p align=center><input type=submit value=\"Set Password\" name=B1></p>
			</form>
			";
		} else {
			echo "Can Not Change Guest Password.<br>";
			echo "<br>Return to <a href=menu.php>Main Menu</a>.<br>";
		}
		break;
}


include("../html_footer.inc");
?>