<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Workout;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ExcerciseType;
use App\Entity\Excercise;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Formater\WorkoutList;
use App\Services\FormErrors;
use App\Services\FormJson;

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

    /**
     * @Route("/add-workout", name="add_workout")
     */
    public function add()
    {
        $user = $this->getUser();

        $workout = new Workout();
        $workout->setUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($workout);
        $em->flush();

        return $this->redirectToRoute('workout_details', ['workoutId' => $workout->getId()]);
    }

    /**
     * @Route("/workout-list", name="workout_list")
     */
    public function list(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Workout::class);
        $workouts = $repository->findBy([
            'user' => $this->getUser(),
            'status' => 1
        ]);

        return $this->render('workout/list.html.twig', [
            'workouts' => $workouts
        ]);
    }

    /**
     * @Route("/workout-list-json", name="workout_list_json")
     */
    public function listJson(WorkoutList $formater)
    {
        $repository = $this->getDoctrine()->getRepository(Workout::class);
        $workouts = $repository->findBy([
            'user' => $this->getUser(),
            'status' => 1
        ]);
            
        
        $workouts = array_map(function($object) {
            return $object->toArray();
        }, $workouts);

        $workouts = $formater->format($workouts);

        $response = new JsonResponse($workouts);
        return $response;
    }

    /**
     * @Route("/workout/{workoutId}", name="workout_details")
     */
    public function details($workoutId, Request $request, FormErrors $formErrors, FormJson $formJson)
    {
        $workoutRepository = $this->getDoctrine()->getRepository(Workout::class);
        $workout = $workoutRepository->findOneBy([
            'id' => $workoutId,
            'user' => $this->getUser()
        ]);
        if (!$workout) {
            throw new \Exception("Workout not found");
        }
        
        return $this->render('workout/details.html.twig', [
            'workout' => $workout,
        ]);
    }


    /**
     * @Route("/workout-remove/{workoutId}", name="workout_remove")
     */
    public function remove($workoutId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $workoutRrepository = $entityManager->getRepository(Workout::class);
        $workout = $workoutRrepository->findOneBy([
            'user' => $this->getUser(),
            'id' => $workoutId
        ]);

        if (!$workout) {
            throw $this->createNotFoundException(
                'Workout not found ' . $workoutId
            );
        }

        $workout->setStatus(0);
        $entityManager->persist($workout);
        $entityManager->flush();

        $response = new JsonResponse([
            'result' => 'success'
        ]);
        
        return $response;
    }

}
