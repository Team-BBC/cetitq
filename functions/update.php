<?php
//update
!isset($_POST) ? die("Acceso denegado") :"";
header('Content-Type: text/html; charset=UTF-8');
require 'bakend.php';
$mes = new dbConnect();
$id_sustancia = $_POST['per'];
$nomb_sustancia = $_POST['sustancia'];
$nomb_sustancia = strtolower($nomb_sustancia);
$destinoBD = "$nomb_sustancia.pdf";

$oldName = getOldName($mes, $id_sustancia);

$bandera = false;
if ($oldName == $nomb_sustancia && $_FILES['fichero']['name']!=null){
	$bandera = modifyPDFOnly($nomb_sustancia, $mes, $bandera);
}



if($_FILES['fichero']['name']!=null && !$bandera){
	//update name and new file incoming
	nameFileUpdate($nomb_sustancia, $destinoBD, $id_sustancia, $mes, $oldName);
}else{
	//only update name
	nameUpdate($mes, $nomb_sustancia, $destinoBD, $id_sustancia, $oldName);
}


//function that modifies the pdf only
function modifyPDFOnly($nomb_sustancia, $mes){
	$file_name = $_FILES['fichero']['name'];
	$file_tmp = $_FILES['fichero']['tmp_name'];
	$acceptedarr = array("pdf");
	$extension = pathinfo($file_name, PATHINFO_EXTENSION);

	if(!in_array($extension, $acceptedarr)) {
		echo"Verifica que el archivo sea pdf";
	}else{
		$tempo = move_uploaded_file($file_tmp, "../ficheros/$nomb_sustancia.pdf");
		if($tempo){
			header("Location: ../admin.php");
			$mes->mysqli->close();
		}else{
			echo "Error al modificar el archivo";
		}
	}
	return true;
}


function getOldName($mes, $id_sustancia)
{
	$oldName="";
	$stmt = $mes->mysqli->prepare('select sustancia from htq_ficheros where id=?');
	$stmt->bind_param('i', $id_sustancia);
	$stmt->execute();
	$stmt->bind_result($oldName);
	if($stmt->fetch()){
		echo $oldName;
	}else{
		echo"Error al conseguir id, intente de nuevo";
	}
	$stmt->close();
	return $oldName;
}

//function that modifies only the name 
function nameUpdate($mes, $nomb_sustancia, $destinoBD, $id_sustancia, $oldName){
	try{
		//rename
		$query = $mes->mysqli->prepare("update htq_ficheros set sustancia=?, url=?, fecha=NOW() where id=?");
		$query->bind_param('ssi', $nomb_sustancia, $destinoBD, $id_sustancia);
		//$temp = rename("../ficheros/$oldName.pdf", "../ficheros/$nomb_sustancia.pdf");

		if(rename("../ficheros/$oldName.pdf", "../ficheros/$nomb_sustancia.pdf")){
			if($query->execute()){
				$query->close();
				$mes->mysqli->close();
				echo"Archivo modificado con exito";
				header("Location:../admin.php");
			}else{
				$query->close();
				$mes->mysqli->close();
				if(rename("/ficheros/$nomb_sustancia.pdf", "/ficheros/$oldName.pdf")){
					echo"Volver a modificar hubo un error";
				}else{
					echo"El archivo no se subio a la base de datos pero se modifico el nombre del archivo\n para que no existan errores con este pdf volver a descargarlo y agregar como un nuevo registro";
					echo "<a href='ficheros/$oldName'>archivo</a>";
				}
			}
		}else{
			echo "Error al modificar el pdf";
		}
		$mes->mysqli->close();
	}catch(mysqli_sql_exception $e){
		$query->close();
		$mes->mysqli->close();
		echo"Error al consultar el url para renombrar ".$e;
	}
}

//function that modifies the name and the pdf file
function nameFileUpdate($nomb_sustancia, $destinoBD, $id_sustancia, $mes, $oldName){
	
	$file_name = $_FILES['fichero']['name'];
	$file_tmp = $_FILES['fichero']['tmp_name'];
	$file_name = strtolower($file_name);
	$acceptedarr = array("pdf");
	$extension = pathinfo($file_name, PATHINFO_EXTENSION);

	if(!in_array($extension, $acceptedarr)) {
		echo"Verifica que el archivo sea pdf";
	}else{
		$tempo = move_uploaded_file($file_tmp, "../ficheros/$nomb_sustancia.pdf");
		if($tempo){
			$querys = $mes->mysqli->prepare("update htq_ficheros set sustancia=?, url=?, fecha=NOW() where id=?");
			$querys->bind_param('ssi', $nomb_sustancia, $destinoBD, $id_sustancia);
			$querys->execute();
			if($querys->affected_rows > 0){
				// archivados();
				unlink("../ficheros/$oldName.pdf");
				$querys->close();
				header("Location:../admin.php");
			}else{
				echo "error al crear la consulta a la base de datos";
				unlink("../ficheros/$file_tmp");
			}
		}else{
			echo "Error al subir el archivo";
		}
		$mes->mysqli->close();
	}
}