<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class BartekController extends Controller {
    /**
     * @Route("/")
     */
    
    public function newAction(Request $request) {
        $task = new Task();

        $task->setTaskName('Nowe zadanie');
        $task->setDueDate(new \DateTime());

        $form = $this->createFormBuilder($task)
                ->add('taskName', TextType::class)
                ->add('dueDate', DateType::class)
                ->add('submit', SubmitType::class, ['label' => 'Utwórz zadanie'])
                ->getForm();

        return $this->render('default/new.html.twig', ['form' => $form->createView()]);
    }

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
