<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $direccion = null;

    #[ORM\Column(length: 50)]
    private ?string $telefono = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    private ?string $web = null;

   
    /**
     * @var Collection<int, Linea>
     */
    #[ORM\OneToMany(targetEntity: Linea::class, mappedBy: 'empresa')]
    #[Ignore] 
    private Collection $lineas;

    public function __construct()
    {
        $this->lineas = new ArrayCollection();
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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(string $web): static
    {
        $this->web = $web;

        return $this;
    }

    /**
     * @return Collection<int, Linea>
     */
    public function getLineas(): Collection
    {
        return $this->lineas;
    }

    public function addLinea(Linea $linea): static
    {
        if (!$this->lineas->contains($linea)) {
            $this->lineas->add($linea);
            $linea->setEmpresa($this);
        }

        return $this;
    }

    public function removeLinea(Linea $linea): static
    {
        if ($this->lineas->removeElement($linea)) {
            // set the owning side to null (unless already changed)
            if ($linea->getEmpresa() === $this) {
                $linea->setEmpresa(null);
            }
        }

        return $this;
    }
}
