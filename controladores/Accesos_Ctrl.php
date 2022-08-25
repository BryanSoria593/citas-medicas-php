<?php
class Accesos_Ctrl
{    
    public function __construct()
    {
        
    }
    public function validarlogin($f3){
        $email=$f3->get('POST.email');
        $password=$f3->get('POST.password');
        
       // echo "hola". $usr. $pass;
        $cadenaSql="";
        // SELECT U.email, U.nombres, U.apellidos, U.password, U.user_rol FROM `usuario` U WHERE `email` = 'paciente@gmail.com' AND  `password`='12345'

        $cadenaSql= $cadenaSql . " SELECT U.id_usuario, U.nombres, U.apellidos, U.user_rol, U.imagen ";
        $cadenaSql= $cadenaSql . " FROM `usuario` U ";
        $cadenaSql= $cadenaSql . " WHERE U.email='".$email."' ";
        $cadenaSql= $cadenaSql . " AND U.password='".$password."'";
        $items=$f3->DB->exec( $cadenaSql);
        //codificar a JSON
        echo json_encode(
            [
                'cantidad'=>count($items),
                'mensaje'=>count($items)>0? 'Bienvenido':'No existe datos',
                'data'=> $items
            ]
           );

    }

    public function fun_accesos($f3){
        $perfil=$f3->get('POST.perfil');

       $cadenaSql="";
       $cadenaSql= $cadenaSql . " SELECT `ACC_ID`, `id_rol`, `ACC_NOMBRE`, `ACC_PAGINA` ";
       $cadenaSql= $cadenaSql . " FROM `accesos`";
       $cadenaSql= $cadenaSql . " WHERE id_rol= '$perfil' ";

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

    

}