
<?php
//get class info  $dat_info_class[3,4]  // level/section
include($_SESSION['pathLeader']."_sql/select/iep_survey/info_class.php");

//////////////////////////////////////////////////////////////////

	//ICC redirect, set at 0 on teacher_vars
	IF($dat_info_class[3]>3)
		$_SESSION["ICC_redirect"] = 1;
//	IF($dat_info_class[3]==4)
//		$_SESSION["ICC_redirect"] = 1;

//////////////////////////////////////////////////////////////////

//get class type info [$dat_info_classtype]  [1]//label
$_SESSION['iep_class_type'] = $dat_info_class[1];
include($_SESSION['pathLeader']."_sql/select/info_iep_class_type.php");

//get teacher of class $dat_info_classins[3]//netid
include($_SESSION['pathLeader']."_sql/select/info_class_instructor.php");
				
//get faculty name $dat_info_staff[4,3] //lastname, firstname
$str_net=$dat_info_classins[3];
$_SESSION['netid_faculty']=$dat_info_classins[3];
include($_SESSION['pathLeader']."_sql/select/info_staff_name.php");


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
	
	
	$sql_ary_studid = "SELECT DISTINCT studid FROM stud_iep_classes WHERE classID = ".$_SESSION['iep_class_id'];
	//echo $sql_ary_studid_oc;
	$res_ary_studid = mysqli_query($studROLink, $sql_ary_studid) or die ("Couldn't class type ".$_SESSION['iep_class_type']." studid query.");
	WHILE ($rows=mysqli_fetch_array($res_ary_studid)){
							
				$str_studid = TRIM($rows["studid"]);				
					array_push($_SESSION['class_studids'], $str_studid);
				
				IF($_SESSION['iep_class_type'] == 2)
					array_push($_SESSION['ary_oc_studid'], $str_studid);
					
				IF($_SESSION['iep_class_type'] == 1)
					array_push($_SESSION['ary_g_studid'], $str_studid);
					
				IF($_SESSION['iep_class_type'] == 3)
					array_push($_SESSION['ary_r_studid'], $str_studid);
					
				IF($_SESSION['iep_class_type'] == 4)
					array_push($_SESSION['ary_wc_studid'], $str_studid);												
	}
	mysqli_free_result($res_ary_studid);
//	print_r($_SESSION['class_studids']);	
	
	//clear out dups from array
	$_SESSION['unique_studids'] = array_unique($_SESSION['class_studids']); 	
	$_SESSION['imp_unique_studids'] = IMPLODE(",", $_SESSION['unique_studids']);
	
//	print_r($_SESSION['imp_unique_studids']);	
	
	IF($_SESSION['iep_class_type'] == 2)
		$_SESSION['imp_oc_studid'] = IMPLODE(",", $_SESSION['ary_oc_studid']);
		
	IF($_SESSION['iep_class_type'] == 1)
		$_SESSION['imp_g_studid'] = IMPLODE(",", $_SESSION['ary_g_studid']);
		
	IF($_SESSION['iep_class_type'] == 3)
		$_SESSION['imp_r_studid'] = IMPLODE(",", $_SESSION['ary_r_studid']);
		
	IF($_SESSION['iep_class_type'] == 4)
		$_SESSION['imp_wc_studid'] = IMPLODE(",", $_SESSION['ary_wc_studid']);
	
////////////////////////////////////////////////////////////////////////////////
//GET SURVEY RESPONSE LANGUAGE
$r1= "Strongly Disagree";
$r2= "Disagree";
$r3= "Agree";
$r4= "Strongly Agree";

IF($_SESSION['survey_language']!=1025){
	include($_SESSION['pathLeader']."_sql/select/info_iep_survey_resp.php");
	$r1 = htmlspecialchars($dat_info_responses[2], ENT_NOQUOTES, 'UTF-8');
	$r2 = htmlspecialchars($dat_info_responses[3], ENT_NOQUOTES, 'UTF-8');
	$r3 = htmlspecialchars($dat_info_responses[4], ENT_NOQUOTES, 'UTF-8');
	$r4 = htmlspecialchars($dat_info_responses[5], ENT_NOQUOTES, 'UTF-8');
}


$tbl_row_faces ="<tr>
<td style='text-align:center'><img src='../../_images/Smileys/Strongly Disagree.jpg' width='101' height='98' alt='strongly disagree' /><br />".$r1."</td>
<td style='text-align:center'><img src='../../_images/Smileys/Disagree.jpg' width='101' height='98' alt='disagree' /><br />".$r2."</td>
<td style='text-align:center'><img src='../../_images/Smileys/Agree.jpg' width='101' height='98' alt='agree' /><br />".$r3."</td>
<td style='text-align:center'><img src='../../_images/Smileys/Strongly Agree.jpg' width='101' height='98' alt='strongly agree' /><br />".$r4."</td>
</tr>";

$tbl_row_grades ="<tr><td colspan='4'>&nbsp;</td></tr>
<tr>
	<td style='text-align:center'><font size='+5'>A</font><br /></td>
	<td style='text-align:center'><font size='+5'>B</font><br /></td>
	<td style='text-align:center'><font size='+5'>C</font><br /></td>
	<td style='text-align:center'><font size='+5'>D</font><br /></td>
	<td style='text-align:center'><font size='+5'>E</font><br /></td>
</tr>
<tr><td colspan='4'>&nbsp;</td></tr>";

?>

