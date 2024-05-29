<?php

namespace App\Entity;

use App\Repository\LineaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineaRepository::class)]
class Linea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'lineas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Empresa $empresa = null;

    /**
     * @var Collection<int, Sublinea>
     */
    #[ORM\OneToMany(targetEntity: Sublinea::class, mappedBy: 'linea')]
    private Collection $sublineas;

    #[ORM\Column(length: 50)]
    private ?string $tipo = null;

    public function __construct()
    {
        $this->sublineas = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): static
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * @return Collection<int, Sublinea>
     */
    public function getSublineas(): Collection
    {
        return $this->sublineas;
    }

    public function addSublinea(Sublinea $sublinea): static
    {
        if (!$this->sublineas->contains($sublinea)) {
            $this->sublineas->add($sublinea);
            $sublinea->setLinea($this);
        }

        return $this;
    }

    public function removeSublinea(Sublinea $sublinea): static
    {
        if ($this->sublineas->removeElement($sublinea)) {
            // set the owning side to null (unless already changed)
            if ($sublinea->getLinea() === $this) {
                $sublinea->setLinea(null);
            }
        }

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }
}
