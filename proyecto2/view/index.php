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
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Francois+One&family=Lato:wght@300;700&family=Titan+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    
</head>
<body>
    <?php 

        include 'template/header.php';
     ?>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top " style=" background-color: #b91e1e;">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler d-lg-none text-white" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="collapsibleNavId">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white nav-item-text"  href="index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white nav-item-text" href="#">Productos</a>
                </li>
                <li class="nav-item">
                    <span style="color: yellow;"></span>
                    <a class="nav-link text-white nav-item-text" href="carritoview.php">Carrito
                        (<?php
                            if(empty($_SESSION['carrito'])){
                                echo '<span style="color: yellow;">0</span>';
                            }else{
                                echo '<span style="color: yellow;">';
                                echo count($_SESSION['carrito']);
                                echo '</span>';
                            }
                            
                        ?>)</a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle text-white nav-item-text" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Autenticarse</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Iniciar sesión</a>
                        <a class="dropdown-item" href="#">Registrarse</a>
                    </div>
                </li>
            </ul>
           
        </div>
    </nav>
      <br><br><br><br><br>
     -->
  
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
            
        

        <h1 class="text-center animate__animated animate__bounce" style="font-family:Amatic SC, sans-serif;font-weight: 600;">Productos</h1>
       
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
                    <div class="card animate__animated animate__fadeInDown animate__delay-1s">
                        <img class="card-img-top d-block mx-auto producto-item-img" src="'.$producto['productoimg'].'" alt="" >
                        <div class="card-body">
                            <h5 class="card-title text-center producto-item ">'.$producto['productonombre'].'</h5>
                            <p class="card-text text-center producto-item-precio">₡'.$producto['productoprecio'].'</p>
                                <div class="text-center">
        
                                    <form action="../business/carritoaction.php" method="POST">
                                        <input type="hidden" name="productoid" value="'.$producto['productoid'].'">
                                        <input type="hidden" name="productonombre" value="'.$producto['productonombre'].'">
                                        <input type="hidden" name="productoprecio" value="'.$producto['productoprecio'].'">
                                        <input type="hidden" name="productocantidad" value="1">
                                        <button class="btn btn-primary producto-item-boton" name ="agregar" type="submit">Agregar a carrito</button>
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
                <li class="page-item paginacion-item <?php echo $propiedad ?>"><a class="page-link" href="index.php?pagina=<?php echo    $_GET['pagina']-1 ?>">Anterior</a></li>
                <?php 
                    for($i = 1;$i <= $paginas;$i++){
                        if($_GET['pagina'] == $i){
                            echo '<li class="page-item paginacion-item active"><a class="page-link"  href="index.php?pagina='.$i.'">'.$i.'</a></li>';
                        }else{
                            echo '<li class="page-item paginacion-item"><a class="page-link"  href="index.php?pagina='.$i.'">'.$i.'</a></li>';
                        }
                        
                    }

                ?>
                <?php 
                 $propiedad = $_GET['pagina'] >= $paginas ? "disabled" : "" ;
                 ?>
                <li class="page-item paginacion-item <?php echo $propiedad ?>"><a class="page-link " href="index.php?pagina=<?php echo $_GET['pagina']+1 ?>">Siguiente</a></li>
            </ul>
        </nav>
            
        </div>
    </div>
        <?php include 'template/footer.php' ?>
   <!--  <section class="footer-copyright border-top py-3" style=" background-color: black;">
        <div class="container d-flex justify-content-center align-items-center">
            <p class="mb-0 producto-item-boton text-white"> © 2022 SO</p>

        </div>
    </section> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    



</body>
</html>