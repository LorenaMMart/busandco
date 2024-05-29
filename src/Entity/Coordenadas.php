<?php

namespace App\Entity;

use App\Repository\CoordenadasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoordenadasRepository::class)]
class Coordenadas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $latitud = null;

    #[ORM\Column]
    private ?float $longitud = null;

    #[ORM\Column]
    private ?int $orden = null;

    #[ORM\ManyToOne(inversedBy: 'coordenadas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sublinea $sublinea = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitud(): ?float
    {
        return $this->latitud;
    }

    public function setLatitud(float $latitud): static
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function getLongitud(): ?float
    {
        return $this->longitud;
    }

    public function setLongitud(float $longitud): static
    {
        $this->longitud = $longitud;

        return $this;
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

    public function getSublinea(): ?Sublinea
    {
        return $this->sublinea;
    }

    public function setSublinea(?Sublinea $sublinea): static
    {
        $this->sublinea = $sublinea;

        return $this;
    }
}
