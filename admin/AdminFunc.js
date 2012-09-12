function VerifyDeleteAnnc(){
	if(confirm("Are You Sure You Want Clear All Announcments?")){
		location.replace("clearAnnouncment.php");
	} else {
		location.replace("admin.php");
	}	
}

function VerifyClearStudents(){
	if(confirm("Are You Sure You Want Delete All Student Records?")){
		location.replace("clearStudents.php");
	} else {
		location.replace("admin.php");
	}	
}

function VerifyClearScores(){
	if(confirm("Are You Sure You Want Delete All Student Scores?")){
		location.replace("clearScores.php");
	} else {
		location.replace("admin.php");
	}	
}

function VerifySystemReset(){
	if(confirm("WARNING!! This Operation Will Remove All Information from the Database.")){
		if(confirm("Are You Sure you want to Continue with this Operation?")){
			location.replace("resetSystem.php");
		} else {
			location.replace("admin.php");
		}
	} else {
		location.replace("admin.php");
	}	
}

function AskToUpdate(){
	if(confirm("Would You Like to Update The Ticker Now?")){
		location.replace("rss/updateTicker.php");
	} else {
		location.replace("admin.php");
	}
}

function CheckAdminBrowser(){
	if(navigator.appName == "WebTV"){
 		alert("This System Does Not Support WebTV.")
 		location.replace("index.html");
	}else if(navigator.appName == "Netscape"){
 		alert("This System Does Not Support Netscape.")
 		location.replace("error.html");
	}else if(navigator.appName == "Microsoft Internet Explorer"){
		temp=navigator.appVersion.split("MSIE");
		version=parseFloat(temp[1]);
 		if(version < 5){
 			alert("Please Upgrade to Internet Explorer 5+.")
 			location.replace("error.html");
 		} else {
 			// Allow to Continue
 		}
	}
}

function VerifyGlobalLogging(){
	if(confirm("You are About to set Logging Globally (All Objects), Continue?")){
		location.replace("editLoggingGlobal.php");
	} else {
		location.replace("admin.php");
	}	
}
