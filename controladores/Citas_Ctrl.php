<?php
class Citas_Ctrl
{
    public $M_Cita = null;
    public function __construct()
    {
        $this->M_Cita = new M_Cita();
    }
    
    public function getTurnos($f3){        
        $cadenaSql= $cadenaSql . " SELECT id_disponibilidad, TU.id_turno, date_format(TU.hora_inicio,'%H:%i') as hora_inicio,  date_format(TU.hora_final,'%H:%i') as hora_final";
        $cadenaSql= $cadenaSql . " FROM `disponibilidad_cita`DIS ";
        $cadenaSql= $cadenaSql . " INNER JOIN turno TU ";
        $cadenaSql= $cadenaSql . " ON DIS.id_turno = TU.id_turno ";
        

        $items=$f3->DB->exec( $cadenaSql);
        //codificar a JSON
        echo json_encode(
            [
                'cantidad'=>count($items),
                'mensaje'=>count($items)>0? 'Datos':'No existe datos',
                'Tickets'=> $items
            ]
           );
    }


    public function newCite($f3){            
        $fecha=$f3->get('POST.date');
        $usuario=$f3->get('POST.id_user');
        $doctor=$f3->get('POST.idDoctor');
        $disponibilidad=$f3->get('POST.ticket');

        $cadenaSql= $cadenaSql . " INSERT INTO `cita` ( `fecha`, `estado`, `id_usuario`, `id_doctor`, `id_disponibilidad`) ";
        $cadenaSql= $cadenaSql . " VALUES ( '$fecha', 'Pendiente','$usuario','$doctor','$disponibilidad') ";
        
        $items=$f3->DB->exec( $cadenaSql);
        
        //codificar a JSON
        echo json_encode(
            [                
              'mensaje'=>$items? 'Datos registrados':'No se ha podido registrar',
              $fecha,
              $usuario,
              $doctor,
              $disponibilidad,                
            ]
           );

    }
    public function getCites($f3){            
        $idUsuario=$f3->get('POST.idUsuario');
        
        $cadenaSql= $cadenaSql . " SELECT CI.id_cita, CI.fecha, CI.estado, CI.id_disponibilidad, ";
        $cadenaSql= $cadenaSql . " USU.nombres AS NombreDoc, USU.apellidos AS ApellidoDoc, USU.imagen AS ImagenDoc,USU2.nombres AS NombreUsu, USU2.apellidos ApellidoUsu, USU2.imagen AS ImagenUsu,date_format(TUR.hora_inicio,'%H:%i') as hora_inicio,  date_format(TUR.hora_final,'%H:%i') as hora_final, ARE.nombre AS Area";        
        $cadenaSql= $cadenaSql . " FROM `cita` CI ";
        $cadenaSql= $cadenaSql . " INNER JOIN doctor DOC on CI.id_doctor = DOC.id_doctor ";
        $cadenaSql= $cadenaSql . " INNER JOIN area ARE on DOC.id_area = ARE.id_area ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU on DOC.id_usuario = USU.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU2 ON ci.id_usuario = usu2.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN disponibilidad_cita DIS on CI.id_disponibilidad = DIS.id_disponibilidad ";
        $cadenaSql= $cadenaSql . " INNER JOIN turno TUR on DIS.id_turno = TUR.id_turno ";
        $cadenaSql= $cadenaSql . " where USU2.id_usuario = '$idUsuario' ";
                        
        $items=$f3->DB->exec( $cadenaSql);
                
        //codificar a JSON
        echo json_encode(
            [                
                'mensaje'=>$items? ' Citas ':'No existen citas para este usuario',
                'Citas'=> $items
                
            ]
           );

    }
    public function getCitesByPending($f3){            
        $idUsuario=$f3->get('POST.idUsuario');
        
        $cadenaSql= $cadenaSql . " SELECT CI.id_cita, CI.fecha, CI.estado, CI.id_disponibilidad, ";
        $cadenaSql= $cadenaSql . " USU.nombres AS NombreDoc, USU.apellidos AS ApellidoDoc, USU.imagen AS ImagenDoc,USU2.nombres AS NombreUsu, USU2.apellidos ApellidoUsu, USU2.imagen AS ImagenUsu,date_format(TUR.hora_inicio,'%H:%i') as hora_inicio,  date_format(TUR.hora_final,'%H:%i') as hora_final, ARE.nombre AS Area";        
        $cadenaSql= $cadenaSql . " FROM `cita` CI ";
        $cadenaSql= $cadenaSql . " INNER JOIN doctor DOC on CI.id_doctor = DOC.id_doctor ";
        $cadenaSql= $cadenaSql . " INNER JOIN area ARE on DOC.id_area = ARE.id_area ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU on DOC.id_usuario = USU.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU2 ON ci.id_usuario = usu2.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN disponibilidad_cita DIS on CI.id_disponibilidad = DIS.id_disponibilidad ";
        $cadenaSql= $cadenaSql . " INNER JOIN turno TUR on DIS.id_turno = TUR.id_turno ";
        $cadenaSql= $cadenaSql . " where USU2.id_usuario = '$idUsuario' AND CI.estado = 'Pendiente'  ";
                        
        $items=$f3->DB->exec( $cadenaSql);                
        //codificar a JSON
        echo json_encode(
            [                
                'mensaje'=>$items? ' Citas ':'No existen citas para este usuario',
                'Citas'=> $items                
            ]
           );
    }

