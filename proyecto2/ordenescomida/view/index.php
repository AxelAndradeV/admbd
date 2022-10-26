<?php 
session_start();
include '../business/productobusiness.php';

$contador = 0;
$cantidadPorPagina = 12;
$productoBusiness = new ProductoBusiness();
$paginas = $productoBusiness->getTotalProductos();





?>

<?php 
    if(!$_GET){
        header('Location: index.php?pagina=1');
    } 


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
                    <a class="nav-link" href="carritoview.php">Carrito(
                        <?php
                            if(empty($_SESSION['carrito'])){
                                echo 0;
                            }else{
                                echo count($_SESSION['carrito']);
                            }
                            
                        ?>
                                                )</a>
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
    <br><br><br><br><br>
    <div class="container">
    
        
            
        <?php
                    if (isset($_GET['mensaje'])) {
                        if($_GET['mensaje']=="exito"){
                            echo '<div class="alert alert-success" role="alert">';
                            echo '<a href="carritoview.php" class="badge badge-success">Ver carrito</a>';
                            echo '</div>';
                        }else if($_GET['mensaje']=="repetido"){
                            echo '<div class="alert alert-success" role="alert">';
                            echo 'Ya ha sido agregado :c';
                            echo '</div>';
                        }
                        
                        //print_r($_SESSION['carrito']);
                        //echo $_GET['mensaje'];
                    } 
        ?>
            
        

       
        <div class="row d-flex justify-content-center">

            <?php 
                
                $inicio = ($_GET['pagina']-1)*$cantidadPorPagina;
                
                $productos = $productoBusiness->getPaginasProducto($inicio, $cantidadPorPagina );

                //print_r($productos);

                foreach($productos as $producto){
                //     echo '<div class="col3 mx-3 mt-3">
                //     <div class="card">
                //         <img class="card-img-top" src="'.$producto['productoimg'].'" alt="" width="100" height="200">
                //         <div class="card-body">
                //             <h5 class="card-title">'.$producto['productonombre'].'</h5>
                //             <p class="card-text">'.$producto['productoprecio'].'</p>
                //             <div class="text-center">
                //                 <button class="btn btn-primary " type="button">Agregar a carrito</button>
                //             </div>
                            
                //         </div>
                //     </div>
                // </div>';
                    echo '<div class="col3 mx-3 mt-3">
                    <div class="card">
                        <img class="card-img-top" src="'.$producto['productoimg'].'" alt="" width="100" height="200">
                        <div class="card-body">
                            <h5 class="card-title">'.$producto['productonombre'].'</h5>
                            <p class="card-text">'.$producto['productoprecio'].'</p>
                                <div class="text-center">
        
                                    <form action="../business/carritoaction.php" method="POST">
                                        <input type="hidden" name="productoid" value="'.$producto['productoid'].'">
                                        <input type="hidden" name="productonombre" value="'.$producto['productonombre'].'">
                                        <input type="hidden" name="productoprecio" value="'.$producto['productoprecio'].'">
                                        <input type="hidden" name="productocantidad" value="1">
                                        <button class="btn btn-primary " name ="agregar" type="submit">Agregar a carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                    $contador++;
                }

              $paginas = ceil($paginas/$cantidadPorPagina);
            ?>

            
           <!--  <div class="col3 mx-3 mt-3">
                <div class="card">
                    <img class="card-img-top" src="https://assets.stickpng.com/thumbs/5882488ae81acb96424ffaaf.png" alt="" width="100" height="200">
                    <div class="card-body">
                        <h5 class="card-title">Title</h5>
                        <p class="card-text">Content</p>
                        <div class="text-center">

                            <form action="../business/test.php" method="POST">
                                <input type="text" name="productoid" value="">
                                <input type="text" name="productonombre" value="">
                                <input type="text" name="productoprecio" value="">
                                <input type="text" name="productocantidad" value="1">
                                <button class="btn btn-primary " name ="agregarCarrito" type="submit">Agregar a carrito</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div> -->


            
            

          
            </div>
           
                        
            <nav>

              <ul class="pagination  justify-content-center mt-4">
                <?php $propiedad = $_GET['pagina'] <= 1 ? "disabled" : "" ; ?>
                <li class="page-item <?php echo $propiedad ?>"><a class="page-link" href="index.php?pagina=<?php echo    $_GET['pagina']-1 ?>">Anterior</a></li>
                <?php 
                    for($i = 1;$i <= $paginas;$i++){
                        if($_GET['pagina'] == $i){
                            echo '<li class="page-item active"><a class="page-link"  href="index.php?pagina='.$i.'">'.$i.'</a></li>';
                        }else{
                            echo '<li class="page-item"><a class="page-link"  href="index.php?pagina='.$i.'">'.$i.'</a></li>';
                        }
                        
                    }

                ?>
                <?php 
                 $propiedad = $_GET['pagina'] >= $paginas ? "disabled" : "" ;
                 ?>
                <li class="page-item <?php echo $propiedad ?>"><a class="page-link " href="index.php?pagina=<?php echo $_GET['pagina']+1 ?>">Siguiente</a></li>
            </ul>
        </nav>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    


</body>
</html>