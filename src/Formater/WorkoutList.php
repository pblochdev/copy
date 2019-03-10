<?php

namespace App\Formater;

use Symfony\Component\Routing\RouterInterface;

class WorkoutList
{
	protected $router;

	public function __construct(RouterInterface $router)
	{
		$this->router = $router;
	}

	public function format($data)
	{
		foreach ($data as &$item) {
			$item['remove_url'] = $this->getUrl('workout_remove', $item['id']);
			$item['details_url'] =  $this->getUrl('workout_details', $item['id']);
		}

		return $data;
	}

	protected function getUrl($urlName, $itemId)
	{
		return $this->router->generate($urlName, [
			'workoutId' => $itemId
		]);
	}
}