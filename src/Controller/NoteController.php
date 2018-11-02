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

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $note->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            $this->addFlash('success', 'Task created!');
        }

        return $this->render('note/index.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/", name="list")
     */
    public function list(Request $request)
    {
        $note = new Note;
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $note->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            $this->addFlash('success', 'Task created!');
        }

        $repository = $this->getDoctrine()->getRepository(Note::class);

        $notes = $repository->findBy([
            'user' => $this->getUser()->getId()
        ], [
            'id' => 'DESC'
        ]);

        return $this->render('note/list.html.twig', array(
            'notes' => $notes,
            'form' => $form->createView()
        ));
    }
}
