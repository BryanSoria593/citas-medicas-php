<?php
    class M_Cita extends \DB\SQL\Mapper{
        public function __construct(){
            parent::__construct(\Base::instance()->get('DB'),'cita');
        }
    }
?>