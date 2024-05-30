<?php

namespace App\Dto;

class CuerpoOrigenDestino
{
    private array $lineasCO;
    private array $sublinasCO;
    private array $paradasCO;
    private array $horarioParadaCO;
    private array $subParHorCO;

    public function __construct()
    {
        
    }
    
    static function of(array $lineasCO, array $sublinasCO, array $paradasCO, array $horarioParadaCO, array $subParHorCO): CuerpoOrigenDestino{
        $data = new CuerpoOrigenDestino();
        $data->setLineasCO($lineasCO);
        $data->setSublinasCO($sublinasCO);
        $data->setParadasCO($paradasCO);
        $data->setHorarioParadaCO($horarioParadaCO);
        $data->setSubParHorCO($subParHorCO);
        return $data;
    }

    /**
     * @return array
     */
    public function getLineasCO()
    {
        return $this->lineasCO;
    }

   /**
     * @param array $lineasCO
     * @return CuerpoOrigenDestino
     */
    public function setLineasCO($lineasCO)
    {
        $this->lineasCO = $lineasCO;

        return $this;
    }

    /**
     * @return array
     */ 
    public function getSublinasCO()
    {
        return $this->sublinasCO;
    }

    /**
     * @param array $sublinasCO
     * @return CuerpoOrigenDestino
     */
    public function setSublinasCO($sublinasCO)
    {
        $this->sublinasCO = $sublinasCO;

        return $this;
    }

    /**
     * @return array
     */ 
    public function getParadasCO()
    {
        return $this->paradasCO;
    }

    /**
     * @param array $paradasCO
     * @return CuerpoOrigenDestino
     */
    public function setParadasCO($paradasCO)
    {
        $this->paradasCO = $paradasCO;

        return $this;
    }

    /**
     * @return array
     */ 
    public function getHorarioParadaCO()
    {
        return $this->horarioParadaCO;
    }

    /**
     * @param array $horarioParadaCO
     * @return CuerpoOrigenDestino
     */
    public function setHorarioParadaCO($horarioParadaCO)
    {
        $this->horarioParadaCO = $horarioParadaCO;

        return $this;
    }

    /**
     * @return array
     */
    public function getSubParHorCO()
    {
        return $this->subParHorCO;
    }

    /**
     * @param array $subParHorCO
     * @return CuerpoOrigenDestino
     */
    public function setSubParHorCO($subParHorCO)
    {
        $this->subParHorCO = $subParHorCO;

        return $this;
    }
}
?>