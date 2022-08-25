<?php
    class M_Doctor extends \DB\SQL\Mapper{
        public function __construct(){
            parent::__construct(\Base::instance()->get('DB'),'doctor');
        }
    }
?>