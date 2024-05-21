<?php

namespace App\Dto;

use Doctrine\DBAL\Types\BlobType;

class EmpresaDto
{
    private int $id;
    private string $nombre;
   
    public function __construct()
    {
        
    }

    static function of(int $id,string $nombre): EmpresaDto
    {
        $data = new EmpresaDto();
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
     * @return EmpresaDto
     *
     */
    public function setNombre(string $nombre): EmpresaDto
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
     * @return EmpresaDto
     *
     */
    public function setId(int $id): EmpresaDto
    {
        $this->id = $id;
        return $this;
    }
   
}
?>