<?php

?>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #03204C;">
    <a class="navbar-brand" href="index.php">
        <!--<img src="v5/hojasTq/Ceti.png.webp" width="30" height="30" class="d-inline-block align-top" alt="">-->
        Inicio
        </a>
        <button class="btn btn-primary my-2 my-sm-0" id="btnLogin">Login</button>
</nav>

<script type="text/javascript">
    document.getElementById("btnLogin").onclick = function (){
        location.href = "views/login.php";
    };
</script>