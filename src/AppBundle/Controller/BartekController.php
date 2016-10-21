<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

//use Symfony\Component\Validator\Constraints\DateTime;

class BartekController extends Controller {

    /**
     * @Route("/add")
     */
    public function newAction(Request $request) {
        $task = new Task();

        $task->setTitle('Nowe zadanie');
        $task->setDate(new \DateTime());

        $form = $this->createFormBuilder($task)
                ->add('title', TextType::class)
                ->add('content', TextareaType::class)
                ->add('date', DateType::class)
                ->add('submit', SubmitType::class, ['label' => 'Utwórz zadanie'])
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $task = $form->getData();

            var_dump($task);

            $pdo = $this->container->get('db1');

            $query = $pdo->prepare("INSERT INTO notes (title, content, date) VALUES (?,?,?)");
            $query->bindValue(1, $task->getTitle());
            $query->bindValue(2, $task->getContent());
            $query->bindValue(3, $task->getDate()->format("Y-m-d H:i:m"));

            $query->execute();

            echo $task->getTitle();
            echo $task->getDate()->format("Y-m-d");
            return $this->redirectToRoute('success');
        }

        return $this->render('default/form-addNote.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/success")
     */
    public function succes() {
        return $this->render('default/success.html.twig', ['text' => 'Wszystko gra!']);
        //  return Response();
    }

    /**
     * @Route("/bartek/{name}")
     */
    public function showAction($name) {

        $pdo = $this->container->get('db1');

        $query = $pdo->prepare("SELECT * FROM notes");
        $query->execute();
        $query = $query->fetchAll();

        $login = $this->container->getParameter('database_host');

        $notes = [
            1 => 'costam',
            2 => 'nie',
            3 => 'tak'
        ];

        return $this->render('bartek/show.html.twig', [
                    'name' => $name,
                    'notes' => $notes,
                    'login' => $login
                        ]
        );
    }

    /**
     * @Route("/notes")
     * @Method("GET")
     */
    public function getNotesAction($msg = '') {

        $pdo = $this->container->get('db1');

        $query = $pdo->prepare('SELECT * FROM notes');
        $query->execute();
        $notes = $query->fetchAll();

        return $this->render('default/notes.html.twig', [
                    'notes' => $notes,
                    'msg' => $msg
        ]);
    }

    /**
     * @Route("/notes/delete/{id}")
     * @param type $id
     */
    public function deleteNote($id) {
        $pdo = $this->container->get('db1');

        $query = $pdo->prepare('DELETE FROM notes WHERE id_note=?');
        $query->bindValue(1, $id);

        $query->execute();

        return $this->redirectToRoute("notes", ['msg' => 'Usunięto notatkę!']);
    }

    /**
     * @Route("/notes/edit")
     */
    public function editNote($id) {
        $task = new Task();



        $notes = $this->createFormBuilder($task)
                ->add('taskName', TextType::class)
                ->add('dueDate', DateType::class)
                ->add('submit', SubmitType::class, ['label' => 'Utwórz zadanie'])
                ->getForm();
    }

}
