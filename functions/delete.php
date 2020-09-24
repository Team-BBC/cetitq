<?php
!isset($_POST) ? die("Acceso denegado") :"";
require 'bakend.php';
$con = new dbConnect();

//DELETE
$id_sustancia = $_POST['id'];

$query = $con->mysqli->prepare("select sustancia from htq_ficheros where id=?");
$query->bind_param('i', $id_sustancia);
$query->execute();
$query->bind_result($nombre_sustancia);
$query->fetch();
$query->close();

$stmt = $con->mysqli->prepare("delete from htq_ficheros where id=?");
$stmt->bind_param("i", $id_sustancia);
//errases the file from dir
if(unlink("../ficheros/$nombre_sustancia.pdf") && $stmt->execute()){
	$stmt->close();
	$con->mysqli->close();
	header("Location:../admin.php");
}else{
	echo "error al eliminar el archivo o borrar de la base de datos.";
}
?>