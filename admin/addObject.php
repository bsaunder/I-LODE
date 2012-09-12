<?
include("../html_header.inc");
include("html_middle2.inc");
include("../conn.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}

switch($func)
{
	case "addo":
		//$comms = str_replace("\n","<br>",$comms);
		//$assigns = str_replace("\n","<br>",$assigns);
		$sql = "INSERT INTO objects (title,info,author,slides,metadata,logging,comments,assignments) VALUES('$title','$info','$author','$slides','$meta',0,'$comms','$assigns')";
		$results = mysql_query($sql) or die("Could Not Create Object Base.<br>");
		$thisid = mysql_insert_id();
		echo "Starting Object #$thisid with $slides slides<br><br>";
		echo "<b>$title</b><br>$info<br><br>";
		echo "<form method=post action=addObject.php>";
		echo "<input type=hidden name=func value=crsli>";
		echo "<input type=hidden name=endslide value=$slides>";
		echo "<input type=hidden name=curslide value=1>";
		echo "<input type=hidden name=oid value=$thisid>";
		echo "<input type=submit name=B1 value=\"Setup Slides\">";
		echo "</form>";
		break;
	case "crsli":
		echo "<b>Setup Slide $curslide</b><br><br>";
		echo "
				<table width=470 align=center border=0>
		        	<tr>
		        		<td>
						
						<script src=\"SlideEditor.js\" type=\"text\javascript\"></script>
		        		<form method=post action=addObject.php name=slide>
						<table border=0 cellpadding=0 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100% id=AutoNumber3>
		                  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b>Main Slide & Question</b><br>
							<font size=1 face=arial color=red><b>NOTE:</b> Any Field Left Blank Will Not Be Created</font>
		        			</td>
		                  </tr>
						  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>&nbsp;</td>
		                  </tr>
						  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>";
							include("editorMain.php");
						  echo "</td>
		                  </tr><tr>
		                    <td width=18% valign=top><b><font size=2>Slide Text</font></b></td>
		                    <td width=82%><textarea rows=14 name=newtext cols=41 onSelect=\"storeCaret(this);\" onClick=\"storeCaret(this);\" onKeyup=\"storeCaret(this);\"></textarea></td>
		                  </tr>
		                  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>&nbsp;</td>
		                  </tr>
		                  <tr>
		                    <td width=18% valign=top><b><font size=2>
                            Question</font></b></td>
		                    <td width=82%><textarea rows=5 name=quest cols=41></textarea></td>
		                  </tr>
						  <tr>
		                    <td width=18% valign=top><b><font size=2>
                            Question Type</font></b></td>
		                    <td width=82%><select size=1 name=qType onClick=setQType()>
  								<option value=sa>Short Answer</option>
    							<option value=mc selected>Multiple Choice</option>
    							<option value=tf>True/False</option>
    							</select></td>
		                  </tr>
					
						  <tr id=sa>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>Answer
                            <input type=text name=sa_answer size=32></font></b></td>
		                  </tr>
		
						 <tr id=tf>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><font size=2>Answer</font><select size=1 name=tf_answer>
  								<option value=T selected>True</option>
    							<option value=F>False</option>
    							</select></td>
		                  </tr>
					
		                  <tr id=mc>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>A
                            <input type=text name=A size=32></font></b><input type=radio value=A name=answer></td>
		                  </tr>
		                  <tr id=mc2>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>B
                            <input type=text name=B size=32></font></b><input type=radio value=B name=answer></td>
		                  </tr>
					
		                  <tr id=mc3>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>C
                            <input type=text name=C size=32></font></b><input type=radio value=C name=answer></td>
		                  </tr>
		                  <tr id=mc4>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>D
                            <input type=text name=D size=32></font></b><input type=radio value=D name=answer></td>
		                  </tr>
					
						  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>&nbsp;</td>
		                  </tr>
						  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b>Alternate Slide & Question</b><br>
							<font size=1 face=arial color=red><b>NOTE:</b> Any Field Left Blank Will Not Be Created</font>
		        			</td>
		                  </tr>
						  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>&nbsp;</td>
		                  </tr>
						  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>"; 
						  include("editorAlt.php");
						  echo"</td>
		                  </tr>
						  <tr>
		                    <td width=18% valign=top><b><font size=2>Slide Text</font></b></td>
		                    <td width=82%><textarea rows=14 name=a_newtext cols=41 onSelect=\"storeCaret(this);\" onClick=\"storeCaret(this);\" onKeyup=\"storeCaret(this);\"></textarea></td>
		                  </tr>
		                  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>&nbsp;</td>
		                  </tr>
		                  <tr>
		                    <td width=18% valign=top><b><font size=2>
                            Question</font></b></td>
		                    <td width=82%><textarea rows=5 name=a_quest cols=41></textarea></td>
		                  </tr>
						  <tr>
		                    <td width=18% valign=top><b><font size=2>
                            Question Type</font></b></td>
		                    <td width=82%><select size=1 name=a_qType onClick=setAQType()>
  								<option value=sa>Short Answer</option>
    							<option value=mc selected>Multiple Choice</option>
    							<option value=tf>True/False</option>
    							</select></td>
		                  </tr>
					
						  <tr id=asa>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>Answer
                            <input type=text name=asa_answer size=32></font></b></td>
		                  </tr>
		
						  <tr id=atf>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><font size=2>Answer</font><select size=1 name=atf_answer>
  								<option value=T selected>True</option>
    							<option value=F>False</option>
    							</select></td>
		                  </tr>
					
		                  <tr id=amc>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>A
                            <input type=text name=a_A size=32></font></b><input type=radio value=A name=a_answer></td>
		                  </tr>
		                  <tr id=amc2>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>B
                            <input type=text name=a_B size=32></font></b><input type=radio value=B name=a_answer></td>
		                  </tr>
					
		                  <tr id=amc3>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>C
                            <input type=text name=a_C size=32></font></b><input type=radio value=C name=a_answer></td>
		                  </tr>
		                  <tr id=amc4>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><b><font size=2>D
                            <input type=text name=a_D size=32></font></b><input type=radio value=D name=a_answer></td>
		                  </tr>
					
						  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>&nbsp;</td>
		                  </tr>                  
						  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%>&nbsp;</td>
		                  </tr>
		                  <tr>
		                    <td width=18%>&nbsp;</td>
		                    <td width=82%><br>
							<input type=hidden name=endslide value=$endslide>
							<input type=hidden name=curslide value=$curslide>
							<input type=hidden name=oid value=$oid>
							<input type=hidden name=func value=makesli>
		                    <input type=submit value=\"Create Slide\" name=B1></td>
		                  </tr>
		                </table>
		        		</form>
		        		</td>
		        	</tr>
		        </table>

			";
		break;
	case "makesli":
		//$newtext = str_replace("\n","<br>",$newtext);
		$sql = "INSERT INTO text (objectid,slide,text) VALUES('$oid','$curslide','$newtext')";
		$results = mysql_query($sql) or die("Could Not Create Slide.<br>");
		if($quest != "" && $quest != null){	
			$quest = str_replace("\n","<br>",$quest);	
			if($qType == "mc"){
				$sql = "INSERT INTO questions (objectid,slideid,question,answer,type) VALUES('$oid','$curslide','$quest','$answer','$qType')";
				$results = mysql_query($sql) or die("Could Not Create Question.<br>");
				$qid = mysql_insert_id();	
				// Add Answer Choices
				if($A != ""){
					$sql = "INSERT INTO answerChoices (questionid,value,text) VALUES('$qid','A','$A')";
					$results = mysql_query($sql) or die("Could Not Create Answer A.<br>");
				}
				if($B != ""){
					$sql = "INSERT INTO answerChoices (questionid,value,text) VALUES('$qid','B','$B')";
					$results = mysql_query($sql) or die("Could Not Create Answer B.<br>");
				}
				if($C != ""){
					$sql = "INSERT INTO answerChoices (questionid,value,text) VALUES('$qid','C','$C')";
					$results = mysql_query($sql) or die("Could Not Create Answer C.<br>");
				}
				if($D != ""){
					$sql = "INSERT INTO answerChoices (questionid,value,text) VALUES('$qid','D','$D')";
					$results = mysql_query($sql) or die("Could Not Create Answer D.<br>");
				}
			}
			
			if($qType == "tf"){
				$sql = "INSERT INTO questions (objectid,slideid,question,answer,type) VALUES('$oid','$curslide','$quest','$tf_answer','$qType')";
				$results = mysql_query($sql) or die("Could Not Create Question.<br>");
				$qid = mysql_insert_id();
				$sql = "INSERT INTO answerChoices (questionid,value,text) VALUES('$qid','T','True')";
				$results = mysql_query($sql) or die("Could Not Create Answer True.<br>");
				$sql = "INSERT INTO answerChoices (questionid,value,text) VALUES('$qid','F','False')";
				$results = mysql_query($sql) or die("Could Not Create Answer False.<br>");
			}
			
			if($qType == "sa"){
				$sql = "INSERT INTO questions (objectid,slideid,question,answer,type) VALUES('$oid','$curslide','$quest','$sa_answer','$qType')";
				$results = mysql_query($sql) or die("Could Not Create Question.<br>");
				$qid = mysql_insert_id();
			}
		}
		
		// Create Alternate Slide
		// Add Alternate Text
		if($a_newtext != ""){
			$a_newtext = str_replace("\n","<br>",$a_newtext);
			$sql = "INSERT INTO alt_text (objectid,slide,text) VALUES('$oid','$curslide','$a_newtext')";
			$results = mysql_query($sql) or die("Could Not Create Slide (Alt).<br>");
		}
		
		// Add Alternate Question
		if($a_quest != ""){
			$a_quest = str_replace("\n","<br>",$a_quest);
			if($a_qType == "mc"){
				$sql = "INSERT INTO alt_questions (objectid,slideid,question,answer,type) VALUES('$oid','$curslide','$a_quest','$a_answer','$a_qType')";
				$results = mysql_query($sql) or die("Could Not Create Question (Alt).<br>");
				$a_qid = mysql_insert_id();
				// Add Alternate Answer Choices
				if($a_A != ""){
					$sql = "INSERT INTO alt_answerChoices (questionid,value,text) VALUES('$a_qid','A','$a_A')";
					$results = mysql_query($sql) or die("Could Not Create Answer A (Alt).<br>");
				}
				if($a_B != ""){
					$sql = "INSERT INTO alt_answerChoices (questionid,value,text) VALUES('$a_qid','B','$a_B')";
					$results = mysql_query($sql) or die("Could Not Create Answer B (Alt).<br>");
				}
				if($a_C != ""){
					$sql = "INSERT INTO alt_answerChoices (questionid,value,text) VALUES('$a_qid','C','$a_C')";
					$results = mysql_query($sql) or die("Could Not Create Answer C (Alt).<br>");
				}
				if($a_D != ""){
					$sql = "INSERT INTO alt_answerChoices (questionid,value,text) VALUES('$a_qid','D','$a_D')";
					$results = mysql_query($sql) or die("Could Not Create Answer D (Alt).<br>");
				}	
			}
			
			if($a_qType == "tf"){
				$sql = "INSERT INTO alt_questions (objectid,slideid,question,answer,type) VALUES('$oid','$curslide','$a_quest','$atf_answer','$a_qType')";
				$results = mysql_query($sql) or die("Could Not Create Question (Alt).<br>");
				// Add Alternate Answer Choices
				$sql = "INSERT INTO alt_answerChoices (questionid,value,text) VALUES('$a_qid','T','True')";
				$results = mysql_query($sql) or die("Could Not Create Answer True (Alt).<br>");
				$sql = "INSERT INTO alt_answerChoices (questionid,value,text) VALUES('$a_qid','F','False')";
				$results = mysql_query($sql) or die("Could Not Create Answer False (Alt).<br>");
			}
			
			if($a_qType == "sa"){
				$sql = "INSERT INTO alt_questions (objectid,slideid,question,answer,type) VALUES('$oid','$curslide','$a_quest','$asa_answer','$a_qType')";
				$results = mysql_query($sql) or die("Could Not Create Question (Alt).<br>");	
			}
		}
				
		
		echo "Slide $curslide Created<br><br>";
		if($curslide == $endslide){
			echo "<font size=3><b>Object Setup Completed</b></font><br>";
		} else {
			$curslide++;
			echo "<form method=post action=addObject.php>";
			echo "<input type=hidden name=endslide value=$endslide>
				<input type=hidden name=curslide value=$curslide>
				<input type=hidden name=oid value=$oid>
				<input type=hidden name=func value=crsli>
		        <input type=submit value=\"Create Next Slide\" name=B1></form>";
		}		
		break;
	default:
		echo "
			<table width=470 align=center border=0>
	        	<tr>
	        		<td>
	        		<form method=post action=addObject.php>
	        		<table border=0 cellpadding=0 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100% id=AutoNumber3>
	                  <tr>
	                    <td width=18%><b><font size=2>Title</font></b></td>
	                    <td width=82%><input type=text name=title size=49></td>
	                  </tr>
	                  <tr>
	                    <td width=18%><b><font size=2>Info</font></b></td>
	                    <td width=82%>
	        			<font size=2 face=arial>
	                    <input type=text name=info size=49></font></td>
	                  </tr>
	                  <tr>
	                    <td width=18%><b><font size=2>Author</font></b></td>
	                    <td width=82%>
	        			<font size=2 face=arial>
	                    <input type=text name=author size=49></font></td>
					  </tr>
			          </tr>
						<tr>
	                    <td width=18%><b><font size=2>Slides</font></b></td>
	                    <td width=82%>
	        			<font size=2 face=arial>
	                    <input type=text name=slides size=49 value=1></font></td>
	                  </tr>
					  <tr>
	                    <td width=18% valign=top><b><font size=2>Comments</font></b></td>
	                    <td width=82%><textarea rows=7 name=comms cols=41></textarea></td>
	                  </tr>
					  <tr>
	                    <td width=18% valign=top><b><font size=2>Assignments</font></b></td>
	                    <td width=82%><textarea rows=7 name=assigns cols=41></textarea></td>
	                  </tr>
	                  <tr>
	                    <td width=18% valign=top><b><font size=2>Metadata</font></b></td>
	                    <td width=82%><textarea rows=14 name=meta cols=41></textarea></td>
	                  </tr>
	                  <tr>
	                    <td width=18%>&nbsp;</td>
	                    <td width=82%><br>
						<input type=hidden name=func value=addo>
	                    <input type=submit value=\"Create Object\" name=B1></td>
	                  </tr>
	                </table>
	        		</form>
	        		</td>
	        	</tr>
	        </table>

		";
		break;	
}

include("../html_footer.inc");
?>

