<?php

namespace App\Dto;

class CuerpoLineaDetalleDto
{
    private string $poblacion;
    private string $parada;
    private int $idParada;
    private array $coordenadas;
    private array $enlaces;


    public function __construct()
    {
        
    }

    static function of(string $poblacion, string $parada,int $idParada, array $enlaces, array $coordenadas): CuerpoLineaDetalleDto{
        $data = new CuerpoLineaDetalleDto();
        $data->setPoblacion($poblacion);
        $data->setParada($parada);
        $data->setIdParada($idParada);
        $data->setEnlaces($enlaces);
        $data->setCoordenadas($coordenadas);
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
     * @return int
     */
    public function getIdParada(): int
    {
        return $this->idParada;
    }

    /**
     * @param int $idPrada
     * @return CuerpoLineaDetalleDto
     */
    public function setIdParada(string $idParada): CuerpoLineaDetalleDto
    {
        $this->idParada = $idParada;
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

    /**
     * @return array
     */
    public function getCoordenadas(): array
    {
        return $this->coordenadas;
    }

    /**
     * @param array $coordenadas
     * @return CuerpoLineaDetalleDto
     */
    public function setCoordenadas(array $coordenadas): CuerpoLineaDetalleDto
    {
        $this->coordenadas = $coordenadas;
        return $this;
    }  
}
?>