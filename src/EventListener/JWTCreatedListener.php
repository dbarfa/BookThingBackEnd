<?php

namespace App\EventListener;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository= $userRepository;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event,

    )
    {
        $data = $event->getUser()->getUserIdentifier();
        $userRepo = $this->userRepository->findOneBy(['username'=>$data]);
        $payload['username']= $event->getUser()->getUserIdentifier();
        $payload['id'] = $userRepo->getId();
        $payload['role'] = $event->getUser()->getRoles();
        $event->setData($payload);

    }
}