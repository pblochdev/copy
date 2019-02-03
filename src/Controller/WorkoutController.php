<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WorkoutController extends Controller
{
    /**
     * @Route("/workout", name="workout")
     */
    public function index()
    {
        return $this->render('workout/index.html.twig', [
            'controller_name' => 'WorkoutController',
        ]);
    }
}
