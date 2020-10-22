<?php
!isset($_POST) ? die("Acceso denegado") :"";
require "bakend.php";
$myObj = new dbConnect();
session_start();


$usuario = $_POST['username'];
$password = $_POST['password'];
$stmt = $myObj->mysqli->prepare('select password from htq_users where username = ?');
$stmt->bind_param('s', $usuario);
$stmt->execute();
$stmt->bind_result($contra);
$stmt->fetch();
$stmt->close();

if(password_verify($password, $contra)){
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
