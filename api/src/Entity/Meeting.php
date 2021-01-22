<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\NextAgendaMeetingController;
use App\Repository\MeetingRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use function in_array;

/**
 * @ORM\Entity(repositoryClass=MeetingRepository::class)
 * @ApiResource(
 *     itemOperations={
 *         "get",
 *         "put",
 *         "delete",
 *         "patch"={
 *             "method"="PATCH",
 *             "path"="/meetings/{id}/next",
 *             "controller"=NextAgendaMeetingController::class,
 *             "normalization_context"={"groups"={"meeting_read:next"}},
 *             "denormalization_context"={"groups"={"meeting_write:next"}}
 *         },
 *     },
 *     collectionOperations={
 *         "get",
 *         "post"
 *     }
 * )
 */
class Meeting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $subject;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $quorum = null;

    /**
     * @ORM\OneToOne(targetEntity=Agenda::class, cascade={"persist", "remove"})
     * @Groups({"meeting_read:next"})
     */
    private ?Agenda $currentAgenda = null;

    /**
     * @ORM\OneToMany(targetEntity=Agenda::class, mappedBy="meeting", orphanRemoval=true)
     */
    private Collection $agendas;

    /**
     * @ORM\OneToMany(targetEntity=MeetingUser::class, mappedBy="meeting")
     */
    private Collection $meetingUsers;

    public function __construct()
    {
        $this->agendas = new ArrayCollection();
        $this->meetingUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getQuorum(): ?float
    {
        return $this->quorum;
    }

    public function setQuorum(?float $quorum): self
    {
        $this->quorum = $quorum;

        return $this;
    }

    public function getCurrentAgenda(): ?Agenda
    {
        return $this->currentAgenda;
    }

    public function setCurrentAgenda(?Agenda $currentAgenda): self
    {
        $this->currentAgenda = $currentAgenda;

        return $this;
    }

    /**
     * @return Collection|Agenda[]
     */
    public function getAgendas(): Collection
    {
        return $this->agendas;
    }

    public function addAgenda(Agenda $agenda): self
    {
        if (!$this->agendas->contains($agenda)) {
            $this->agendas[] = $agenda;
            $agenda->setMeeting($this);
        }

        return $this;
    }

    public function removeAgenda(Agenda $agenda): self
    {
        $this->agendas->removeElement($agenda);

        return $this;
    }

    public function getAdmins(): Collection
    {
        return $this->getMeetingUsersByRole(MeetingUser::ROLE_ADMIN);
    }

    public function getWriters(): Collection
    {
        return $this->getMeetingUsersByRole(MeetingUser::ROLE_WRITER);
    }

    public function getReaders(): Collection
    {
        return $this->getMeetingUsersByRole(MeetingUser::ROLE_READER);
    }

    public function getVoters(): Collection
    {
        return $this->getMeetingUsersByRole(MeetingUser::ROLE_VOTER);
    }

    public function addMeetingUser(MeetingUser $meetingUser): self
    {
        if (!$this->meetingUsers->contains($meetingUser) &&
            !$this->meetingUsers->filter(fn (MeetingUser $mu) => $mu->getUser() === $meetingUser->getUser())->count()
        ) {
            $this->meetingUsers[] = $meetingUser;
            $meetingUser->setMeeting($this);
        }

        return $this;
    }

    public function removeMeetingUser(MeetingUser $meetingUser): self
    {
        $this->meetingUsers->removeElement($meetingUser);

        return $this;
    }

    private function getMeetingUsersByRole(string $role): Collection
    {
        return $this->meetingUsers->filter(
            fn (MeetingUser $meetingUser) => in_array(MeetingUser::ROLE_ADMIN, $meetingUser->getRoles())
        );
    }
}
