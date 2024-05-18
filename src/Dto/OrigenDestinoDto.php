<?php

namespace App\Dto;

class OrigenDestinoDto
{
    private int $idParada;
    private string $parada;
    private int $idEmpresa;
    private string $Empresa;
    
    private string $nombre;
   
    public function __construct()
    {
        
    }

    // static function of(int $id,string $nombre): OrigenDestinoDto
    // {
    //     $data = new OrigenDestinoDto();
    //     $data->setId($id);
    //     $data->setNombre($nombre);
       
    //     return $data;
    // }

    // /**
    //  * @return string
    //  */
    // public function getNombre(): string
    // {
    //     return $this->nombre;
    // }

    // /**
    //  * @param string $nombre
    //  * @return OrigenDestinoDto
    //  */
    // public function setNombre(string $nombre): OrigenDestinoDto
    // {
    //     $this->nombre = $nombre;
    //     return $this;
    // }

    // /**
    //  * @return int
    //  */
    // public function getId(): int
    // {
    //     return $this->id;
    // }

    // /**
    //  * @param string $id
    //  * @return OrigenDestinoDto
    //  */
    // public function setId(int $id): OrigenDestinoDto
    // {
    //     $this->id = $id;
    //     return $this;
    // }    
}
?>