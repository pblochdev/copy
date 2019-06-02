<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalendarController extends Controller
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function index()
    {
        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }
}
