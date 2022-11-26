<?php
include('../catalogo/global/conexion.php');

session_start();

$idUsuario = $_SESSION['idUsuario'];

if(!isset($_SESSION['idUsuario'])){
    header('Location: ../../index.php');

}
$tabUsu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM usuario WHERE idUsuario = '$idUsuario'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Perfil de usuario Cotton & Co Sweaters</title>
    <script src="https://kit.fontawesome.com/be71717483.js" crossorigin="anonymous"></script>
</head>

<body>
   
    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <div class="perfil-usuario-avatar">
                <i class="fa-regular fa-user" ></i>
                    </button>
                </div>

            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo"><?php echo $tabUsu['firstName']," ", $tabUsu['surname']; ?></h3>
                
            </div>
            <div class="perfil-usuario-footer">
                <ul class="lista-datos">
                <a href="../index.php"> <i class="fa-solid fa-user"></i> Perfil</a>
                <a href=""><i class="fa-solid fa-bag-shopping"></i>  compras</a>
                <a href=""><i class="fa-solid fa-heart"></i>  Favoritos</a>
                <a href=""><i class="fa-sharp fa-solid fa-door-closed"></i></i>  Cerrar</a>
                        </ul>
            </div>

            <div class="container-references">
                <img src="" alt="">
            </div>
            <div class="redes-sociales">
                <a href="" class="boton-redes facebook fab fa-facebook-f"><i class="icon-facebook"></i></a>
                <a href="" class="boton-redes twitter fab fa-twitter"><i class="icon-twitter"></i></a>
                <a href="" class="boton-redes instagram fab fa-instagram"><i class="icon-instagram"></i></a>
            </div>
        </div>
    </section>

</body>

</html>