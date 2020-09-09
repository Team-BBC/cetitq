<?php
require "bakend.php";
$myObj = new dbConnect();
session_start();

$usuario = $_POST['username'];
$password = $_POST['password'];
$stmt = $myObj->mysqli->prepare('select * from users where username = ? and password=?');
$stmt->bind_param('ss', $usuario, $password);


$stmt->execute();

$result = $stmt->get_result();
$row =$result->fetch_assoc();

if($row!=null){
    $stmt->close();
    $_SESSION['username'] = $usuario;
    header("location: ../admin.php");
}else{
    echo"Datos Incorrectos";
}
$myObj->mysqli->close();
?>