<?php


namespace App\Controller;

use App\Entity\MeetingUser;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;

class GetMeetingsByUser
{
    public function __invoke(User $data): Collection
    {
        return $data->getMeetingUsers()->map(fn (MeetingUser $meetingUser) => $meetingUser->getMeeting());
    }
}
