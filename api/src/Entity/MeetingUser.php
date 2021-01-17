<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MeetingUserRepository;
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
     */
    private array $roles = [];

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

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = self::ROLE_READER;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
