
<!--/////////////////////DIV 2/////////////////////////////////-->
<div align="center">
<FORM name="survey_form" id="survey_form" action="survey_val.php" method="post" accept-charset="utf-8">
<center>
<!-- TABLE 1 -->
<table class="no_bp" style="width: 750px" align="center">

<tr><th colspan="4"><?php echo $dat_info_classtype[1];?> Course Survey for <?php echo $dat_info_staff[4].", ".$dat_info_staff[3]." (ClassID ".$_SESSION['iep_class_id'].")"; ?></th></tr>
	
    <?php $cnt_question=1;?>


<?php
/*//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////SELF/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////*/
?>

    <tr class="no_b" bgcolor="#CCCCCC">
		<td colspan="4"><strong>About yourself</strong></td>
	</tr>   
    
<?php    
	$_SESSION['ary_questions_self'] = array();
	
    $sql_sel_ques_self = "SELECT * FROM `iep_survey_questions` 
    		WHERE `questionArea` LIKE 'self'
			AND `status` =1
			ORDER BY `questionID` ASC ";
	$res_sel_ques_self = mysqli_query($progROLink, $sql_sel_ques_self) or die ("Couldn't self questions info query.");		
	WHILE ($rows_self_ques=mysqli_fetch_array($res_sel_ques_self)){
		
			$questionID = TRIM($rows_self_ques["id"]);
		    array_push($_SESSION['ary_questions_self'],$questionID);
			
			//get other lang questions
			$var_question_lang = '';
			IF($_SESSION['survey_language']!=1025){
				include($_SESSION['pathLeader']."_sql/select/iep_survey/info_question_lang.php");					
				$var_question_lang = "<br />".$dat_info_question_lang[3];
			}
		    			
			echo "<tr class='no_b'><td colspan='4'><strong>Question ".$cnt_question++.". </strong>".TRIM($rows_self_ques[3]).$var_question_lang."</td></tr>";
		
			//for the grades question
			IF($questionID==22){			
				echo "<tr><td colspan='4'><table>";
				
					echo $tbl_row_grades; //created on survey_var2			
				
				echo "<tr>";
					echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='5' onchange='rad_survey_check()' /></td>";
					echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='4' onchange='rad_survey_check()' /></td>";
					echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='3' onchange='rad_survey_check()' /></td>";
					echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='2' onchange='rad_survey_check()' /></td>";
					echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='1' onchange='rad_survey_check()' /></td>";
				echo "</tr>";
				
				echo "</table></td></tr>";
				
				echo "<tr><td colspan='4' style='text-align:center'><p><HR /></p></td></tr>";
			
			
			}
			ELSE{
			echo $tbl_row_faces; //created on survey_var2
		
			echo "<tr>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='1' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='2' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='3' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='4' onchange='rad_survey_check()' /></td>";
			echo "</tr>";
			
			echo "<tr><td colspan='4' style='text-align:center'><p><HR /></p></td></tr>";
			}
	}
    mysqli_free_result($res_sel_ques_self);
    
    ?>






    
    
<?php
/*//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////TEACHER///////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////*/
?>

   
    <tr class="no_b" bgcolor="#CCCCCC">
		<td colspan="4"><strong>About the teacher</strong></td>
	</tr>
    
<?php    
	$_SESSION['ary_questions_teacher'] = array();
	
    $sql_sel_ques_class = "SELECT * FROM `iep_survey_questions` 
    		WHERE `questionArea` LIKE 'teacher'
			AND `status` =1
			ORDER BY `questionID` ASC ";
	$res_sel_ques_class = mysqli_query($progROLink, $sql_sel_ques_class) or die ("Couldn't class.questions info query.");		
	WHILE ($rows_class_ques=mysqli_fetch_array($res_sel_ques_class)){
		
			$questionID = TRIM($rows_class_ques["id"]);
		    array_push($_SESSION['ary_questions_teacher'],$questionID);
			
			//get other lang questions
			$var_question_lang = '';
			IF($_SESSION['survey_language']!=1025){
				include($_SESSION['pathLeader']."_sql/select/iep_survey/info_question_lang.php");					
				$var_question_lang = "<br />".$dat_info_question_lang[3];
			}
		    
			echo "<tr class='no_b'><td colspan='4'><strong>Question ".$cnt_question++.". </strong>".TRIM($rows_class_ques[3]).$var_question_lang."</td></tr>";
		
			echo $tbl_row_faces; //created on survey_var2
		
			echo "<tr>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='1' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='2' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='3' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='4' onchange='rad_survey_check()' /></td>";
			echo "</tr>";
			
			echo "<tr><td colspan='4' style='text-align:center'><p><HR /></p></td></tr>";
	}
    mysqli_free_result($res_sel_ques_class);
    
    ?>


    
