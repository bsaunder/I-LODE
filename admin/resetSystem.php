<?
include("../html_header.inc");
include("html_middle3.inc");
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
$sql = "TRUNCATE TABLE objects";
$results = mysql_query($sql) or die("Could Not Delete Objects.<br>");
$sql = "TRUNCATE TABLE text";
$results = mysql_query($sql) or die("Could Not Delete Slides.<br>");
$sql = "TRUNCATE TABLE questions";
$results = mysql_query($sql) or die("Could Not Delete Questions.<br>");
$sql = "TRUNCATE TABLE answerChoices";
$results = mysql_query($sql) or die("Could Not Delete Answers Choices.<br>");
$sql = "TRUNCATE TABLE alt_text";
$results = mysql_query($sql) or die("Could Not Delete Alternate Slides.<br>");
$sql = "TRUNCATE TABLE alt_questions";
$results = mysql_query($sql) or die("Could Not Delete Alternate Questions.<br>");
$sql = "TRUNCATE TABLE alt_answerChoices";
$results = mysql_query($sql) or die("Could Not Delete Alternate Answers Choices.<br>");
$sql = "TRUNCATE TABLE images";
$results = mysql_query($sql) or die("Could Not Delete Images.<br>");
$sql = "TRUNCATE TABLE announcments";
$results = mysql_query($sql) or die("Could Not Delete Announcments.<br>");
$sql = "TRUNCATE TABLE admins";
$results = mysql_query($sql) or die("Could Not Delete Admins.<br>");
setcookie("ILOAdmin", "no", time() - 14400);
echo "Database Reset...<br>";
echo "Creating New Admin Account...<br>";
$sql = "INSERT INTO admins (fname,lname,email,password,level) VALUES('System','Admin','SysAdmin','ilo2sys1',1)";
$results = mysql_query($sql) or die("Could Not Create Admin Account.<br>");
echo "Admin Account Created...<br>";
echo "<b>System Reset Complete.</b><br><br>";
echo "You may Access the Admin area using the Following Login Information:<br>";
echo "Login: SysAdmin<br>Pass: ilo2sys1<br>";
echo "<br><a href=index.html>Continue</a><br>";

include("../html_footer.inc");
?>