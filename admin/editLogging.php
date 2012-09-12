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
	case "set":
		$sql = "UPDATE objects SET logging = $R1 WHERE id = $oid";
		$results = mysql_query($sql) or die("Couldnt Set Logging.");
		echo "<font size=3><b>Logging Set.</b></font><br><br>";
		if($R1 == 0){
			echo "Logging Was Enabled<br><br>";
		} else {
			echo "Logging Was Disabled<br><br>";
		}
		break;
	default:
		$sql = "SELECT id,title FROM objects ORDER BY title";
		$results = mysql_query($sql) or die("Could Not Find Any Objects.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$id = $row['id'];
				$title = $row['title'];
				
				$rows .= "<option value=$id>$title</option>";
			}
		}
		
		echo "
		<table border=0 width=80% align=center>	
		<form method=POST action=editLogging.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Object</font></b></td>
		      <td width=145><select size=1 name=oid>
      <option selected>Select An Object</option>
      $rows
      </select></td>
		    </tr>
		<tr>
		      <td width=105><b><font face=Arial size=2>Select Logging</font></b></td>
		      <td width=145>
			  
  <input type=radio value=0 name=R1>Enable&nbsp;&nbsp;&nbsp;&nbsp;
  <input type=radio value=1 name=R1>Disable
				</td>
		    </tr>
		  </table>
		<input type=hidden name=func value=set>
		  <p align=center><input type=submit value=\"Set Logging\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>