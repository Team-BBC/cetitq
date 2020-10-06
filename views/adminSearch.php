<?php
session_start();
$usuario = $_SESSION['username'];    
if(!isset($usuario)){
    header("location: views/login.php");
}
require "../functions/bakend.php";
$myObj = new dbConnect();

$searchWord = $_POST['search'];
?>

<!DOCTYPE html>
<html>
<head>
        <!--favicon-->
        <link rel="shortcut icon" type="image/png" href="../imagenes/manetologo1.png"/>
        <!-- Required meta tags -->
        <meta name="robots" content="noindex">
        
        <!-- Bootstrap CSS and js libraries -->
        <?php
            require '../libraries/libraries.php';
        ?>
        
        <title> Administrador </title>
        
    </head>
    <body style="background-image: url(imagenes/bg.png);">
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #03204C;">
                <a class="navbar-brand" href="../index.php">
                    <!--<img src="v5/hojasTq/Ceti.png.webp" width="30" height="30" class="d-inline-block align-top" alt="">-->
                    Inicio
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="badge badge-info">Bienvenido <?php $usuario = $_SESSION['username']; echo $usuario;?></div>
                    </li>
                </ul>
                <button class="btn btn-primary my-2 my-sm-0" id="btnSalir">Salir</button>
            </nav>

            <script type="text/javascript">
                document.getElementById("btnSalir").onclick = function (){
                    location.href = "../functions/saliendo.php";
                };
            </script>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../admin.php">AdminPage</a></li>
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
                                                $myObj->aPlaceTableHeader();
                                                $myObj->aSearch($searchWord);
	                                    	?>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>

        </div><!--Termina Contenido-->        
        <!--Pie de Pagina-->
        <?php
            require 'modalDelete.php';
            require 'newModalUpdate.php';
        ?>
        <script src="../script.js"></script>

        <?php require'footer.php';?>
    </body>
</html>