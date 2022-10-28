<?php 

    class Producto{
        private $productoid ;
        private $productonombre;
        private $productoprecio;
        private $productoestado;

        public function __construct($id, $nombre,$precio,$estado){
            $this->productoid = $id;
            $this->productonombre = $nombre;
            $this->productoprecio = $precio;
            $this->productoestado = $estado;
        }

        function setIdProducto($id){
            $this->productoid = $id;
        }

        function getIdProducto(){
            return $this->productoid;
        }

        function setNombre($nombre){
            $this->productonombre = $nombre;
        }

        function getNombreProducto(){
            return $this->productonombre;
        }

        function setPrecioProducto($precio){
            $this->productoprecio = $precio;
        }

        function getPrecioProducto(){
            return $this->productoprecio;
        }

        function setEstadoProducto($estado){
            $this->productoestado = $estado;
        }

    }


?>