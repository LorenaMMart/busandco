<?php

namespace App\Dto;


class IncidenciasDto
{
    private int $id;
    private string $nombre;
    private string $descripcion;
    private string $fecha;
    private array $lineas;
  
    public function __construct()
    {

        
    }

    static function of(int $id, string $nombre, string $descripcion, string $fecha, array $lineas): IncidenciasDto
    {
        $data = new IncidenciasDto();
        $data->setId($id);
        $data->setNombre($nombre);
        $data->setDescripcion($descripcion);
        $data->setFecha($fecha);
        $data->setLineas($lineas);
       
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
     * @return string
     */ 
    public function getFecha(): string
    {
        return $this->fecha;
    }

    /**
     * @param string $fecha
     * @return IncidenciasDto
     *
     */
    public function setFecha($fecha):IncidenciasDto
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return array
     */ 
    public function getLineas()
    {
        return $this->lineas;
    }

    /**
     * @param array $linea
     * @return IncidenciasDto
     *
     */
    public function setLineas($lineas) : IncidenciasDto
    {
        $this->lineas = $lineas;

        return $this;
    }
}
?>