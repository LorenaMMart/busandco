<?php

namespace App\Entity;

use App\Repository\SublineaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: SublineaRepository::class)]
class Sublinea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'sublineas')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Linea $linea = null;

    /**
     * @var Collection<int, SublineasParadasHorarios>
     */
    #[ORM\OneToMany(targetEntity: SublineasParadasHorarios::class, mappedBy: 'sublinea')]
    #[Ignore]
    private Collection $sublineasParadasHorarios;

    /**
     * @var Collection<int, IncidenciasSublineas>
     */
    #[ORM\OneToMany(targetEntity: IncidenciasSublineas::class, mappedBy: 'sublinea')]
    #[Ignore]
    private Collection $incidenciasSublineas;

    /**
     * @var Collection<int, Coordenadas>
     */
    #[ORM\OneToMany(targetEntity: Coordenadas::class, mappedBy: 'sublinea')]
    #[Ignore]
    private Collection $coordenadas;

    public function __construct()
    {
        $this->sublineasParadasHorarios = new ArrayCollection();
        $this->incidenciasSublineas = new ArrayCollection();
        $this->coordenadas = new ArrayCollection();
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

    public function getLinea(): ?Linea
    {
        return $this->linea;
    }

    public function setLinea(?Linea $linea): static
    {
        $this->linea = $linea;

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
            $sublineasParadasHorario->setSublinea($this);
        }

        return $this;
    }

    public function removeSublineasParadasHorario(SublineasParadasHorarios $sublineasParadasHorario): static
    {
        if ($this->sublineasParadasHorarios->removeElement($sublineasParadasHorario)) {
            // set the owning side to null (unless already changed)
            if ($sublineasParadasHorario->getSublinea() === $this) {
                $sublineasParadasHorario->setSublinea(null);
            }
        }

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
            $incidenciasSublinea->setSublinea($this);
        }

        return $this;
    }

    public function removeIncidenciasSublinea(IncidenciasSublineas $incidenciasSublinea): static
    {
        if ($this->incidenciasSublineas->removeElement($incidenciasSublinea)) {
            // set the owning side to null (unless already changed)
            if ($incidenciasSublinea->getSublinea() === $this) {
                $incidenciasSublinea->setSublinea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Coordenadas>
     */
    public function getCoordenadas(): Collection
    {
        return $this->coordenadas;
    }

    public function addCoordenada(Coordenadas $coordenada): static
    {
        if (!$this->coordenadas->contains($coordenada)) {
            $this->coordenadas->add($coordenada);
            $coordenada->setSublinea($this);
        }

        return $this;
    }

    public function removeCoordenada(Coordenadas $coordenada): static
    {
        if ($this->coordenadas->removeElement($coordenada)) {
            // set the owning side to null (unless already changed)
            if ($coordenada->getSublinea() === $this) {
                $coordenada->setSublinea(null);
            }
        }

        return $this;
    }

   
}
