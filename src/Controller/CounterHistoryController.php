<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\CounterHistory;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CounterHistoryType;
use App\Entity\Counter;

class CounterHistoryController extends Controller
{
	/**
	 * @Route("/add-history/{counterId}", name="add_counter_history")
	 */
	public function addHistory($counterId)
	{
		if (!empty($counterId)) {
			$repository = $this->getDoctrine()->getRepository(Counter::class);

			$counter = $repository->findOneBy([
				'id' => $counterId,
				'user' => $this->getUser()->getId()
			]);
			$counterHistory = new CounterHistory;
			$counterHistory->setCounterId($counter);
			$em = $this->getDoctrine()->getManager();
			$em->persist($counterHistory);
			$em->flush();
			return $this->redirectToRoute('counter_list');
		}
	}
}