<?php

namespace App\Entity;

use App\Entity\Interfaces\VoteInterface;
use App\Entity\Traits\VoteTrait;
use App\Repository\HasVotedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HasVotedRepository::class)
 */
class HasVoted implements VoteInterface
{
    use VoteTrait;

    /**
     * @ORM\ManyToOne(targetEntity=MeetingUser::class, inversedBy="votedAgendas")
     * @ORM\JoinColumn(nullable=false)
     */
    private MeetingUser $meetingUser;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $hasVoted;

    public function getMeetingUser(): MeetingUser
    {
        return $this->meetingUser;
    }

    public function setMeetingUser(MeetingUser $meetingUser): self
    {
        $this->meetingUser = $meetingUser;

        return $this;
    }

    public function getHasVoted(): ?bool
    {
        return $this->hasVoted;
    }

    public function setHasVoted(bool $hasVoted): self
    {
        $this->hasVoted = $hasVoted;

        return $this;
    }
}
