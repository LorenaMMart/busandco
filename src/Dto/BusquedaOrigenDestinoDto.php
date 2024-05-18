<?php

namespace App\Dto;

class BusquedaOrigenDestinoDto
{
    private object $paradas;
    private object $empresas;
   
    public function __construct()
    {
        
    }

    static function of(object $paradas, object $empresas): BusquedaOrigenDestinoDto
    {
        $data = new BusquedaOrigenDestinoDto();
        $data->setParadas($paradas);
        $data->setEmpresas($empresas);
        return $data;
    }

    /**
     * @return object
     */
    public function getParadas(): object
    {
        return $this->paradas;
    }

    /**
     * @param object $paradas
     * @return BusquedaOrigenDestinoDto
     *
     */
    public function setParadas(object $paradas): BusquedaOrigenDestinoDto
    {
        $this->$paradas = $paradas;
        return $this;
    }

    /**
     * @return object
     */
    public function getEmpresas(): object
    {
        return $this->empresas;
    }

    /**
     * @param object $empresas
     * @return BusquedaOrigenDestinoDto
     *
     */
    public function setEmpresas(object $Empresas): BusquedaOrigenDestinoDto
    {
        $this->empresas = $Empresas;
        return $this;
    }    
}
?>