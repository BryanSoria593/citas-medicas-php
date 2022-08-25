<?php
class Historial_Ctrl
{
    public $M_Historial = null;
    public function __construct()
    {
        $this->M_Historial = new M_Historial();
    }
    
    
    public function registerMedicament($f3){
        $historial = new M_Historial();                
        $idCite = $f3->get('POST.idCite'); 
        $this->M_Historial->set( 'descripcion',$f3->get('POST.descripcion'));
        $this->M_Historial->set( 'id_cita',$idCite) ;       
        $this->M_Historial->save();        

        $cadenaSql= $cadenaSql . " UPDATE cita CI SET `estado`='Asistido' WHERE CI.id_cita = '$idCite' ";
        $items=$f3->DB->exec( $cadenaSql);   

        echo json_encode(
            [                                
                'id_receta'=> $this->M_Historial->get('id_receta')                
            ]
           );        
    }
    public function getMedicamentoByIdCite($f3){        
        $historial = new M_Historial();
        $idCite = $f3->get('POST.idCite'); 
        $cadenaSql= $cadenaSql . " SELECT HI.id_receta, HI.descripcion, HI.id_cita FROM `historial` HI ";
        $cadenaSql= $cadenaSql . " INNER JOIN cita CI on HI.id_cita = CI.id_cita ";    
        $cadenaSql= $cadenaSql . " WHERE CI.id_cita = '$idCite' ";    
        $items=$f3->DB->exec( $cadenaSql);   
            
        echo json_encode(
            [                                              
                'Historial'=>$items                
            ]
           );
    }

}