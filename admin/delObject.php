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
		// Delete All Answers
		$sql = "SELECT * FROM questions WHERE objectid = '$oid'";
		$results = mysql_query($sql) or die("Could Not Select Questions To Delete Answers.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$id = $row['id'];
				$sql2 = "DELETE FROM answerChoices WHERE questionid = $id";
				$results2 = mysql_query($sql2) or die("Could Not Select Questions To Delete Answers.<br>");
			}
		}
		$sql = "SELECT * FROM alt_questions WHERE objectid = '$oid'";
		$results = mysql_query($sql) or die("Could Not Select Alt Questions To Delete Answers.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$id = $row['id'];
				$sql2 = "DELETE FROM alt_answerChoices WHERE questionid = $id";
				$results2 = mysql_query($sql2) or die("Could Not Select Alt Questions To Delete Answers.<br>");
			}
		}
		// Delete Object
		$sql = "DELETE FROM objects WHERE id = '$oid'";
		$results = mysql_query($sql) or die("Could Not Delete Object From objects.<br>");
		// Delete All Text
		$sql = "DELETE FROM text WHERE objectid = '$oid'";
		$results = mysql_query($sql) or die("Could Not Delete Object From text.<br>");
		$sql = "DELETE FROM alt_text WHERE objectid = '$oid'";
		$results = mysql_query($sql) or die("Could Not Delete Object From alt_text.<br>");
		// Delete All Questions
		$sql = "DELETE FROM questions WHERE objectid = '$oid'";
		$results = mysql_query($sql) or die("Could Not Delete Object From questions.<br>");
		$sql = "DELETE FROM alt_questions WHERE objectid = '$oid'";
		$results = mysql_query($sql) or die("Could Not Delete Object From alt_questions.<br>");
		// Delete Scores
		$sql = "DELETE FROM scores WHERE objectid = '$oid'";
		$results = mysql_query($sql) or die("Could Not Delete Object From scores.<br>");
		// Delete Extra Attempts
		$sql = "DELETE FROM extraAttempts WHERE objectid = '$oid'";
		$results = mysql_query($sql) or die("Could Not Delete Object From extraAttempts.<br>");
		echo "<font size=3><b>Object Deleted</b></font><br><br>";
		break;
	default:
		// Display Form
		
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
		<form method=POST action=delObject.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Object</font></b></td>
		      <td width=145><select size=1 name=oid>
      <option selected>Select An Object</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=del>
		  <p align=center><input type=submit value=\"Delete Object\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>