<?php

namespace App\Services;

class FormJson
{
	public function getJson($form)
	{
		$jsonForm = [];

		foreach($form as $child) {
			$jsonForm[] = [
				'name' => $child->getName(),
				'attr' => $child->getConfig()->getOptions()['attr']
			];
		}

		return json_encode($jsonForm);
	}
}