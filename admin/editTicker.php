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
		$sql = "UPDATE settings SET ticker = $R1 WHERE class = 'all'";
		$results = mysql_query($sql) or die("Couldnt Set Ticker Status.");
		echo "<font size=3><b>Ticker Status Set.</b></font><br><br>";
		if($R1 == 0){
			echo "Ticker Was Enabled<br><br>";
		} else {
			echo "Ticker Was Disabled<br><br>";
		}
		break;
	default:
		echo "
		<table border=0 width=80% align=center>	
		<form method=POST action=editTicker.php>
		<tr>
		      <td width=105><b><font face=Arial size=2>Select Status</font></b></td>
		      <td width=145>
			  
  <input type=radio value=0 name=R1>Enable&nbsp;&nbsp;&nbsp;&nbsp;
  <input type=radio value=1 name=R1>Disable
				</td>
		    </tr>
		  </table>
		<input type=hidden name=func value=set>
		  <p align=center><input type=submit value=\"Set Ticker Status\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>