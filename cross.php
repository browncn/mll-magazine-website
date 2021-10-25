<?php 
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Access-Control-Allow-Headers: Content-Type');

echo 'hello world!!! cross was successful. yay!!!!!!!!!!!!!<br>Here comes the new challenger!!!!';

setcookie($name, $value, [
    'expires' => time() + 86400,
    'path' => '/',
    'domain' => 'domain.com',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'None',
]);

?>