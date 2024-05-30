<?php

namespace App\Dto;

use DateTime;

class NoticiaDto
{
    private int $id;
    private string $nombre;
    private string $descripcion;
    private string $cuerpo;
    private DateTime $fecha;
  
    public function __construct()
    {
        
    }

    static function of(int $id, string $nombre, string $descripcion, string $cuerpo, DateTime $fecha): NoticiaDto
    {
        $data = new NoticiaDto();
        $data->setId($id);
        $data->setNombre($nombre);
        $data->setDescripcion($descripcion);
        $data->setFecha($fecha);
       
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
     * @return 
     *
     */
    public function setNombre(string $nombre): NoticiaDto
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
     * @return 
     *
     */
    public function setId(int $id): NoticiaDto
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
     * @return 
     *
     */
    public function setDescripcion(string $descripcion): NoticiaDto
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    
    /**
     * @return string
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }

   /**
     * @param string $cuerpo
     * @return 
     *
     */
    public function setCuerpo(string $cuerpo): NoticiaDto
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * @return DateTime
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param DateTime $fecha
     * @return 
     *
     */
    public function setFecha(DateTime $fecha): NoticiaDto
    {
        $this->fecha = $fecha;

        return $this;
    }


}
?>