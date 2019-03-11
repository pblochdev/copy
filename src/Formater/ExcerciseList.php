<?php

namespace App\Formater;

use Symfony\Component\Routing\RouterInterface;

class ExcerciseList
{
	protected $router;

	public function __construct(RouterInterface $router)
	{
		$this->router = $router;
	}

	public function format($data)
	{
		foreach ($data as &$item) {
			$item['remove_url'] = $this->getUrl('excercise_remove', $item['id']);
		}

		return $data;
	}

	protected function getUrl($urlName, $itemId)
	{
		return $this->router->generate($urlName, [
			'excerciseId' => $itemId
		]);
	}
}