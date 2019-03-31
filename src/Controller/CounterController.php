<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Counter;
use App\Entity\CounterHistory;
use App\Form\CounterHistoryType;
use App\Form\CounterType;
use Symfony\Component\HttpFoundation\Request;
use App\Services\FormErrors;

class CounterController extends Controller
{
    /**
     * @Route("/add-counter", name="add_counter")
     */
    public function addCounter(Request $request, FormErrors $formErrors)
    {
        $counter = new Counter;
        $form = $this->createForm(CounterType::class, $counter);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $counter = $form->getData();
                $counter->setUserId($this->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($counter);
                $em->flush();
                $this->addFlash('success', 'Counter created');
            } else {
                // dump($formErrors->getErrors($form));
            }
        }

        return $this->render('counter/add-counter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/counter-list", name="counter_list")
     */
    public function list(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Counter::class);

        $counters = $repository->findBy([
            'user' => $this->getUser()->getId(),
        ], [
            'id' => 'DESC'
        ]);
        
        return $this->render('counter/list.html.twig', array(
            'counters' => $counters, 
        ));
    }

    /**
     * @Route("/counter-details/{counterId}", name="counter_details")
     */
    public function counterDetails($counterId)
    {
        $repository = $this->getDoctrine()->getRepository(Counter::class);
        $counter = $repository->find($counterId);

        return $this->render('counter/details.html.twig', array(
            'counter' => $counter
        ));
    }

}
