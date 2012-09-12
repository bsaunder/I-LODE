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
	case "upd":
		$sql = "UPDATE objects SET title='$title',author='$author',info='$info',metadata='$meta' WHERE id = $id";
		$results = mysql_query($sql) or die("Could Not Update Object.<br>");
		echo "<font size=3><b>Object $id Updated</b></font><br><br>";
		echo "<b>Title:</b> $title<br>";
		echo "<b>Info:</b> $info<br>";
		echo "<b>Author:</b> $author<br>";
		break;
	case "form":
		$sql = "SELECT * FROM objects WHERE id = $oid";
		$results = mysql_query($sql) or die("Could Not Select Object Info.<br>");
		if(@mysql_num_rows($results) == 1)
		{		
			$row = mysql_fetch_array($results);
			$id = $row['id'];
			$title = $row['title'];
			$info = $row['info'];
			$author = $row['author'];
			$meta = $row['metadata'];
			
			echo "
				<table width=470 align=center border=0>
		        	<tr>
		        		<td>
		        		<form method=post action=editObject.php>
		        		<table border=0 cellpadding=0 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100% id=AutoNumber3>
		                  <tr>
		                    <td width=18%><b><font size=2>Title</font></b></td>
		                    <td width=82%><input type=text name=title size=49 value=$title></td>
		                  </tr>
		                  <tr>
		                    <td width=18%><b><font size=2>Info</font></b></td>
		                    <td width=82%>
		        <font size=2 face=arial>
		                    <input type=text name=info size=49 value=$info></font></td>
		                  </tr>
		                  <tr>
		                    <td width=18%><b><font size=2>Author</font></b></td>
		                    <td width=82%>
		        <font size=2 face=arial>
		                    <input type=text name=author size=49 value=$author></font></td>
		                  </tr>
		                  <tr>
		                    <td width=18% valign=top><b><font size=2>Metadata</font></b></td>
		                    <td width=82%><textarea rows=14 name=meta cols=41>$meta</textarea></td>
		                  </tr>
		                  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><br>
							<input type=hidden name=id value=$id>
							<input type=hidden name=func value=upd>
		                    <input type=submit value=\"Update Object\" name=B1></td>
		                  </tr>
		                </table>
		        		</form>
		        		</td>
		        	</tr>
		        </table>
	
			";
		} else {
			echo "No Previous Data Found.<br>";
		}		
		break;
	default:
		$sql = "SELECT id,title FROM objects ORDER BY title";
		$results = mysql_query($sql) or die("Could Not Find Any Objects.<br>");
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$id = $row['id'];
				$title = $row['title'];
				
				$rows .= "<option value=$id>$title</option>";
			}
		}
		
		echo "
			<table border=0 width=80% align=center>	
			<form method=POST action=editObject.php>
			  <tr>
			      <td width=105><b><font face=Arial size=2>Select Object</font></b></td>
			      <td width=145><select size=1 name=oid>
	      <option selected>Select An Object</option>
	      $rows
	      </select></td>
			    </tr>
			  </table>
			<input type=hidden name=func value=form>
			  <p align=center><input type=submit value=\"Edit Object\" name=B1></p>
			</form>
		";
		break;
}

include("../html_footer.inc");
?>