<?php


namespace App\Controller;

use App\Entity\Meeting;
use Symfony\Component\Security\Core\Exception\LogicException;

class NextAgendaMeetingController
{
    public function __invoke(Meeting $data): Meeting
    {
        $agenda = $data->getCurrentAgenda();

        if (!$data->getAgendas()->contains($agenda)) {
            throw new LogicException("This agenda isn't in the list of this meeting");
        }

        if (!$agenda) {
            $next = $data->getAgendas()->first();
        } else {
            dump($data->getAgendas()->current());
            $index = $data->getAgendas()->indexOf($agenda);
            dump($data->getAgendas()->current());
            $next = $data->getAgendas()->get($index);
            dd($data->getAgendas()->current());
        }

        $data->setCurrentAgenda($next);
        return $data;
    }
}
