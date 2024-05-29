<?php

namespace App\Dto;

use DateTime;

class ParadaHorarioDto
{
    private int $idParada;
    private string $nombreParada;
    private array $horario;
   
    public function __construct()
    {
        
    }

    static function of(int $idParada, string $nombreParada, array $horario): ParadaHorarioDto
    {
        $data = new ParadaHorarioDto();
        $data->setIdParada($idParada);
        $data->setNombreParada($nombreParada);
        for ($i=0; $i < count($horario) ; $i++) { 
            $horario[$i]['hora']=$horario[$i]['hora']->format('H:i');
        }
        $data->setHorario($horario);
       
        return $data;
    }

    /**
     * @return int
     */
    public function getIdParada(): int
    {
        return $this->idParada;
    }

    /**
     * @param string $idParada
     * @return ParadaHorarioDto
     */
    public function setIdParada(int $idParada): ParadaHorarioDto
    {
        $this->idParada = $idParada;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombreParada(): string
    {
        return $this->nombreParada;
    }

    /**
     * @param string $nombreParada
     * @return ParadaHorarioDto
     */
    public function setNombreParada(string $nombreParada): ParadaHorarioDto
    {
        $this->nombreParada = $nombreParada;
        return $this;
    }

    /**
     * @return array
     */
    public function getHorario(): array
    {
        return $this->horario;
    }

    /**
     * @param array $horario
     * @return ParadaHorarioDto
     */
    public function setHorario(array $horario): ParadaHorarioDto
    {
        $this->horario = $horario;
        return $this;
    }  
}
?>