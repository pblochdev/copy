<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Workout;

class TimelineController extends Controller
{
    /**
     * @Route("/timeline", name="timeline")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Workout::class);
        $workouts = $repository->getTimeline($this->getUser()->getId());

        return $this->render('timeline/index.html.twig', [
            'workouts' => $workouts
        ]);
    }
}
