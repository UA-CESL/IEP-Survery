<?php session_start(); // start up your PHP session! ?>

<?php //include("index_sec.php"); ?>

<?php include("_vars.php"); ?>

<?php include("survey_vars.php"); ?>

<?php include($_SESSION['pathLeader']."_inc/_header.php"); ?>

<?php include("survey_js.js"); ?>

<?php //include("start_val.php"); ?>

<?php include($_SESSION['pathLeader']."_func/_func.php"); ?>

<?php include($_SESSION['pathLeader']."../ffutsterces/_appdbconnect.php"); ?>

<?php include("survey_vars2.php"); ?>

<?php //include($_SESSION['pathLeader']."_inc/_dbconnect.php"); ?>

<?php include("survey_form.php"); ?>

<?php include($_SESSION['pathLeader']."_inc/_dbclose.php"); ?>

<?php include($_SESSION['pathLeader']."_inc/_footer.php"); ?>



