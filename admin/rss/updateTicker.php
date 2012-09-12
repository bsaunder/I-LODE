<?
include("../../html_header.inc");
include("html_middle.inc");
include("../../conn.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

$sql = "SELECT id,date,text FROM announcments ORDER BY date";
$results = mysql_query($sql) or die("Could Not Find Any Announcments (Main).<br>");
if(@mysql_num_rows($results) >= 1)
{	
	// Set jsCode to Ticker Content
	$sql = "SELECT id,date,text FROM announcments ORDER BY id DESC";
	$results = mysql_query($sql) or die("Could Not Find Any Announcments (Build).<br>");
	$jsCode = "&nbsp;&nbsp;&nbsp;";
	while ($row = mysql_fetch_array($results)) {
		$date = $row['date'];
		$text = $row['text'];
		$jsCode .= "$text <font size=1>($date)</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
} else {
	echo "No Announcments Found for Ticker<br>";
	$jsCode = "";
}

include("JScriptConfig.php");
echo "Creating JS File...<br>";
$jsFile = fopen("AnncTicker.js",'w');
if(!$jsFile){
	echo "<b>ERROR:</b> Could Not Create JS File.";
	exit;
} 
echo "File Ready...<br>Writting Data...<br>";

$jsCode = "var marqueecontent=\"<nobr><font size=2 face=arial>" . $jsCode;
$jsCode = str_replace("'","\'",$jsCode);
$jsCode = str_replace("\n"," ",$jsCode);
$jsCode .=  "No More Announcments</font></nobr>\";";
fputs($jsFile,$jsCode);
fputs($jsFile,$jsBot);
echo "Finished Writting Data.<br>";
fclose($jsFile);
echo "AnncTicker.js Created Successfully.<br>";
echo "<br><b>To Use:</b><br>Enable From Admin Menu";


include("../../html_footer.inc");
?>