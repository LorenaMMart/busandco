<?php

namespace App\Dto;

class CuerpoOrigenDestinoDto
{
    private array $lineasCO;
    private array $sublineasCO;
    private array $horarioParadaCO;
    private array $subParHorCO;

    public function __construct()
    {
        
    }
    
    static function of(array $lineasCO, array $sublineasCO, array $horarioParadaCO, array $subParHorCO): CuerpoOrigenDestinoDto{
        $data = new CuerpoOrigenDestinoDto();
        $data->setLineasCO($lineasCO);
        $data->setSublinasCO($sublineasCO);
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
     * @return CuerpoOrigenDestinoDto
     */
    public function setLineasCO($lineasCO): CuerpoOrigenDestinoDto
    {
        $this->lineasCO = $lineasCO;

        return $this;
    }

    /**
     * @return array
     */ 
    public function getSublinasCO()
    {
        return $this->sublineasCO;
    }

    /**
     * @param array $sublinasCO
     * @return CuerpoOrigenDestinoDto
     */
    public function setSublinasCO($sublineasCO): CuerpoOrigenDestinoDto
    {
        $this->sublineasCO = $sublineasCO;

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
     * @return CuerpoOrigenDestinoDto
     */
    public function setHorarioParadaCO($horarioParadaCO): CuerpoOrigenDestinoDto
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
     * @return CuerpoOrigenDestinoDto
     */
    public function setSubParHorCO($subParHorCO): CuerpoOrigenDestinoDto
    {
        $this->subParHorCO = $subParHorCO;

        return $this;
    }
}
?>