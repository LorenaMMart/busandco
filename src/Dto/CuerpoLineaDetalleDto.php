<?php

namespace App\Dto;

class CuerpoLineaDetalleDto
{
    private string $poblacion;
    private string $parada;
    private array $enlaces;


    public function __construct()
    {
        
    }

    static function of(string $poblacion, string $parada, array $enlaces): CuerpoLineaDetalleDto{
        $data = new CuerpoLineaDetalleDto();
        $data->setPoblacion($poblacion);
        $data->setParada($parada);
        $data->setEnlaces($enlaces);
        return $data;
    }

    /**
     * @return string
     */
    public function getPoblacion(): string
    {
        return $this->poblacion;
    }

    /**
     * @param string $poblacion
     * @return CuerpoLineaDetalleDto
     */
    public function setPoblacion(string $poblacion): CuerpoLineaDetalleDto
    {
        $this->poblacion = $poblacion;
        return $this;
    }

    /**
     * @return string
     */
    public function getParada(): string
    {
        return $this->parada;
    }

    /**
     * @param string $parada
     * @return CuerpoLineaDetalleDto
     */
    public function setParada(string $parada): CuerpoLineaDetalleDto
    {
        $this->parada = $parada;
        return $this;
    }

    /**
     * @return array
     */
    public function getEnlaces(): array
    {
        return $this->enlaces;
    }

    /**
     * @param array $enlaces
     * @return CuerpoLineaDetalleDto
     */
    public function setEnlaces(array $enlaces): CuerpoLineaDetalleDto
    {
        $this->enlaces = $enlaces;
        return $this;
    }

    

    
    
}
?>