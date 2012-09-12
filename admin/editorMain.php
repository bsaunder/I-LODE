<?
if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

$sql = "SELECT * FROM images ORDER BY name";
$results = mysql_query($sql) or die("Could Not Find Any Images.<br>");
if(@mysql_num_rows($results) >= 1)
{		
	while ($row = mysql_fetch_array($results)) {
		$id = $row['id'];
		$name = $row['name'];
		$filename = $row['filename'];
		$description = $row['description'];
		
		$images .= "<option value=\"images/$filename\">$name</option>";
		
	}
}

echo "
<style>
  .butClass
  {    
    border: 1px solid;
    border-color: #000000;
    background-color: #D6D3CE;
  }
  .form_elem
  {
  	background-color: #D6D3CE;
  	border: 1px solid;
    border-color: #000000;
  	color: #000000; 
  	font-family: Arial; 
  	font-size: 9pt; 
  }
</style>
<p style=margin-top: 0; margin-bottom: 0>
<img alt=Bold class=butClass src=images/bold.gif onClick=doFormat('b') onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
<img alt=Italic class=butClass src=images/italic.gif onClick=doFormat('i') onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
<img alt=Underline class=butClass src=images/underline.gif onClick=doFormat('u') onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>&nbsp;&nbsp;
<img alt=Left class=butClass src=images/left.gif onClick=doAlign('left') onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
<img alt=Center class=butClass src=images/center.gif onClick=doAlign('center') onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
<img alt=Right class=butClass src=images/right.gif onClick=doAlign('right') onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
<img alt=Justify class=butClass src=images/justify.gif onClick=doAlign('justify') onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
&nbsp;&nbsp<img alt=\"Background Color\" class=butClass src=images/bgcol.gif onClick=doBackground() onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
<img alt=\"Foreground Color\" class=butClass src=images/forecol.gif onClick=doForeground() onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
&nbsp;&nbsp<img alt=\"Horizontal Rule\" class=butClass src=images/rule.gif onClick=doRule() onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
<img alt=Link class=butClass src=images/link.gif onClick=doLink() onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>
<br>
<select size=1 name=mainImg class=form_elem>
<option selected>Choose Image</option>
$images
</select>
<img alt=Image class=butClass src=images/image.gif onClick=doImage() onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>&nbsp;&nbsp;
<select size=1 name=fontSize class=form_elem>
<option selected value=3>Font Size</option>
<option value=1>8 pt</option>
<option value=2>10 pt</option>
<option value=3>12 pt</option>
<option value=4>14 pt</option>
<option value=5>16 pt</option>
<option value=6>18 pt</option>
</select>
<img alt=\"Font Size\" class=butClass src=images/fontsize.gif onClick=doFontSize() onMouseOver=selOn(this) onMouseOut=selOff(this) onMouseDown=selDown(this) onMouseUp=selUp(this) width=23 height=22>&nbsp;&nbsp;
<br>
<font size=1 face=Arial>* HTML Supported</font>
</p>
";


?>