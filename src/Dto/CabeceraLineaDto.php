<?php

namespace App\Dto;

class ListLineasDto
{
    private string $nombre;
    private string $descripcion;
    private string $empresa;
    private string $tipo;


    public function __construct()
    {
        
    }

    static function of(string $nombre, string $descripcion, string $empresa, string $tipo): ListLineasDto{
        $data = new ListLineasDto();
        $data->setNombre($nombre);
        $data->setDescripcion($descripcion);
        $data->setEmpresa($empresa);
        $data->setTipo($tipo);
        return $data;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return LineasDto
     */
    public function setNombre(string $nombre): ListLineasDto
    {
        $this->nombre = $nombre;
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
        $this->empresa = $tipo;
        return $this;
    }

    
    
}
?>