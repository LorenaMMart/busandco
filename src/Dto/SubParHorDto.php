<?php

namespace App\Dto;

class SubParHorDto
{
    private int $orden;
    private string $direccion;
    private int $idParada;
   
    public function __construct()
    {
        
    }

    static function of(int $orden,string $direccion, int $idParada): SubParHorDto
    {
        $data = new SubParHorDto();
        $data->setorden($orden);
        $data->setdireccion($direccion);
        $data->setidParada($idParada);
       
        return $data;
    }

    /**
     * @return string
     */
    public function getdireccion(): string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     * @return SubParHorDto
     */
    public function setdireccion(string $direccion): SubParHorDto
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * @return int
     */
    public function getorden(): int
    {
        return $this->orden;
    }

    /**
     * @param int $orden
     * @return SubParHorDto
     */
    public function setorden(int $orden): SubParHorDto
    {
        $this->orden = $orden;
        return $this;
    }    

    /**
     * @return int
     */
    public function getidParada()
    {
        return $this->idParada;
    }

    
    /**
     * @param int $idParada
     * @return SubParHorDto
     */
    public function setidParada($idParada) : SubParHorDto
    {
        $this->idParada = $idParada;

        return $this;
    }
}
?>