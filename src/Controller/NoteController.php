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
        $user = $this->getUser();
        $notes = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $note->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            $this->addFlash('success', 'Task created!');
        }

        $repository = $this->getDoctrine()->getRepository(Note::class);
        if ($user) {
            $notes = $repository->findBy([
                'user' => $this->getUser()->getId(),
                'status' => 1
            ], [
                'id' => 'DESC'
            ]);
        }

        return $this->render('note/list.html.twig', array(
            'notes' => $notes,
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/list-done", name="list_done")
     */
    public function listDone(Request $request)
    {
        $note = new Note;
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);
        $user = $this->getUser();
        $notes = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $note->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            $this->addFlash('success', 'Task created!');
        }

        $repository = $this->getDoctrine()->getRepository(Note::class);
        if ($user) {
            $notes = $repository->findBy([
                'user' => $this->getUser()->getId(),
                'status' => 2
            ], [
                'id' => 'DESC'
            ]);
        }

        return $this->render('note/list-done.html.twig', array(
            'notes' => $notes,
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("note-remove/{noteId}", name="note_remove")
     */
    public function remove($noteId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $note = $entityManager->getRepository(Note::class)->findOneBy([
            'id' => $noteId,
            'user' => $this->getUser()->getId(),
        ]);

        if (!$note) {
            throw $this->createNotFoundException(
                'Note not found '. $noteId
            );
        }
        
        $note->setStatus(0);
        $entityManager->flush();

        return $this->redirectToRoute('list');
    }


    /**
     * @Route("note-done/{noteId}", name="note_done")
     */
    public function done($noteId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $note = $entityManager->getRepository(Note::class)->findOneBy([
            'id' => $noteId,
            'user' => $this->getUser()->getId(),
        ]);

        if (!$note) {
            throw $this->createNotFoundException(
                'Note not found '.$id
            );
        }
        
        $note->setStatus(2);
        $note->setDoneAt(new \DateTime());
        $entityManager->flush();

        return $this->redirectToRoute('list');
    }
}
