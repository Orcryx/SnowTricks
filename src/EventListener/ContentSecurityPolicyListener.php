<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ContentSecurityPolicyListener
{
    public function onKernelResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $response->headers->set('Content-Security-Policy', "frame-src 'self' https://www.youtube.com;");
    }
}
