<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller
{
    /**
     * @Route("/note", name="add_note")
     */
    public function index(Request $request)
    {
        $note = new Note;
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);
        var_dump($this->getUser()->getId());
        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $note->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            $this->addFlash('success', 'Task created!');
        }
        else {
            $this->addFlash('error', 'Not valid!');
        }

        return $this->render('note/index.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/list", name="list")
     */
    public function list()
    {
        $repository = $this->getDoctrine()->getRepository(Note::class);

        $notes = $repository->findBy([
            'user' => $this->getUser()->getId()
        ]);
            
        return $this->render('note/list.html.twig', array(
            'notes' => $notes
        ));
    }
}
