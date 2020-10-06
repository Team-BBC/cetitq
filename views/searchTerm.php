<?php
if(!$_POST){
    exit('no tienes acceso permitido a este archivo, busca algo');
}
include "../functions/bakend.php";
$myObj = new dbConnect();

$likeSustancia = $_POST["search"];
?>
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
			<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #03204C;">
				<a class="navbar-brand" href="../index.php">
					<!--<img src="v5/hojasTq/Ceti.png.webp" width="30" height="30" class="d-inline-block align-top" alt="">-->
					Inicio
					</a>
					<button class="btn btn-primary my-2 my-sm-0" id="btnLogin">Login</button>
			</nav>

			<script type="text/javascript">
				document.getElementById("btnLogin").onclick = function (){
					location.href = "login.php";
				};
			</script>
				<nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Busqueda</li>
                    </ol>
                </nav>
				<!--barra de busqueda & resultados-->
	        	<form action="#" method="post">
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
												$myObj->uSearch($likeSustancia);
	                                    	?>
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