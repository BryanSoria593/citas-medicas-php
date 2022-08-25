<?php
class Despachos_Ctrl
{
    
    public $M_Pedidos = null;
    public function __construct()
    {
        $this->M_Pedidos = new M_Pedidos();
    }

    public function listarPedidos($f3){
       $cadenaSql="";
        $cadenaSql= $cadenaSql . " SELECT P.PED_ID,C.CLI_NOM,C.CLI_APE,P.PED_FECHA,";
        $cadenaSql= $cadenaSql . " P.PED_SUBTOTAL,P.PED_IVA,P.PED_TOTAL  ";
        $cadenaSql= $cadenaSql . " FROM PEDIDOS P, CLIENTES C ";
        $cadenaSql= $cadenaSql . " WHERE P.CLI_ID=C.CLI_ID AND P.PED_ESTADO='A'";
        $items=$f3->DB->exec( $cadenaSql);
        //codificar a JSON    
        echo json_encode(
            [
                'cantidad'=>count($items),
                'mensaje'=>count($items)>0? 'Consulta con datos':'No existe datos',
                'data'=> $items
            ]
           );

    }


    public function DetallexDespacho($f3){
        $id=$f3->get('POST.id');

       // echo "hola". $usr. $pass;
       $cadenaSql="";
        $cadenaSql= $cadenaSql . " SELECT D.DET_ID,P.PRO_NOM, T.TA_TALLA, P.PRO_PRE, I.IMG_FOTO ";
        $cadenaSql= $cadenaSql . " FROM DETALLE D inner join  TALLAS T on D.TA_ID=T.TA_ID ";
        $cadenaSql= $cadenaSql . " inner join PRODUCTO P ON T.PRO_ID=P.PRO_ID ";
        $cadenaSql= $cadenaSql . " inner join IMAGENES I ON P.PRO_ID=I. PRO_ID ";
        $cadenaSql= $cadenaSql . " WHERE D.PED_ID=".$id;

        $items=$f3->DB->exec( $cadenaSql);
        //codificar a JSON
        echo json_encode(
            [
                'cantidad'=>count($items),
                'mensaje'=>count($items)>0? 'Consulta con datos':'No existe datos',
                'data'=> $items
            ]
           );

    }


    public function fun_despachar($f3){
        $ped_id=$f3->get('POST.id');
        $id=0;
        $this->M_Pedidos->load(['PED_ID=?', $ped_id]);
        if($this->M_Pedidos->loaded()>0){
            $this->M_Pedidos->set('PED_ESTADO','D');
            $this->M_Pedidos->save();
            $id=1;
            $mensaje="El pedido fue despachado";
        }else{
            $mensaje="NO se puedo reralizar el despacho";
        }
        echo json_encode([
            'id'=>$id,
            'mensaje'=>$mensaje
        ]);
    }





}