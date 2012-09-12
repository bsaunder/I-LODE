<?
include("../html_header.inc");
include("html_middle.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

switch($func){
	case "add":
		include("../conn.inc");
		// Add User
		$sql = "INSERT INTO announcments (date,text) VALUES('$date','$text')";
		$results = mysql_query($sql) or die("Could Not Add Announcment.<br>");
		echo "<font size=3><b>Announcment Added</b></font><br><br>";
		echo "<b>Added Text:</b> $text<br>";
		echo "<script type=\"text/javascript\">AskToUpdate();</script>";
		
		break;
	default:
		// Display Form
		$date = date("M j, y");
		echo "
		<table border=0 width=80% align=center>		
		<form method=POST action=addAnnouncment.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Date</font></b></td>
		      <td width=145><input type=text name=date size=20 readonly=readonly value=\"$date\"></td>
		    </tr>
		    <tr>
		      <td width=105><b><font face=Arial size=2>Text</font></b></td>
		      <td width=145><textarea rows=5 name=text cols=41></textarea></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=add>
		  <p align=center><input type=submit value=\"Add Announcment\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>