<?
include("../html_header.inc");
include("html_middle.inc");
include("../conn.inc");
if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

		
$sql = "SELECT * FROM students ORDER BY fname";
$results = mysql_query($sql) or die("Could Not Find Any Students.<br>");
if(@mysql_num_rows($results) >= 1)
{		
	while ($row = mysql_fetch_array($results)) {
		$email = $row['email'];
		$fname = $row['fname'];
		$lname = $row['lname'];
		$pword = $row['password'];
		
		if($email != "guest"){
			$rows .= "
				<tr>
            	<td width=33%><font face=arial size=2>&nbsp;$fname $lname</font></td>
            	<td width=35%><font face=arial size=2>&nbsp;$email</font></td>
            	<td width=32%><font face=arial size=2>&nbsp;$pword</font></td>
          		</tr>
			";
		}
	}
}
		
echo "
	<font size=3><b>Student Logins</b></font><br><br>
	<table border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse\" bordercolor=#000000 width=100% id=AutoNumber3>
          <tr>
            <td width=33%><font face=arial size=2><b>Full Name<b></font></td>
            <td width=35%><font face=arial size=2><b>Username<b></font><font face=arial size=1> (email)</font></td>
            <td width=32%><font face=arial size=2><b>Password<b></font></td>
          </tr>
		$rows
        </table>
";

include("../html_footer.inc");
?>