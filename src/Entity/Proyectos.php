<?php

namespace App\Entity;

use App\Repository\ProyectosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProyectosRepository::class)]
class Proyectos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 88888, nullable: true)]
    private $descripcion;

    #[ORM\ManyToOne(targetEntity: sedes::class, inversedBy: 'Proyectos')]
    private $sede;

    #[ORM\OneToMany(mappedBy: 'proyecto', targetEntity: User::class)]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getSede(): ?sedes
    {
        return $this->sede;
    }

    public function setSede(?sedes $sede): self
    {
        $this->sede = $sede;

        return $this;
    }
}
