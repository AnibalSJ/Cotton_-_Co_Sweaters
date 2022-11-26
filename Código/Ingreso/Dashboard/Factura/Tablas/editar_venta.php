<?php

$idFactura= $_GET['idFactura'];
$conexion= mysqli_connect("localhost", "root", "", "cotton");

$sql = "SELECT f.idFactura, u.idUsuario, u.firstName, u.secondName, u.surname, u.secondSurname, u.phone, u.direccion, f.fecha, f.total FROM factura f INNER JOIN usuario u ON u.idUsuario = f.idUsuario WHERE idFactura = '$idFactura'";
$resultadoFactura = mysqli_query($conexion, $sql);
$factura = mysqli_fetch_assoc($resultadoFactura);

$consulta= "SELECT  df.idFactura, df.codigo, p.nameProducto, p.descripcion, p.precio, df.cantidad FROM detallefactura df INNER JOIN factura f ON f.idFactura = df.idFactura INNER JOIN producto p ON df.codigo = p.codigo WHERE f.idFactura= '$idFactura'";
$detalles = mysqli_query($conexion, $consulta);

$sqlUsuarios = "SELECT u.idUsuario, u.firstName, u.secondName, u.surname, u.secondSurname, u.phone, u.direccion FROM usuario u;";
$consultaUsuario = mysqli_query($conexion, $sqlUsuarios);

$sqlProductos = "SELECT p.codigo, p.nameProducto, p.precio FROM producto p";
$consultaProducto = mysqli_query($conexion, $sqlProductos);
<<<<<<< HEAD
=======

while($productos = $consultaProducto->fetch_assoc()){
    $arrayProductos[] = array(
            //$productos['codigo'] => array (
                'Código'=>$productos['codigo'],
                'Nombre'=>$productos['nameProducto'],
                'Precio'=>$productos['precio']
        );
}
//print_r($arrayProductos);
>>>>>>> origin/main
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>

    <link rel="icon" href="https://media.discordapp.net/attachments/1015677011961860167/1015677294016208906/Logo.png">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/es.css">
</head>

<body id="page-top">

<form  action="funciones_admin.php" method="POST">
<div id="login" >
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    
                            <br><br>
                            <h3 class="text-center">Editar Venta</h3>
                            <div class="form-group">
                                <label for="idUsuario" class="form-label">Cambiar usuario</label>
                                <select name="idUsuario" id="idUsuario" required>
                                    <option value="">Seleccione el usuario correspondiente</option>
                                    <?php while($row = $consultaUsuario->fetch_assoc())
                                            {
                                                $usuario = '"'.$row['idUsuario'].'"';
                                                echo "<option value=".$usuario; if ($row['idUsuario']==$factura['idUsuario']){ echo "selected"; };
                                                echo ">".$row['idUsuario']." - ".$row['firstName']." ".$row['secondName']." ".$row['surname']." ".$row['secondSurname']." - ".$row['phone']." - ".$row['direccion']."</option>";
                                            }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha</label><br>
                                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $factura['fecha'];?>"required>
                            </div>
                            
                            <div class="detallitos">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($detalles)){?>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <select name="codigos">
                                                    <option value="">Seleccione el producto correspondiente</option>
                                                    <?php //while($productos = $consultaProducto->fetch_assoc()){
                                                            foreach ($arrayProductos as $productos) {
                                                                $cod = "'".$productos[$row['codigo']]['Código']."'";
                                                                echo "<option value=".$cod; if ($productos['Código']==$row['codigo']){ echo "selected"; };
                                                                echo ">".$productos['Nombre']." - ".$productos['Precio']."</option>";
                                                            }
                                                    ?>
                                                </select>
                                            </td>
                                            
                                            <td><input type="text" id="" value="<?php echo $row['cantidad'] ?>"></td>
                                            <td><?php echo $row['precio']*$row['cantidad'] ?></td>
                                            <td>Eliminar</td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>Agregar</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="total" class="form-label">Total </label>
                                <input type="text"  id="total" name="total" class="form-control" value="<?php echo $factura['total'];?>" disabled required>
                            </div>
                        
                            <input type="hidden" name="accion" value="editar_registro">
                            <input type="hidden" name="idFactura" value="<?php echo $idFactura;?>">
                            </div>
                        
                           <br>
                                <div class="mb-3">
                                    
                                <button type="submit" class="btn btn-success" >Editar</button>
                               <a href="../factura.php" class="btn btn-danger">Cancelar</a>
                               
                            </div>
                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>