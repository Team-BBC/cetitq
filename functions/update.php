<?php
//update
!isset($_POST) ? die("Acceso denegado") :"";

require 'bakend.php';
$mes = new dbConnect();
$id_sustancia = $_POST['per'];
$nomb_sustancia = $_POST['sustancia'];
$nomb_sustancia = strtolower($nomb_sustancia);
$destinoBD = "$nomb_sustancia.pdf";

$oldName = getOldName($mes, $id_sustancia);

$st = $mes->mysqli->prepare("select * from htq_ficheros where sustancia=?");
$st->bind_param('s', $nomb_sustancia);
$st->execute();
$st->store_result();
if($st->num_rows()>0){
	echo"Este archivo ya existe en la base de datos.";
	$st->close();
	$mes->mysqli->close();
	exit();
}


if($_FILES['fichero']['name']!=null){
	//update name and new file incoming
	$file_name = $_FILES['fichero']['name'];
	$file_tmp = $_FILES['fichero']['tmp_name'];
	$acceptedarr = array("pdf");
	$extension = pathinfo($file_name, PATHINFO_EXTENSION);
	//do not forget to remove the old file. try to get the name with a select query before updating

	if(!in_array($extension, $acceptedarr)) {
		echo"Verifica que el archivo sea pdf";
	}else{
		$tempo = move_uploaded_file($file_tmp, "../ficheros/$file_name");
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
			$querys->close();
			echo "Error al subir el archivo";
		}
		$mes->mysqli->close();
	}
	
}else{
	//only update name
	try{
		//rename

		//$oldFileDir =  "<a href='../ficheros/".$oldName.".pdf'>$oldName</a>\n";
		//$newFileDir = "<a href='../ficheros/".$nomb_sustancia.".pdf'>$nomb_sustancia</a>\n";
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
					echo "<a href='ficheros/$oldName'";
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


function getOldName($mes, $id_sustancia): string
{
	$oldName="";
	$stmt = $mes->mysqli->prepare('select sustancia from htq_ficheros where id=?');
	$stmt->bind_param('i', $id_sustancia);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows > 0){
		$stmt->bind_result($oldName);	
		$stmt->fetch();
	}else{
		echo"Error al conseguir id, intente de nuevo";
	}
	$stmt->close();
	return $oldName;
}


function archivados(){
	/*this function is inted to be used so that the files that are updated do not get removed and use the eliminated char in the database for show or not.*/
}


/* 
$query = $mes->mysqli->prepare("update htq_ficheros set sustancia=?, url=?, fecha=NOW() where id=?");
		$query->bind_param('ssi', $nomb_sustancia, $destinoBD, $id_sustancia);	
		if(rename("/ficheros/$oldName.pdf", "/ficheros/$nomb_sustancia.pdf") && $query->execute()){
			$result= $query->affected_rows;
			if($result > 0){
				$query->close();
				$mes->mysqli->close();
				header("Location:../admin.php");
			}else{
				$query->close();
				$mes->mysqli->close();
				echo "Error al actualizar nombre";
			}
		}else{
			$query->close();
			$mes->mysqli->close();
			echo $oldName;
			$stmt->close();
			//echo"Error al renombrar el archivo o ejecutado de update clause ";
		}
		*/

		/*

$stmt = $mes->mysqli->prepare("select * from htq_ficheros where id =?");
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


*/