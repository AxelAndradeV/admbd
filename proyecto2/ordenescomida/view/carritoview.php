<?php
    session_start(); 
    include '../business/productobusiness.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="collapsibleNavId">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carritoview.php">Carrito(0)</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Autenticarse</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Iniciar sesión</a>
                        <a class="dropdown-item" href="#">Registrarse</a>
                    </div>
                </li>
            </ul>
           
        </div>
    </nav>
    <br><br>
    
    <div class="container">
      
        <br>
        <h1>Lista de carrito</h1>
        <div class="alert alert-success" role="alert">
            
            <?php
                        if (isset($_GET['mensaje'])) {
                            echo $_GET['mensaje'];
                            
                            //echo $_GET['mensaje'];
                        } 
            ?>
           
        </div>
        
       
        <hr>
        <table class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th width="20%">ID</th>
                    <th width="15%" class="text-center">Nombre</th>                    
                    <th width="20%" class="text-center">Cantidad</th>
                    <th width="20%" class="text-center">Precio</th>
                    <th width="20%" class="text-center">Total</th>
                    <th width="5%">--</th>
                        
                </tr>
            </thead>
            <tbody>
                <?php 
                    $total = 0;
                    if(!empty($_SESSION['carrito'])){
                        foreach($_SESSION['carrito'] as $indice=>$producto){
                            
                            echo '<tr>
                                <td width="20%" class="text-center">'.$producto['productoid'].'</td>
                                <td width="15%" class="text-center">'.$producto['productonombre'].'</td>
                                <td width="20%" class="text-center">'.$producto['productocantidad'].'</td>
                                <td width="20%" class="text-center">'.$producto['productoprecio'].'</td>
                                <td width="20%" class="text-center">'.number_format($producto['productoprecio']*$producto['productocantidad']).'</td>
                                <td width="5%">
                                    <form action="../business/carritoaction.php" method="POST">
                                        <input type="hidden" name="productoid" value="'.$producto['productoid'].'">
                                        <button class="btn btn-danger" name="eliminar" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            
                                </tr>;';
                            $total+=$producto['productoprecio']*$producto['productocantidad'];
                        }
                    }else{
                    echo ' <div class="alert alert-success" role="alert">
                                No hay productos :c
                            </div>';
                    }
                    
                ?>
                
                <!-- <tr>
                    <td width="20%" class="text-center">2</td>
                    <td width="15%" class="text-center">2</td>
                    <td width="20%" class="text-center">2</td>
                    <td width="20%" class="text-center">2</td>
                    <td width="20%" class="text-center">2</td>
                    <td width="5%"><button class="btn btn-danger" type="button">Eliminar</button></td>
                </tr> -->
                    
                <tr>
                    <td colspan="4" style="text-align: right;" align="3"><h3>Total</h3></td>
                    <td align="3"><h3><?php echo number_format($total,2) ?></h3></td>
                    
                </tr>

                
            </tbody>
            <tr>
                <td colspan="6">
                     <form action="../business/ordenaction.php" method="POST">
                        <div class="alert alert-success">
                          <div class="form-group">
                            <label for="nombre">Ingrese su nombre: </label>
                            <input type="text" name="clientenombre" class="form-control">
                            <label for="telefono">Teléfono: </label>
                            <input type="number" name="clientetelefono" class="form-control">
                            <label for="email">Correo: </label>
                            <input type="email" name="clientecorreo" class="form-control">
                    
                            <label for="metodo">Método de pago: </label>
                            <select name="clientemetodo" class="form-control">
                                <option value="1">Efectivo</option>
                                <option value="2">Sinpe</option>
                                <option value="3">Tarjeta</option>
                            </select>
                           
                            <input style="margin-top: 1rem;" type="submit" class="btn btn-primary btn-lg btn-block" name="ordenar" value="Realizar orden">
                           </div>
                        </div>
                    </form>
                </td>
               
              
            </tr>
        </table>
         <tr>
                                       <?php
  // echo '<td><a href="cart.php?action=empty"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Vaciar carrito</button></a>&nbsp;<a href="foodlist.php"></td><button class="btn btn-warning">Seguir comprando</button></a>&nbsp;<a href="payment.php"><button class="btn btn-success pull-right"><span class="glyphicon glyphicon-share-alt"></span> Realizar orden</button></a>';
                    ?>
                </tr>
    <td></td>
           
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>