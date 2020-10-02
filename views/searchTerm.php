<?php
if(!$_POST){
    exit('no tienes acceso permitido a este archivo, busca algo');
}
include "../functions/bakend.php";
$myObj = new dbConnect();
?>
<?php
$likeSustancia = $_POST['search'];
echo $likeSustancia;

    $stmt = $myObj->mysqli->prepare("select sustancia from htq_ficheros where sustancia like'%?%' limit 15");
    $stmt->bind_param('s', $likeSustancia);
    $stmt->execute();
    $stmt->bind_result($nombSustancia);

    while($stmt->fetch()){
        //table content
        $datosTabla = "";
        $datosTabla = $datosTabla.'<tr>
        <td >'.$nombSustancia.'</td>
        <td class="text-center">
            <span class="btn btn-info btn-sm ">                      
            <a href = "../ficheros/'.$nombSustancia.'.pdf" target="_blank">
                <img src="imagenes/descargar.png">
            </a>
            </span>
        </td>
        </tr>';   
        echo $datosTabla;
    }
    echo "</table>";
    $stmt->close();
    $myObj->mysqli->close();


?>
<?php
/*
<!DOCTYPE html>
<html>
	<head>
		<!--favicon-->
		<link rel="shortcut icon" type="image/webp" href="../imagenes/Ceti.png.webp"/>
	    <!-- Required meta tags -->
	    <meta name="robots">
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    
	    <!-- Bootstrap CSS and js libraries -->
	    <?php
	        require_once "../libraries/libraries.php";
	    ?>


	    <title>Hojas de Seguridad</title>
	</head>

	<body style="background-image: url(imagenes/bg.png);">
		<div id="wrap">
			<!--main page-->
			<div id="content">
				<?php
					include "navbar.php";
				?>
				<nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Busqueda</li>
                    </ol>
                </nav>
				<!--barra de busqueda & resultados-->
	        	<form action="../functions/search.php" method="post">
	                <div class="form-group text-center">
	                    <input class="form-control m-auto mt-1" style="width: 60%;" type="text" name="search" placeholder="Escribe una Sustancia" required/>
	                    <input type="submit" value="Buscar">
	                </div>
	            </form>     
	            <div class="container">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card text-left">
	                            <div class="card-header">
	                                <ul class="nav nav-tabs card-header-tabs">
	                                    <li class="nav-item">
	                                        <p>Resultados</p>
	                                    </li>
	                                </ul>
	                            </div>
	                            <div class="card-body">
	                                <div class="row">
	                                    <div class="col-sm-12 m-auto">
											<?php 
												$myObj->uPlaceTableHeader();
	                                    		$myObj->display();
	                                    	?>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
			</div>
			
			
		</div> <!--termina contenido-->
		<!--footer-->
		<?php require 'footer.php';?>
	</body>
</html>
*/?>