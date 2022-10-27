<?php 
	session_start();
	include 'ordenbusiness.php';
	

	if($_POST['ordenar']){
		$total = 0;
		$nombre = $_POST['clientenombre'];
		$telefono = $_POST['clientetelefono'];
		$correo = $_POST['clientecorreo'];
		
		$metodo =$_POST['clientemetodo'];

		foreach($_SESSION['carrito'] as $indice=>$producto){
			$total+=($producto['productoprecio']*$producto['productocantidad']);
		}
		$orden = new Orden();
		$orden->setClienteOrden($nombre);
		$orden->setTelefonoOrden($telefono);
		$orden->setCorreoOrden($correo);
		$orden->setMetodoOrden($metodo);
		$orden->setFechaOrden(date("Y-m-d"));
		$orden->setTotalOrden($total);
		$orden->setEstadoOrden(2);

		$ordenBusiness = new OrdenBusiness();
		$ordeninsertada = $ordenBusiness->insertarTBOrden($orden);
		$ordenultimoid = $ordenBusiness->getUltimoIdOrden();
		$detalle = null;
		foreach($_SESSION['carrito'] as $indice=>$producto){
			$detalle = new Detalle();
			$detalle->setOrdenId($ordenultimoid);
			$detalle->setProductoId($producto['productoid']);
			$detalle->setPrecio($producto['productoprecio']);
			$detalle->setCantidad($producto['productocantidad']);


			$ordenBusiness->insertarTBDetalle($detalle);
		}


		if($ordeninsertada == 1){
			unset($_SESSION['carrito']);
			header("location: ../view/index.php" );
		}else{
			header("location: ../view/carritoview.php" );
		}
		// echo $total;
	}



 ?>