<?php
session_start();
if(isset($_SESSION['username'])){
    header("location: ../admin.php");
}
?>
<!DOCTYPE html>
<head>

    <meta charset = "utf-8"/>
     <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            
    <!-- Bootstrap CSS -->
    <?php include"../libraries/libraries.php"?>
    <title> Inicio de Sesion</title>

</head>
<body style="background-image: url(../imagenes/bg.png);" >

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #03204C;">
            <a class="navbar-brand" href="index.php">
                <!--<img src="v5/hojasTq/Ceti.png.webp" width="30" height="30" class="d-inline-block align-top" alt="">-->
                Inicio
                </a>
        </nav>  
         <div class="container rounded" style="background: white; width: 80%;margin-top: 50px;" >
            <form class ="text-center " style="margin-top: 40px" action="../functions/loggear.php" method="POST">
                <div class="form-group mx-auto h2" style="width: 60%;margin-top: 40px">
                    <label for="text">Nombre de usuario</label>
                    <input type="text" class="form-control text-center" style="margin-top: 22px" placeholder="Ingresa su usuario" name="username">
                </div>
                <div class="form-group mx-auto h2" style="width: 60%;margin-top: 20px">
                    <label for="pwd">Contraseña</label>
                    <input type="password" class="form-control text-center"style="margin-top: 22px" placeholder="Ingrese su contraseña" name="password">
                </div >
                <div class="form-group mx-auto " style="width: 60%;margin-top: 20px">
                    <button id="login" type="submit" class="btn btn-primary" style="margin-top: 35px;margin-bottom: 30px" >Entrar</button>
                </div>
                
            </form> 
            <script src="script.js"></script>
        </div>        
        
        
    </div>

    <!--footer -->

    

</body>