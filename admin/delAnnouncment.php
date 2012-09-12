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
		$sql = "DELETE FROM announcments WHERE id = $annc";
		$results = mysql_query($sql) or die("Could Not Delete Announcment.<br>");
		echo "<font size=3><b>Announcment Deleted.</b></font><br><br>";
		echo "<script type=\"text/javascript\">AskToUpdate();</script>";
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
		<form method=POST action=delAnnouncment.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Announcment</font></b></td>
		      <td width=145><select size=1 name=annc>
      <option selected>Select An Announcment</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=del>
		  <p align=center><input type=submit value=\"Delete Announcment\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>