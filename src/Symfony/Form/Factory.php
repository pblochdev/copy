<?php

namespace App\Symfony\Form;

use Symfony\Component\Form\FormFactory;


class Factory extends FormFactory
{
	public function getJsonErrors()
	{
		$errors = $this->getErrors();
		dump($errors);
	}
}