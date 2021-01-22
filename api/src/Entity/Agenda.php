<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AgendaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgendaRepository::class)
 * @ApiResource
 */
class Agenda
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=Meeting::class, inversedBy="agendas")
     * @ORM\JoinColumn(nullable=false)
     */
    private Meeting $meeting;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $label;

    /**
     * @ORM\Column(type="float")
     */
    private float $majority = 50;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="agenda", orphanRemoval=true)
     */
    private Collection $votes;

    /**
     * @ORM\OneToMany(targetEntity=HasVoted::class, mappedBy="agenda", orphanRemoval=true)
     */
    private Collection $usersVoted;

    /* TODO: add file */

    public function __construct()
    {
        $this->votes = new ArrayCollection();
        $this->usersVoted = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeeting(): Meeting
    {
        return $this->meeting;
    }

    public function setMeeting(Meeting $meeting): self
    {
        $this->meeting = $meeting;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getMajority(): ?float
    {
        return $this->majority;
    }

    public function setMajority(float $majority): self
    {
        $this->majority = $majority;

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setAgenda($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        $this->votes->removeElement($vote);

        return $this;
    }

    /**
     * @return Collection|HasVoted[]
     */
    public function getUsersVoted(): Collection
    {
        return $this->usersVoted;
    }

    public function addUsersVoted(HasVoted $usersVoted): self
    {
        if (!$this->usersVoted->contains($usersVoted)) {
            $this->usersVoted[] = $usersVoted;
            $usersVoted->setAgenda($this);
        }

        return $this;
    }

    public function removeUsersVoted(HasVoted $usersVoted): self
    {
        $this->usersVoted->removeElement($usersVoted);

        return $this;
    }
}
