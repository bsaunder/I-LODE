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
	case "del":
		$sql = "SELECT filename FROM images WHERE id = $id";
		$results = mysql_query($sql) or die("Could Not Get Filename for Deletion.<br>");
		if(@mysql_num_rows($results) == 1)
		{		
			$row = mysql_fetch_array($results);
			$filename = $row['filename'];
		}
		if(!unlink("../images/$filename")){// Delete the File
			echo "Could Not Delete Image File.<br>";
			break;
		}
		$sql = "DELETE FROM images WHERE id = $id";
		$results = mysql_query($sql) or die("Could Not Delete Image from Database.<br>");
		echo "<font size=3><b>Image Deleted</b></font><br><br>";
		break;
	default:
		$sql = "SELECT id,name FROM images ORDER BY name";
		$results = mysql_query($sql) or die("Could Not Find Any Images.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$id = $row['id'];
				$name = $row['name'];
				
				$rows .= "<option value=$id>$name</option>";
			}
		}
		
		echo "
		<table border=0 width=80% align=center>		
		<form method=POST action=delImage.php>
		  <tr>
		      <td width=105><b><font face=Arial size=2>Select Image</font></b></td>
		      <td width=145><select size=1 name=id>
      <option selected>Select An Image</option>
      $rows
      </select></td>
		    </tr>
		  </table>
		<input type=hidden name=func value=del>
		  <p align=center><input type=submit value=\"Delete Image\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>