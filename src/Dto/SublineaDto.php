<?php

namespace App\Dto;

class SublineaDto
{
    private int $id;
    private string $nombre;
   
    public function __construct()
    {
        
    }

    static function of(int $id,string $nombre): SublineaDto
    {
        $data = new SublineaDto();
        $data->setId($id);
        $data->setNombre($nombre);
       
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
     * @return SublineaDto
     */
    public function setNombre(string $nombre): SublineaDto
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
     * @return SublineaDto
     */
    public function setId(int $id): SublineaDto
    {
        $this->id = $id;
        return $this;
    }    
}
?>