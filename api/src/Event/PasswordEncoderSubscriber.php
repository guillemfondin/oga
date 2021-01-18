<?php

namespace App\Event;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function in_array;

final class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @return array<string, array<int, int|string>>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]
        ];
    }

    /**
     * @param ViewEvent $event
     */
    public function encodePassword(ViewEvent $event): void
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($user instanceof User && $this->isAuthorizedMethods($method)) {
            $this->setPassword($user);
        }
    }

    private function setPassword(User $user): void
    {
        if ('' === $user->getPassword() || null === $user->getPassword()) {
            return;
        }

        $hash = $this->encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);
    }

    private function isAuthorizedMethods(string $method): bool
    {
        $authorizedMethods = [
            Request::METHOD_PATCH,
            Request::METHOD_POST,
        ];

        return in_array($method, $authorizedMethods);
    }
}
