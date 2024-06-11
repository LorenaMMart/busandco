<?php

namespace App\Entity;

use App\Repository\IncidenciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncidenciaRepository::class)]
class Incidencia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(nullable : true)]
    private ?bool $estado = null;

    /**
     * @var Collection<int, IncidenciasSublineas>
     */
    #[ORM\OneToMany(targetEntity: IncidenciasSublineas::class, mappedBy: 'incidencia')]
    private Collection $incidenciasSublineas;

    public function __construct()
    {
        $this->incidenciasSublineas = new ArrayCollection();
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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function isEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(BooleanType $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection<int, IncidenciasSublineas>
     */
    public function getIncidenciasSublineas(): Collection
    {
        return $this->incidenciasSublineas;
    }

    public function addIncidenciasSublinea(IncidenciasSublineas $incidenciasSublinea): static
    {
        if (!$this->incidenciasSublineas->contains($incidenciasSublinea)) {
            $this->incidenciasSublineas->add($incidenciasSublinea);
            $incidenciasSublinea->setIncidencia($this);
        }

        return $this;
    }

    public function removeIncidenciasSublinea(IncidenciasSublineas $incidenciasSublinea): static
    {
        if ($this->incidenciasSublineas->removeElement($incidenciasSublinea)) {
            // set the owning side to null (unless already changed)
            if ($incidenciasSublinea->getIncidencia() === $this) {
                $incidenciasSublinea->setIncidencia(null);
            }
        }

        return $this;
    }
}
