<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Excercise;
use App\Entity\Workout;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Formater\ExcerciseList;

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

        $response = new JsonResponse([
            'result' => 'success'
        ]);
        
        return $response;
    }

    /**
     * @Route("/workout-details/{workoutId}", name="api_workout_details")
     */
    public function getExcercises($workoutId, ExcerciseList $formatter)
    {
        $workoutRepository = $this->getDoctrine()->getRepository(Workout::class);
        $workout = $workoutRepository->findOneBy([
            'id' => $workoutId,
            'user' => $this->getUser()
        ]);
        if (!$workout) {
            throw new \Exception("Workout not found");
        }

        $excercieRepository = $this->getDoctrine()->getRepository(Excercise::class);

        $excercises = $excercieRepository->findBy([
            'status' => 1,
            'workout' => $workoutId
        ]);

        $excercises = array_map(function($object) {
            return $object->toArray();
        }, $excercises);
        $excercises = $formatter->format($excercises);

        $response = new JsonResponse($excercises);

        return $response;
    }
}
