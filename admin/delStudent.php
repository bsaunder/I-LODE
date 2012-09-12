<?
include("../html_header.inc");
include("html_middle.inc");
include("../conn.inc");
if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

switch($func){
	case "del":
		$sql = "DELETE FROM students WHERE email = '$student'";
		$results = mysql_query($sql) or die("Could Not Delete User From students.<br>");
		$sql = "DELETE FROM scores WHERE user = '$student'";
		$results = mysql_query($sql) or die("Could Not Delete User From scores.<br>");
		$sql = "DELETE FROM userAnswers WHERE user = '$student'";
		$results = mysql_query($sql) or die("Could Not Delete User From userAnswers.<br>");
		$sql = "DELETE FROM extraAttempts WHERE user = '$student'";
		$results = mysql_query($sql) or die("Could Not Delete User From extraAttempts.<br>");
		echo "<font size=3><b>User Deleted</b></font><br><br>";
		break;
	default:
		// Display Form
		
		$sql = "SELECT email,fname,lname FROM students ORDER BY fname";
		$results = mysql_query($sql) or die("Could Not Find Any Students.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$email = $row['email'];
				$fname = $row['fname'];
				$lname = $row['lname'];
				
				if($email != "guest"){
					$rows .= "<option value=$email>$fname $lname</option>";
				}
			}
		}
		
		echo "
		<table border=0 width=80% align=center>		
		<form method=POST action=delStudent.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Student</font></b></td>
		      <td width=145><select size=1 name=student>
      <option selected>Select A Student</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=del>
		  <p align=center><input type=submit value=\"Delete Student\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>