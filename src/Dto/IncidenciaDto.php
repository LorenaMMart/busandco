<?php

namespace App\Dto;

use DateTime;

class IncidenciasDto
{
    private int $id;
    private string $nombre;
    private string $descripcion;
    private DateTime $fecha;
    private bool $estado;
  
    public function __construct()
    {
        
    }

    static function of(int $id, string $nombre, string $descripcion, DateTime $fecha, bool $estado): IncidenciasDto
    {
        $data = new IncidenciasDto();
        $data->setId($id);
        $data->setNombre($nombre);
        $data->setDescripcion($descripcion);
        $data->setFecha($fecha);
        $data->setEstado($estado);
       
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
     * @return IncidenciasDto
     *
     */
    public function setNombre(string $nombre): IncidenciasDto
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return IncidenciasDto
     *
     */
    public function setId(int $id): IncidenciasDto
    {
        $this->id = $id;
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
     * @return IncidenciasDto
     *
     */
    public function setDescripcion(string $descripcion): IncidenciasDto
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return DateTime
     */ 
    public function getFecha(): DateTime
    {
        return $this->fecha;
    }

    /**
     * @param DateTime $fecha
     * @return IncidenciasDto
     *
     */
    public function setFecha($fecha):IncidenciasDto
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return bool
     */
    public function getEstado(): bool
    {
        return $this->estado;
    }

     /**
     * @param bool $estado
     * @return IncidenciasDto
     *
     */
    public function setEstado($estado): IncidenciasDto
    {
        $this->estado = $estado;

        return $this;
    }
}
?>