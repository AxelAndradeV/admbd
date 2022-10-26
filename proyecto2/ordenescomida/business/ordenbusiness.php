<?php 


include '../data/ordendata.php';

class OrdenBusiness{

	private $ordenData;

	public function OrdenBusiness(){
		$this->ordenData = new OrdenData();
	}

	public function insertarTBOrden($orden){
		return $this->ordenData->insertarTBOrden($orden);
	}

	public function insertarTBDetalle($detalle){
		return $this->ordenData->insertarTBDetalle($detalle);	
	}

	public function getUltimoIdOrden(){
		return $this->ordenData->getUltimoIdInsertado();
	}


	public function getAllTBOrdenes(){
		return $this->ordenData->getAllTBOrdenes();
	}

}


 ?>