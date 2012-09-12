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
		$sql = "UPDATE objects SET logging = $R1";
		$results = mysql_query($sql) or die("Couldnt Set Global Logging.");
		echo "<font size=3><b>Logging Set.</b></font><br><br>";
		if($R1 == 0){
			echo "Global Logging Was Enabled<br><br>";
		} else {
			echo "Global Logging Was Disabled<br><br>";
		}
		break;
	default:
		echo "
		<table border=0 width=80% align=center>	
		<form method=POST action=editLoggingGlobal.php>
		<tr>
		      <td width=105><b><font face=Arial size=2>Select Global Logging</font></b></td>
		      <td width=145>
			  
  <input type=radio value=0 name=R1>Enable&nbsp;&nbsp;&nbsp;&nbsp;
  <input type=radio value=1 name=R1>Disable
				</td>
		    </tr>
		  </table>
		<input type=hidden name=func value=set>
		  <p align=center><input type=submit value=\"Set Global Logging\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>