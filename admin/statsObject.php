<?
include("../html_header.inc");
include("html_middle.inc");
include("../conn.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

function calcElapsedTime($u1,$u2)
{
	// calculate elapsed time (in seconds!)
	$diff = $u2-$u1;
	$daysDiff = 0; $hrsDiff = 0; $minsDiff = 0; $secsDiff = 0;
	
	$sec_in_a_day = 60*60*24;
	while($diff >= $sec_in_a_day){$daysDiff++; $diff -= $sec_in_a_day;}
	$sec_in_an_hour = 60*60;
	while($diff >= $sec_in_an_hour){$hrsDiff++; $diff -= $sec_in_an_hour;}
	$sec_in_a_min = 60;
	while($diff >= $sec_in_a_min){$minsDiff++; $diff -= $sec_in_a_min;}
	$secsDiff = $diff;
	
	return "$minsDiff : $secsDiff";
}

switch($func){
	case "show":
		$sql = "SELECT UNIX_TIMESTAMP(s1) AS u1,UNIX_TIMESTAMP(s2) AS u2, user, correct, incorrect, score, attempts FROM scores WHERE objectid = $oid ORDER BY user";
		$results = mysql_query($sql) or die("Couldnt Execute Search Query.");
		if(@mysql_num_rows($results) >= 1)
		{
			$sql2 = "SELECT title FROM objects WHERE id = $oid";
			$results2 = mysql_query($sql2) or die("Couldnt Execute Name Query.");
			$row2 = mysql_fetch_array($results2);
			$title = $row2['title'];
			
			echo "
			<font size=3><b>$title Stats</b></font><br>	
			<table width=467 id=AutoNumber3>
		          <tr>
		            <td width=188><b><font size=2 face=Arial>User</font></b></td>
		            <td width=24 align=center><b><font size=2 face=Arial>R</font></b></td>
		            <td width=25 align=center><b><font size=2 face=Arial>W</font></b></td>
		            <td width=26 align=center><b><font size=2 face=Arial>%</font></b></td>
		            <td width=111 align=center><b><font size=2 face=Arial>M : S</font></b></td>
		            <td width=86 align=center><b><font size=2 face=Arial>
		            Attempts</font></b></td>
		          </tr>
			";
			
			while ($row = mysql_fetch_array($results)) {
				$user = $row['user'];
				$correct = $row['correct'];
				$incorrect = $row['incorrect'];
				$score = $row['score'];
				$stop = $row['u2'];
				$start = $row['u1'];
				$attempts = $row['attempts'];
		
				$time = calcElapsedTime($start,$stop);
				
				$sql2 = "SELECT fname,lname FROM students WHERE email = '$user'";
				$results2 = mysql_query($sql2) or die("Couldnt Execute Name Query.");
				$row2 = mysql_fetch_array($results2);
				$fname = $row2['fname'];
				$lname = $row2['lname'];
				
				if($user != "guest"){
					echo "
					<tr>
			            <td width=188><font size=2 face=Arial>$fname&nbsp;$lname</font></td>
			            <td width=24 align=center><font size=2 face=Arial>$correct</font></td>
			            <td width=25 align=center><font size=2 face=Arial>$incorrect</font></td>
			            <td width=26 align=center><font size=2 face=Arial>$score</font></td>
			            <td width=111 align=center><font size=2 face=Arial>$time</font></td>
			            <td width=86 align=center><font size=2 face=Arial>$attempts</font></td>
			          </tr>
					";	
				}
			}
			
			echo "</table>";
		} else {
			echo "No Results Found.<br>";
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
		<form method=POST action=statsObject.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Object</font></b></td>
		      <td width=145><select size=1 name=oid>
      <option selected>Select An Object</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=show>
		  <p align=center><input type=submit value=\"Get Stats\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>