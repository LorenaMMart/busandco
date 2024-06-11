<?php

namespace App\Dto;

class CuerpoOrigenDestinoDto
{
    private int $idLinea;
    private string $linea;
    private string $empresa;
    private int $idSublinea;
    private string $sublinea;
    private array $direcciones;


    public function __construct()
    {
        
    }

    static function of(int $idLinea, string $linea,string $empresa, int $idSublinea, string $sublinea, array $direcciones): CuerpoOrigenDestinoDto {
        $data = new CuerpoOrigenDestinoDto();
        $data->setIdLinea($idLinea);
        $data->setLinea($linea);
        $data->setEmpresa($empresa);
        $data->setIdSublinea($idSublinea);
        $data->setSublinea($sublinea);
        $data->setDirecciones($direcciones);
        return $data;
    }

    /**
     * @return int
     */
    public function getIdLinea(): int
    {
        return $this->idLinea;
    }

    /**
     * @param int $idLinea
     * @return CuerpoOrigenDestinoDto
     */
    public function setIdLinea(int $idLinea): CuerpoOrigenDestinoDto
    {
        $this->idLinea = $idLinea;
        return $this;
    }

    /**
     * @return string
     */
    public function getLinea(): string
    {
        return $this->linea;
    }

    /**
     * @param string $linea
     * @return CuerpoOrigenDestinoDto
     */
    public function setLinea(string $linea): CuerpoOrigenDestinoDto
    {
        $this->linea = $linea;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmpresa(): string
    {
        return $this->empresa;
    }

    /**
     * @param string $empresa
     * @return CuerpoOrigenDestinoDto
     */
    public function setEmpresa(string $empresa): CuerpoOrigenDestinoDto
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return int
     */ 
    public function getIdSublinea()
    {
        return $this->idSublinea;
    }

    /**
     * @param int $idLinea
     * @return CuerpoOrigenDestinoDto
     */
    public function setIdSublinea($idSublinea) : CuerpoOrigenDestinoDto
    {
        $this->idSublinea = $idSublinea;

        return $this;
    }

    /**
     * @return string
     */ 
    public function getSublinea()
    {
        return $this->sublinea;
    }

     /**
     * @param string $sublinea
     * @return CuerpoOrigenDestinoDto
     */
    public function setSublinea($sublinea) : CuerpoOrigenDestinoDto
    {
        $this->sublinea = $sublinea;

        return $this;
    }

    /**
     * @return array
     */ 
    public function getDirecciones()
    {
        return $this->direcciones;
    }

    /**
     * @param array $direcciones
     * @return CuerpoOrigenDestinoDto
     */
    public function setDirecciones($direcciones)
    {
        $this->direcciones = $direcciones;

        return $this;
    }
}
?>