<?php
require_once ("../../../DB/db.php");
// error_reporting(0);
session_start();

$idUsuario = $_SESSION['idUsuario'];
$docType = $_SESSION['docType'];

if(!isset($_SESSION['idUsuario'])){
    header('Location: ../../index.php');

}
$consul="SELECT * FROM persona WHERE id_persona = '$idUsuario'";
$consult=mysqli_query($DB,$consul);

$sql = mysqli_query($DB,"SELECT * FROM producto");
$row = mysqli_num_rows($sql);

$rows=mysqli_fetch_array($consult);
include "añadir.php";
// session_unset();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a2ea5c7b4d.js" crossorigin="anonymous"></script><!-- IMPORTACION DE FONTAWESOME -->
    <link rel="stylesheet" href="CSS/carrito.css"><!-- IMPORTACION DE ESTILOS -->
    <link rel="icon" href="https://media.discordapp.net/attachments/1015677011961860167/1015677294016208906/Logo.png">
    <title>Carrito de compras</title>
</head>

<body>
    <div class="cabeza">
        <a href="../Usu_Per/index.php"><i class="fa-solid fa-person-walking-arrow-right" style="font-size: 40px;margin: 0 0 0 20px !important;cursor: pointer;text-decoration: none;"></i></a>
        <h1>Bienvenido <?php echo $rows['firstName']; ?> a Cotton & Co Sweaters</h1>
        <input id="searchbar" type="text" name="search" placeholder="Search">
    </div>
    <div class="container-productos">
        <?php
            if($row>0){
                while($data = mysqli_fetch_array($sql)){
                    if($data['idEstado']==1){
                    ?>
                        <form action="" method="post">
                        <div class="carta" id="carta">
                            <center><img class="imagen" src="data:image/jpg;base64, <?php echo base64_encode($data['imagen']) ?>"></center>
                            <hr>
                            <input type="hidden" class="nombreSearch" name="nameProducto" id="" value="<?php echo $data['nameProducto'] ?>">
                            <input type="hidden" name="codigo" id="" value="<?php echo $data['codigo'] ?>">
                            <input type="hidden" name="precio" id="" value="<?php echo $data['precio'] ?>">
                            <p class="Producto"><?php echo $data['nameProducto']; ?></p>
                            <p><?php echo $data['descripcion'] ?></p>
                            <p><?php echo "$",$data['precio'] ?></p>
                            <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="<?php echo $data['stock'] ?>">    
                            <input type="submit" name="btnAccion" id="añadir" value="Añadir">
                        </div>
                    </form>
                    <?php
                    }
                }
            }
        ?>

        <div class="slider-lateral">
            <i class="fa-solid fa-cart-shopping" id="carrito"></i>
            <div class="carrito-productos">
                <center><h1>Productos</h1></center>
                <table id="tabla">
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total de la compra</th>
                    </tr>
                    <?php if(!empty($_SESSION['carrito'])) { ?>
                        <div class="container-pedidos">    
                            <?php $total=0; ?>
                            <?php foreach($_SESSION['carrito'] as $indice=>$productos){ ?>
                                <div class="productos">
                                    <tr>
                                        <td><?php echo $productos['nameProducto']; ?></td>
                                        <td><?php echo $productos['cantidad']; ?></td>
                                        <td><?php echo "$".$productos['precio']; ?></td>
                                        <td><?php echo "$".($productos['cantidad']*$productos['precio']); ?></td>
                                    </tr>
                                    <?php $total=$total+($productos['cantidad']*$productos['precio']); 
                                    $_SESSION['total'] = $total;
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                        <tr>
                            <td colspan="3"><center>Total</center></td>
                            <!-- <td><?php //echo number_format($total,2) ?></td> -->
                            <td><?php echo "$".$total ?></td>
                        </tr>
                        <form action="" method="post">
                            <input type="submit" name="btnVaciar" id="vaciar" value="Vaciar">
                            <input type="submit" name="btnComprar" id="comprar" value="Comprar">
                        </form>
                    <?php } else{
                        echo "El carrito esta vacio";
                    } ?>
                </table>
            </div>
        </div>
        <script src="script/carrito.js"></script>
    </body>
<script>
    const barra = document.getElementById('searchbar');
    
    barra.addEventListener('keyup',()=>{
        const search = document.getElementById('searchbar').value;
        const x = document.getElementsByClassName('carta');
        const producto = document.getElementsByClassName('Producto');
        let valor = search.toLowerCase();

        for(i = 0; i < x.length; i++){
            if(producto[i].innerHTML.toLowerCase().includes(valor)){
                x[i].style.display = "block";
            }else{
                x[i].style.display = "none";
            }
        }
    })
</script>
</html>