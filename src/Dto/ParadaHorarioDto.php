<?php

namespace App\Dto;

use DateTime;

class ParadaHorarioDto
{
    private string $nombreParada;
    private DateTime $horario;
    private string $tipo;
   
    public function __construct()
    {
        
    }

    static function of(string $nombreParada, DateTime $horario, string $tipo): ParadaHorarioDto
    {
        $data = new ParadaHorarioDto();
        $data->setNombreParada($nombreParada);
        $data->setHorario($horario);
        $data->setTipo($tipo);
       
        return $data;
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
     * @return DateTime
     */
    public function getHorario(): DateTime
    {
        return $this->horario;
    }

    /**
     * @param DateTime $horario
     * @return ParadaHorarioDto
     */
    public function setHorario(DateTime $horario): ParadaHorarioDto
    {
        $this->horario = $horario;
        return $this;
    }
    
    /**
     * @return string $tipo
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return ParadaHorarioDto
     */
    public function setTipo(string $tipo): ParadaHorarioDto
    {
        $this->tipo = $tipo;
        return $this;
    }  
    
}
?>