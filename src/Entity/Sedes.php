<?php

namespace App\Entity;

use App\Repository\SedesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SedesRepository::class)]
class Sedes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $localizacion;

    #[ORM\OneToMany(mappedBy: 'sede', targetEntity: Proyectos::class)]
    private $proyectos;

    #[ORM\OneToOne(inversedBy: 'sede', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $administradorSede;

    public function __construct()
    {
        $this->proyectos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getLocalizacion(): ?string
    {
        return $this->localizacion;
    }

    public function setLocalizacion(string $localizacion): self
    {
        $this->localizacion = $localizacion;

        return $this;
    }

    /**
     * @return Collection<int, Proyectos>
     */
    public function getProyectos(): Collection
    {
        return $this->proyectos;
    }

    public function addProyecto(Proyectos $proyecto): self
    {
        if (!$this->proyectos->contains($proyecto)) {
            $this->proyectos[] = $proyecto;
            $proyecto->setSede($this);
        }

        return $this;
    }

    public function removeProyecto(Proyectos $proyecto): self
    {
        if ($this->proyectos->removeElement($proyecto)) {
            // set the owning side to null (unless already changed)
            if ($proyecto->getSede() === $this) {
                $proyecto->setSede(null);
            }
        }

        return $this;
    }

    public function getAdministradorSede(): ?User
    {
        return $this->administradorSede;
    }

    public function setAdministradorSede(?User $administradorSede): self
    {
        $this->administradorSede = $administradorSede;

        return $this;
    }
}
