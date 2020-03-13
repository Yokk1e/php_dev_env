<?php
include('../../database.php');
$file_name = upload_check($_FILES['picture']);
$members = [
    $_POST['email'],
    md5($_POST['password']),
    $_POST['fname'],
    $_POST['lname'],
    $_POST['birthDate'],
    $_POST['address'],
    $file_name
];
$stmt = $conn->prepare("INSERT INTO member(email,password,fname,lname,birthDate,address,picture)
                        VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param('sssssss',...$members);
$stmt->execute();
$stmt->close();

$userLog = fopen("../../logs/register-log.log","a");
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
function upload_check($images_files){
    $target_dir = "../../images/";
    $target_file = $target_dir . basename($images_files["name"]);
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($images_files)) {
        $check = getimagesize($images_files["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check file size
    // if ($images_files["size"] > 500000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    }else {
        $file_name = uniqid(rand(), true).'.'.$imageFileType;
        if (move_uploaded_file($images_files["tmp_name"], $target_dir.$file_name)) {
            echo "The file ". basename( $images_files["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return $file_name;
}

?>