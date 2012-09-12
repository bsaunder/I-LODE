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
	case "upd":
		$sql = "UPDATE admins SET fname='$fname',lname='$lname',email='$email',password='$pword' WHERE id = $id";
		$results = mysql_query($sql) or die("Could Not Update Admin.<br>");
		echo "<font size=3><b>Admin Updated</b></font><br><br>";
		echo "<b>Added User:</b> $fname $lname<br>";
		echo "<b>User Login:</b> $email<br>";
		echo "<b>User Pass:</b> $pword<br>";
		break;
	case "form":
		$sql = "SELECT * FROM admins WHERE email = '$newadmin'";
		$results = mysql_query($sql) or die("Could Not Select Admin Info.<br>");
		if(@mysql_num_rows($results) == 1)
		{		
			$row = mysql_fetch_array($results);
			$id = $row['id'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$email = $row['email'];
			$pass = $row['password'];
			
			echo "
				<table border=0 width=80% align=center>		
				<form method=POST action=editAdmin.php>
				  <tr>
				      <td width=105><b><font face=Arial size=2>First Name</font></b></td>
				      <td width=145><input type=text name=fname size=20 value=$fname></td>
				    </tr>
				    <tr>
				      <td width=105><b><font face=Arial size=2>Last Name</font></b></td>
				      <td width=145><input type=text name=lname size=20 value=$lname></td>
				    </tr>
				    <tr>
				      <td width=105><b><font size=2 face=Arial>Email </font>
				      <font face=Arial size=1>(User ID)</font></b></td>
				      <td width=145><input type=text name=email size=20 value=$email></td>
				    </tr>
				    <tr>
				      <td width=105><b><font face=Arial size=2>Password</font></b></td>
				      <td width=145><input type=text name=pword size=20 value=$pass></td>
				    </tr>
				  </table>
				<input type=hidden name=func value=upd>
				<input type=hidden name=id value=$id>
				  <p align=center><input type=submit value=\"Update Admin\" name=B1></p>
				</form>
	
			";
		} else {
			echo "Invalid Admin.<br>";
		}		
		break;
	default:
		$sql = "SELECT email,fname,lname FROM admins ORDER BY fname";
		$results = mysql_query($sql) or die("Could Not Find Any Admins.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$email = $row['email'];
				$fname = $row['fname'];
				$lname = $row['lname'];
				
				$rows .= "<option value=$email>$fname $lname</option>";
			}
		}
		
		echo "
		<table border=0 width=80% align=center>		
		<form method=POST action=editAdmin.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Admin</font></b></td>
		      <td width=145><select size=1 name=newadmin>
      <option selected>Select An Admin</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=form>
		  <p align=center><input type=submit value=\"Edit Admin\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>