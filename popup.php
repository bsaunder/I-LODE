<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<?
include("conn.inc");
$sql = "SELECT * FROM objects WHERE id = $oid";
$results = mysql_query($sql);
if(@mysql_num_rows($results) == 1)
{
	$row = mysql_fetch_array($results);
	$id = $row['id'];
	$title = $row['title'];
	echo "<title>$title</title>";
}else{
	echo "<title>Not Found</title>";
}
?>
</head>

<frameset cols="250,510">
  <frame name="contents" src="comments.php?oid=<? echo "$oid"; ?>" scrolling="auto">
  <frame name="main" src="display.php?oid=<? echo "$oid"; ?>" scrolling="auto">
  <noframes>
  <body>

  <p>Sorry for the Inconvenience but your browser does not support frames.</p>

  </body>
  </noframes>
</frameset>

</html>