    public function getCitesById($f3){            
        $idCite=$f3->get('POST.idCite');
        
        $cadenaSql= $cadenaSql . " SELECT CI.id_cita, CI.fecha, CI.estado, CI.id_disponibilidad, ";
        $cadenaSql= $cadenaSql . " USU.nombres AS NombreDoc, USU.apellidos AS ApellidoDoc, USU.imagen AS ImagenDoc,USU2.nombres AS NombreUsu, USU2.apellidos ApellidoUsu, USU2.imagen AS ImagenUsu,date_format(TUR.hora_inicio,'%H:%i') as hora_inicio,  date_format(TUR.hora_final,'%H:%i') as hora_final, ARE.nombre AS Area";        
        $cadenaSql= $cadenaSql . " FROM `cita` CI ";
        $cadenaSql= $cadenaSql . " INNER JOIN doctor DOC on CI.id_doctor = DOC.id_doctor ";
        $cadenaSql= $cadenaSql . " INNER JOIN area ARE on DOC.id_area = ARE.id_area ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU on DOC.id_usuario = USU.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU2 ON ci.id_usuario = usu2.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN disponibilidad_cita DIS on CI.id_disponibilidad = DIS.id_disponibilidad ";
        $cadenaSql= $cadenaSql . " INNER JOIN turno TUR on DIS.id_turno = TUR.id_turno ";
        $cadenaSql= $cadenaSql . " where CI.id_cita = '$idCite'";
                        
        $items=$f3->DB->exec( $cadenaSql);                
        //codificar a JSON
        echo json_encode(
            [                
                'mensaje'=>$items? ' Citas ':'No existen citas para este usuario',
                'Citas'=> $items                
            ]
           );
    }

    public function updateCiteById($f3){
        $idCite = $f3->get('POST.idCite'); 
        $newDate=$f3->get('POST.fecha');
        $newTicket=$f3->get('POST.idDisp');

        $cadenaSql= $cadenaSql . " UPDATE `cita` CI SET `fecha`='$newDate',`id_disponibilidad`= '$newTicket' ";
        $cadenaSql= $cadenaSql . " WHERE CI.id_cita = '$idCite' ";

        $items=$f3->DB->exec( $cadenaSql);                
        //codificar a JSON
        echo json_encode(
            [                
                'mensaje'=>$items? ' Cita actualizada ':'No se ha podido actualizar la cita',
                'Citas'=> $items                
            ]
           );        
    }
 
    public function deleteCiteById($f3){
        $idCite = $f3->get('POST.idCite'); 
        
        $cadenaSql= $cadenaSql . " UPDATE `cita` CI SET `estado`='Cancelado'  ";
        $cadenaSql= $cadenaSql . " WHERE CI.id_cita = '$idCite' ";

        $items=$f3->DB->exec( $cadenaSql);                
        //codificar a JSON
        echo json_encode(
            [                
                'mensaje'=>$items? ' Cita cancelada ':'No se ha podido cancelar la cita',
                'Citas'=> $items                
            ]
           );        
    }

