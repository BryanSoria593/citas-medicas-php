<?php
class Clientes_Ctrl
{
    public $M_Clientes = null;
    public function __construct()
    {
        $this->M_Clientes = new M_Clientes();
    }
    public function listar($f3){
       $resultado=$this->M_Clientes->find(['CLI_EST=?','A']);
       $items[]=array();
       foreach( $resultado as $producto){
        $items[]=$producto->cast();
       }

       //codificar el objeto a formato JSON
       echo json_encode(
        [
            'cantidad'=>count($resultado),
            'mensaje'=>count($items)>0? 'Consulta con datos':'No existe datos',
            'Productos'=> $items
        ]
       );

    }


    public function postInsCliente($f3){
        $mensaje="HOLA";
        $id=0;
        $cliente=new M_Clientes();
        $cliente->load(['CLI_CED=?',$f3->get('POST.CLI_CED')]);
      
        if($cliente->loaded()>0){
            $mensaje=" Ya existe un cliente registrado con esa Cédula";
        }else{
            //insertar un nuevo cliente
            $this->M_Clientes->set('CLI_CED',$f3->get('POST.CLI_CED'));
            $this->M_Clientes->set('CLI_NOM',$f3->get('POST.CLI_NOM'));
            $this->M_Clientes->set('CLI_APE',$f3->get('POST.CLI_APE'));
            $this->M_Clientes->set('CLI_DIR',$f3->get('POST.CLI_DIR'));
            $this->M_Clientes->set('CLI_TEL',$f3->get('POST.CLI_TEL'));
            $this->M_Clientes->set('CLI_EMEIL',$f3->get('POST.CLI_EMEIL'));
            $this->M_Clientes->set('CLI_EST',$f3->get('POST.CLI_EST'));
            $this->M_Clientes->save();
            //recuperar el id con el que se registró en la BD
            $id=$this->M_Clientes->get('CLI_ID');
            $mensaje="Se registró el cliente";
        }

        echo json_encode([
            'mensaje'=>$mensaje,
            'id'=>$id
        ]);

    }


    public function getClientexCed($f3){
        $id=0;
        $cliente=new M_Clientes();
        $cliente->load(['CLI_CED=?',$f3->get('POST.cedula')]);
        $items=array();
        if($cliente->loaded()>0){
            $mensaje="Cliente encontrado";
            $items=$cliente->cast();
            $id=1;
        }else{
            $mensaje="No existe el Cliente";
            $id=0;
        }
        echo json_encode([
            'mensaje'=>$mensaje,
            'id'=>$id,
            'data'=> $items
        ]);

    } 


    public function fun_ActualizarCliente($f3){
        $cedula=$f3->get('POST.cedula');
        /*$mensaje="Hola".$cedula;
        echo $mensaje;*/
        $id=0;
        $this->M_Clientes->load(['CLI_CED=?', $cedula]);
        if($this->M_Clientes->loaded()>0){
            $this->M_Clientes->set('CLI_CED',$f3->get('POST.cedula'));
            $this->M_Clientes->set('CLI_NOM',$f3->get('POST.nombres'));
            $this->M_Clientes->set('CLI_APE',$f3->get('POST.apellidos'));
            $this->M_Clientes->set('CLI_DIR',$f3->get('POST.direccion'));
            $this->M_Clientes->set('CLI_TEL',$f3->get('POST.telefono'));
            $this->M_Clientes->set('CLI_EMEIL',$f3->get('POST.correo'));
            $this->M_Clientes->set('CLI_EST',$f3->get('POST.estado'));
            $this->M_Clientes->save();
            $id=1;
            $mensaje="Se realizó los cambios con éxito";
        }else{
            $mensaje="NO Existe Datos";
        }
        echo json_encode([
            'id'=>$id,
            'mensaje'=>$mensaje
        ]);
       
    }

    
    public function fun_eliminar($f3){
        $cedula=$f3->get('POST.cedula');
        $id=0;
        $this->M_Clientes->load(['CLI_CED=?', $cedula]);
        if($this->M_Clientes->loaded()>0){
            $this->M_Clientes->set('CLI_EST',$f3->get('POST.estado'));
            $this->M_Clientes->save();
            $id=1;
            $mensaje="Se realizó los cambios con éxito";
        }else{
            $mensaje="NO Existe Datos";
        }
        echo json_encode([
            'id'=>$id,
            'mensaje'=>$mensaje
        ]);
    }


    

}//fin clase