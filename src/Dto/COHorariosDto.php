<?php

namespace App\Dto;

class COHorariosDto
{
    private int $id;
    private array $horario;
    private string $tipo;
   
    public function __construct()
    {
        
    }

    static function of(int $id, array $horario, string $tipo): COHorariosDto
    {
        $data = new COHorariosDto();
        $data->setId($id);
        $data->setHorario($horario);
        $data->setTipo($tipo);
       
        return $data;
    }

    /**
     * @return int
     */ 
    public function getId()
    {
        return $this->id;
    }

     /**
     * @param int $id
     * @return COHorariosDto
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * @return COHorariosDto
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

     /**
     * @param string $tipo
     * @return COHorariosDto
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}
?>