<?php

namespace App\Entity;

use App\Repository\IncidenciasSublineasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncidenciasSublineasRepository::class)]
class IncidenciasSublineas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'incidenciasSublineas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Incidencia $indicencia = null;

    #[ORM\ManyToOne(inversedBy: 'incidenciasSublineas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sublinea $sublinea = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndicencia(): ?Incidencia
    {
        return $this->indicencia;
    }

    public function setIndicencia(?Incidencia $indicencia): static
    {
        $this->indicencia = $indicencia;

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
