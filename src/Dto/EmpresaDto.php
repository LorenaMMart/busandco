<?php

namespace App\Dto;

class EmpresaDto
{
    private int $id;
    private string $nombre;
    private string $direccion;
    private string $telefono;
    private string $email;
    private string $web;
   
    public function __construct()
    {
        
    }

    static function of(int $id,string $nombre, string $direccion, string $telefono, string $email, string $web): EmpresaDto
    {
        $data = new EmpresaDto();
        $data->setId($id);
        $data->setNombre($nombre);
        $data->setDireccion($direccion);
        $data->setTelefono($telefono);
        $data->setEmail($email);
        $data->setWeb($web);
       
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

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     * @return EmpresaDto
     *
     */
    public function setDireccion(string $direccion): EmpresaDto
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     * @return EmpresaDto
     *
     */
    public function setTelefono(string $telefono): EmpresaDto
    {
        $this->telefono = $telefono;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return EmpresaDto
     *
     */
    public function setEmail(string $email): EmpresaDto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeb(): string
    {
        return $this->web;
    }

    /**
     * @param string $web
     * @return EmpresaDto
     *
     */
    public function setWeb(string $web): EmpresaDto
    {
        $this->web = $web;
        return $this;
    }


}
?>