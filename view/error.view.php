<?php
require_once 'smarty/libs/Smarty.class.php';

class ErrorView{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }


    public function errorAdmin()
    {
       
        $this->smarty->display('templates/erroradmin.tpl');
    }

}