<?php

$userLog = fopen("../../logs/login-log.log","a");
print_r($userLog);
  $text = date("Y-m-d H:m:s")."\t".
          "\t".
          $_SERVER['HTTP_HOST'].
          $_SERVER['REQUEST_URI'].
          "\t".get_client_ip()."\n";
  fwrite($userLog,$text);
  fclose($userLog);
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