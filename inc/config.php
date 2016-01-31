<?php

// // server info
// $server = 'localhost';
// $user = 'root';
// $pass = '';
// $db = 'punks';

// // connect to the database
// $mysqli = new mysqli($server, $user, $pass, $db);

// // show errors (remove this line if on a live site)
// mysqli_report(MYSQLI_REPORT_ERROR);

 $db = ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", ""));  
 if (!$db) { 
 die("<p style='color:#646464;font-size:10px;'>Database connection failed miserably: </p>" . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))); 
 } 
 echo "<p style='color:#646464;font-size:10px;'>Connected to database | "; 
 $db_select = ((bool)mysqli_query($db, "USE " . 'punks')); 
 if (!$db_select) { 
 die("<p style='color:#646464;font-size:10px;'>Database selection also failed miserably: </p>" . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
 } 
 echo "Connected to punks</p>"; 

$mysqli = mysqli_connect("localhost","root","","punks"); 

?>