<?php

//get class type info [$dat_info_classtype]
include($_SESSION['pathLeader']."_sql/select/info_iep_class_type.php");

//get current session
include($_SESSION['pathLeader']."_sql/select/info_session_current.php");
$_SESSION["var_session"] = $dat_get_session_current[0];
$_SESSION["var_session"] = 109; //hard coded
include($_SESSION['pathLeader']."_sql/select/info_session.php");

	$_SESSION['ary_class_options']=array();
	
//this is for classes that will not be evaluated	
	$_SESSION['var_class_excl'] = "892";
	
//this is for SKILLS classes that will need to be evaluated	
	$_SESSION['var_class_incl'] = "1084";

/////////////////////////////////////////////////////////////////////////////////////
/*
create a list of class options to choose from
if beginning survey, bring up all oc (class type 2) sections of a chosen level
if grammar (2nd survey, class type 1), bring up all grammar choices based on the studids in the OC level/section chosen
if written comm (4 round, and class type 4),bring up all wc choices based on the studids in the OC/G level/section chosen
if reading (3 round, and class type 3),bring up all grammar choices based on the studids in the OC/G/WC level/section chosen
*/
/////////////////////////////////////////////////////////////////////////////////////

	IF(COUNT($_SESSION['unique_studids'])>0)
		$imp_studids = "AND studid IN (".$_SESSION['imp_unique_studids'].")";
	

	
	IF(COUNT($_SESSION['imp_oc_studid'])>0)
		$imp_oc = "AND studid IN (".$_SESSION['imp_oc_studid'].")";
	ELSE
		$imp_oc='';
	
	IF(COUNT($_SESSION['imp_g_studid'])>0)
		$imp_g = "AND studid IN (".$_SESSION['imp_g_studid'].")";
	ELSE
		$imp_g='';
			
	IF(COUNT($_SESSION['imp_wc_studid'])>0)
		$imp_wc = "AND studid IN (".$_SESSION['imp_wc_studid'].")";
	ELSE
		$imp_wc='';

IF($_SESSION['iep_class_type']==2){
	//get all oc classes at that post level
	$sql_oc_options = "SELECT * FROM `iep_classes`
						WHERE `classTypeID` =2
						AND `sessionID` =".$_SESSION["var_session"] ."
						AND `level` =".$survey_course_dd."
						AND `status` =1
						AND id NOT IN (".$_SESSION['var_class_excl'].")
						OR  id IN (".$_SESSION['var_class_incl'].")
						ORDER BY `id` ASC ";
	//echo $sql_oc_options;
	$res_oc_options = mysqli_query($progROLink, $sql_oc_options) or die ("Couldn't oc query. ".$sql_oc_options);
	WHILE ($rows=mysqli_fetch_array($res_oc_options)){
							
				$str_id = TRIM($rows["id"]);
				array_push($_SESSION['ary_class_options'], $str_id);		
											
			}
	mysqli_free_result($res_oc_options);
}
ELSEIF($_SESSION['iep_class_type']==1){
	//$_SESSION['ary_class_options']=array();
	//get all grammar classes at that level
	//for session 105, i've exclu classid 892
	$sql_g_options = "SELECT DISTINCT classID FROM stud_iep_classes 
						WHERE `classTypeID` =1
						AND `sessionID` =".$_SESSION["var_session"]."
						AND `status` =1
						AND id NOT IN (".$_SESSION['var_class_excl'].")
						".$imp_oc."
						ORDER BY `classID` ASC ";
	//echo $sql_g_options;
	$res_g_options = mysqli_query($studROLink, $sql_g_options) or die ("Couldn't g query.");
	WHILE ($rows=mysqli_fetch_array($res_g_options)){
							
				$str_id = TRIM($rows["classID"]);
				array_push($_SESSION['ary_class_options'], $str_id);		
											
			}
	mysqli_free_result($res_g_options);
}
ELSEIF($_SESSION['iep_class_type']==4){	
	//WRITTEN COMMUNICATION
	
	//get all wc classes at that level
	$sql_wc_options = "SELECT DISTINCT classID FROM stud_iep_classes 
						WHERE `classTypeID` =4
						AND `status` =1
						AND id NOT IN (".$_SESSION['var_class_excl'].")
						AND `sessionID` =".$_SESSION["var_session"]."
						".$imp_oc."
						".$imp_g."
						ORDER BY `classID` ASC ";
	//echo $sql_wc_options;
	$res_wc_options = mysqli_query($studROLink, $sql_wc_options) or die ("Couldn't wc query.");
	WHILE ($rows=mysqli_fetch_array($res_wc_options)){
							
				$str_id = TRIM($rows["classID"]);
				array_push($_SESSION['ary_class_options'], $str_id);		
											
			}
	mysqli_free_result($res_wc_options);
}
ELSEIF($_SESSION['iep_class_type']==3){
	//READING
	
	//get all reading classes at that level
	$sql_r_options = "SELECT DISTINCT classID FROM stud_iep_classes 
						WHERE `classTypeID` =3
						AND `status` =1
						AND id NOT IN (".$_SESSION['var_class_excl'].")
						AND `sessionID` =".$_SESSION["var_session"]."
						".$imp_oc."
						".$imp_g."
						".$imp_wc."
						ORDER BY `classID` ASC ";	
	//force sql for a particular session
/*	$sql_r_options = "SELECT DISTINCT classID FROM stud_iep_classes 
						WHERE `classTypeID` =3
						AND `status` =1
						AND sessionID = 103
						ORDER BY `classID` ASC";
*/
	//echo $sql_r_options;
	$res_r_options = mysqli_query($studROLink, $sql_r_options) or die ("Couldn't r query.");
	WHILE ($rows=mysqli_fetch_array($res_r_options)){
							
				$str_id = TRIM($rows["classID"]);
				array_push($_SESSION['ary_class_options'], $str_id);		
											
			}
	mysqli_free_result($res_r_options);
}



?>