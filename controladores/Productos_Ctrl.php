<?php
class Productos_Ctrl
{
    public $M_Producto = null;
    public function __construct()
    {
        $this->M_Producto = new M_Producto();
    }
    public function listar($f3){
       $resultado=$this->M_Producto->find("PRO_EST='A'");
       $items[]=array();
        foreach( $resultado as $producto){
        $items[]=$producto->cast();
       }
       //codificar el objeto a formato JSON
       echo json_encode(
        [
            'cantidad'=>count($items),
            'mensaje'=>count($items)>0? 'Consulta con datos':'No existe datos',
            'Productos'=> $items
        ]
       );

    }

    public function listarProductosSql($f3){
        $cadenaSql="";
        $cadenaSql= $cadenaSql . " select * ";
        $cadenaSql= $cadenaSql . " from producto ";
        $cadenaSql= $cadenaSql . " where PRO_EST='A' ";
        $items=$f3->DB->exec( $cadenaSql);
        //codificar a JSON
        echo json_encode(
            [
                'cantidad'=>count($items),
                'mensaje'=>count($items)>0? 'Consulta con datos':'No existe datos',
                'Productos'=> $items
            ]
           );

    }


}