<?
include("../html_header.inc");
include("html_middle.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

switch($func){
	case "add":
		// Process File
		if($userFile == "none"){
			echo "<font size=3><b>Image Not Uploaded</b></font><br><br>";
			break;	
		}
		if($userFile_size == 0){
			echo "<font size=3>Image Size is Zero (Invalid Size)</font><br><br>";
			break;	
		}
		if(!is_uploaded_file($userFile)){
			echo "<font size=3>WARNING! Possible Upload Attack</font><br><br>";
			break;	
		}
		$copyPath = "../images/".$userFile_name;
		if(!copy($userFile,$copyPath)){
			echo "<font size=3>Can Not Copy File</font><br><br>";
			break;	
		}
	
		// Add File to Database
		include("../conn.inc");
		$sql = "INSERT INTO images (name,filename,description,class) VALUES('$name','$userFile_name','$desc','all')";
		$results = mysql_query($sql) or die("Could Not Add Image to Database.<br>");
		echo "<font size=3><b>Image Uploaded</b></font><br><br>";
		echo "<b>Preview:</b><br><center><img src=\"../images/$userFile_name\"></center><br>";
		break;
	default:
		// Display Form
		echo "
		<table border=0 width=80% align=center>		
		<form method=POST action=addImage.php enctype=\"multipart/form-data\">
		  <tr>
		      <td width=105><b><font face=Arial size=2>Name</font></b></td>
		      <td width=145><input type=text name=name size=20></td>
		    </tr>
		    <tr>
		      <td width=105><b><font face=Arial size=2>Description</font></b></td>
		      <td width=145><input type=text name=desc size=40></td>
		    </tr>
		    <tr>
		      <td width=105><b><font size=2 face=Arial>File</font></b></td>
		      <td width=145><input type=file name=userFile size=20></td>
		    </tr>
		  </table>
		<input type=hidden name=MAX_FILE_SIZE value=10000>
		<input type=hidden name=func value=add>
		  <p align=center><input type=submit value=\"Upload Image\" name=B1></p>
		</form>
		";
		break;
}

include("../html_footer.inc");
?>