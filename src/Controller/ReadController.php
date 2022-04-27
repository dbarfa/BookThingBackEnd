<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class ReadController extends AbstractFOSRestController
{
    #[Post('/api/read/add', name: 'add_read')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    public function index()
    {
        return;
    }
}