<?php
/*//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////COMMENTS//////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////*/
$var_question_lang = '';
IF($_SESSION['survey_language']!=1025){
	$sql_info_question_lang = "SELECT * FROM `iep_survey_questions_translations` WHERE 
										status = 1 AND 
										`questionID` =17 AND
										langID = ".$_SESSION['survey_language'];
	//echo $sql_info_question_lang;
	$res_info_question_lang = mysqli_query($progROLink, $sql_info_question_lang) or die ("Couldn't survey lang quest query.");
	$dat_info_question_lang = mysqli_fetch_row($res_info_question_lang);
	mysqli_free_result($res_info_question_lang);
	$var_question_lang = "<br />".$dat_info_question_lang[3];
}
?> 

    <tr class="no_b" bgcolor="#CCCCCC">
		<td colspan="4"><strong>Comments for <?php echo $dat_info_staff[4].", ".$dat_info_staff[3]; ?> </strong></td>
	</tr>
    
    <tr class='no_b'><td colspan='4'><strong>Question 12.</strong> Something I liked about this class was..... (optional)<?php echo $var_question_lang;?></td></tr>
    <tr class='no_b'><td colspan='4'>
    	<textarea cols="150" rows="5" name="17"></textarea>
    </td></tr>
    
<?php
$var_question_lang = '';
IF($_SESSION['survey_language']!=1025){
	$sql_info_question_lang = "SELECT * FROM `iep_survey_questions_translations` WHERE 
										status = 1 AND 
										`questionID` =18 AND
										langID = ".$_SESSION['survey_language'];
	//echo $sql_info_question_lang;
	$res_info_question_lang = mysqli_query($progROLink, $sql_info_question_lang) or die ("Couldn't survey lang quest query.");
	$dat_info_question_lang = mysqli_fetch_row($res_info_question_lang);
	mysqli_free_result($res_info_question_lang);
	$var_question_lang = "<br />".$dat_info_question_lang[3];
}
?>   

    <tr class='no_b'><td colspan='4'><strong>Question 13.</strong> What suggestions do you have for the teacher? (optional)<?php echo $var_question_lang;?></td></tr>
    <tr class='no_b'><td colspan='4'>
    	<textarea cols="150" rows="5" name="18"></textarea>
    </td></tr>
    
        
    <tr><td colspan="4" style="text-align:center"><p>&nbsp;</p></td></tr>    

<?php
/*/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////CLASS////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////*/
?>
    
    <tr class="no_b" bgcolor="#CCCCCC">
		<td colspan="4"><strong>About the class</strong></td>
	</tr>
    
<?php    
	$_SESSION['ary_questions_class'] = array();
    $sql_sel_ques_class = "SELECT * FROM `iep_survey_questions` 
    		WHERE `questionArea` LIKE 'class'
			AND `status` =1
			ORDER BY `questionID` ASC ";
	$res_sel_ques_class = mysqli_query($progROLink, $sql_sel_ques_class) or die ("Couldn't class.questions info query.");		
	WHILE ($rows_class_ques=mysqli_fetch_array($res_sel_ques_class)){
		
			$questionID = TRIM($rows_class_ques["id"]);
		    array_push($_SESSION['ary_questions_class'],$questionID); //this is used on the val page
			
			
			//get other lang questions
			$var_question_lang = '';
			IF($_SESSION['survey_language']!=1025){
				include($_SESSION['pathLeader']."_sql/select/iep_survey/info_question_lang.php");					
				$var_question_lang = "<br />".$dat_info_question_lang[3];
			}
			 
			echo "<tr class='no_b'><td colspan='4'><strong>Question 14.</strong> ".TRIM($rows_class_ques[3]).$var_question_lang."</td></tr>";
		
			echo $tbl_row_faces; //created on survey_var2
		
			echo "<tr>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='1' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='2' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='3' onchange='rad_survey_check()' /></td>";
				echo "<td style='text-align:center'><input type='radio' name='".$questionID."' id='".$questionID."' value='4' onchange='rad_survey_check()' /></td>";
			echo "</tr>";
	}
    mysqli_free_result($res_sel_ques_class);
	
    
    ?>

    
 
<tr><td colspan="4" style="text-align:center"><p>&nbsp;</p></td></tr> 
<tr><td colspan='4' style='text-align:center'><p><HR /></p></td></tr>
<tr><td colspan="4" style="text-align:center"><input type="submit" value="Done" id="submit_survey" disabled="disabled" /></td></tr> 
<tr><td colspan="4" style="text-align:center"><hr /></td></tr> 

</table>
<!-- END TABLE 1 -->
 

   </center>
</form>

</div>