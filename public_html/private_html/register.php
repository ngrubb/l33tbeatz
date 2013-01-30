<?php 
include ('../../private_html/myTeamConnect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>Registering</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>  

<body>  
<div id="main">
    <h1>Registering</h1>

<?php
if(!empty($_POST['email']))
{
    $email = mysql_real_escape_string($_POST['email']);
    $firstName = mysql_real_escape_string($_POST['firstName']);
    $lastName = mysql_real_escape_string($_POST['lastName']);
            //Gender
        if ($_POST['gender'] =='f') {
            $gender = "F";
        }

        else if ($_POST['gender'] =='m') {
            $gender = "M";
        }
    
	 $checkusername = mysql_query("SELECT * FROM User WHERE Email = '".$email."'");
     
     if(mysql_num_rows($checkusername) == 1)
     {
     	echo "<h1>Error</h1>";
        echo "<p>Sorry, that email is already in use. <a href=\"../login.html\">Please go back and try again.</a></p>";
     }
     else
     {
        $password = randomPassword();
        $hash = sha1($password);

     	$registerquery = mysql_query("INSERT INTO User (User_First_Name, User_Last_Name, Password, Email, Gender) VALUES('".$firstName."', '".$lastName."', '".$hash."', '".$email."', '".$gender."')");
        if($registerquery)
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

        	echo "<h1>Success</h1>";
        	echo "<p>Your account was successfully created. $password is your new password. Remember it and please <a href=\"../settings.php\">click here to login and change your password</a>.</p>";
        }
        else
        {
     		echo "<h1>Error</h1>";
        	echo "<p>Sorry, your registration failed. Please go back and try again.</p>";    
        }    	
     }
}

?>
</div>
</body>
</html>