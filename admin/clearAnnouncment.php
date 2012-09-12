<?
include("../html_header.inc");
include("html_middle.inc");
include("../conn.inc");
if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}


$sql = "TRUNCATE TABLE announcments";
$results = mysql_query($sql) or die("Could Not Delete Announcments.<br>");
echo "<font size=3><b>Announcments Cleared</b></font><br><br>";
echo "<script type=\"text/javascript\">AskToUpdate();</script>";

include("../html_footer.inc");
?>