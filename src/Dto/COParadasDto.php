<?php

namespace App\Dto;

class COParadasDto
{
    private int $idParada;
    private string $parada;
    private string $poblacion;
    private int $orden;
    private array $horario;
   
    public function __construct()
    {
        
    }

    static function of(int $idParada, string $parada, string $poblacion, int $orden, array $horario): COParadasDto
    {
        $data = new COParadasDto();
        $data->setIdParada($idParada);
        $data->setParada($parada);
        $data->setPoblacion($poblacion);
        $data->setOrden($orden);
        for ($i=0; $i < count($horario) ; $i++) { 
            $horario[$i]['hora']=$horario[$i]['hora']->format('H:i');
        }
        $data->setHorario($horario);
       
        return $data;
    }

    /**
     * @return int
     */
    public function getIdParada()
    {
        return $this->idParada;
    }

    /**
     * @param int $idparadas
     * @return COParadasDto
     */ 
    public function setIdParada($idParada)
    {
        $this->idParada = $idParada;

        return $this;
    }

    /**
     * @return string
     */
    public function getParada()
    {
        return $this->parada;
    }

   /**
     * @param string $paradas
     * @return COParadasDto
     */ 
    public function setParada($parada)
    {
        $this->parada = $parada;

        return $this;
    }

    /**
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * @param string $poblacion
     * @return COParadasDto
     */ 
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * @param string $int
     * @return COParadasDto
     */ 
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * @return array
     */ 
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * @param array $horario
     * @return COParadasDto
     */ 
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }
}
?>