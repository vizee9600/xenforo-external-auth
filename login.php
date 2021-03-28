<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="style.css" />
<link rel="shortcut icon" href="favicon.png" type="img/png">
</head>
<body>
<?php
require('src/XF.php');
if (isset($_REQUEST['username'])){
    $name = stripslashes($_REQUEST['username']);
    $pass = stripslashes($_REQUEST['password']);

XF::start($fileDir);

/**
* Checks if user is banned
*/
$finder = \XF::finder('XF:User');
$user = $finder->where('username', $name)->fetchOne();
if($user->is_banned) {
    die('Banned.');
}
    
/**
* Gets the user info & checks the password
**/
$loginService = \XF::app()->service('XF:User\Login', $name, $ip);
$success = $loginService->validate($pass);
    
/**
* Login failed
**/
if(!$success) {
    die('fail');
}

/**
* Successful login
**/
if($success) {
    echo 'success';
}
}
?>
</body>
</html>
