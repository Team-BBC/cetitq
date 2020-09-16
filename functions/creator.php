<?php

require "bakend.php";
$myObj = new dbConnect();

!isset($_POST) ? die("Access denied") : "";

if(isset($_POST['ok'])){
    //variables
    $nombre = $_POST['nombre'];
    $file_name = $_FILES['fichero']['name'];
    $file_tmp = $_FILES['fichero']['tmp_name'];
    //convertir a minusculas
    $nombre = strtolower($nombre);
    $destinoBD = "$nombre.pdf";

    $acceptedarr = array("pdf");
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);

    //consulta si ya existe la sustancia
    $stmt = $myObj->mysqli->prepare('select * from htq_ficheros where sustancia = ?');
    $stmt->bind_param('s', $nombre);

    $stmt->execute();

    $result = $stmt->get_result();
    $row =$result->fetch_assoc();

    if($row!=null){
        $stmt->close();
        die('Este archivo ya existe');
    }else{
        $stmt->close();
        //verifica si es un archivo pdf
        if(!in_array($extension, $acceptedarr)){
            echo"Verifica que sea .pdf";
        }else{
            //si mueve el archivo con exito, sube a la base de datos.
            if(move_uploaded_file($file_tmp, "../ficheros/".$file_name)){
                $query = $myObj->mysqli->prepare('insert into htq_ficheros(sustancia, url, fecha) values(?, ?, NOW())');
                $query->bind_param('ss', $nombre, $destinoBD);
                $query->execute();
                $result= $query->affected_rows;
                if ($result > 0){
                    header("Location:../admin.php");        
                }else{
                    echo '<script type="text/javascript"> alert("Error al subir archivo"); </script> ';
                }
            }else{
                echo 'Error al copiar archivo en /ficheros';                
            }
        }
    }
}
?>