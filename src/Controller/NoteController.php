<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\FormErrors;
use App\Formater\NoteList;
use Symfony\Component\HttpFoundation\JsonResponse;

class NoteController extends Controller
{
    /**
     * @Route("/notes-list", name="notes_list")
     */
    public function list(NoteList $noteListFormater)
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(Note::class);

        $notes = $repository->findBy([
            'user' => $this->getUser()->getId(),
            'status' => 1
        ], [
            'id' => 'DESC'
        ]);
        
        $notes = array_map(function($item) {
            return $item->toArray();
        }, $notes);

        $notes = $noteListFormater->format($notes);
        
        return new JsonResponse($notes);
    }


    /**
     * @Route("/", name="list")
     */
    public function index(Request $request)
    {
        return $this->render('note/list.html.twig');
    }


    /**
     * @Route("/list-done", name="list_done")
     */
    public function listDone(Request $request, FormErrors $formErrors)
    {
        $note = new Note;
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);
        $user = $this->getUser();
        $notes = [];

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $note = $form->getData();
                $note->setUser($this->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($note);
                $em->flush();
                $this->addFlash('success', 'Task created!');
            } else {
            }   
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
     * @Route("add-note", name="add_note")
     */
    public function addNote(Request $request, FormErrors $formErrors)
    {
        $form = $this->createForm(NoteType::class);
        $form->handleRequest($request);
        $response = [];

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $note = $form->getData();
                $note->setUser($this->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($note);
                $em->flush();
                $response = [
                    'result' => 'success'
                ];
            } else {
                $response = [
                    'result' => 'invalid',
                    'errors' => $formErrors->getErrors($form)
                ];
            }
        }

        return new JsonResponse($response);
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

        return new JsonResponse([
            'result' => 'success'
        ]);
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

        return new JsonResponse([
            'result' => 'success'
        ]);
    }
}
