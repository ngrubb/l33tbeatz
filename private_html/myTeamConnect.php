<?php
/* ----------------------------------------------------------------------------
  Continue Session or send user to login page if they have not logged in
*/
session_start();

// if ($_SESSION['LoggedIn'] != 1){
//     header ('Location: ../public_html/login.html');
// }

/* ----------------------------------------------------------------------------
  File establishes a connection and selects the correct database and adds 
  functions available to every web page.
*/
DEFINE(	'DB_USER',     'l33tbeatz');
DEFINE(	'DB_PASSWORD', 'drum5');
DEFINE(	'DB_HOST',     'camelot.cs.messiah.edu');
DEFINE(	'DB_NAME',     'l33tbeatz');

$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or
        die('Could not connect to the correct database management system. <br /><br />
            Please contact Team L33tBEATz as soon as possible.');

mysql_select_db(DB_NAME) or
        die('Could not select the correct database. <br /><br /> 
            Please contact Team L33tBEATz as soon as possible.');
        
/* ----------------------------------------------------------------------------
  Function for escaping data
*/
function escape_data($data) {
    global $dbc;

    if(ini_get('magic_quotes_gpc')) {
        $data = stripslashes($data);
    }

    # Check for mysql_real_escape_string support

    if (function_exists('mysql_real_escape_string')) {
        $data = mysql_real_escape_string(trim($data), $dbc);
    }else {
        $data = mysql_escape_string(trim($data), $dbc);
    }

    return $data;
}

function close_connection($dbc){
	mysql_close($dbc);
}

/* ----------------------------------------------------------------------------
    Generate Random Password Function
*/
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); 
}


?>