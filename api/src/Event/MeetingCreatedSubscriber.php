<?php

namespace App\Event;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Meeting;
use App\Entity\MeetingUser;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;
use function in_array;

final class MeetingCreatedSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    private Security $security;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(Security $security, EntityManagerInterface $manager)
    {
        $this->security = $security;
        $this->manager = $manager;
    }

    /**
     * @return array<string, array<int, int|string>>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['setOwner', EventPriorities::POST_WRITE]
        ];
    }

    /**
     * @param ViewEvent $event
     * @throws ORMException
     */
    public function setOwner(ViewEvent $event): void
    {
        $meeting = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($meeting instanceof Meeting && $this->isAuthorizedMethods($method)) {
            /** @var User $user */
            $user = $this->security->getUser();
            $meetingUser = (new MeetingUser())
                ->setMeeting($meeting)
                ->setUser($user)
                ->setRoles([MeetingUser::ROLE_ADMIN])
            ;

            $this->manager->persist($meetingUser);
            $this->manager->flush();
        }
    }

    private function isAuthorizedMethods(string $method): bool
    {
        $authorizedMethods = [
            Request::METHOD_POST,
        ];

        return in_array($method, $authorizedMethods);
    }
}
