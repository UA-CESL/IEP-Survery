<?php session_start(); // start up your PHP session! ?>


<?php include($_SESSION['pathLeader']."../ffutsterces/_appdbconnect.php"); ?>

<FORM method="post">
<!--THIS VAR DETERMINES THE NEXT COURSES TO PRESENT TO STUDENT TO CHOOSE FROM -->
<?php echo "<input type='hidden' name='hd_completed' id='hd_completed' value='".$_SESSION['iep_class_type']."' />";
$_SESSION['hd_completed']=$_SESSION['iep_class_type'];

?>


<?php
//set vars for insert sql
	$var_sessionid = $_SESSION['var_session'];
	$var_netid = $_SESSION['netid_faculty'];
	$var_classid = $_SESSION['iep_class_id'];

//get values from survey

//values for self////////////////////////////////////////////////////////////////

$cnt_self_questions = COUNT($_SESSION['ary_questions_self']);
FOR($i_cnt_sq=0; $i_cnt_sq<$cnt_self_questions; $i_cnt_sq++){
	
	$value_self = TRIM(strip_tags($_POST[$_SESSION['ary_questions_self'][$i_cnt_sq]])); 
	
	$var_questionid = $_SESSION['ary_questions_self'][$i_cnt_sq];
	$var_value = $value_self;	
	
	//excute insert
	include($_SESSION['pathLeader']."_sql/ins/evals_iep_responses.php");
	
	
	//sql
/*	$sql_ins_selfval = "INSERT INTO `iep_survey_responses`(`id`, `sessionID`, `netID`, `classID`, `questionID`, `questionValue`, `status`, `timestamp`) 
							VALUES (
							NULL,
							'".$_SESSION['var_session']."',
							'".$_SESSION['netid_faculty']."',
							'".$_SESSION['iep_class_id']."',
							'".$_SESSION['ary_questions_self'][$i_cnt_sq]."',
							'".$value_self."',
							'1',
							CURRENT_TIMESTAMP)";
*/							
	//echo $sql_ins_classval."<br />";
//	IF($value_self>0 && $value_self<6)
//		mysqli_query($progWOLink, $sql_ins_selfval) or die ("Couldn't ins self query.");
	
}


//values for class////////////////////////////////////////////////////////////////

$cnt_class_questions = COUNT($_SESSION['ary_questions_class']);
FOR($i_cnt_cq=0; $i_cnt_cq<$cnt_class_questions; $i_cnt_cq++){
	
	$value_class = TRIM(strip_tags($_POST[$_SESSION['ary_questions_class'][$i_cnt_cq]])); 
	
	$var_questionid = $_SESSION['ary_questions_class'][$i_cnt_cq];
	$var_value = $value_class;	
	
	//excute insert
	include($_SESSION['pathLeader']."_sql/ins/evals_iep_responses.php");
	
	
	//sql
/*	$sql_ins_classval = "INSERT INTO `iep_survey_responses`(`id`, `sessionID`, `netID`, `classID`, `questionID`, `questionValue`, `status`, `timestamp`) 
							VALUES (
							NULL,
							'".$_SESSION['var_session']."',
							'".$_SESSION['netid_faculty']."',
							'".$_SESSION['iep_class_id']."',
							'".$_SESSION['ary_questions_class'][$i_cnt_cq]."',
							'".$value_class."',
							'1',
							CURRENT_TIMESTAMP)";
	//echo $sql_ins_classval."<br />";
	IF($value_class>0 && $value_class<5)
		mysqli_query($progWOLink, $sql_ins_classval) or die ("Couldn't ins class query.");
*/
}

//values for teacher////////////////////////////////////////////////////////////////

$cnt_teacher_questions = COUNT($_SESSION['ary_questions_teacher']);
FOR($i_cnt_tq=0; $i_cnt_tq<$cnt_teacher_questions; $i_cnt_tq++){
	
	$value_teacher = TRIM(strip_tags($_POST[$_SESSION['ary_questions_teacher'][$i_cnt_tq]])); 
	
	$var_questionid = $_SESSION['ary_questions_teacher'][$i_cnt_tq];
	$var_value = $value_teacher;	
	
	//excute insert
	include($_SESSION['pathLeader']."_sql/ins/evals_iep_responses.php");
	
	//sql
/*	$sql_ins_teacherval = "INSERT INTO `iep_survey_responses`(`id`, `sessionID`, `netID`, `programID`, `classID`, `questionID`, `questionValue`, `status`, `timestamp`) 
							VALUES (
							NULL,
							'".$_SESSION['var_session']."',
							'".$_SESSION['netid_faculty']."',
							'1',
							'".$_SESSION['iep_class_id']."',
							'".$_SESSION['ary_questions_teacher'][$i_cnt_tq]."',
							'".$value_teacher."',
							'1',
							CURRENT_TIMESTAMP)";
	//echo $sql_ins_teacherval."<br />";
	IF($value_teacher>0 && $value_teacher<5)
		mysqli_query($progWOLink, $sql_ins_teacherval) or die ("Couldn't ins teach query.");
*/
}


//comments/////////////////////////////////////////////////////////////////////////
$value_comment1 = TRIM(strip_tags($_POST['17'])); 
$value_comment2 = TRIM(strip_tags($_POST['18'])); 
//clean commnet
$value_comment1 = str_replace("'", "", $value_comment1);
$value_comment2 = str_replace("'", "", $value_comment2);

	//sql
	$sql_ins_comment = "INSERT INTO `iep_survey_comments`(`id`, `sessionID`, `netID`, `programID`, `classID`, `questionID`, `comments`, `status`, `timestamp`)
							 VALUES 
							 (
							 NULL,		
							'".$_SESSION['var_session']."',	
							'".$_SESSION['netid_faculty']."',	
							'1',			
							'".$_SESSION['iep_class_id']."',				
							'17',
							'".$value_comment1."',
							'1',
							CURRENT_TIMESTAMP)";
	//echo $sql_ins_comment."<br />";
	IF($value_comment1!='')
		mysqli_query($progWOLink, $sql_ins_comment) or die ("Couldn't ins comments1 query.");
		
	//sql
	$sql_ins_comment = "INSERT INTO `iep_survey_comments`(`id`, `sessionID`, `netID`, `programID`, `classID`, `questionID`, `comments`, `status`, `timestamp`)
							 VALUES 
							 (
							 NULL,		
							'".$_SESSION['var_session']."',	
							'".$_SESSION['netid_faculty']."',	
							'1',							
							'".$_SESSION['iep_class_id']."',				
							'18',
							'".$value_comment2."',
							'1',
							CURRENT_TIMESTAMP)";
	//echo $sql_ins_comment."<br />";
	IF($value_comment2!='')
		mysqli_query($progWOLink, $sql_ins_comment) or die ("Couldn't ins comments2 query.");

include($_SESSION['pathLeader']."_inc/_dbclose.php"); 

//redirect
printf("<script>location.href='teacher.php'</script>");


?>
</FORM>


