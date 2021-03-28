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
* Verify the account details
**/
$loginService = \XF::app()->service('XF:User\Login', $name, $ip);
$success = $loginService->validate($pass);
if(!$success) {
    die('fail');
}

/**
* Successful login
**/
$columns = array("user_id", "username", "user_group_id", "secondary_group_ids");
$data = array();
foreach ($columns as $c) {
    $data[$c] = $user[$c];
}
if($success) {
    echo 'success';
}
}
?>
</body>
</html>
