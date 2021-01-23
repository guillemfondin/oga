<?php

namespace App\Event;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

final class JwtCreatedSubscriber
{
    public function updateJwtData(JWTCreatedEvent $event): void
    {
        /** @var User $user */
        $user = $event->getUser();
        $data = $event->getData();

        $data['id'] = $user->getId();

        $event->setData($data);
    }
}
