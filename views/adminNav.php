<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #03204C;">
    <a class="navbar-brand" href="index.php">
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
        location.href = "functions/saliendo.php";
    };
</script>