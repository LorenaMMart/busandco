<?php

namespace App\Dto;

class BusquedaOrigenDestinoDto
{
    private array $paradas;
    private array $empresas;
   
    public function __construct()
    {
        
    }

    static function of(array $paradas, array $empresas): BusquedaOrigenDestinoDto
    {
        $data = new BusquedaOrigenDestinoDto();
        $data->setParadas($paradas);
        $data->setEmpresas($empresas);
        return $data;
    }

    /**
     * @return array
     */
    public function getParadas(): array
    {
        return $this->paradas;
    }

    /**
     * @param array $paradas
     * @return BusquedaOrigenDestinoDto
     *
     */
    public function setParadas(array $paradas): BusquedaOrigenDestinoDto
    {
        $this->paradas = $paradas;
        return $this;
    }

    /**
     * @return array
     */
    public function getEmpresas(): array
    {
        return $this->empresas;
    }

    /**
     * @param array $empresas
     * @return BusquedaOrigenDestinoDto
     *
     */
    public function setEmpresas(array $empresas): BusquedaOrigenDestinoDto
    {
        $this->empresas = $empresas;
        return $this;
    }    
}
?>