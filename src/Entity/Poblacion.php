<?php

namespace App\Entity;

use App\Repository\PoblacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoblacionRepository::class)]
class Poblacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Parada>
     */
    #[ORM\OneToMany(targetEntity: Parada::class, mappedBy: 'poblacion')]
    private Collection $paradas;

    public function __construct()
    {
        $this->paradas = new ArrayCollection();
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

    /**
     * @return Collection<int, Parada>
     */
    public function getParadas(): Collection
    {
        return $this->paradas;
    }

    public function addParada(Parada $parada): static
    {
        if (!$this->paradas->contains($parada)) {
            $this->paradas->add($parada);
            $parada->setPoblacion($this);
        }

        return $this;
    }

    public function removeParada(Parada $parada): static
    {
        if ($this->paradas->removeElement($parada)) {
            // set the owning side to null (unless already changed)
            if ($parada->getPoblacion() === $this) {
                $parada->setPoblacion(null);
            }
        }

        return $this;
    }
}
