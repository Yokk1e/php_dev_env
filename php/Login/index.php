<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="login.css">
<?php
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
  // echo $_SERVER['HTTP_HOST']."<br>";
  // echo $_SERVER['REQUEST_URI']."<br>";
  // echo $_SERVER['QUERY_STRING'];
  
  $userId = 4;
  $sql = "SELECT * FROM member WHERE username ='$_POST[username]' and password = '$_POST[password]'";
  $userLog = fopen("user-log.log","a");
  $text = date("Y-m-d H:m:s")."\t".
          $userId."\t".
          $_SERVER['HTTP_HOST'].
          $_SERVER['REQUEST_URI'].
          " | ".$sql." | ".
          "\t".get_client_ip()."\n";
  fwrite($userLog,$text);
  fclose($userLog);

?>
</head>
<body>

<h2>Member management</h2>
<a onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</a>
<a href="<?php echo 'account/v_register.php'?>">Register</a>

<div id="id01" class="modal">
  <form class="modal-content animate" action="index.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="do_it.jpg" alt="Avatar" class="avatar">
    </div>
    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <button type="submit">Login</button>
    </div>
  </form>
</div>

<script>
var modal = document.getElementById('id01');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>

