<?php

namespace App\Dto;

class ParadaDto
{
    private int $id;
    private string $nombre;
    private float $latitud;
    private float $longitud;
   
    public function __construct()
    {
        
    }

    static function of(int $id,string $nombre, float $latitud, float $longitud): ParadaDto
    {
        $data = new ParadaDto();
        $data->setId($id);
        $data->setNombre($nombre);
        $data->setLatitud($latitud);
        $data->setLongitud($longitud);
       
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
     * @return ParadaDto
     *
     */
    public function setNombre(string $nombre): ParadaDto
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
     * @return ParadaDto
     *
     */
    public function setId(int $id): ParadaDto
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return float
     */
    public function getLatitud(): float
    {
        return $this->latitud;
    }

    /**
     * @param float $id
     * @return ParadaDto
     *
     */
    public function setLatitud(float $latitud): ParadaDto
    {
        $this->latitud = $latitud;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitud(): float
    {
        return $this->longitud;
    }

    /**
     * @param float $id
     * @return ParadaDto
     *
     */
    public function setLongitud(float $longitud): ParadaDto
    {
        $this->longitud = $longitud;
        return $this;
    }   
}
?>