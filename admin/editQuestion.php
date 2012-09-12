<?
include("../html_header.inc");
include("html_middle.inc");
include("../conn.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

switch($func)
{
	case "upd": // Update Question & Answers
		$sql = "UPDATE questions SET question='$quest', answer='$answer' WHERE id = $qid";
		$results = mysql_query($sql) or die("Could Not Update Question.<br>");
		if($type != "sa"){
			if($A != ""){
				$sql = "UPDATE answerChoices SET text='$A' WHERE questionid = $qid && value='A'";
				$results = mysql_query($sql) or die("Could Not Update Answer A.<br>");	
			}
			
			if($B != ""){
				$sql = "UPDATE answerChoices SET text='$B' WHERE questionid = $qid && value='B'";
				$results = mysql_query($sql) or die("Could Not Update Answer B.<br>");	
			}
			
			if($C != ""){
				$sql = "UPDATE answerChoices SET text='$C' WHERE questionid = $qid && value='C'";
				$results = mysql_query($sql) or die("Could Not Update Answer C.<br>");	
			}
			
			if($D != ""){
				$sql = "UPDATE answerChoices SET text='$D' WHERE questionid = $qid && value='D'";
				$results = mysql_query($sql) or die("Could Not Update Answer D.<br>");	
			}
		}
		echo "<font size=3><b>Question Updated</b></font><br>";
		break;
	case "upda": // Update Question & Answers
		$sql = "UPDATE alt_questions SET question='$quest', answer='$answer' WHERE id = $qid";
		$results = mysql_query($sql) or die("Could Not Update Question.<br>");
		if($type != "sa"){
			if($A != ""){
				$sql = "UPDATE alt_answerChoices SET text='$A' WHERE questionid = $qid && value='A'";
				$results = mysql_query($sql) or die("Could Not Update Answer A.<br>");	
			}
			
			if($B != ""){
				$sql = "UPDATE alt_answerChoices SET text='$B' WHERE questionid = $qid && value='B'";
				$results = mysql_query($sql) or die("Could Not Update Answer B.<br>");	
			}
			
			if($C != ""){
				$sql = "UPDATE alt_answerChoices SET text='$C' WHERE questionid = $qid && value='C'";
				$results = mysql_query($sql) or die("Could Not Update Answer C.<br>");	
			}
			
			if($D != ""){
				$sql = "UPDATE alt_answerChoices SET text='$D' WHERE questionid = $qid && value='D'";
				$results = mysql_query($sql) or die("Could Not Update Answer D.<br>");	
			}
		}
		echo "<font size=3><b>Alternate Question Updated</b></font><br>";
		break;
	case "edit": // Edit Question & Answers
		if($isAlt == 0){
			// Not Alt
			$sql = "SELECT * FROM questions WHERE id = $qid";
			$results = mysql_query($sql) or die("Could Not Find Question.<br>");
			$code = "upd";
		} else {
			// Alt
			$sql = "SELECT * FROM alt_questions WHERE id = $qid";
			$results = mysql_query($sql) or die("Could Not Find Alt Question.<br>");
			$code = "upda";
		}	
		
		if(@mysql_num_rows($results) == 1)
		{
			$row = mysql_fetch_array($results);
			$question = $row['question'];
			$ans = $row['answer'];
			$type = $row['type'];
			
			switch($type){
				case "mc":
				case "tf":
					if($isAlt == 0){
						// Not Alt
						$sql = "SELECT * FROM answerChoices WHERE questionid = $qid ORDER BY value";
						$results = mysql_query($sql);
					} else {
						// Alt
						$sql = "SELECT * FROM alt_answerChoices WHERE questionid = $qid ORDER BY value";
						$results = mysql_query($sql);
					}
					if(@mysql_num_rows($results) >= 1)
					{
						while($row = mysql_fetch_array($results))
						{
							$text = $row['text'];
							$value = $row['value'];
								
							if($ans == $value){
								$radio = "<input type=radio checked value=$value name=answer>";
							} else {
								$radio = "<input type=radio value=$value name=answer>";
							}		
							
							$answers.= "<tr>
				                    <td width=18%>&nbsp;</td>
				                    <td width=82%><b><font size=2>$value
		                            <input type=text name=$value size=32 value=\"$text\"></font></b>$radio</td>
				                  </tr>";
						}
					}
		
					echo "
					<table width=470 align=center border=0>
				        	<tr>
				        		<td>
				        		<form method=post action=editQuestion.php>
				        		<table border=0 cellpadding=0 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100% id=AutoNumber3>
									<tr>
				                    <td width=18% valign=top><b><font size=2>
		                            Question</font></b></td>
				                    <td width=82%><textarea rows=5 name=quest cols=41>$question</textarea></td>
				                  </tr>
				                  $answers
				                  <tr>
				                    <td width=18%>&nbsp;</td>
				                    <td width=82%>&nbsp;</td>
				                  </tr>
				                  <tr>
				                    <td width=18%>&nbsp;</td>
				                    <td width=82%><br>
									<input type=hidden name=qid value=$qid>
									<input type=hidden name=func value=$code>
									<input type=hidden name=type value=$type>
				                    <input type=submit value=\"Save Question\" name=B1></td>
				                  </tr>
				                </table>
				        		</form>
				        		</td>
				        	</tr>
				        </table>
					";
					break;
				case "sa":
					echo "
						<table width=470 align=center border=0>
					        	<tr>
					        		<td>
					        		<form method=post action=editQuestion.php>
					        		<table border=0 cellpadding=0 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100% id=AutoNumber3>
										<tr>
					                    <td width=18% valign=top><b><font size=2>
			                            Question</font></b></td>
					                    <td width=82%><textarea rows=5 name=quest cols=41>$question</textarea></td>
					                  </tr>
					                  <tr id=asa>
		                    			<td width=18%>&nbsp;</td>
		                    			<td width=82%><b><font size=2>Answer
                            			<input type=text name=answer size=32 value=$ans></font></b></td>
		                  			  </tr>
					                  <tr>
					                    <td width=18%>&nbsp;</td>
					                    <td width=82%>&nbsp;</td>
					                  </tr>
					                  <tr>
					                    <td width=18%>&nbsp;</td>
					                    <td width=82%><br>
										<input type=hidden name=qid value=$qid>
										<input type=hidden name=func value=$code>
										<input type=hidden name=type value=$type>
					                    <input type=submit value=\"Save Question\" name=B1></td>
					                  </tr>
					                </table>
					        		</form>
					        		</td>
					        	</tr>
					        </table>
					";
					break;
				default:
					echo "Invalid Question Type Found. Can Not Edit.<br>";
					break;	
			}
		} else {
			echo "Multiple Question ID's Found, Contact System Admin.<br>";
			include("../html_footer.inc");
			exit();
		}
		
		
		break;
	case "quest": // Choose Question
		if($isAlt == 0){
			// Not Alt
			$sql = "SELECT id,question,slideid FROM questions WHERE objectid = $oid ORDER BY slideid";
			$results = mysql_query($sql) or die("Could Not Find Any Questions.<br>");
		} else {
			// Alt
			$sql = "SELECT id,question,slideid FROM alt_questions WHERE objectid = $oid ORDER BY slideid";
			$results = mysql_query($sql) or die("Could Not Find Any Questions.<br>");
		}
			
		if(@mysql_num_rows($results) >= 1)
		{		
			while ($row = mysql_fetch_array($results)) {
				$id = $row['id'];
				$sid = $row['slideid'];
				$text = $row['question'];
				
				if(strlen($text) >= 21){
					$text = substr($text,0,20);
					$text = $text . "..."; // Causes a Problem
				}
				
				$rows .= "<option value=$id>$sid. $text</option>";
			}
		}
		
		echo "
			<table border=0 width=80% align=center>	
			<form method=POST action=editQuestion.php>
			  <tr>
			      <td width=105><b><font face=Arial size=2>Select Question</font></b></td>
			      <td width=145><select size=1 name=qid>
	      <option selected>Select A Question</option>
	      $rows
	      </select></td>
			    </tr>
			  </table>
			<input type=hidden name=func value=edit>
			<input type=hidden name=isAlt value=$isAlt>
			  <p align=center><input type=submit value=\"Select Question\" name=B1></p>
			</form>
		";
		break;
	default: // Choose Object
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
			<form method=POST action=editQuestion.php>
			  <tr>
			      <td width=105><b><font face=Arial size=2>Select Object</font></b></td>
			      <td width=145><select size=1 name=oid>
	      <option selected>Select An Object</option>
	      $rows
	      </select></td>
			    </tr><tr><td width=105><b><font face=Arial size=2>Alternate</font></b></td>
		      <td width=145>
			  <font face=Arial size=2>
  			<input type=radio value=0 name=isAlt checked>No&nbsp;&nbsp;&nbsp;&nbsp;
  			<input type=radio value=1 name=isAlt>Yes</font>
				</td></tr>
			  </table>
			<input type=hidden name=func value=quest>
			  <p align=center><input type=submit value=\"Select Object\" name=B1></p>
			</form>
		";
		break;
}

include("../html_footer.inc");
?>