    public function getPendingCitesByDoctor($f3){
        $idDoctor = $f3->get('POST.idDoctor'); 
        
        $cadenaSql= $cadenaSql . " SELECT CI.id_cita, CI.fecha, CI.estado, CI.id_disponibilidad, ";
        $cadenaSql= $cadenaSql . " USU.nombres AS NombreDoc, USU.apellidos AS ApellidoDoc, USU.imagen AS ImagenDoc,USU2.nombres AS NombreUsu, USU2.apellidos ApellidoUsu, USU2.imagen AS ImagenUsu,date_format(TUR.hora_inicio,'%H:%i') as hora_inicio,  date_format(TUR.hora_final,'%H:%i') as hora_final, ARE.nombre AS Area";        
        $cadenaSql= $cadenaSql . " FROM `cita` CI ";
        $cadenaSql= $cadenaSql . " INNER JOIN doctor DOC on CI.id_doctor = DOC.id_doctor ";
        $cadenaSql= $cadenaSql . " INNER JOIN area ARE on DOC.id_area = ARE.id_area ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU on DOC.id_usuario = USU.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU2 ON ci.id_usuario = usu2.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN disponibilidad_cita DIS on CI.id_disponibilidad = DIS.id_disponibilidad ";
        $cadenaSql= $cadenaSql . " INNER JOIN turno TUR on DIS.id_turno = TUR.id_turno ";
        $cadenaSql= $cadenaSql . " where USU.id_usuario = '$idDoctor' AND CI.estado = 'Pendiente'";

        $items=$f3->DB->exec( $cadenaSql);                
        //codificar a JSON
        echo json_encode(
            [                
                'mensaje'=>$items? ' Cita actualizada ':'No se ha podido actualizar la cita',
                'Citas'=> $items                
            ]
           );        
    }
    public function getCitesByDoctor($f3){
        $idDoctor = $f3->get('POST.idDoctor'); 
        
        $cadenaSql= $cadenaSql . " SELECT CI.id_cita, CI.fecha, CI.estado, CI.id_disponibilidad, ";
        $cadenaSql= $cadenaSql . " USU.nombres AS NombreDoc, USU.apellidos AS ApellidoDoc, USU.imagen AS ImagenDoc,USU2.nombres AS NombreUsu, USU2.apellidos ApellidoUsu, USU2.imagen AS ImagenUsu,date_format(TUR.hora_inicio,'%H:%i') as hora_inicio,  date_format(TUR.hora_final,'%H:%i') as hora_final, ARE.nombre AS Area";        
        $cadenaSql= $cadenaSql . " FROM `cita` CI ";
        $cadenaSql= $cadenaSql . " INNER JOIN doctor DOC on CI.id_doctor = DOC.id_doctor ";
        $cadenaSql= $cadenaSql . " INNER JOIN area ARE on DOC.id_area = ARE.id_area ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU on DOC.id_usuario = USU.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU2 ON ci.id_usuario = usu2.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN disponibilidad_cita DIS on CI.id_disponibilidad = DIS.id_disponibilidad ";
        $cadenaSql= $cadenaSql . " INNER JOIN turno TUR on DIS.id_turno = TUR.id_turno ";
        $cadenaSql= $cadenaSql . " where USU.id_usuario = '$idDoctor'";

        $items=$f3->DB->exec( $cadenaSql);
        //codificar a JSON
        echo json_encode(
            [                
                'mensaje'=>$items? ' Cita actualizada ':'No se ha podido actualizar la cita',
                'Citas'=> $items                
            ]
           );        
    }
    public function getCitesWithStateAsist($f3){
        $idUsuario = $f3->get('POST.idUsuario'); 
        
        $cadenaSql= $cadenaSql . " SELECT CI.id_cita, CI.fecha, CI.estado, CI.id_disponibilidad, ";
        $cadenaSql= $cadenaSql . " USU.nombres AS NombreDoc, USU.apellidos AS ApellidoDoc, USU.imagen AS ImagenDoc,USU2.nombres AS NombreUsu, USU2.apellidos ApellidoUsu, USU2.imagen AS ImagenUsu,date_format(TUR.hora_inicio,'%H:%i') as hora_inicio,  date_format(TUR.hora_final,'%H:%i') as hora_final, ARE.nombre AS Area";        
        $cadenaSql= $cadenaSql . " FROM `cita` CI ";
        $cadenaSql= $cadenaSql . " INNER JOIN doctor DOC on CI.id_doctor = DOC.id_doctor ";
        $cadenaSql= $cadenaSql . " INNER JOIN area ARE on DOC.id_area = ARE.id_area ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU on DOC.id_usuario = USU.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN usuario USU2 ON ci.id_usuario = usu2.id_usuario ";
        $cadenaSql= $cadenaSql . " INNER JOIN disponibilidad_cita DIS on CI.id_disponibilidad = DIS.id_disponibilidad ";
        $cadenaSql= $cadenaSql . " INNER JOIN turno TUR on DIS.id_turno = TUR.id_turno ";
        $cadenaSql= $cadenaSql . " where USU2.id_usuario = '$idUsuario' and CI.estado = 'Asistido'";

        $items=$f3->DB->exec( $cadenaSql);
        //codificar a JSON
        echo json_encode(
            [                
                'mensaje'=>$items? ' Cita actualizada ':'No se ha podido actualizar la cita',
                'Citas'=> $items                
            ]
           );        
    }

    
    


    


}