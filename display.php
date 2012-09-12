<?
include("conn.inc");
include("html_header.inc");

if($ILOUserAuth != "yes"){
	include("html_middle.inc");
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("html_footer.inc");
	exit();
}

$sql = "SELECT * FROM objects WHERE id = $oid";
$results = mysql_query($sql);
if(@mysql_num_rows($results) == 1)
{
	$row = mysql_fetch_array($results);
	$meta = $row['metadata'];
	echo "$meta";
} else {
	echo "<!-- No Meta Data -->";
}
include("html_middle2.inc");

switch($option)
{
	case "p": // Process Answer
		// Check Answer
		if($R1 == $a){ // Correct
			echo "$R1 was Correct.<br>";
			$c = "0";
		} else { // Incorrect
			echo "$R1 was Incorrect.<br>The Correct Answer was <b>$a</b>.<br>";
			$c = "1";
		}
		
		// Log the Answer for The Question just Processed.
		// Check for Logging & Log Answer
		$sql = "SELECT * FROM objects WHERE id = $oid";
		$results = mysql_query($sql);
		if(@mysql_num_rows($results) == 1)
		{
			$row = mysql_fetch_array($results);
			$logging = $row['logging'];
			//echo "Checking Logging<br>";
			if($logging == 0){
				if($try == 1){
					// Logging Answers, Update Answer & Timestamp
					//echo "Not Found, Inserting Row<br>";
					if($c == 0){
						$sql = "UPDATE scores SET correct = correct+1, questions = questions+1 WHERE user = '$user' && objectid = $oid";
						$results = mysql_query($sql);
					} else {
						$sql = "UPDATE scores SET incorrect = incorrect+1, questions = questions+1 WHERE user = '$user' && objectid = $oid";
						$results = mysql_query($sql);
					}
					
					$sql = "INSERT INTO userAnswers VALUES('','$user',$oid,$slide,$alt,'$R1',$c,NOW())";
					$results = mysql_query($sql);
				}		
			} else {
				// Not Loggin Answers, Just Update Time
			}
		}
		
		// If Answer Incorrect, and not on Alternate Text already, Display Alternate Text / Question
		if($alt != 1){
			if($c == 1){
				// Check for Alternate Text
				$sql = "SELECT * FROM alt_text WHERE objectid = $oid && slide = $slide";
				$results = mysql_query($sql);
				if(@mysql_num_rows($results) == 1){
					echo "<br><br>";
					echo "<a href=display.php?option=sa&&oid=$oid&&slide=$slide&&eslide=$eslide&&try=$try>
							Continue</a><br><br>";
					break; // Break out of Switch
				}
			}
		}
		//echo "<br>After Alt Text Display Check.<br><br>";
		
		// Finish up Object When on Last Slide
		if($slide == $eslide){	
			
			if($try == 1){
				// Get, Set, & Display Score
				$sql = "SELECT * FROM scores WHERE user = '$user' && objectid = $oid";
				$results = mysql_query($sql);
				if(@mysql_num_rows($results) == 1)
				{
					$row = mysql_fetch_array($results);
					$correct = $row['correct'];
					$incorrect = $row['incorrect'];
					$questions = $row['questions'];
					
					$score = ($correct / $questions) * 100;
					$score = round($score,2);
					
					$sql = "UPDATE scores SET score = $score WHERE user = '$user' && objectid = $oid";
					$results = mysql_query($sql);
					echo "<br><br>";
					echo "Your Score Was $score<br>";
				} else {
					echo "<br><br>";
					echo "<font coloer=red>Could Not Calculate Score.</font><br>";	
				}	
			}
			echo "<br>";
			echo "Object Complete.<br>";
			echo "<form><input type=button value=\"Close This Window\" onClick=\"window.parent.close()\"></form>";
		// If Not last Slide then Continue to Next Slide
		} else {
			$slide++;
			echo "<br><br>";
			echo "<a href=display.php?option=s&&oid=$oid&&slide=$slide&&eslide=$eslide&&try=$try>
					Continue</a><br><br>";
		}
		break;
	case "s": // Show Slide
		$sql = "SELECT * FROM text WHERE objectid = $oid && slide = $slide";
		$results = mysql_query($sql);
		if(@mysql_num_rows($results) == 1)
		{
			$row = mysql_fetch_array($results);
			$text = $row['text'];
			
			if($slide == 1){
				// Check for Logging & Log Answer
				$sql = "SELECT * FROM objects WHERE id = $oid";
				$results = mysql_query($sql);
				if(@mysql_num_rows($results) == 1)
				{
					$row = mysql_fetch_array($results);
					$logging = $row['logging'];
					//echo "Checking Logging<br>";
					if($logging == 0){
						$sql = "SELECT * FROM scores WHERE user = '$user' && objectid = $oid";
						$results = mysql_query($sql);
						if(@mysql_num_rows($results) == 1){
							// Record Already There, Update
							$sql = "UPDATE scores SET attempts = attempts+1 WHERE user = '$user' && objectid = $oid";
							$results = mysql_query($sql);
							$sql = "INSERT INTO extraAttempts VALUES('','$user',$oid,NOW())";
							$results = mysql_query($sql);
						} else {
							// Record Not There, Insert
							$sql = "INSERT INTO scores VALUES('','$user','$oid',0,0,0,0,NOW(),NOW(),1)";
							$results = mysql_query($sql);
							$try = 1;
						}
					} 
				}
			}
			
			echo "<b>Slide $slide</b><br><br>";
			echo "$text";
			echo "<br><br>";
			
			$sql = "SELECT * FROM questions WHERE objectid = $oid && slideid = $slide";
			$results = mysql_query($sql);
			if(@mysql_num_rows($results) == 1)
			{
				$row = mysql_fetch_array($results);
				$question = $row['question'];
				$answer = $row['answer'];
				$qid = $row['id'];
				$qType = $row['type'];
				
				echo "<form method=post action=display.php?a=$answer>";
				echo "<b>Question:</b><br> $question<br><br>";
				echo "<input type=hidden name=oid value=$oid>";
				echo "<input type=hidden name=try value=$try>";
				echo "<input type=hidden name=option value=p>";
				echo "<input type=hidden name=alt value=0>";
				echo "<input type=hidden name=slide value=$slide>";
				echo "<input type=hidden name=eslide value=$eslide>";
				if($qType == "mc" || $qType == "tf"){
					$sql = "SELECT * FROM answerChoices WHERE questionid = $qid ORDER BY value";
					$results = mysql_query($sql);
					if(@mysql_num_rows($results) >= 1)
					{
						while($row = mysql_fetch_array($results))
						{
							$qtext = $row['text'];
							$value = $row['value'];
							
							echo "<b>$value</b><input type=radio value=$value name=R1>$qtext<br>";
						}
					}
				} else if($qType == "sa"){
					echo "<b>Answer: </b><input type=text name=R1 size=20><br>";	
				}				
				echo "<br><input type=submit value=Continue>";
				echo "</form>";
			} else {
				//echo "No Question Found.<br>";
				if($slide == $eslide){	
					echo "<br><br>";
					echo "Object Complete.<br>";
					echo "<form><input type=button value=\"Close This Window\" onClick=\"window.parent.close()\"></form>";
				} else {
					$slide++;
					echo "<br><br>";
					echo "<a href=display.php?option=s&&oid=$oid&&slide=$slide&&eslide=$eslide>
							Continue</a><br><br>";
				}
			}
			
		} else {
			echo "No Text Found.<br><br>";
		}
		break;
	case "sa": // Show Alternate Slide
		$sql = "SELECT * FROM alt_text WHERE objectid = $oid && slide = $slide";
		$results = mysql_query($sql);
		if(@mysql_num_rows($results) == 1)
		{
			$row = mysql_fetch_array($results);
			$text = $row['text'];
						
			echo "<b>Slide $slide Continued</b><br><br>";
			echo "$text";
			echo "<br><br>";
			
			$sql = "SELECT * FROM alt_questions WHERE objectid = $oid && slideid = $slide";
			$results = mysql_query($sql);
			if(@mysql_num_rows($results) == 1)
			{
				$row = mysql_fetch_array($results);
				$question = $row['question'];
				$answer = $row['answer'];
				$qid = $row['id'];
				
				echo "<form method=post action=display.php?a=$answer>";
				echo "<b>Question:</b><br> $question<br><br>";
				echo "<input type=hidden name=oid value=$oid>";
				echo "<input type=hidden name=try value=$try>";
				echo "<input type=hidden name=option value=p>";
				echo "<input type=hidden name=alt value=1>";
				echo "<input type=hidden name=slide value=$slide>";
				echo "<input type=hidden name=eslide value=$eslide>";
				$sql = "SELECT * FROM alt_answerChoices WHERE questionid = $qid";
				$results = mysql_query($sql);
				if(@mysql_num_rows($results) >= 1)
				{
					$char = "A";
					while($row = mysql_fetch_array($results))
					{
						$qtext = $row['text'];
						$value = $row['value'];
						
						echo "<b>$char</b><input type=radio value=$value name=R1>$qtext<br>";
						$char++;
					}
				}
				echo "<br><input type=submit value=Continue>";
				echo "</form>";
			} else {
				//echo "No Question Found.<br>";
				if($slide == $eslide){	
					echo "<br><br>";
					echo "Object Complete.<br>";
					echo "<form><input type=button value=\"Close This Window\" onClick=\"window.parent.close()\"></form>";
				} else {
					$slide++;
					echo "<br><br>";
					echo "<a href=display.php?option=s&&oid=$oid&&slide=$slide&&eslide=$eslide>
							Continue</a><br><br>";
				}
			}
			
		} else {
			echo "No Text Found.<br><br>";
		}
		break;
	default: // Intro
		$sql = "SELECT * FROM objects WHERE id = $oid";
		$results = mysql_query($sql);
		if(@mysql_num_rows($results) == 1)
		{
			$row = mysql_fetch_array($results);
			$id = $row['id'];
			$title = $row['title'];
			$info = $row['info'];
			$slides = $row['slides'];
			$logging = $row['logging'];
			
			if($logging == 0){
				$logNote = "<font size=1>This Object Currently Logging Answers</font>";
			} else {
				$logNote = "";
			}
			
			$slide = 1;
			$eslide = $slides;
			
			echo "<b>$title</b><br><br>$info<br><br>";
			echo "<a href=display.php?option=s&&oid=$oid&&slide=$slide&&eslide=$eslide>
					Click Here To Begin</a><br><br>";
			echo "$logNote";

		} else {
			echo "Learning Object Not Found.<br>Please Try Again Later.<br>";
		}
		break;
}

// Include Footer
include("html_footer.inc");
?>