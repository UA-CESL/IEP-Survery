<?php include($_SESSION['pathLeader']."_sql/select/info_session_current.php"); ?>

<?php 
$_SESSION["var_session"] = $dat_get_session_current[0];
$_SESSION["var_session"] = 109; //hard coded
include($_SESSION['pathLeader']."_sql/select/info_session.php");?>


<!--/////////////////////DIV 2/////////////////////////////////-->
<div align="center">
<FORM name="index_form" id="index_form" action="teacher.php" method="post">
<center>
<!-- TABLE 1 -->
<table class="no_bp" style="width: 750px" align="center">

<tr><th colspan="2">IEP Course Survey for <?php echo $dat_info_session[10]." ".$dat_info_session[1]; ?></th></tr>
	
    
    <tr class="no_b" bgcolor="#CCCCCC">
		<td colspan="2">Thank you for taking this survey. Your thoughtful responses will help us improve the class we offer.</td>
	</tr>
    
    <tr><td colspan="2" style="text-align:center">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p><hr /></p>
    				Choose your <strong>Oral Communication</strong> Class level:<br />
                    <em>for Part-Time students, choose your most common level</em> <br />
                    <select name="dd_oclevel" id="dd_oclevel" onchange="dd_oclevel_check()">
                    	<option value=""></option>  
                    <?php
						//get distinct levels of OC for session
						$sql_dist_level = "SELECT DISTINCT level FROM iep_classes
											WHERE sessionID = ".$_SESSION["var_session"]."
											AND status = 1
											AND classTypeID = 2
											ORDER BY level ASC";
						$res_dist_level = mysqli_query($progROLink, $sql_dist_level) or die ("Couldn't dist oc query.");
						WHILE ($rows=mysqli_fetch_array($res_dist_level)){
							
							$strLev = TRIM($rows['level']);
							
							//echo "<option value='".$strLev."'>".$strLev."</option>";
	  						echo "<option value = '".$strLev."'>".$strLev."</option> \n";
							
						}
						mysqli_free_result($res_dist_level);
						
						
						

					?>                    
                  </select> 
                  
    <p>&nbsp;</p>
    <p>&nbsp;</p>
                  
                  Choose a language for you survey:<br />
                   <select name="dd_language" id="dd_language" >
                   		<option value="1025">English</option>
                   
                   <?php  FOR($i_lang=0; $i_lang<COUNT($ary_lang); $i_lang++){
                   		
						//get language	label		   
				   			$var_lang = $ary_lang[$i_lang];
							include($_SESSION['pathLeader']."_sql/select/info_ref_lang.php");
				   
				   			echo "<option value='".$ary_lang[$i_lang]."'>".$dat_info_lang[1]."</option>";
						
				   }?>
                   </select>
                  
    <p>&nbsp;</p>
    <p>&nbsp;</p>
                  
                  
               
    
                      
                
            <!--   DISABLED UNTIL NEXT TIME  -->        
   
    <input type="submit" value="Next" name="start_submit" id="start_submit"  /> <!--disabled="disabled"  />
 
                 
                  <!-- <strong>THIS SESSION'S COURSE EVALUATIONS ARE CLOSED.</strong>-->
                 
    <p><hr /></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    
    </td></tr>

</table>
<!-- END TABLE 1 -->

 


   </center>
</form>

</div>