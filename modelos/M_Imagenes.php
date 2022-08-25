<?php
    class M_Imagenes extends \DB\SQL\Mapper{
        public function __construct(){
            parent::__construct(\Base::instance()->get('DB'),'imagen');
        }
    }
?>