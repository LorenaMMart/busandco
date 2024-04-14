<?php

namespace App\Entity;

use App\Repository\SublineasParadasHorariosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SublineasParadasHorariosRepository::class)]
class SublineasParadasHorarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $orden = null;

    #[ORM\Column(length: 50)]
    private ?string $direccion = null;

    #[ORM\ManyToOne(inversedBy: 'sublineasParadasHorarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sublinea $sublinea = null;

    #[ORM\ManyToOne(inversedBy: 'sublineasParadasHorarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Horario $horario = null;

    #[ORM\ManyToOne(inversedBy: 'sublineasParadasHorarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parada $parada = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(int $orden): static
    {
        $this->orden = $orden;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getSublinea(): ?Sublinea
    {
        return $this->sublinea;
    }

    public function setSublinea(?Sublinea $sublinea): static
    {
        $this->sublinea = $sublinea;

        return $this;
    }

    public function getHorario(): ?Horario
    {
        return $this->horario;
    }

    public function setHorario(?Horario $horario): static
    {
        $this->horario = $horario;

        return $this;
    }

    public function getParada(): ?Parada
    {
        return $this->parada;
    }

    public function setParada(?Parada $parada): static
    {
        $this->parada = $parada;

        return $this;
    }
}
