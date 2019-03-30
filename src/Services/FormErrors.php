<?php 

namespace App\Services;

class FormErrors
{
	public function getJson($form)
	{
		$errors = [];
		foreach ($form as $child) {
			if (!$child->isValid()) {
				foreach ($child->getErrors() as $error) {
					$errors[$child->getName()][] = $error->getMessage();
				}
			}
		}
		
		return $errors;
	}
}
