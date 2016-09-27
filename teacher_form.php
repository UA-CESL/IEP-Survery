
<!--/////////////////////DIV 2/////////////////////////////////-->
<div align="center">
<FORM name="teacher_form" id="teacher_form" action="survey.php" method="post">
<center>
<!-- TABLE 1 -->
<table class="no_bp" style="width: 750px" align="center">

<tr><th colspan="4"><?php echo $dat_info_classtype[1];?> Course Survey</th></tr>
	
    
    <tr class="no_b" bgcolor="#CCCCCC">
		<td colspan="4">Please choose your <?php echo $dat_info_classtype[1];?> teacher below</td>
	</tr>
    
    <tr><td colspan="4" style="text-align:center"><p>&nbsp;</p></td></tr>    
    <tr><td colspan="4"><h3><?php echo $dat_info_classtype[1];?></h3></td></tr> 
    
    <?php
	$ary_cnt = COUNT($_SESSION['ary_class_options']);
	FOR($i_cnt_opt=0; $i_cnt_opt<$ary_cnt; $i_cnt_opt++){
		
		$sql_sel_class = "SELECT a.*, b.netid FROM iep_classes a 
							JOIN iep_class_instructors b ON a.id=b.classID 
							WHERE a.id = ".$_SESSION['ary_class_options'][$i_cnt_opt];
		$res_sel_class = mysqli_query($progROLink, $sql_sel_class) or die ("Couldn't class info query.");
		WHILE ($rows_class=mysqli_fetch_array($res_sel_class)){
							
				$str_id = TRIM($_SESSION['ary_class_options'][$i_cnt_opt]);
				$str_lev = TRIM($rows_class["level"]);
				$str_sec = TRIM($rows_class["section"]);	
				$str_net = TRIM($rows_class["netid"]);	
				
				//code to deliniate levels
				IF($i_cnt_opt==0){
					$lev_new = $str_lev;
						echo "<tr><td colspan='4'><h4>Level ".$lev_new."</h4></td></tr> ";
				}
				ELSE {
					IF($lev_new != $str_lev){
						$lev_new = $str_lev;
						//echo "<tr><td colspan='4' style='text-align:center'><hr /></td></tr> ";
						echo "<tr><td colspan='4'><h4>Level ".$lev_new."</h4></td></tr> ";
					}
				}
				
				//get faculty name $dat_info_staff[4,3]
				include($_SESSION['pathLeader']."_sql/select/info_staff_name.php");
				
				//get faculty photo link
				$path_photo = "https://ceslapp.arizona.edu/_images/faculty/".$str_net.".jpg";
				
				//check if enough surveys have already been done for this class, max=20
				//set class max at number of students in class +2
				include($_SESSION['pathLeader']."_sql/select/iep_survey/info_class_cnt.php");				
				$class_max=$dat_cnt_class[0]+2;
				$class_max=30;
				
				$sql_cnt_classresponses = "SELECT COUNT(*) FROM iep_survey_responses WHERE status = 1 AND classID = ".$str_id;
				$res_cnt_classresponses  = mysqli_query($progROLink, $sql_cnt_classresponses) or die ("Couldn't class cnt query.");
				$dat_cnt_classresponses = mysqli_fetch_row($res_cnt_classresponses);
				mysqli_free_result($res_cnt_classresponses);
				
				IF($dat_cnt_classresponses[0]/8<=$class_max){
					echo "<tr valign='middle'>";
						echo "<td><input type='radio' name='class_selection' id='class_selection' value='".$str_id."' onchange='rad_teacher_check()'  /></td>";
						//echo "<td><input type='radio' name='class_selection' value='".$str_id."' />".$str_id."</td>";
						echo "<td><strong>Level/Section:</strong> ".$str_lev.$str_sec." </td>";
						echo "<td><strong>Teacher:</strong> ".$dat_info_staff[4].", ".$dat_info_staff[3]."</td>";
						echo "<td><a href='".$path_photo."' target='_blank'><img src='".$path_photo."' width='50' height='50' /></a></td>";
					echo "</tr>";	
				}
											
			}						
	}
	echo "<tr><td colspan='4' style='text-align:center'><p>&nbsp;</p></td></tr> ";
//	IF($_SESSION['iep_class_type']!=2){
		echo "<tr valign='middle' bgcolor='#CCCCCC'>";
			echo "<td><input type='radio' name='class_selection' id='class_selection' value='0' onchange='rad_teacher_check()'  /></td>";
			echo "<td colspan='3'>I did not have a <strong>".$dat_info_classtype[1]."</strong> class this session <strong>OR</strong> my teacher is not in the list above.</td>";
		echo "</tr>";
//	}
    
 ?>
<tr><td colspan="4" style="text-align:center"><p>&nbsp;</p></td></tr> 
<tr><td colspan="4" style="text-align:center"><hr /></td></tr> 
<tr><td colspan='4' style='text-align:center'><input type='submit' value='Next' id='submit_teacher' disabled='disabled' /></td></tr>
<?php /* IF($ary_cnt>0) 
	echo "<tr><td colspan='4' style='text-align:center'><input type='submit' value='Next' id='submit_teacher' disabled='disabled' /></td></tr>";
	ELSE 
	echo "<tr><td colspan='4' style='text-align:center'><input type='submit' value='Next' id='submit_teacher' /></td></tr>";
*/ ?>
    
<tr><td colspan="4" style="text-align:center"><hr /></td></tr> 

</table>
<!-- END TABLE 1 -->
 

   </center>
</form>

</div>