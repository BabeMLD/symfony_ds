<?php

namespace App\Entity;

use App\Repository\TechnicienRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TechnicienRepository::class)]
class Technicien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("tech : read")]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups("tech : read")]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    #[Groups("tech : read")]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    #[Groups("tech : read")]
    private ?string $date_naissance = null;

    #[ORM\ManyToOne(inversedBy: 'technicien_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Server $server_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?string
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(string $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getServerId(): ?Server
    {
        return $this->server_id;
    }

    public function setServerId(?Server $server_id): self
    {
        $this->server_id = $server_id;

        return $this;
    }
}
