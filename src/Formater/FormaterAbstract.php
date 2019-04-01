<?php

namespace App\Formater;

use Symfony\Component\Routing\RouterInterface;

abstract class FormaterAbstract {

	protected $router;

	public function __construct(RouterInterface $router)
	{
		$this->router = $router;
	}

	abstract public function format($data);

	protected function getUrl($urlName, $itemId, $key)
	{
		return $this->router->generate($urlName, [
			$key => $itemId
		]);
	}
}