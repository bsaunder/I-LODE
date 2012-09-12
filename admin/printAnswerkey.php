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
	case "show":		
		$sql = "SELECT * FROM questions WHERE objectid = $oid ORDER BY slideid";
		$results = mysql_query($sql) or die("Could Not Find Any Questions.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$slide = $row['slideid'];
				$answer = $row['answer'];
				$question = $row['question'];
		
				if(strlen($question) >= 47){
					$question = substr($question,0,45);
					$question = $question . "...";
				}
				
				$rows .= "
					<tr>
		           	<td width=15%><font face=arial size=2>&nbsp;$slide</font></td>
		          	<td width=15%><font face=arial size=2>&nbsp;$answer</font></td>
		           	<td width=70%><font face=arial size=2>&nbsp;$question</font></td>
		        	</tr>
				";
				
				$sql2 = "SELECT * FROM alt_questions WHERE objectid = $oid && slideid = $slide";
				$results2 = mysql_query($sql2) or die("Could Not Find Any Alt Questions.<br>");
				if(@mysql_num_rows($results2) == 1)
				{
					$row2 = mysql_fetch_array($results2);
					$answer = $row2['answer'];
					$question = $row2['question'];
		
					if(strlen($question) >= 51){
						$question = substr($question,0,50);
						$question = $question . "...";
					}
				
					$rows .= "
						<tr>
		           		<td width=15%><font face=arial size=2>&nbsp;$slide ALT</font></td>
		          		<td width=15%><font face=arial size=2>&nbsp;$answer</font></td>
		           		<td width=70%><font face=arial size=2>&nbsp;$question</font></td>
		        		</tr>
					";
				}
			}
		}
		
		$sql2 = "SELECT title FROM objects WHERE id = '$oid'";
		$results2 = mysql_query($sql2) or die("Couldnt Execute Name Query.");
		$row2 = mysql_fetch_array($results2);
		$title = $row2['title'];
				
		echo "
			<font size=3><b>$title Answer Key</b></font><br><br>
			<table border=1 cellpadding=0 cellspacing=0 style=\"border-collapse: collapse\" bordercolor=#000000 width=100% id=AutoNumber3>
		          <tr>
		            <td width=15%><font face=arial size=2><b>Slide<b></font></td>
		            <td width=15%><font face=arial size=2><b>Answer<b></font></td>
		            <td width=70%><font face=arial size=2><b>Question<b></font></td>
		          </tr>
				$rows
		        </table>
		";
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
		<form method=POST action=printAnswerkey.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Object</font></b></td>
		      <td width=145><select size=1 name=oid>
      <option selected>Select An Object</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=show>
		  <p align=center><input type=submit value=\"Get Answer Key\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>