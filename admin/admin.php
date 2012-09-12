<?
include("../html_header.inc");
include("html_middle.inc");

if($ILOAdmin != "yes"){
	echo "You Are Not Authorized To Enter This Area!<br>";
	include("../html_footer.inc");
	exit();
}


include("../conn.inc");
$sql = "SELECT * FROM admins WHERE email = '$admin'";
$results = mysql_query($sql) or die("Could Not Verify Admin Level.<br><br>");
$row = mysql_fetch_array($results);
$level = $row['level'];

echo "
<script type=\"text/\">
	if(navigator.appName == 'WebTV'){
 		alert('This System Does Not Support WebTV.')
 		location.replace('index.html');
	}else if(navigator.appName == 'Netscape'){
 		alert('This System Does Not Support Netscape.')
 		location.replace('error.html');
	}else if(navigator.appName == 'Microsoft Internet Explorer'){
		temp=navigator.appVersion.split('MSIE');
		version=parseFloat(temp[1]);
 		if(version < 5){
 			alert('Please Upgrade to Internet Explorer 5+.')
 			location.replace('error.html');
 		} else {
 			// Allow to Continue
 		}
	}
</script>
<b>ILO System Administration Area<br>
        </b></font>
        <font size=1 face=arial>
        Authorized Users Only<br>
&nbsp;</font><table border=0 cellpadding=0 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100% id=AutoNumber3>
          <tr>
            <td width=50% valign=top>
            <ul>
              <li><b><font size=2 face=Arial>Objects</font></b><font face=Arial size=2><ul>
                <li>
                <a href=addObject.php>
                Add New Object</a> </li>
				<li>
                <a href=editEnabled.php>
                Edit Object Status</a> </li>
                <li>
                <a href=editLogging.php>
                Edit Object Logging</a> </li>
                <li><a onclick=VerifyGlobalLogging() href=#>Edit Global 
                Logging</a> </li>
                <li>
                <a href=editObject.php>
                Edit Existing Object</a> </li>
                <li>
                <a href=editSlide.php>
                Edit Existing Slide</a> </li>
                <li>
                <a href=editQuestion.php>
                Edit Existing Question</a> </li>
                <li>
                <a href=delObject.php>
                Delete Entire Object</a></li><font face=arial size=2>
              </ul>
              </li>
              <li><b>Images</b><ul>
                <li>
                <a href=addImage.php>
                Upload Image</a> </li>
                <li>
                <a href=viewImages.php>
                View Images</a> </li>
                <li>
                <a href=delImage.php>
                Delete Image</a> </li>
              </ul>
              </li>
              <li><b>Announcements</b> <br>
              <font face=arial size=2><font size=1>Update Ticker After 
              Modifications</font></font><ul>
                <li>
                <a href=addAnnouncment.php>
                Add Announcement</a> </li>
                <li>
                <a href=editAnnouncment.php>
                Edit Announcement</a> </li>
                <li>
                <a href=delAnnouncment.php>
                Delete Announcement</a> </li>
                <li><a onclick=VerifyDeleteAnnc() href=#>Clear Announcements</a>
                </li>
                <li>
                <a href=editTicker.php>
                Edit Ticker Status</a> </li>
                <li>
                <a href=rss/updateTicker.php>
                Update Ticker</a></li>
              </ul>
              </li>
            </ul>
            </font></font>
            <p>&nbsp;</td>
            <td width=50% valign=top><font face=arial size=2>
            <ul>
              <li><b>Students</b><ul>
                <li>
                <a href=addStudent.php>
                Add Student</a> </li>
                <li>
                <a href=editStudent.php>
                Edit Student</a> </li>
                <li>
                <a href=delStudent.php>
                Delete Student</a> </li>
                <li><a onclick=VerifyClearStudents() href=#>Clear Student 
                Roster</a> </li>
              </ul>
              </li>
              <li><b>Scores</b>
              <ul>
                <li>
                <a href=statsObject.php>
                Object Scores</a> </li>
                <li>
                <a href=statsStudent.php>
                Student Scores</a> </li>
                <li>
				<a href=resetObject.php>
				Reset Object Scores</a> </li>
                <li><a onclick=VerifyClearScores() href=#>Reset All Scores</a>
                </li>
              </ul>
              </li>
              <li><b>View</b>
              <ul>
                <li>
                <a href=printStudents.php>
                Student Logins</a> </li>
                <li>
                <a href=printAnswerkey.php>
                Answer Keys</a> </li>
              </ul>
              </li>";
if($level >= 1){
	echo "
		<li><b>Administration</b><ul>
	    <li><a href=addAdmin.php>Add Admin</a></li>
		<li><a href=editAdmin.php>Edit Admin</a></li>
		<li><a href=delAdmin.php>Delete Admin</a></li>
		<li><a href=newPassword.php>Change My Password</a></li>
	  </ul>
	  </li>
	";
}
echo "</ul></td></tr></table>";
if($level >= 1){
	echo "<li><font size=2 face=arial color=red><a href=# onClick=\"VerifySystemReset();\">Reset System</a></font></li>";
}

include("../html_footer.inc");
?>