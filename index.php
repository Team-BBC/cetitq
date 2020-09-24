<?php
	include "functions/bakend.php";
	$myObj = new dbConnect();
?>


<!DOCTYPE html>
<html>
	<head>
		<!--favicon-->
		<link rel="shortcut icon" type="image/webp" href="imagenes/Ceti.png.webp"/>
	    <!-- Required meta tags -->
	    <meta name="robots">
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    
	    <!-- Bootstrap CSS and js libraries -->
	    <?php
	        require_once "libraries/libraries.php";
	    ?>
	    <link rel= "stylesheet"  type="text/css"  href="libraries/stylesheet.css"/>


	    <title>Hojas de Seguridad</title>
	</head>

	<body style="background-image: url(imagenes/bg.png);">
		<div id="wrap">
			<!--main page-->
			<div id="content">
				<?php
					include "views/navbar.php";
				?>
				<div class = "text-center text-light mt-5" style="width: 100%;"> 
	                <h2>
	                    <label >Division de Tecnologias Quimicas</label>
	                </h2>
	                <h3 > 
	                    <label>hojas de Seguridad</label>
	                </h3>
	            </div>

				<!--barra de busqueda & resultados-->
	        	<form method="post">
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
		<?php require 'views/footer.php';?>
	</body>
</html>