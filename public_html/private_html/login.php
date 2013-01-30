<?php 
include ('../../private_html/myTeamConnect.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Process</title>
</head>

<body>
<h1>Login</h1>
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Email']))
{
	 header ('Location: ../library.php');
}

elseif(!empty($_POST['email']) && !empty($_POST['password']))
{
	$email = mysql_real_escape_string($_POST['email']);
    $password = sha1(mysql_real_escape_string($_POST['password']));

	$checklogin = mysql_query("SELECT * FROM User WHERE Email = '".$email."' AND Password = '".$password."'");

    if(mysql_num_rows($checklogin) == 1)
    {
        $_SESSION['LoggedIn'] = 1;
        $user = mysql_query("SELECT * FROM User WHERE Email = '".$email."' ");
    	$row = mysql_fetch_array($user);
        $email = $row['Email'];

        //Set session variables
        $_SESSION['Email'] = $email;
        $_SESSION['FirstName'] = $row['User_First_Name'];
        $_SESSION['LastName'] = $row['User_Last_Name'];
        $_SESSION['Gender'] = $row['Gender'];        


        header ('Location: ../library.php');
        
    }
    
    else
    {
    	echo "<h1>Error</h1>";
        echo "<p>Sorry, your account could not be found. 
        Please <a href=\"../login.html\">click here to try again</a>.</p>";
    }
}
?>

</body>
</html>