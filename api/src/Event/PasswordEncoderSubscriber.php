<?php

namespace App\Event;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
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
     * @return array
     */
    #[ArrayShape([KernelEvents::VIEW => "array"])] public static function getSubscribedEvents(): array
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

        if ($user instanceof User &&
            $this->isAuthorizedMethods($method) &&
            '' !== $user->getPassword() &&
            null !== $user->getPassword()
        ) {
            $this->setPassword($user);
        }
    }

    private function setPassword(User $user): void
    {
        $hash = $this->encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);
    }

    #[Pure] private function isAuthorizedMethods(string $method): bool
    {
        $authorizedMethods = [
            Request::METHOD_PATCH,
            Request::METHOD_POST,
        ];

        return in_array($method, $authorizedMethods);
    }
}
