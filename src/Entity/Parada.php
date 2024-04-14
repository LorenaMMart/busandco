<?php

namespace App\Entity;

use App\Repository\ParadaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParadaRepository::class)]
class Parada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?float $latitud = null;

    #[ORM\Column]
    private ?float $longitud = null;

    #[ORM\ManyToOne(inversedBy: 'paradas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poblacion $poblacion = null;

    /**
     * @var Collection<int, SublineasParadasHorarios>
     */
    #[ORM\OneToMany(targetEntity: SublineasParadasHorarios::class, mappedBy: 'parada')]
    private Collection $sublineasParadasHorarios;

    public function __construct()
    {
        $this->sublineasParadasHorarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
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

    public function getPoblacion(): ?Poblacion
    {
        return $this->poblacion;
    }

    public function setPoblacion(?Poblacion $poblacion): static
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * @return Collection<int, SublineasParadasHorarios>
     */
    public function getSublineasParadasHorarios(): Collection
    {
        return $this->sublineasParadasHorarios;
    }

    public function addSublineasParadasHorario(SublineasParadasHorarios $sublineasParadasHorario): static
    {
        if (!$this->sublineasParadasHorarios->contains($sublineasParadasHorario)) {
            $this->sublineasParadasHorarios->add($sublineasParadasHorario);
            $sublineasParadasHorario->setParada($this);
        }

        return $this;
    }

    public function removeSublineasParadasHorario(SublineasParadasHorarios $sublineasParadasHorario): static
    {
        if ($this->sublineasParadasHorarios->removeElement($sublineasParadasHorario)) {
            // set the owning side to null (unless already changed)
            if ($sublineasParadasHorario->getParada() === $this) {
                $sublineasParadasHorario->setParada(null);
            }
        }

        return $this;
    }
}
