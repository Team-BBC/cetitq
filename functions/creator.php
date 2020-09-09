<?php

require "bakend.php";
$myObj = new dbConnect();

!isset($_POST) ? die("Access denied") :"";

if(isset($_POST['ok'])){
    $nombre = $_POST['nombre'];
    $archivoRecibido = $_FILES['fichero']['name'];
    $destino = "../ficheros/$nombre.pdf";
    $destinoBD = "$nombre.pdf";

    $acceptedarr = array("pdf");
    $extension = pathinfo($archivoRecibido, PATHINFO_EXTENSION);
    if(!in_array($extension, $acceptedarr)){
        echo"Verifica que sea .pdf";
    }else{
        $stmt = $myObj->mysqli->prepare('select * from document where sustancia = ?');
        $stmt->bind_param('s', $nombre);

        $stmt->execute();

        $result = $stmt->get_result();
        $row =$result->fetch_assoc();

        if($row!=null){
            die('Este archivo ya existe');
            header("Location:../admin.php");
        }else{
            $stmt = $myObj->mysqli->prepare('insert into document(sustancia, url, fecha) values(?, ?, NOW())');
            $stmt->bind_param('ss', $nombre, $destinoBD);

            $stmt->execute();
            $result= $stmt->affected_rows;
            if ($result > 0){
                if(move_uploaded_file($archivoRecibido, $destino)){
                    echo '<script>console.log("hi, file uploaded")</script>';
                    header("Location:../admin.php");
                }
            }else{
                echo '<script type="text/javascript"> alert("Error al subir archivo"); </script> ';
            }
        }
        header("Location:../admin.php");
    }
    


}

?>