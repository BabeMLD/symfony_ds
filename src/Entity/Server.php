<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ServerRepository::class)]
class Server
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("server : read")]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups("server : read")]
    private ?string $name = null;

    #[ORM\Column(length: 80)]
    private ?string $freq_prop = null;

    #[ORM\Column(length: 50)]
    #[Groups("server : read")]
    private ?string $taille_m = null;

    #[ORM\Column(length: 50)]
    #[Groups("server : read")]
    private ?string $taille_db = null;

    #[ORM\OneToMany(mappedBy: 'server_id', targetEntity: Technicien::class)]
    private Collection $technicien_id;

    public function __construct()
    {
        $this->technicien_id = new ArrayCollection();
    }

   

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

    public function getFreqProp(): ?string
    {
        return $this->freq_prop;
    }

    public function setFreqProp(string $freq_prop): self
    {
        $this->freq_prop = $freq_prop;

        return $this;
    }

    public function getTailleM(): ?string
    {
        return $this->taille_m;
    }

    public function setTailleM(string $taille_m): self
    {
        $this->taille_m = $taille_m;

        return $this;
    }

    public function getTailleDb(): ?string
    {
        return $this->taille_db;
    }

    public function setTailleDb(string $taille_db): self
    {
        $this->taille_db = $taille_db;

        return $this;
    }

    /**
     * @return Collection<int, technicien>
     */
    public function getTechnicienId(): Collection
    {
        return $this->technicien_id;
    }

    public function addTechnicienId(technicien $technicienId): self
    {
        if (!$this->technicien_id->contains($technicienId)) {
            $this->technicien_id->add($technicienId);
            $technicienId->setServerId($this);
        }

        return $this;
    }

    public function removeTechnicienId(technicien $technicienId): self
    {
        if ($this->technicien_id->removeElement($technicienId)) {
            // set the owning side to null (unless already changed)
            if ($technicienId->getServerId() === $this) {
                $technicienId->setServerId(null);
            }
        }

        return $this;
    }

  
}
