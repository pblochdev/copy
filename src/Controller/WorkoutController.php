<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Workout;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ExcerciseType;
use App\Entity\Excercise;

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
     * @Route("/workout/{workoutId}", name="workout_details")
     */
    public function details($workoutId, Request $request)
    {
        $workoutRepository = $this->getDoctrine()->getRepository(Workout::class);
        $workout = $workoutRepository->findOneBy([
            'id' => $workoutId,
            // 'excercise_id' => 1
        ]);
        if (!$workout) {
            throw new \Exception("Workout not found");
        }

        $excercieRepository = $this->getDoctrine()->getRepository(Excercise::class);

        $excercises = $excercieRepository->findBy([
            'status' => 1,
            'workout' => $workoutId
        ]);

        $form = $this->createForm(ExcerciseType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $excercise = $form->getData();
            $excercise->setWorkout($workout);
            $excercise->setOrderOfExcercise(count($workout->getExcercises()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($excercise);
            $em->flush();
            return $this->redirect($request->getUri());
        }

        return $this->render('workout/details.html.twig', [
            'workout' => $workout,
            'excercises' => $excercises,
            'form' => $form->createView()
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

        return $this->redirectToRoute('workout_list');
    }

}