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
        
        return $this->render('note/index.html.twig', array(
            'form'  => $form->createView()
        ));
    }
}
