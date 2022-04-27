<?php

namespace App\App\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;
class JWTDecodedListener
{
    /**
     * @param JWTDecodedEvent $event
     *
     * @return void
     */
    public function onJWTDecoded(JWTDecodedEvent $event)
    {
        $payload = $event->getPayload();
        $payload['email'] = 'test';
        $event->setPayload($payload);
    }
}