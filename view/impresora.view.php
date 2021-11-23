<?php

require_once 'smarty/libs/Smarty.class.php';


class ImpresoraView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    public function renderHome($allPrinters)
    {
        $this->smarty->assign('impresora', $allPrinters);
        $this->smarty->display('templates/home.tpl');
    }

    public function renderDetails($detalles)
    {
        $this->smarty->assign('titulo', 'Detalles');
        $this->smarty->assign('impresora', $detalles);
        $this->smarty->display('templates/detalles.tpl');
    }

    public function renderFilter($Metodos)
    {
        $this->smarty->assign('titulo', 'Filtrar');
        $this->smarty->assign('metodo', $Metodos);
        $this->smarty->display('templates/filtrar.tpl');
    }
    public function renderFiltrado($impresoras, $filtro)
    {
        $this->smarty->assign('titulo', 'Filtrar');
        $this->smarty->assign('impresora', $impresoras);
        $this->smarty->assign('filtro', $filtro);
        $this->smarty->display('templates/filtrado.tpl');
    }

}
