<?php

namespace App\Entity;

use App\Repository\HorarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HorarioRepository::class)]
class Horario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hora = null;

    #[ORM\Column(length: 50)]
    private ?string $tipo = null;

    /**
     * @var Collection<int, SublineasParadasHorarios>
     */
    #[ORM\OneToMany(targetEntity: SublineasParadasHorarios::class, mappedBy: 'horario')]
    private Collection $sublineasParadasHorarios;

    public function __construct()
    {
        $this->sublineasParadasHorarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHora(): ?\DateTimeInterface
    {
        return $this->hora;
    }

    public function setHora(\DateTimeInterface $hora): static
    {
        $this->hora = $hora;

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
            $sublineasParadasHorario->setHorario($this);
        }

        return $this;
    }

    public function removeSublineasParadasHorario(SublineasParadasHorarios $sublineasParadasHorario): static
    {
        if ($this->sublineasParadasHorarios->removeElement($sublineasParadasHorario)) {
            // set the owning side to null (unless already changed)
            if ($sublineasParadasHorario->getHorario() === $this) {
                $sublineasParadasHorario->setHorario(null);
            }
        }

        return $this;
    }
}
