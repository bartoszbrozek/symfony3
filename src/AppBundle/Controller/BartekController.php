<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BartekController extends Controller {

    /**
     * @Route("/bartek/{name}")
     */
    public function showAction($name) {

        $notes = [
            1 => 'costam',
            2 => 'nie',
            3 => 'tak'
        ];

        return $this->render('bartek/show.html.twig', [
                    'name' => $name,
                    'notes' => $notes
                        ]
        );
    }

}
