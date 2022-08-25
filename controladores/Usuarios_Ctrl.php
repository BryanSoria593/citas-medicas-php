<?php
class Usuarios_Ctrl
{
    public $M_Usuario = null;
    public function __construct()
    {
        $this->M_Usuario = new M_Usuario();
    }
    public function listar($f3){
       $resultado=$this->M_Usuario->find("USR_EST='A'");
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
    
    public function registerUser($f3){
        $mensaje="";
        $id=0;
        $usuario=new M_Usuario();
        $usuario->load(['email=?',$f3->get('POST.email')]);         
        $rango = rand(1, 20);
        $imagen = "https://rickandmortyapi.com/api/character/avatar/{$rango}.jpeg";
      
        if($usuario->loaded()>0){
            $mensaje=" Ya existe un cliente registrado con esa Cédula";
        }else{
            //insertar un nuevo cliente
            $this->M_Usuario->set('cedula',$f3->get('POST.cedula'));            
            $this->M_Usuario->set('email',$f3->get('POST.email'));
            $this->M_Usuario->set('nombres',$f3->get('POST.nombres'));
            $this->M_Usuario->set('apellidos',$f3->get('POST.apellidos'));
            $this->M_Usuario->set('fecha',$f3->get('POST.fecha'));
            $this->M_Usuario->set('ciudad',$f3->get('POST.ciudad'));
            $this->M_Usuario->set('sexo',$f3->get('POST.sexo'));
            $this->M_Usuario->set('password',$f3->get('POST.contrasena'));
            $this->M_Usuario->set('imagen',$imagen);
            $this->M_Usuario->set('user_rol',0);
            $this->M_Usuario->save();
            //recuperar el id con el que se registró en la BD
            $id=$this->M_Usuario->get('id_usuario');
            $mensaje="Te has registrado con éxito, redirigiendo al login";
        }

        echo json_encode([
            'mensaje'=>$mensaje,
            'id'=>$id
        ]);

    }

}//fin clase