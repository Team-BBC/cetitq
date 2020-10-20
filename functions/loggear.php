<?php
!isset($_POST) ? die("Acceso denegado") :"";
require "bakend.php";
$myObj = new dbConnect();
session_start();

$usuario = $_POST['username'];
$password = $_POST['password'];
$stmt = $myObj->mysqli->prepare('select * from htq_users where username = ? and password=?');
$stmt->bind_param('ss', $usuario, $password);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows()==1){
    $_SESSION['username'] = $usuario;
    header("Location: ../admin.php");
    $stmt->close();
    $myObj->mysqli->close();
    exit;
}else{
    echo "Datos no coinciden con un usuario";
}
$stmt->close();
$myObj->mysqli->close();
