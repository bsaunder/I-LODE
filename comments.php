
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Instructors Comments</title>
</head>

<body link="#333399" vlink="#333399" alink="#333399" bgcolor="#666666">

<div align="center">
  <center>
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="235" id="AutoNumber1">
	<tr bgcolor="#FFFFFF">
	<td>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="95%" id="AutoNumber1">
    <tr bgcolor="#FFFFFF">
      <td width="100%"><b><font size="2" face="Arial">Instructors Comments</font></b><hr color="#000000">
<?
include("conn.inc");
$sql = "SELECT * FROM objects WHERE id = $oid";
$results = mysql_query($sql);
if(@mysql_num_rows($results) == 1)
{
	$row = mysql_fetch_array($results);
	$comments = $row['comments'];
	$assignments = $row['assignments'];
	echo "<p><font size=\"2\" face=\"Arial\">
      $comments
      </font></p>
	  <p><font size=\"2\" face=\"Arial\">
      $assignments
      </font></p>";
} else {
	echo "<p><font size=\"2\" face=\"Arial\">Error Retrieving Data.</font></p>";
}

?>
      </td>
    </tr>
  </table>

	</td>
	</tr>
  </table>
  </center>
</div>

</body>

</html>
