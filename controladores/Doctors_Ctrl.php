<?php
class Doctors_Ctrl
{
    public $M_Doctor = null;
    public function __construct()
    {
        $this->M_Doctor = new M_Doctor();
    }
    
    public function getDoctors($f3){
        $especialidad=$f3->get('POST.especialidad');
        $cadenaSql="";
        $cadenaSql= $cadenaSql . " SELECT D.id_doctor,D.id_usuario, D.disponibilidad,U.nombres, U.apellidos, U.email, U.imagen,E.id_especialidad,E.nombre, A.id_area, A.nombre ";
        $cadenaSql= $cadenaSql . " FROM doctor D ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario U ON D.id_usuario = U.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN area A ON D.id_area = A.id_area ";
        $cadenaSql= $cadenaSql . " INNER JOIN especialidad E ON D.id_especialidad = E.id_especialidad WHERE D.disponibilidad='1' and  E.nombre='$especialidad' ";
        
        $items=$f3->DB->exec( $cadenaSql);
        
        echo json_encode(
            [
                'cantidad'=>count($items),
                'mensaje'=>$items? 'Datos':'No existe datos',
                'Productos'=> $items
            ]
           );

    }
    

}//fin clase