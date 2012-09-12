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
		$sql = "UPDATE announcments SET text='$text' WHERE id = $id";
		$results = mysql_query($sql) or die("Could Not Update Announcment.<br>");
		echo "<font size=3><b>Announcment Updated</b></font><br><br>";
		echo "<b>Updated Text:</b> $text<br>";
		echo "<script type=\"text/javascript\">AskToUpdate();</script>";
		break;
	case "form":
		$sql = "SELECT id,date,text FROM announcments ORDER BY date";
		$results = mysql_query($sql) or die("Could Not Select Announcment Info.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			$row = mysql_fetch_array($results);
			$date = $row['date'];
			$text = $row['text'];
			$id = $row['id'];
			
			echo "
				<table border=0 width=80% align=center>		
				<form method=POST action=editAnnouncment.php>
				  <tr>
				      <td width=105><b><font face=Arial size=2>Date</font></b></td>
				      <td width=145><input type=text name=date size=20 readonly=readonly value=\"$date\"></td>
				    </tr>
				    <tr>
				      <td width=105><b><font face=Arial size=2>Text</font></b></td>
				      <td width=145><textarea rows=5 name=text cols=41>$text</textarea></td>
				    </tr>
				  </table>
				<input type=hidden name=func value=add>
				<input type=hidden name=func value=upd>
				<input type=hidden name=id value=$id>
				  <p align=center><input type=submit value=\"Edit Announcment\" name=B1></p>
				</form>
			";
		} else {
			echo "Invalid Announcment.<br>";
		}		
		break;
	default:
		$sql = "SELECT id,date,text FROM announcments ORDER BY date";
		$results = mysql_query($sql) or die("Could Not Find Any Announcments.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$date = $row['date'];
				$text = $row['text'];
				$id = $row['id'];
				
				if(strlen($text) >= 21){
					$text = substr($text,0,20);
					$text = $text . "...";
				}
				
				$rows .= "<option value=$id>$date - $text</option>";
			}
		}
		
		echo "
		<table border=0 width=80% align=center>		
		<form method=POST action=editAnnouncment.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Announcment</font></b></td>
		      <td width=145><select size=1 name=annc>
      <option selected>Select An Announcment</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=form>
		  <p align=center><input type=submit value=\"Edit Announcment\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>