<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Excercise;

class ExcerciseController extends Controller
{
    /**
     * @Route("/excercise", name="excercise")
     */
    public function index()
    {
        return $this->render('excercise/index.html.twig', [
            'controller_name' => 'ExcerciseController',
        ]);
    }

    /**
     * @Route("/excercise-remove/{excerciseId}", name="excercise_remove")
     */
    public function remove($excerciseId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $excerciseRepository = $entityManager->getRepository(Excercise::class);
        $excercise = $excerciseRepository->findOneBy([
            'id' => $excerciseId,
            // 'user' => $this->getUser()->getId()
        ]);
        
        if (!$excercise) {
            throw $this->createNotFoundException(
                'Excercise not found ' . $excerciseId
            );
        }

        $excercise->setStatus(0);
        $entityManager->persist($excercise);
        $entityManager->flush();

        return $this->redirectToRoute('workout_details', [
            'workoutId' => $excercise->getWorkout()->getId()
        ]);
    }
}
