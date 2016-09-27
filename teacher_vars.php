<?php
//how do we determine the next course/level/section to display
/*
if survey_course_dd gets a var, then it's the beginning of the survey,
therefore, we present OC options.  set $_SESSION["iep_class_type"] =2

if survey_course_hd gets the var, then a course has been completed
and now we need to determin which course/level/section to offer
*/
//echo "id: ".$_SESSION['iep_class_type']."<br />";
$survey_course_dd = TRIM(strip_tags($_POST['dd_oclevel']));
//echo "dd: ".$survey_course_dd."<br />";
$survey_course_hd = TRIM(strip_tags($_POST['hd_completed']));
//echo "hd: ".$survey_course_hd."<br />"; 

IF($survey_course_dd >0) {
	IF($_SESSION["ICC_redirect"]!=1)
	$_SESSION["ICC_redirect"] = 0; //set the completed survey redirect, this can be change on survey_vars2	
	
	$_SESSION['iep_class_type'] = 2;
	$_SESSION['class_studids']=array(); //create the array to keep track of studid possibility	
	$_SESSION['survey_language'] = TRIM(strip_tags($_POST['dd_language']));
	IF($_SESSION['survey_language']=='')
		$_SESSION['survey_language']=1025;  //English
}
ELSE {
	IF($_SESSION['hd_completed']==2)
		$_SESSION['iep_class_type'] = 1;
	ELSEIF($_SESSION['hd_completed']==1)
		$_SESSION['iep_class_type'] = 4;
	ELSEIF($_SESSION['hd_completed']==4)
		$_SESSION['iep_class_type'] = 3;
	ELSEIF($_SESSION['hd_completed']==3)
		$_SESSION['iep_class_type'] = 42; //number to indicate that the survey is completed
	ELSE
		$_SESSION['iep_class_type'] = 99; //forced number to redirect
}

//echo $_SESSION['iep_class_type']."<br />";

//$_SESSION["survey_location"]==0  Oral Communication (2)
//$_SESSION["survey_location"]==1  Grammar (1)
//$_SESSION["survey_location"]==2  Written Communication (4)
//$_SESSION["survey_location"]==3  Reading (3)

IF($_SESSION['iep_class_type']==42){
	//redirect
	//printf("<script>location.href='thx.php'</'script>");
	//printf("<script>location.href='../../student/iep_intent_cont/index.php'</'script>");
	//printf("<script>location.href='https://uarizona.co1.qualtrics.com/SE/?SID=SV_54s7VA6XpUBfA57'</'script>"); //FALL 1 15
	//printf("<script>location.href='https://uarizona.co1.qualtrics.com/SE/?SID=SV_1zfWrUDbeARqn8p'</'script>"); //FALL 2 15
	//ICC for levels 4,6,7)
	
	//FORCE skip of ICC survey
	IF($_SESSION["ICC_redirect"]==1){
		//printf("<script>location.href='https://uarizona.co1.qualtrics.com/SE/?SID=SV_6RJoWWzbXys9zql'</'script>"); //FALL 2 15
		//printf("<script>location.href='https://uarizona.co1.qualtrics.com/SE/?SID=SV_4PzQRzTY4YuADzf'</'script>"); //Spring 2 16
		//printf("<script>location.href='https://uarizona.co1.qualtrics.com/jfe/form/SV_3EtSyRHFSjKKTqZ'</'script>"); //Summer 16
		printf("<script>location.href='https://uarizona.co1.qualtrics.com/jfe/form/SV_3EtSyRHFSjKKTqZ'</script>"); //Summer 16
		}
	ELSE {
	//for all others, this is the link to the end of session survey
		//printf("<script>location.href='https://uarizona.co1.qualtrics.com/SE/?SID=SV_9WurDt9lJ4DJIPj'</'script>"); //FALL 2 15
		//printf("<script>location.href='https://uarizona.co1.qualtrics.com/SE/?SID=SV_5o4xhgKkU7aXIQR'</'script>"); //spring 1 16
		//printf("<script>location.href='https://uarizona.co1.qualtrics.com/jfe/form/SV_3dWoXrPAbTbjy85'</'script>"); //spring 2 16
		printf("<script>location.href='https://uarizona.co1.qualtrics.com/jfe/form/SV_55udEkPEpjD6R25'</script>"); //summer 16
	}
}

IF($_SESSION['iep_class_type']==99){
	//redirect
	printf("<script>location.href='index.php'</script>");
}


?>