<?php


namespace App\Entity\Traits;

use App\Entity\Agenda;
use App\Entity\MeetingUser;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait VoteTrait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=Agenda::class, inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private Agenda $agenda;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $votedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgenda(): Agenda
    {
        return $this->agenda;
    }

    public function setAgenda(Agenda $agenda): self
    {
        $this->agenda = $agenda;

        return $this;
    }

    public function getVotedAt(): DateTimeInterface
    {
        return $this->votedAt;
    }

    public function setVotedAt(DateTimeInterface $votedAt): self
    {
        $this->votedAt = $votedAt;

        return $this;
    }
}
