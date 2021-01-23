<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetMeetingsByUser;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ApiResource(
 *     normalizationContext={"groups"={"users:read"}},
 *     denormalizationContext={"groups"={"users:write"}},
 *     itemOperations={
 *         "get",
 *         "put",
 *         "delete",
 *         "patch",
 *         "meetings"={
 *             "method"="GET",
 *             "path"="/users/{id}/meetings",
 *             "controller"=GetMeetingsByUser::class,
 *             "normalization_context"={"groups"={"user_read:meetings"}},
 *         },
 *     },
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"users:read"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"users:read", "users:write"})
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"users:read", "users:write"})
     * @var string[]
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"users:write"})
     */
    private ?string $password = null;

    /**
     * @ORM\OneToMany(targetEntity=MeetingUser::class, mappedBy="user")
     * @Groups({"users:read"})
     */
    private Collection $meetingUsers;

    public function __construct()
    {
        $this->meetingUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

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
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMeetingUsers(): Collection
    {
        return $this->meetingUsers;
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // Implement method
    }
}
