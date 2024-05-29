<?php

namespace App\Dto;

class CabeceraLineaDto
{
    private int $idLinea;
    private string $nombreLinea;
    private array $sublineas;
    private array $direccion;
    private string $empresa;
    private string $logo;
    private array $coordenadas;


    public function __construct()
    {
        
    }

    static function of(int $idLinea, string $nombreLinea, array $sublineas, array $direccion, string $empresa, string $logo, array $coordenadas): CabeceraLineaDto{
        $data = new CabeceraLineaDto();
        $data->setIdLinea($idLinea);
        $data->setNombreLinea($nombreLinea);
        $data->setSublineas($sublineas);
        $data->setDireccion($direccion);
        $data->setEmpresa($empresa);
        $data->setLogo($logo);
        $data->setCoordenadas($coordenadas);
        return $data;
    }

    /**
     * @return int
     */
    public function getIdLinea(): int
    {
        return $this->idLinea;
    }

    /**
     * @param int $idLinea
     * @return LineasDto
     */
    public function setIdLinea(string $idLinea): CabeceraLineaDto
    {
        $this->idLinea = $idLinea;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombreLinea(): string
    {
        return $this->nombreLinea;
    }

    /**
     * @param string $nombreLinea
     * @return LineasDto
     */
    public function setNombreLinea(string $nombreLinea): CabeceraLineaDto
    {
        $this->nombreLinea = $nombreLinea;
        return $this;
    }

    /**
     * @return array
     */
    public function getSublineas(): array
    {
        return $this->sublineas;
    }

    /**
     * @param array $sublinea
     * @return LineasDto
     */
    public function setSublineas(array $sublineas): CabeceraLineaDto
    {
        $this->sublineas = $sublineas;
        return $this;
    }

    /**
     * @return array
     */
    public function getDireccion(): array
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     * @return LineasDto
     */
    public function setDireccion(array $direccion): CabeceraLineaDto
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmpresa(): string
    {
        return $this->empresa;
    }

    /**
     * @param string $empresa
     * @return LineasDto
     */
    public function setEmpresa(string $empresa): CabeceraLineaDto
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return CabeceraLineaDto
     */
    public function setLogo(string $logo): CabeceraLineaDto
    {
        $this->logo = $logo;
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
     * @return CabeceraLineaDto
     */
    public function setCoordenadas(array $coordenadas): CabeceraLineaDto
    {
        $this->coordenadas = $coordenadas;
        return $this;
    }

}
?>