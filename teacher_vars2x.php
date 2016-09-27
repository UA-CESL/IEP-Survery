<?php

//get class type info [$dat_info_classtype]
include($_SESSION['pathLeader']."_sql/select/info_iep_class_type.php");

//get current session
include($_SESSION['pathLeader']."_sql/select/info_session_current.php");
$_SESSION["var_session"] = $dat_get_session_current[0];
include($_SESSION['pathLeader']."_sql/select/info_session.php");

	$_SESSION['ary_class_options']=array();

/////////////////////////////////////////////////////////////////////////////////////
/*
create a list of class options to choose from
if beginning survey, bring up all oc (class type 2) sections of a chosen level
if grammar (2nd survey, class type 1), bring up all grammar choices based on the studids in the OC level/section chosen
if reading (3 round, and class type 3),bring up all grammar choices based on the studids in the OC level/section chosen
if written comm (4 round, and class type 4),bring up all wc choices based on the studids in the OC level/section chosen
*/
/////////////////////////////////////////////////////////////////////////////////////

IF($_SESSION['iep_class_type']==2){
	//get all oc classes at that post level
	$sql_oc_options = "SELECT * FROM `iep_classes`
						WHERE `classTypeID` =2
						AND `sessionID` =".$dat_get_session_current[0]."
						AND `level` =".$survey_course_dd."
						AND `status` =1
						ORDER BY `id` ASC ";
	//echo $sql_oc_options;
	$res_oc_options = mysqli_query($progROLink, $sql_oc_options) or die ("Couldn't oc query.");
	WHILE ($rows=mysqli_fetch_array($res_oc_options)){
							
				$str_id = TRIM($rows["id"]);
				array_push($_SESSION['ary_class_options'], $str_id);		
											
			}
	mysqli_free_result($res_oc_options);
}
ELSEIF($_SESSION['iep_class_type']==1){
	//get distinct levels for student in Grammar class using the $_SESSION['imp_oc_studid']
	$_SESSION['ary_gram_lev_dist']=array();
	$sql_sel_gram_dist = "SELECT DISTINCT level FROM stud_schedule WHERE 
							studid IN (".$_SESSION['imp_oc_studid'].") AND
							`course_name` LIKE '".$dat_info_classtype[1]."'
							AND `sessionID` =".$dat_get_session_current[0]."
							AND `status` =1
							ORDER BY `id` ASC ";
	$res_sel_gram_dist = mysqli_query($studROLink, $sql_sel_gram_dist) or die ("Couldn't gram list query.");
	WHILE ($rows=mysqli_fetch_array($res_sel_gram_dist)){
							
				$str_id = TRIM($rows["level"]);
				array_push($_SESSION['ary_gram_lev_dist'], $str_id);		
											
			}
	mysqli_free_result($res_sel_gram_dist);
	$_SESSION['imp_gram_lev_dist'] = IMPLODE(",", $_SESSION['ary_gram_lev_dist']);								
							

//get distinct section for student in Grammar class using the $_SESSION['imp_oc_studid']
	$_SESSION['ary_gram_sec_dist']=array();
	$sql_sel_gram_dist = "SELECT DISTINCT section FROM stud_schedule WHERE 
							studid IN (".$_SESSION['imp_oc_studid'].") AND
							`course_name` LIKE '".$dat_info_classtype[1]."'
							AND `sessionID` =".$dat_get_session_current[0]."
							AND level IN (".$_SESSION['imp_gram_lev_dist'].")
							AND `status` =1
							ORDER BY `id` ASC ";
	$res_sel_gram_dist = mysqli_query($studROLink, $sql_sel_gram_dist) or die ("Couldn't gram list query.");
	WHILE ($rows=mysqli_fetch_array($res_sel_gram_dist)){
							
				$str_id = TRIM($rows["section"]);
				array_push($_SESSION['ary_gram_sec_dist'], $str_id);		
											
			}
	mysqli_free_result($res_sel_gram_dist);
	//$_SESSION['imp_gram_sec_dist'] = IMPLODE(",", $_SESSION['ary_gram_sec_dist']);	
	$_SESSION['sectionLike'] = '';
	FOR($i_cnt_sec=0;  $i_cnt_sec<COUNT($_SESSION['ary_gram_sec_dist']); $i_cnt_sec++){
		IF($i_cnt_sec==0)
			$_SESSION['sectionLike'].= "'".$_SESSION['ary_gram_sec_dist'][$i_cnt_sec]."'";
		ELSE
			$_SESSION['sectionLike'].= " OR section LIKE '".$_SESSION['ary_gram_sec_dist'][$i_cnt_sec]."'";
	}
									
	
	//get all grammar classes at that level
	$sql_g_options = "SELECT * FROM `iep_classes`
						WHERE `classTypeID` =1
						AND `sessionID` =".$dat_get_session_current[0]."
						AND `level` IN (".$_SESSION['imp_gram_lev_dist'].")
						AND (section LIKE ".$_SESSION['sectionLike'].")
						AND `status` =1
						ORDER BY `id` ASC ";
	//echo $sql_g_options;
	$res_g_options = mysqli_query($progROLink, $sql_g_options) or die ("Couldn't g query.");
	WHILE ($rows=mysqli_fetch_array($res_g_options)){
							
				$str_id = TRIM($rows["id"]);
				array_push($_SESSION['ary_class_options'], $str_id);		
											
			}
	mysqli_free_result($res_g_options);
}
ELSEIF($_SESSION['iep_class_type']>2 && $_SESSION['iep_class_type']< 5){								
	
	//get all grammar classes at that level
	$sql_r_options = "SELECT * FROM `iep_classes`
						WHERE `classTypeID` =".$_SESSION['iep_class_type']."
						AND `sessionID` =".$dat_get_session_current[0]."
						AND `level` IN (".$_SESSION['imp_gram_lev_dist'].")
						AND (section LIKE ".$_SESSION['sectionLike'].")
						AND `status` =1
						ORDER BY `id` ASC ";
	//echo $sql_r_options;
	$res_r_options = mysqli_query($progROLink, $sql_r_options) or die ("Couldn't r query.");
	WHILE ($rows=mysqli_fetch_array($res_r_options)){
							
				$str_id = TRIM($rows["id"]);
				array_push($_SESSION['ary_class_options'], $str_id);		
											
			}
	mysqli_free_result($res_r_options);
}
/*
ELSEIF($_SESSION['iep_class_type']==4){								
	
	//get all grammar classes at that level
	$sql_wc_options = "SELECT * FROM `iep_classes`
						WHERE `classTypeID` =".$_SESSION['iep_class_type']."
						AND `sessionID` =".$dat_get_session_current[0]."
						AND `level` IN (".$_SESSION['imp_gram_lev_dist'].")
						AND (section LIKE ".$_SESSION['sectionLike']."
						AND `status` =1
						ORDER BY `id` ASC ";
	echo $sql_wc_options;
	$res_wc_options = mysqli_query($progROLink, $sql_wc_options) or die ("Couldn't wc query.");
	WHILE ($rows=mysqli_fetch_array($res_wc_options)){
							
				$str_id = TRIM($rows["id"]);
				array_push($_SESSION['ary_class_options'], $str_id);		
											
			}
	mysqli_free_result($res_wc_options);
}
	*/



?>