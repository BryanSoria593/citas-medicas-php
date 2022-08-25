<?php

class Imagenes_Ctrl
{
    public $M_Imagenes = null;
    public function __construct()
    {

        $this->M_Imagenes = new M_Imagenes();
    }

  public function uploadImgaes($f3){
    
        $arrayImages = $f3->get('POST.arrayImages'); 
        $idReceta = $f3->get('POST.idReceta'); 

        $cadenaSql= $cadenaSql . " INSERT INTO `imagen`(`id_receta`, `url`) VALUES ";
        $cadenaSql= $cadenaSql . " ('$idReceta','$arrayImages') ";    
        $items=$f3->DB->exec( $cadenaSql);                            
        
        
        echo json_encode(
            [                              
                'IMAGENES'=>$arrayImages,
                'idReceta'=>$idReceta
                
            ]
           );               
  }

  public function getImageByIdHistorial($f3){

    $idReceta = $f3->get('POST.idReceta'); 
    
    $cadenaSql= $cadenaSql . " SELECT IMA.id_imagen, IMA.id_receta, IMA.url FROM `imagen` IMA ";
    $cadenaSql= $cadenaSql . " INNER JOIN historial HI on IMA.id_receta = HI.id_receta ";
    $cadenaSql= $cadenaSql . " where IMA.id_receta = '$idReceta' ";
    
    $items=$f3->DB->exec( $cadenaSql); 

    echo json_encode(
        [                              
            'Imagenes'=>$items,
            
            
        ]
       );               
    
    
    

  }

}
