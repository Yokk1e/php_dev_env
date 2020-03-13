<?php
    include('../database.php');

    $data = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'birthDate' => $_POST['birthDate'],
        'address' => $_POST['address'],
        'path_picture' => '17/1234'
    ];
    
    $stmt = $conn->prepare("INSERT INTO member('email', 'password', 'fname', 'lname', 'birth_date', 'address', 'picture') 
                            VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss",$data);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    
?>