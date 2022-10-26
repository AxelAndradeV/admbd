<?php 

include '../data/productodata.php';

class ProductoBusiness{

    private $productoData;

    public function ProductoBusiness(){
        $this->productoData = new ProductoData();
    }
    
    public function getTotalProductos(){
    	return $this->productoData->getTotalProductos();
    }

    public function getPaginasProducto($inicio, $cantidad){
    	return $this->productoData->getPaginasProducto($inicio, $cantidad);
    }

    public function getAllTBProductos(){
        return $this->productoData->getAllTBProductos();
    }

}

?>