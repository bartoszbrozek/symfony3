<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class BartekController extends Controller {

    /**
     * @Route("/bartek/{name}")
     */
    public function showAction($name) {

        $pdo = $this->container->get('db1');

        $query = $pdo->prepare("SELECT * FROM note");
        $query->execute();
        $query = $query->fetchAll();

        $login = $this->container->getParameter('database_host');

        $notes = [
            1 => 'costam',
            2 => 'nie',
            3 => 'tak'
        ];

        var_dump($query);

        return $this->render('bartek/show.html.twig', [
                    'name' => $name,
                    'notes' => $notes,
                    'login' => $login
                        ]
        );
    }

    /**
     * @Route("/bartek/{name}/notes", name="notes")
     * @Method("GET")
     */
    public function getNotesAction() {

        $notes = [
                ['id' => 1, 'username' => 'Barteł', 'login' => 'dupa'],
                ['id' => 2, 'username' => 'Marteł', 'login' => 'zupa']
        ];

        $data = [
            'notes' => $notes
        ];

        return new JsonResponse($data);
    }

}
