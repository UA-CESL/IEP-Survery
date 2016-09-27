<?php
//get the posted classid var
$_SESSION['iep_class_id'] = TRIM(strip_tags($_POST['class_selection']));
//$_SESSION['iep_class_id'] = $_POST['class_selection'];
//echo $_SESSION['iep_class_id'];

	//redirect if course is not >0
	//if the class = 0, then it's because the student chose they didn't have teh class of the teacher was not listed above.
	//IF($_SESSION['iep_class_id']==0){
	IF($_SESSION['iep_class_id']<1){
		$_SESSION['hd_completed']=$_SESSION['iep_class_type'];
		printf("<script>location.href='teacher.php'</script>");
	}


?>