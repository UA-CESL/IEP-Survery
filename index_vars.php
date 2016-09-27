<?php
$ary_lang = array();
$sql_sel_dist_lang = "SELECT DISTINCT langID FROM iep_survey_questions_responses WHERE status = 1 AND langID!=1025";
$res_sql_dist_lang = mysqli_query($progROLink, $sql_sel_dist_lang) or die ("Couldn't dist lang query.");
WHILE ($rows=mysqli_fetch_array($res_sql_dist_lang)){
		
		$strLang = TRIM($rows['langID']);	
		array_push($ary_lang, $strLang);					
}
mysqli_free_result($res_sql_dist_lang);



?>