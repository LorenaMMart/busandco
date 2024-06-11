<?php

namespace App\Dto;

class CODireccionesDto
{
    private string $direccion;
    private array $paradas;
   
    public function __construct()
    {
        
    }

    static function of(string $direccion, array $paradas): CODireccionesDto
    {
        $data = new CODireccionesDto();
        $data->setDireccion($direccion);
        $data->setParadas($paradas);
       
        return $data;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     * @return CODireccionesDto
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * @return array
     */
    public function getParadas()
    {
        return $this->paradas;
    }

    /**
     * @param string $paradas
     * @return CODireccionesDto
     */
    public function setParadas($paradas)
    {
        $this->paradas = $paradas;

        return $this;
    }
}
?>