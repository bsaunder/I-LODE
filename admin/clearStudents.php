<?
include("../html_header.inc");
include("html_middle.inc");
include("../conn.inc");
if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}


$sql = "TRUNCATE TABLE students";
$results = mysql_query($sql) or die("Could Not Delete Students.<br>");
$sql = "TRUNCATE TABLE scores";
$results = mysql_query($sql) or die("Could Not Delete Scores.<br>");
$sql = "TRUNCATE TABLE extraAttempts";
$results = mysql_query($sql) or die("Could Not Delete Extra Attempts.<br>");
$sql = "TRUNCATE TABLE userAnswers";
$results = mysql_query($sql) or die("Could Not Delete Student Answers.<br>");
echo "<font size=3><b>Student Records Cleared</b></font><br><br>";

include("../html_footer.inc");
?>