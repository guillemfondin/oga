<?php


namespace App\Entity\Interfaces;

use App\Entity\Agenda;
use DateTimeInterface;

interface VoteInterface
{
    public function getId(): ?int;

    public function getAgenda(): Agenda;

    public function setAgenda(Agenda $agenda): self;

    public function getVotedAt(): DateTimeInterface;

    public function setVotedAt(DateTimeInterface $votedAt): self;
}
