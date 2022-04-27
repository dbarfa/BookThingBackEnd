<?php

namespace App\App\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();


        $data['data'] = array(
            'email' => 'test',
        );

        $event->setData($data);
    }
}