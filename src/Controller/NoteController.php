<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends Controller
{
    /**
     * @Route("/note", name="note")
     */
    public function index()
    {
        $note = new Note;
        $form = $this->createForm(NoteType::class, $note);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            $this->addFlash('success', 'Task created!');
        }
        
        return $this->render('note/index.html.twig', array(
            'form'  => $form->createView()
        ));
    }
}
