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
		$sql = "UPDATE text SET text='$newtext' WHERE id = $sid";
		$results = mysql_query($sql) or die("Could Not Update Slide.<br>");
		echo "<font size=3><b>Slide $sid Updated</b></font><br><br>";
		echo "<b>Text:</b><br> $newtext<br>";
		break;
	case "upda":
		$sql = "UPDATE alt_text SET text='$newtext' WHERE id = $sid";
		$results = mysql_query($sql) or die("Could Not Update Alt Slide.<br>");
		echo "<font size=3><b>Alternate Slide $sid Updated</b></font><br><br>";
		echo "<b>Text:</b><br> $newtext<br>";
		break;
	case "form":
		if($isAlt == 0){
			// Not an Alternate Slide
			$sql = "SELECT * FROM text WHERE objectid = $oid && slide = $slidenum";
			$results = mysql_query($sql) or die("Could Not Select Slide Info.<br>");
			$code = "upd";
		} else {
			// Alternate Slide
			$sql = "SELECT * FROM alt_text WHERE objectid = $oid && slide = $slidenum";
			$results = mysql_query($sql) or die("Could Not Select Alt Slide Info.<br>");
			$code = "upda";
		}
		if(@mysql_num_rows($results) == 1)
		{		
			$row = mysql_fetch_array($results);
			$osid = $row['id'];
			$text = $row['text'];
			
			echo "
				<table width=470 align=center border=0>
		        	<tr>
		        		<td>
						<script src=\"SlideEditor.js\" type=\"text\javascript\"></script>
		        		<form method=post action=editSlide.php name=slide>
		        		<table border=0 cellpadding=0 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100% id=AutoNumber3>
		                  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>";
			include("editorMain.php");
			echo "</td>
		                  </tr>
						  <tr>
		                    <td width=18% valign=top><b><font size=2>Slide Text</font></b></td>
		                    <td width=82%><textarea rows=14 name=newtext cols=41>$text</textarea></td>
		                  </tr>
		                  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><br>
							<input type=hidden name=sid value=$osid>
							<input type=hidden name=func value=$code>
		                    <input type=submit value=\"Update Object\" name=B1></td>
		                  </tr>
		                </table>
		        		</form>
		        		</td>
		        	</tr>
		        </table>
	
			";
		} else {
			echo "Invalid Slide Number.<br>";
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
			<form method=POST action=editSlide.php>
			  <tr>
			      <td width=105><b><font face=Arial size=2>Select Object</font></b></td>
			      <td width=145><select size=1 name=oid>
	      <option selected>Select An Object</option>
	      $rows
	      </select></td>
			    </tr>
				<tr>
					<td width=105><b><font face=Arial size=2>Slide Number</font></b></td>
			      <td width=145><input type=text name=slidenum size=20></td></tr>
		 <td width=105><b><font face=Arial size=2>Alternate</font></b></td>
		      <td width=145>
			  <font face=Arial size=2>
  			<input type=radio value=0 name=isAlt checked>No&nbsp;&nbsp;&nbsp;&nbsp;
  			<input type=radio value=1 name=isAlt>Yes</font>
				</td>
			  </table>
			<input type=hidden name=func value=form>
			  <p align=center><input type=submit value=\"Edit Slide\" name=B1></p>
			</form>
		";
		break;
}

include("../html_footer.inc");
?>