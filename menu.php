<?
include("html_header.inc");
include("html_middle.inc");

include("conn.inc");

$ILOUserAuth = $HTTP_COOKIE_VARS["ILOUserAuth"]; 
$user = $HTTP_COOKIE_VARS["user"];

if($ILOUserAuth != "yes"){
	echo "$ILOUserAuth - $user - You Are Not Authorized To Enter This Area!<br>";
	include("html_footer.inc");
	exit();
}

// Check if Ticker is to be Included
$sql = "SELECT ticker FROM settings WHERE class = 'all'";
$results = mysql_query($sql) or die("Could Not Find Ticker in Class 'ALL'.");
if(@mysql_num_rows($results) == 1){
	$row = mysql_fetch_array($results);
	$ticker = $row['ticker'];
	if($ticker == 0){
		// Ticker is Enabled
		echo "<b>Latest Announcments</b><br>";
		echo "<script src=\"admin/rss/AnncTicker.js\" type=\"text/javascript\"></script>";
	}
} else {
	echo "Ticker Setting Not Found<br>";
}

$sql = "SELECT * FROM objects";
$results = mysql_query($sql) or die("Could Not Find Objects.");
if(@mysql_num_rows($results) >= 1)
{
	echo "Choose a Section below to get Started<br><ul>";
	
	while ($row = mysql_fetch_array($results)) {
		$id = $row['id'];
		$title = $row['title'];
		$info = $row['info'];
		$logging = $row['logging'];
		$enabled = $row['enabled'];
		
		if($enabled == 0){
			if($logging == 0){
				$logNote = "<font color=#00FF00>**</font>";
			} else {
				$logNote = "";
			}
			
			echo "<li><b><a href=javascript:popUp('popup.php?oid=$id')>$title</a></b>
				<font size=1 face=arial> $logNote<ul><li>$info</li></ul></li></font>";
		}else{
			echo "<font color=\"#AAAAAA\"><li><b>$title</b>
				<font size=1><ul><li>$info</li></ul></li></font></font>";
		}
		
	}
	echo "</ul> <font color=#00FF00>**</font> <font size=1>Means These Answers will be Recorded.";
	echo "<br><br><a href=newPassword.php>Change Password</a>.</font><br>";
} else {
	echo "No Learning Objects Currently In System<br>Please Try Again Later.<br>";
}

include("html_footer.inc");
?>