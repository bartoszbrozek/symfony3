<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class BartekController {

    /**
     * @Route("/bartek")
     */
    public function showAction() {
        return new Response('Działa');
    }

}
