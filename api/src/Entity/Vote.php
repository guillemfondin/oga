<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Interfaces\VoteInterface;
use App\Entity\Traits\VoteTrait;
use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 * @ApiResource(
 *     itemOperations={},
 *     collectionOperations={
 *         "get",
 *         "post"
 *     }
 * )
 */
class Vote implements VoteInterface
{
    use VoteTrait;

    /**
     * @ORM\ManyToOne(targetEntity=MeetingUser::class)
     */
    private ?MeetingUser $meetingUser = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $value;

    public function getMeetingUser(): ?MeetingUser
    {
        return $this->meetingUser;
    }

    public function setMeetingUser(?MeetingUser $meetingUser): self
    {
        $this->meetingUser = $meetingUser;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
