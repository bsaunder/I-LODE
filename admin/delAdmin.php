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
		$sql = "DELETE FROM admins WHERE id = '$aid'";
		$results = mysql_query($sql) or die("Could Not Delete User From students.<br>");
		echo "<font size=3><b>Admin Deleted</b></font><br><br>";
		break;
	default:
		// Display Form
		
		$sql = "SELECT id,fname,lname FROM admins ORDER BY fname";
		$results = mysql_query($sql) or die("Could Not Find Any Students.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$id = $row['id'];
				$fname = $row['fname'];
				$lname = $row['lname'];
				
				$rows .= "<option value=$id>$fname $lname</option>";
			}
		}
		
		echo "
		<table border=0 width=80% align=center>		
		<form method=POST action=delAdmin.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Admin</font></b></td>
		      <td width=145><select size=1 name=aid>
      <option selected>Select An Admin</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=del>
		  <p align=center><input type=submit value=\"Delete Admin\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>