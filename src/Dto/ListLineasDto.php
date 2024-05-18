<?php

namespace App\Dto;

class ListLineasDto
{
    private int $idLinea;
    private string $linea;
    private string $descripcion;
    private string $empresa;
    private string $tipo;


    public function __construct()
    {
        
    }

    static function of(int $idLinea, string $linea, string $descripcion, string $empresa, string $tipo): ListLineasDto{
        $data = new ListLineasDto();
        $data->setIdLinea($idLinea);
        $data->setLinea($linea);
        $data->setDescripcion($descripcion);
        $data->setEmpresa($empresa);
        $data->setTipo($tipo);
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
    public function setIdLinea(int $idLinea): ListLineasDto
    {
        $this->idLinea = $idLinea;
        return $this;
    }

    /**
     * @return string
     */
    public function getLinea(): string
    {
        return $this->linea;
    }

    /**
     * @param string $linea
     * @return LineasDto
     */
    public function setLinea(string $linea): ListLineasDto
    {
        $this->linea = $linea;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     * @return LineasDto
     */
    public function setDescripcion(string $descripcion): ListLineasDto
    {
        $this->descripcion = $descripcion;
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
    public function setEmpresa(string $empresa): ListLineasDto
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return LineasDto
     */
    public function setTipo(string $tipo): ListLineasDto
    {
        $this->tipo = $tipo;
        return $this;
    }

    
    
}
?>