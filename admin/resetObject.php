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
	case "reset":
		$sql = "DELETE FROM scores WHERE objectid = $oid";
		$results = mysql_query($sql) or die("Could Not Delete Scores.<br>");
		$sql = "DELETE FROM extraAttempts WHERE objectid = $oid";
		$results = mysql_query($sql) or die("Could Not Delete Extra Attempts.<br>");
		$sql = "DELETE FROM userAnswers WHERE objectid = $oid";
		$results = mysql_query($sql) or die("Could Not Delete Student Answers.<br>");
		echo "<font size=3><b>Object $oid Reset</b></font><br><br>";
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
			<form method=POST action=resetObject.php>
			  <tr>
			      <td width=105><b><font face=Arial size=2>Select Object to Reset</font></b></td>
			      <td width=145><select size=1 name=oid>
	      <option selected>Select An Object</option>
	      $rows
	      </select></td>
			    </tr>
			  </table>
			<input type=hidden name=func value=reset>
			  <p align=center><input type=submit value=\"Reset Object\" name=B1></p>
			</form>
		";
		break;
}

include("../html_footer.inc");
?>