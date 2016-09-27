<?php session_start(); // start up your PHP session! ?>

<?php //include("index_sec.php"); ?>

<?php include("_vars.php"); ?>

<?php //include("index_vars.php"); ?>

<?php include($_SESSION['pathLeader']."_inc/_header.php"); ?>

<?php //include("index_js.js"); ?>

<?php //include("start_val.php"); ?>

<?php include($_SESSION['pathLeader']."_func/_func.php"); ?>

<?php include($_SESSION['pathLeader']."../ffutsterces/_appdbconnect.php"); ?>

<?php //include($_SESSION['pathLeader']."_inc/_dbconnect.php"); ?>

<?php //include("_ariadne.php"); ?>

<?php include("thx_form.php"); ?>

<?php include($_SESSION['pathLeader']."_inc/_dbclose.php"); ?>

<?php include($_SESSION['pathLeader']."_inc/_footer.php"); ?>

<?php
//USED TO CLEAR VAR, START FRESH
session_destroy(); 
?>

