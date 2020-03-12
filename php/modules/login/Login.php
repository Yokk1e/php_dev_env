<?php
include('../../database.php');
session_start();

$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$password = md5($password);

$sql = "SELECT * FROM member WHERE email = $email AND password = $password";
$result = mysqli_query($conn,$sql);

$userLog = fopen("../../logs/login-log.log","a");
$text = date("Y-m-d H:m:s")."\t".
        "\t".
        $_SERVER['HTTP_HOST'].
        $_SERVER['REQUEST_URI'].
        " | ".$sql." | ".
        "\t".get_client_ip()."\n";
  fwrite($userLog,$text);
  fclose($userLog);
  header("location:../search/v_search.php");
if(!$result){
  echo "Email and Password Incorrect!";
}else{
  $_SESSION['UserID'] = $result['id'];
  session_write_close();
  header("location:../search/v_search.php");
}
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
    else
    $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>