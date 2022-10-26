<?php
    include_once 'data.php';
	include '../domain/orden.php';
	include '../domain/detalle.php';

	class OrdenData extends Database{

        public function __construct(){}

        public function getUltimoIdInsertado(){
        	$pdo = Database::conectar();
	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $stmt = $pdo ->prepare("SELECT MAX(ordenid) AS ordenid  FROM tborden");
	        $stmt -> execute();
	        $nextId = 1;
	                
	        if($row = $stmt->fetch()){
	           $nextId = $row[0]+1;
	        }

	        return $nextId;
        }

        public function insertarTBOrden($orden) {
	       
	        $pdo = Database::conectar();
	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $stmt = $pdo ->prepare("SELECT MAX(ordenid) AS ordenid  FROM tborden");
	        $stmt -> execute();
	        $nextId = 1;
	                
	        if($row = $stmt->fetch()){
	           $nextId = $row[0]+1;
	        }

	        
	        $insertar = "INSERT INTO `tborden`(`ordenid`, `ordenclientenombre`, `ordenclientetelefono`, `ordenclientecorreo`, `ordenmetodo`, `ordenfecha`, `ordentotal`, `ordenestado`) VALUES (?,?,?,?,?,?,?,?)";
	        $q = $pdo->prepare($insertar);
	        $result = $q->execute(array($nextId, $orden->getClienteOrden(),$orden->getTelefonoOrden(),$orden->getCorreoOrden(),$orden->getMetodoOrden(),$orden->getFechaOrden(),$orden->getTotalOrden(),$orden->getEstadoOrden()

	        ));

	        Database::desconectar();
	           
	        return $result;
    	}


    	public function insertarTBDetalle($detalle) {
	       
	        $pdo = Database::conectar();
	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $stmt = $pdo ->prepare("SELECT MAX(detalleid) AS detalleid  FROM tbdetalle");
	        $stmt -> execute();
	        $nextId = 1;
	                
	        if($row = $stmt->fetch()){
	           $nextId = $row[0]+1;
	        }

	        $insertar = "INSERT INTO `tbdetalle`(`detalleid`, `detalleordenid`, `detalleproductoid`, `detalleprecio`, `detallecantidad`) VALUES (?,?,?,?,?)";
	        $q = $pdo->prepare($insertar);
	        $result = $q->execute(array($nextId, 
	        	$detalle->getOrdenId(),
	        	$detalle->getProductoId(),
	        	$detalle->getPrecio(),
	        	$detalle->getCantidad()
	        ));

	        Database::desconectar();
	           
	        return $result;
    	}

        public function getAllTBOrdenes() {
            $pdo = Database::conectar();
            $stm = $pdo->prepare("SELECT * FROM tborden");
            $stm->execute();
            Database::desconectar();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
         }

    }
?>