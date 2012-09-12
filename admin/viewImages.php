<?
include("../html_header.inc");
include("html_middle.inc");
include("../conn.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

echo "<font size=3><b>Image Previews</b></font><br><br>";
echo "<center>";
$sql = "SELECT * FROM images ORDER BY name";
$results = mysql_query($sql) or die("Could Not Find Any Images.<br>");
if(@mysql_num_rows($results) >= 1)
{		
	while ($row = mysql_fetch_array($results)) {
		$id = $row['id'];
		$name = $row['name'];
		$filename = $row['filename'];
		$description = $row['description'];
		
		echo "<b>$name</b><br>";
		echo "<font size=1>$description</font><br>";
		echo "<img src=../images/$filename border=0><br><br><br>";
		
	}
}
echo "</center>";

include("../html_footer.inc");
?>