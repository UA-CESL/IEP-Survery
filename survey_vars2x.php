
<?php
//get class info  $dat_info_class[3,4]  // level/section
include($_SESSION['pathLeader']."_sql/select/iep_survey/info_class.php");

//get class type info [$dat_info_classtype]  [1]//label
$_SESSION['iep_class_type'] = $dat_info_class[1];
include($_SESSION['pathLeader']."_sql/select/info_iep_class_type.php");

//get teacher of class $dat_info_classins[3]//netid
include($_SESSION['pathLeader']."_sql/select/info_class_instructor.php");
				
//get faculty name $dat_info_staff[4,3] //lastname, firstname
$str_net=$dat_info_classins[3];
$_SESSION['netid_faculty']=$dat_info_classins[3];
include($_SESSION['pathLeader']."_sql/select/info_staff_name.php");

$tbl_row_faces ="<tr>
<td style='text-align:center'><img src='../../_images/Smileys/Strongly Disagree.jpg' width='101' height='98' alt='strongly disagree' /><br />Strongly Disagree</td>
<td style='text-align:center'><img src='../../_images/Smileys/Disagree.jpg' width='101' height='98' alt='disagree' /><br />Disagree</td>
<td style='text-align:center'><img src='../../_images/Smileys/Agree.jpg' width='101' height='98' alt='agree' /><br />Agree</td>
<td style='text-align:center'><img src='../../_images/Smileys/Strongly Agree.jpg' width='101' height='98' alt='strongly agree' /><br />Strongly Agree</td>
</tr>";

////////////////////////////////////////////////////////////////////////////////
//create an array of all 999 that are in the classes that the person has chosen
IF($_SESSION['iep_class_type'] == 2)
	$_SESSION['ary_oc_studid']=array();
IF($_SESSION['iep_class_type'] == 1)
	$_SESSION['ary_g_studid']=array();
IF($_SESSION['iep_class_type'] == 3)
	$_SESSION['ary_r_studid']=array();
IF($_SESSION['iep_class_type'] == 4)
	$_SESSION['ary_wc_studid']=array();
	
	
	$sql_ary_studid = "SELECT DISTINCT studid FROM stud_schedule WHERE
							status = 1 AND
							programID IN (1,2) AND
							course_name LIKE '".$dat_info_classtype[1]."' AND
							sessionID = ".$_SESSION["var_session"]." AND
							`level` =".$dat_info_class[3]." AND
							section = '".$dat_info_class[4]."'";
	//echo $sql_ary_studid_oc;
	$res_ary_studid = mysqli_query($studROLink, $sql_ary_studid) or die ("Couldn't class type ".$_SESSION['iep_class_type']." studid query.");
	WHILE ($rows=mysqli_fetch_array($res_ary_studid)){
							
				$str_studid = TRIM($rows["studid"]);
				IF($_SESSION['iep_class_type'] == 2)
					array_push($_SESSION['ary_oc_studid'], $str_studid);
				ELSEIF($_SESSION['iep_class_type'] == 1)
					array_push($_SESSION['ary_g_studid'], $str_studid);
				ELSEIF($_SESSION['iep_class_type'] == 3)
					array_push($_SESSION['ary_r_studid'], $str_studid);
				ELSEIF($_SESSION['iep_class_type'] == 4)
					array_push($_SESSION['ary_wc_studid'], $str_studid);		
											
	}
	mysqli_free_result($res_ary_studid);
	//print_r($_SESSION['ary_oc_studid']);	
	
	IF($_SESSION['iep_class_type'] == 2)
		$_SESSION['imp_oc_studid'] = IMPLODE(",", $_SESSION['ary_oc_studid']);
	ELSEIF($_SESSION['iep_class_type'] == 1)
		$_SESSION['imp_g_studid'] = IMPLODE(",", $_SESSION['ary_g_studid']);
	ELSEIF($_SESSION['iep_class_type'] == 3)
		$_SESSION['imp_r_studid'] = IMPLODE(",", $_SESSION['ary_r_studid']);
	ELSEIF($_SESSION['iep_class_type'] == 4)
		$_SESSION['imp_wc_studid'] = IMPLODE(",", $_SESSION['ary_wc_studid']);
		
////////////////////////////////////////////////////////////////////////////////

?>