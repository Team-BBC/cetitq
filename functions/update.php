<?php
//update
!isset($_POST) ? die("Acceso denegado") :"";

require 'bakend.php';
$mes = new dbConnect();
$id_sustancia = $_POST['id'];
$nomb_sustancia = $_POST['sustancia'];
$file_name = $_FILES['fichero']['name'];
$file_tmp = $_FILES['fichero']['tmp_name'];

$nomb_sustancia = strtolower($nomb_sustancia);
$destinoBD = "$nomb_sustancia.pdf";
$acceptedarr = array("pdf");
$extension = pathinfo($file_name, PATHINFO_EXTENSION);

$stmt = $mes->mysqli->prepare("select * from htq_ficheros where sustancia =?");
$stmt->bind_param('s', $nomb_sustancia);
$stmt->execute();


$result = $stmt->get_result();
$row =$result->fetch_assoc();

if($row!=null){
	$stmt->close();
	die('Esta sustancia ya existe');
}else{
	$stmt->close();
	if (!in_array($extension, $acceptedarr)) {
		echo"Verifica que el archivo sea pdf";
	}else{
		if(move_uploaded_file($file_tmp, "../ficheros/".$file_name)){
			$query = $mes->mysqli->prepare("update htq_ficheros set sustancia=?, url=?, fecha=NOW() where id=?");
			$query->bind_param('ssi', $nomb_sustancia, $destinoBD, $id_sustancia);
			$query->execute();
			$result = $query->affected_rows;
			if($result>0){
				header("Location:../admin.php");
			}else{
				echo"Error al subir archivo a la base de datos";
			}
		}else{
			echo 'Error al copiar archivo en /ficheros';
		}
	}
}

?>