<?
// Connection Variables
$password = 'abc123';
$username = 'ilo2';
$mySQLdatabase = 'ilo2ga';

// Connect to Database
$MyConn = mysql_connect('localhost', $username, $password) or die("Invalid server or user");
mysql_select_db("$mySQLdatabase",$MyConn);
?>