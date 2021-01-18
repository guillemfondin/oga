<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MeetingUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeetingUserRepository::class)
 * @ApiResource
 */
class MeetingUser
{
    public const ROLE_READER = 'ROLE_READER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_VOTER = 'ROLE_VOTER';
    public const ROLE_WRITER = 'ROLE_WRITER';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=Meeting::class, inversedBy="meetingUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private Meeting $meeting;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="meetingUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    /**
     * @ORM\Column(type="json")
     * @var string[]
     */
    private array $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=HasVoted::class, mappedBy="meetingUser", orphanRemoval=true)
     */
    private Collection $votedAgendas;

    public function __construct()
    {
        $this->votedAgendas = new ArrayCollection();
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = self::ROLE_READER;

        return array_unique($roles);
    }

    /**
     * @param string[] $roles
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|HasVoted[]
     */
    public function getVotedAgendas(): Collection
    {
        return $this->votedAgendas;
    }

    public function addVotedAgenda(HasVoted $votedAgenda): self
    {
        if (!$this->votedAgendas->contains($votedAgenda)) {
            $this->votedAgendas[] = $votedAgenda;
            $votedAgenda->setMeetingUser($this);
        }

        return $this;
    }

    public function removeVotedAgenda(HasVoted $votedAgenda): self
    {
        $this->votedAgendas->removeElement($votedAgenda);

        return $this;
    }
}
